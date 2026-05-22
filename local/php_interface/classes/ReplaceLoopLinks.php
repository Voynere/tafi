<?php
/**
 * Удаляет/обезвреживает самоссылки (цикличные ссылки вида страница -> ссылка на саму себя)
 * на фронте, не трогая админку и пагинацию.
 */

final class ReplaceLoopLinks
{
    /**
     * Не трогаем пагинацию Bitrix: ?PAGEN_1=2 и т.п.
     */
    private const PAGINATION_RE = '~(?:^|[?&])PAGEN(?:_\d+)?=\d+~i';

    /**
     * Метки, которые часто встречаются в самоссылках и не меняют контент страницы.
     * Если ссылка отличается от текущей страницы только ими — считаем самоссылкой.
     */
    private const TRACKING_KEYS = [
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
        'gclid', 'yclid', 'fbclid', 'ymclid', 'openstat', 'from', 'ref',
    ];

    public static function Handle(string &$content): void
    {
        global $APPLICATION;

        if (!is_object($APPLICATION)) {
            return;
        }

        // Админка / панель — не трогаем.
        if (defined('ADMIN_SECTION') || !empty($APPLICATION->PanelShowed)) {
            return;
        }

        $curUri = (string)($_SERVER['REQUEST_URI'] ?? '');
        if ($curUri === '') {
            return;
        }

        // На страницах пагинации ничего не меняем.
        if (preg_match(self::PAGINATION_RE, $curUri)) {
            return;
        }

        $curPath = self::normalizePath(parse_url($curUri, PHP_URL_PATH) ?: '/');
        $curHost = strtolower((string)($_SERVER['HTTP_HOST'] ?? ''));
        $curHost = ltrim($curHost, 'www.');

        // Важно: заменяем целиком <a ...>...</a> на <span>...</span>,
        // иначе некоторые сканеры всё равно считают такой <a> "ссылкой" даже без href.
        $pattern = '/<a\b([^>]*)\bhref\s*=\s*(["\'])([^"\']*)\2([^>]*)>(.*?)<\/a>/is';
        $content = preg_replace_callback(
            $pattern,
            static function (array $m) use ($curUri, $curPath, $curHost): string {
                $fullTag = $m[0];
                $attrsBefore = $m[1];
                $hrefRaw = trim(html_entity_decode($m[3], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $attrsAfter = $m[4];
                $innerHtml = $m[5];

                if ($hrefRaw === '' || $hrefRaw[0] === '#') {
                    return $fullTag;
                }

                // mailto/tel/javascript — не трогаем
                if (preg_match('~^(?:mailto:|tel:|javascript:)~i', $hrefRaw)) {
                    return $fullTag;
                }

                // Протокол-относительные
                if (str_starts_with($hrefRaw, '//')) {
                    $hrefRaw = 'https:' . $hrefRaw;
                }

                $hrefHost = '';
                $hrefPath = '';
                $hrefQuery = '';

                // Абсолютная ссылка?
                $parsed = @parse_url($hrefRaw);
                if (is_array($parsed) && isset($parsed['host'])) {
                    $hrefHost = strtolower((string)$parsed['host']);
                    $hrefHost = ltrim($hrefHost, 'www.');
                    $hrefPath = (string)($parsed['path'] ?? '/');
                    $hrefQuery = (string)($parsed['query'] ?? '');
                } else {
                    // Относительная ссылка
                    $hrefPath = (string)parse_url($hrefRaw, PHP_URL_PATH);
                    $hrefQuery = (string)parse_url($hrefRaw, PHP_URL_QUERY);
                    if ($hrefPath === '' && str_starts_with($hrefRaw, '?')) {
                        // чисто query на текущую страницу
                        $hrefPath = $curPath;
                        $hrefQuery = ltrim($hrefRaw, '?');
                    }
                }

                $hrefPathNorm = self::normalizePath($hrefPath ?: '/');

                // Если ссылка на другой хост — не считаем самоссылкой.
                if ($hrefHost !== '' && $curHost !== '' && $hrefHost !== $curHost) {
                    return $fullTag;
                }

                // Пагинацию не трогаем.
                if ($hrefQuery !== '' && preg_match(self::PAGINATION_RE, '?' . $hrefQuery)) {
                    return $fullTag;
                }

                $isSamePath = ($hrefPathNorm === $curPath);
                if (!$isSamePath) {
                    // Попытка: href может быть задан как полный REQUEST_URI
                    $hrefUriPath = self::normalizePath((string)parse_url($hrefRaw, PHP_URL_PATH));
                    if ($hrefUriPath !== '' && $hrefUriPath === $curPath) {
                        $isSamePath = true;
                    }
                }

                if (!$isSamePath) {
                    return $fullTag;
                }

                // Если отличается только трекинг-метками — тоже считаем самоссылкой.
                if ($hrefQuery !== '' && !self::isOnlyTrackingQuery($hrefQuery)) {
                    // Это может быть фильтр/сортировка — не ломаем.
                    return $fullTag;
                }

                // Обезвреживаем: превращаем в <span>, чтобы не было тега <a> вообще.
                // Сохраняем data-* и class, удаляем href/target/rel/onclick.
                $attrs = trim($attrsBefore . ' ' . $attrsAfter);
                $attrs = preg_replace('~\s+\b(?:href|target|rel|onclick)\s*=\s*(["\']).*?\1~is', '', ' ' . $attrs);
                $attrs = preg_replace('~\s+~', ' ', trim($attrs));

                $span = '<span data-loop="true" aria-current="page"' . ($attrs !== '' ? ' ' . $attrs : '') . '>' . $innerHtml . '</span>';
                $span = preg_replace('~<span\s+~i', '<span ', $span);

                return $span;
            },
            $content
        );
    }

    private static function normalizePath(string $path): string
    {
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('~/{2,}~', '/', $path);
        $path = preg_replace('~/index\.php$~i', '/', $path);
        if ($path === '') {
            $path = '/';
        }
        // Для директорий — завершающий слэш
        if ($path !== '/' && !preg_match('~\.[a-z0-9]+$~i', $path) && substr($path, -1) !== '/') {
            $path .= '/';
        }
        return $path;
    }

    private static function isOnlyTrackingQuery(string $query): bool
    {
        parse_str($query, $params);
        if (!is_array($params) || !$params) {
            return true;
        }

        $allowed = array_flip(self::TRACKING_KEYS);
        foreach ($params as $k => $v) {
            $k = strtolower((string)$k);
            if (!isset($allowed[$k])) {
                return false;
            }
        }
        return true;
    }
}

