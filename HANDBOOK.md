# 📖 Handbook проекта «ТАФИ» (tafimed.ru)

## 1. Общая информация

| Параметр | Значение |
|----------|----------|
| **CMS** | 1С-Битрикс (редакция «Малый бизнес» или выше) |
| **Шаблон** | Aspro Max (с кастомными переопределениями) |
| **Домен** | tafimed.ru |
| **Тип сайта** | Медицинские лаборатории и диагностические центры |
| **Мультирегиональность** | Aspro Regions (URL-префиксы: `/birobidzhan/`, `/ussuriysk/` и т.д.) |
| **БД** | MySQL (localhost), имя БД: `sitemanager` |
| **Сторонние зависимости** | dompdf, simplexlsx, itb/itb.seo, symfony/var-dumper (dev) |

---

## 2. Структура директорий

```
/ (корень сайта)
├── bitrix/                          # Системная директория Битрикс
│   ├── .settings.php                # Настройки подключения к БД, кеш, крипто
│   ├── header.php                   # Пролог (подключает main/include/prolog.php)
│   ├── footer.php                   # Эпилог
│   ├── urlrewrite.php               # Правила ЧПУ
│   ├── modules/                     # Установленные модули
│   ├── templates/                   # Шаблоны (системные)
│   │   └── aspro_max/               # Основной шаблон Aspro Max
│   ├── components/                  # Системные компоненты
│   └── php_interface/               # Системный php_interface (не используется)
│
├── local/                           # Локальная директория (НЕ теряется при обновлении)
│   ├── composer.json                # Composer-зависимости проекта
│   ├── composer.lock
│   ├── config/                      # Конфигурация
│   │   └── beeralex_core_options.php
│   ├── modules/                     # Локальные модули
│   │   ├── beeralex.core/           # Ядро Beeralex
│   │   ├── itb.import/              # Модуль импорта данных
│   │   ├── itb.licencecheck/        # Проверка лицензий
│   │   ├── itb.seo/                 # SEO-модуль
│   │   └── shestpa.lastmodified/    # Last-Modified заголовки
│   ├── templates/                   # Локальные переопределения шаблонов
│   │   ├── aspro_max/               # ★ Основной рабочий шаблон
│   │   ├── aspro_max_tafi-krasota/  # Шаблон для «Тафи-Красота»
│   │   └── aspro_max_v2/            # Версия 2 шаблона
│   ├── components/                  # Локальные компоненты
│   │   └── itb/
│   │       ├── menu.sections/       # Компонент меню разделов
│   │       ├── sale.order.ajax/     # Кастомное оформление заказа
│   │       └── subscribe.user.form/ # Форма подписки
│   ├── vendor/                      # Composer vendor
│   └── php_interface/               # ★ Основной php_interface
│       ├── init.php                 # Точки входа, обработчики событий
│       ├── autoload.php             # PSR-4 автозагрузка
│       ├── classes/                 # Кастомные классы
│       │   ├── CMaxCustom.php       # Расширение CMax (кастомное меню и пр.)
│       │   ├── CloseExternalFromIndex.php
│       │   ├── ReplaceLoopLinks.php
│       │   └── Custom/EventHandlers/Main.php
│       └── migrations/              # Миграции (Sprint Migration)
│
├── include/                         # Включаемые файлы (подключаются через main.include)
│   ├── phone_header.php             # Телефон в шапке (по умолчанию)
│   ├── phone_footer.php             # Телефон в подвале
│   ├── contacts-site-phone-one.php  # Единый номер на сайте
│   ├── contacts-site-schedule.php   # Расписание
│   ├── contacts-site-address.php    # Адрес
│   ├── contacts-site-email.php      # Email
│   ├── contacts_text.php            # Текст контактов
│   ├── contacts-regions.php         # Текст региональных контактов
│   ├── header-schedule.php          # Расписание в шапке
│   ├── schedule.php                 # Расписание
│   ├── consultation.php             # Блок консультации
│   ├── form-main.php               # Основная форма
│   └── ...                          # Другие включаемые файлы
│
├── ajax/                            # AJAX-обработчики
│   ├── action_basket.php            # Действия с корзиной
│   ├── auth.php                     # Авторизация
│   ├── city_chooser.php             # Выбор города
│   ├── city_select.php             # Выбор города (селект)
│   ├── delivery.php                 # Доставка
│   ├── doctorsFilter.php            # Фильтр врачей
│   ├── fast_view.php               # Быстрый просмотр
│   ├── form.php                     # Обработка форм
│   ├── one_click_buy.php           # Покупка в 1 клик
│   └── ...                          # Другие AJAX-обработчики
│
├── contacts/                        # Раздел «Контакты»
│   ├── index.php                    # Страница контактов (CMax::ShowPageType)
│   └── stores/                      # Филиалы/магазины
│       └── index.php                # ★ Страница филиалов
│
├── catalog/                         # Каталог
├── basket/                          # Корзина
├── order/                           # Оформление заказа
├── personal/                        # Личный кабинет
├── search/                          # Поиск
├── company/                         # О компании (новости, вакансии и пр.)
├── doctors/                         # Врачи
├── services/                        # Услуги
├── booking/                         # Онлайн-запись
├── landings/                        # Лендинги
├── upload/                          # Загруженные файлы
├── images/                          # Изображения
│
├── multidomain_check_city.php       # ★ Определение города по URL-префиксу
├── multidomain_robots.php           # Robots.txt для мультидоменности
├── multidomain_sitemap.php          # Sitemap для мультидоменности
├── sitemap.php                      # Основной sitemap
├── robots.php                       # Robots.txt (динамический)
├── 404.php                          # Страница 404
├── index.php                        # Главная страница
│
├── indexblocks_index1.php           # Блоки главной страницы
├── sotrudnichestvo.php              # Страница «Сотрудничество»
│
├── *.menu.php                       # Файлы меню (различные уровни)
├── .section.php                     # Параметры корневого раздела
├── .access.php                      # Права доступа
│
├── aspro_regions/                   # Роботы для регионов (robots.txt)
└── itb.import/                      # Директория для импортов
```

---

## 3. Модули Битрикс

### Системные модули
| Модуль | Назначение |
|--------|-----------|
| `main` | Ядро Битрикс |
| `iblock` | Информационные блоки |
| `catalog` | Товарный каталог |
| `sale` | Интернет-магазин (заказы, корзина) |
| `form` | Веб-формы |
| `search` | Поиск |
| `seo` | SEO-модуль |
| `landing` | Лендинги |
| `highloadblock` | Highload-блоки |

### Сторонние модули
| Модуль | Назначение |
|--------|-----------|
| `aspro.max` | ★ Ядро шаблона Aspro Max (CMax, CMaxRegionality, CMaxCache) |
| `itb.seo` | SEO-оптимизация от ITB |
| `itb.import` | Импорт данных |
| `itb.multidomains` | Мультидоменность |
| `itb.replacelooplink` | Замена зацикленных ссылок |
| `ittower.simpleprops` | Простые свойства |
| `sprint.migration` | Миграции (управление через админку) |
| `shestpa.lastmodified` | Last-Modified заголовки |
| `dev2fun.imagecompress` | Сжатие изображений |
| `dev2fun.redirects` | Редиректы |
| `rodzeta.redirect` | Редиректы |
| `b01110011.recaptcha` | reCAPTCHA |
| `wsrubi.smtp` | SMTP-отправка почты |
| `arturgolubev.orderletters` | Письма по заказам |
| `asd.nofollow` | Nofollow ссылки |
| `yandex.market` | Яндекс.Маркет |

---

## 4. Мультирегиональность

### Как работает

1. **URL-префикс** — запрос вида `/birobidzhan/contacts/stores/` обрабатывается файлом [`multidomain_check_city.php`](multidomain_check_city.php)
2. Скрипт извлекает первый сегмент пути (`birobidzhan`), ищет его в таблице БД `itb_domains` (поле `CODE`, где `ACTIVE='Y'`)
3. Если найден — устанавливает `$GLOBALS['CITY_CODE_VALUE']` и обрезает префикс из `REQUEST_URI`
4. Модуль Aspro Regions использует `CITY_CODE_VALUE` для загрузки данных региона: `$arRegion['PHONES']`, `$arRegion['LIST_STORES']` и т.д.

### Ключевые файлы
| Файл | Назначение |
|------|-----------|
| [`multidomain_check_city.php`](multidomain_check_city.php) | Определение города по URL |
| [`aspro:regionality.list.max`](bitrix/templates/aspro_max/components/aspro/regionality.list.max/) | Компонент выбора региона |
| [`bitrix/components/itb/multidomain.city.list`](bitrix/components/itb/multidomain.city.list/) | Список городов (мультидоменность) |
| [`defines.php`](bitrix/templates/aspro_max/defines.php:128) (строки 128–142) | Фильтр `$arRegionality` для контактов/магазинов |

### Фильтр региональности для магазинов

В [`defines.php`](bitrix/templates/aspro_max/defines.php:128) (строки 128–142):
```php
if($arRegion)
{
    if($arRegion['LIST_STORES'] && !in_array('component', $arRegion['LIST_STORES']))
    {
        if($arTheme['STORES_SOURCE']['VALUE'] != 'IBLOCK')
            $_SESSION['ASPRO_FILTER']['arRegionality'] = $GLOBALS['arRegionality'] = array('ID' => $arRegion['LIST_STORES']);
        else
            $_SESSION['ASPRO_FILTER']['arRegionality'] = $GLOBALS['arRegionality'] = array('PROPERTY_STORE_ID' => $arRegion['LIST_STORES']);
    }
}
```

---

## 5. Страница филиалов/магазинов

### Файл: [`contacts/stores/index.php`](contacts/stores/index.php)

Два режима работы в зависимости от настройки `STORES_SOURCE`:

| Режим | Компонент | Источник данных |
|-------|-----------|----------------|
| `!= 'IBLOCK'` | `bitrix:catalog.store` (шаблон `main`) | Сущности `CCatalogStore` (Торговые точки Битрикс) |
| `== 'IBLOCK'` | `bitrix:news` (шаблон `shops`) | Инфоблок #11 (`aspro_max_content`), свойства: PHONE, ADDRESS, SCHEDULE, MAP, METRO, EMAIL |

### Шаблоны компонентов
| Шаблон | Путь |
|--------|------|
| `news/shops` | [`bitrix/templates/aspro_max/components/bitrix/news/shops/`](bitrix/templates/aspro_max/components/bitrix/news/shops/) |
| `news.list/shops` | [`bitrix/templates/aspro_max/components/bitrix/news.list/shops/`](bitrix/templates/aspro_max/components/bitrix/news.list/shops/) |
| `catalog.store/main` | [`bitrix/templates/aspro_max/components/bitrix/catalog.store/main/`](bitrix/templates/aspro_max/components/bitrix/catalog.store/main/) |
| `catalog.store.list/main` | [`bitrix/templates/aspro_max/components/bitrix/catalog.store.list/main/`](bitrix/templates/aspro_max/components/bitrix/catalog.store.list/main/) |

### Рендеринг списка магазинов

Все шаблоны вызывают [`CMax::drawShopsList()`](bitrix/modules/aspro.max/classes/general/CMax.php:9548) — метод из модуля `aspro.max`.

---

## 6. Телефоны на сайте

### Источники телефонов

| Расположение | Источник | Файл |
|-------------|----------|------|
| **Шапка (header)** | `$arRegion['PHONES']` (для региона) или `$arTheme['HEADER_PHONES']` (глобально) | [`page_blocks/header/header_*.php`](bitrix/templates/aspro_max/page_blocks/header/header_1.php) → `CMax::ShowHeaderPhones()` |
| **Подвал (footer)** | Аналогично шапке + [`include/phone_footer.php`](include/phone_footer.php) | `page_blocks/footer/footer_*.php` |
| **Карточка магазина** | Свойство `PHONE` элемента инфоблока #11 или сущности `CCatalogStore` | [`news.list/shops/template.php`](bitrix/templates/aspro_max/components/bitrix/news.list/shops/template.php) → `CMax::drawShopsList()` |
| **Шапка (include)** | [`include/phone_header.php`](include/phone_header.php) — статичный файл | `+7 (423) 242-56-60` |
| **Подвал (include)** | [`include/phone_footer.php`](include/phone_footer.php) — статичный файл | `+7 (423) 242-56-60` |
| **Контактный блок** | [`include/contacts-site-phone-one.php`](include/contacts-site-phone-one.php) | `+7 (423) 242-56-60` |

### Как телефон отображается в хедере (header_1.php)

```php
$arRegion['PHONES']  // Если регион определён и есть телефоны — используются региональные
$arTheme['HEADER_PHONES']  // Иначе — глобальные из настроек темы
CMax::ShowHeaderPhones('no-icons')  // Рендерит HTML телефонов
```

---

## 7. Информационные блоки (IBLOCKS)

| ID | Тип | Назначение |
|----|-----|-----------|
| 11 | `aspro_max_content` | Филиалы/магазины (shops) |
| 26 | ? | Врачи (с TAGS) |
| ? | `aspro_max_catalog` | Каталог товаров |

> Точные ID инфоблоков можно узнать в админке: Контент → Информационные блоки.

---

## 8. Кастомные обработчики событий ([`init.php`](local/php_interface/init.php))

| Событие | Обработчик | Назначение |
|---------|-----------|-----------|
| `main::OnEndBufferContent` | `ReplaceLoopLinks::Handle` | Удаление зацикленных ссылок |
| `main::OnEndBufferContent` | `CloseExternalFromIndex::Handle` | Закрытие внешних ссылок на главной |
| `main::OnEndBufferContent` | `deleteKernelJs2` / `deleteKernelCss2` | Удаление ядра Битрикс для Lighthouse |
| `search::BeforeIndex` | `SiteHelper::BeforeIndexHandler` | Добавление TAGS в индекс |
| `main::OnBeforeUserRegister` | `setEmail` | Валидация ФИО при регистрации |
| `sale::OnOrderNewSendEmail` | `bxAddPickupPointToMail` | Добавление данных ПВЗ в письмо о заказе |

---

## 9. Git-workflow

Файл [`.gitignore`](.gitignore) настроен так, что:

- **Хранятся в Git:**
  - `local/templates/` (все локальные шаблоны)
  - `local/php_interface/` (кастомные классы, миграции)
  - `local/components/` (кастомные компоненты)
  - `local/modules/` (локальные модули)
  - `bitrix/templates/` (шаблоны)
  - `bitrix/components/` (кроме `bitrix/components/bitrix/`)
  - Корневые `.php`, `.menu.php` файлы
  - `include/`, `ajax/`, и секции контента

- **НЕ хранятся:**
  - `/bitrix/` (системные файлы, кроме templates/components)
  - `/upload/` (загруженные файлы)
  - `/vendor/` (Composer)
  - `*.sql`, `*.zip`, `*.log`, медиафайлы
  - `.env`, `.idea/`, `.vscode/`

---

## 10. Админка Битрикс

- **URL:** `https://tafimed.ru/bitrix/admin/`
- **Настройки шаблона:** Настройки → Настройки продукта → Сайты → Шаблоны сайтов → Aspro Max
- **Инфоблоки:** Контент → Информационные блоки
- **Регионы:** Настройки Aspro Max → Региональность
- **Торговые точки:** Контент → Торговые точки (если STORES_SOURCE != IBLOCK)
- **Формы:** Сервис → Веб-формы
- **Миграции:** Сервис → Sprint Migration

---

## 11. Быстрый поиск по задачам

| Задача | Где искать |
|--------|-----------|
| Изменить телефон в шапке | Админка → Aspro Max → Настройки → HEADER_PHONES, или [`include/phone_header.php`](include/phone_header.php) |
| Изменить телефон региона | Админка → Aspro Max → Региональность → Редактирование региона → PHONES |
| Изменить телефон магазина (филиала) | **Админка → Контент → Торговые точки** → редактирование точки → поле PHONE |
| Изменить расписание | [`include/contacts-site-schedule.php`](include/contacts-site-schedule.php) или свойство SCHEDULE в инфоблоке |
| Изменить адрес | [`include/contacts-site-address.php`](include/contacts-site-address.php) или свойство ADDRESS в инфоблоке |
| Добавить новый филиал | Админка → Инфоблок #11 → Добавить элемент |
| Изменить главную страницу | [`index.php`](index.php), [`indexblocks_index1.php`](indexblocks_index1.php) |
| Настроить редиректы | [`rodzeta.redirect`](bitrix/modules/rodzeta.redirect/) или [`dev2fun.redirects`](bitrix/modules/dev2fun.redirects/) |
| Запустить миграцию | Админка → Сервис → Sprint Migration |
| Поискать обработчик | [`local/php_interface/init.php`](local/php_interface/init.php) |

---

## 12. Технические заметки

- **Lighthouse-оптимизация:** в [`init.php`](local/php_interface/init.php:158) есть обработчики `deleteKernelJs2`/`deleteKernelCss2`, которые удаляют ядро Битрикс при запросе от Chrome-Lighthouse
- **Debug-функция:** [`fDebug($data)`](local/php_interface/init.php:31) — записывает в `/debugfile.txt`
- **Dump-функция:** [`dds($data)`](local/php_interface/init.php:114) — выводит `<pre>` + запись в `_dump.log`
- **Autoloader:** [`autoload.php`](local/php_interface/autoload.php) — PSR-4 автозагрузка для namespace `Custom\` и `Itb\`
- **SMTP:** модуль `wsrubi.smtp` подключён в [`init.php`](local/php_interface/init.php:25)
- **Каталог по умолчанию:** товарный IBLOCK определяется через `CMaxCache::$arIBlocks[SITE_ID]['aspro_max_catalog']`
- **⚠️ Композитный кеш:** страница филиалов [`contacts/stores/index.php`](contacts/stores/index.php:25) использует `COMPOSITE_FRAME_MODE => "A"`. После изменения данных торговых точек **обязательно** очищать композитный кеш: Админка → Настройки → Производительность → Очистить кеш композитных страниц. Обычная очистка кеша компонентов **НЕ сбрасывает** композитный кеш. Хранится в `/bitrix/html_pages/`.
- **⚠️ JS-подмена телефонов (UTM):** в [`local/templates/aspro_max/js/custom.js`](local/templates/aspro_max/js/custom.js:472) есть UTM-скрипт, который заменяет **ВСЕ** ссылки `tel:` и элементы `.phone-number` на дефолтный номер (`defaultPhone`). Конфиг: `CONFIG.utmToPhone` — маппинг UTM-параметров на номера, `CONFIG.defaultPhone` — номер по умолчанию, `CONFIG.excludeContainers` — CSS-селекторы контейнеров, внутри которых номера НЕ заменяются (карточки магазинов). **JS-файл кешируется браузером 30 дней** (`max-age=2592000`) — после изменений нужен Ctrl+Shift+R или открытие файла JS напрямую для обновления кеша.

---

## 13. Информация о сервере

| Параметр | Значение |
|----------|----------|
| **IP** | 62.113.97.133 |
| **SSH** | `root@62.113.97.133` (порт 22) |
| **Платформа** | Bitrix Virtual Appliance 7.5.2 |
| **Директория сайта** | `/home/bitrix/www/` |
| **Git** | Инициализирован, ветка `master` |
| **БД** | MySQL, база `sitemanager` |

---

## 14. Журнал изменений

### 27.05.2026

**Телефоны филиалов Биробиджана:**
- Проблема: JS-скрипт UTM-подмены телефонов в [`custom.js`](local/templates/aspro_max/js/custom.js:472) заменял все `tel:` ссылки на дефолтный Владивостокский номер
- Исправление: добавлен `excludeContainers` — CSS-селекторы контейнеров карточек магазинов, внутри которых номера не заменяются
- Git-коммит на сервере: `7d73753`

**Привязка товаров к разделам (IBLOCK 26):**
- Проблема: 149 товаров не были привязаны к разделам
- Решение: автоматическая привязка на основе Excel-прайс-листа + маппинг по ключевым словам
- Результат: 122 из 149 привязаны, 27 остались (генетика, патанатомия, новые анализы)
- Git-коммит на сервере: `b040e54`

**Обновление цен на странице «Выезд на дом»:**
- Файл: [`component_epilog.php`](local/templates/aspro_max/components/bitrix/news.detail/news/component_epilog.php)
- Обновлены цены в двух массивах (строки 298-322 и 652-676)
- Git-коммит на сервере: `21aeb2b`
