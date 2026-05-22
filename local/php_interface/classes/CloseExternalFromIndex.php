<?php

/**
 * Обработчик события OnEndBufferContent для Bitrix
 * Закрывает от индексации все внешние скрипты, стили и ссылки
 * (те, что ведут не на https://tafimed.ru/)
 *
 * Подключение: в файле /local/php_interface/init.php
 * AddEventHandler("main", "OnEndBufferContent", ["CloseExternalFromIndex", "Handle"]);
 */

class CloseExternalFromIndex
{
    /**
     * Ваш домен — всё, что ссылается НЕ на него, будет закрыто от индексации.
     * Можно передавать массив допустимых доменов.
     */
    private static array $allowedHosts = [
        'tafimed.ru',
        'www.tafimed.ru',
    ];

    /**
     * Главный метод-обработчик события.
     *
     * @param string &$content HTML-контент страницы (передаётся по ссылке)
     */
    public static function Handle(string &$content): void
    {
        // Не трогаем ответы без HTML (JSON, файлы и т.д.)
        if (!self::isHtmlResponse()) {
            return;
        }

        // 1. Закрываем внешние <script src="..."> тегом <noindex>
        $content = self::closeExternalScripts($content);

        // 2. Закрываем внешние <link rel="stylesheet" href="..."> тегом <noindex>
        $content = self::closeExternalStyles($content);

        // 3. Добавляем rel="nofollow noopener" к внешним <a href="...">
        $content = self::closeExternalLinks($content);
    }

    // -------------------------------------------------------------------------
    // Приватные методы
    // -------------------------------------------------------------------------

    /**
     * Проверяет, что текущий ответ — HTML.
     */
    private static function isHtmlResponse(): bool
    {
        foreach (headers_list() as $header) {
            if (stripos($header, 'Content-Type:') === 0) {
                return stripos($header, 'text/html') !== false;
            }
        }
        // Если заголовок не выставлен явно — считаем HTML по умолчанию
        return true;
    }

    /**
     * Проверяет, является ли URL внешним (не принадлежащим разрешённым доменам).
     *
     * @param string $url
     * @return bool true — внешний, false — внутренний
     */
    private static function isExternalUrl(string $url): bool
    {
        $url = trim($url);

        // Относительные пути — внутренние
        if ($url === '' || $url[0] === '/' || str_starts_with($url, '#') || str_starts_with($url, '?')) {
            return false;
        }

        // Протокол-относительные ссылки //example.com/...
        if (str_starts_with($url, '//')) {
            $url = 'https:' . $url;
        }

        $host = parse_url($url, PHP_URL_HOST);

        if ($host === null || $host === false) {
            return false; // Не удалось распарсить — не трогаем
        }

        $host = strtolower(ltrim($host, 'www.'));

        foreach (self::$allowedHosts as $allowed) {
            $allowed = strtolower(ltrim($allowed, 'www.'));
            if ($host === $allowed || str_ends_with($host, '.' . $allowed)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Оборачивает внешние <script src="..."> в <noindex>...</noindex>.
     */
    private static function closeExternalScripts(string $content): string
    {
        // Ищем теги <script ... src="..."> ... </script>
        return preg_replace_callback(
            '/<script\b([^>]*)\bsrc\s*=\s*(["\'])([^"\']+)\2([^>]*)>(.*?)<\/script>/is',
            static function (array $m): string {
                $src = $m[3];
                if (!self::isExternalUrl($src)) {
                    return $m[0]; // Внутренний — не трогаем
                }
                return '<noindex>' . $m[0] . '</noindex>';
            },
            $content
        );
    }

    /**
     * Оборачивает внешние <link rel="stylesheet" href="..."> в <noindex>...</noindex>.
     * Также обрабатывает <link rel="preload"> и другие ресурсные теги.
     */
    private static function closeExternalStyles(string $content): string
    {
        return preg_replace_callback(
            '/<link\b([^>]*)\bhref\s*=\s*(["\'])([^"\']+)\2([^>]*)>/i',
            static function (array $m): string {
                $href = $m[3];

                // Обрабатываем только ресурсные link-теги (не canonical, не hreflang)
                $fullTag = $m[0];
                $attrs   = $m[1] . $m[4];
                if (preg_match('/\brel\s*=\s*["\']([^"\']+)["\']/i', $attrs, $relMatch)) {
                    $rel = strtolower($relMatch[1]);
                    // Пропускаем SEO-теги
                    if (in_array($rel, ['canonical', 'alternate', 'hreflang', 'next', 'prev'], true)) {
                        return $fullTag;
                    }
                }

                if (!self::isExternalUrl($href)) {
                    return $fullTag;
                }

                return '<noindex>' . $fullTag . '</noindex>';
            },
            $content
        );
    }

    /**
     * Добавляет rel="nofollow noopener" ко всем внешним <a href="...">.
     * Если rel уже есть — дополняет его, не заменяет.
     */
    private static function closeExternalLinks(string $content): string
    {
        return preg_replace_callback(
            '/<a\b([^>]*)\bhref\s*=\s*(["\'])([^"\']+)\2([^>]*)>/i',
            static function (array $m): string {
                $href       = $m[3];
                $attrsBefore = $m[1];
                $attrsAfter  = $m[4];

                if (!self::isExternalUrl($href)) {
                    return $m[0];
                }

                // Собираем все атрибуты кроме rel
                $allAttrs = $attrsBefore . $attrsAfter;

                // Ищем существующий rel
                $existingRel = '';
                $allAttrs = preg_replace_callback(
                    '/\brel\s*=\s*(["\'])([^"\']*)\1/i',
                    static function (array $rm) use (&$existingRel): string {
                        $existingRel = $rm[2];
                        return ''; // Убираем старый rel, добавим новый ниже
                    },
                    $allAttrs
                );

                // Формируем новый rel
                $relParts = array_unique(array_filter(
                    array_merge(
                        preg_split('/\s+/', $existingRel),
                        ['nofollow', 'noopener']
                    )
                ));
                $newRel = implode(' ', $relParts);

                return '<a' . $allAttrs . ' href=' . $m[2] . $href . $m[2] . ' rel="' . $newRel . '">';
            },
            $content
        );
    }
}