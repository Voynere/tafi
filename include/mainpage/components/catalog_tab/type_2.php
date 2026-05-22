<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}?>
<?$APPLICATION->IncludeComponent("aspro:tabs.max", "main_news", Array(
	"IBLOCK_TYPE" => "aspro_max_catalog",	// Тип инфоблока
		"IBLOCK_ID" => "26",	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"TABS_CODE" => "HIT",	// Свойства табов
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "arrFilterProp",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "9",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "5",
		"ADD_DETAIL_TO_SLIDER" => "Y",
		"PROPERTY_CODE" => array(	// Свойства
			0 => "CML2_ARTICLE",
			1 => "PROP_2084",
			2 => "PROP_2085",
			3 => "PROP_2086",
			4 => "PROP_2089",
			5 => "PROP_2090",
			6 => "PROP_2091",
			7 => "PROP_2092",
			8 => "PROP_2093",
			9 => "PROP_2094",
			10 => "",
		),
		"OFFERS_LIMIT" => "0",	// Максимальное количество предложений для показа (0 - все)
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => "/basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "Y",	// Выводить кнопку сравнения
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "Y",	// Использовать вывод цен с диапазонами
		"SHOW_ONE_CLICK_BUY" => "N",	// Отображать кнопку "купить в 1 клик"
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Отображать постраничную навигацию снизу
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "ajax",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISCOUNT_PRICE_CODE" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SHOW_ADD_FAVORITES" => "Y",
		"SHOW_ARTICLE_SKU" => "Y",
		"SECTION_NAME_FILTER" => "",
		"SECTION_SLIDER_FILTER" => "21",
		"COMPONENT_TEMPLATE" => "main",
		"OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "ID",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "ARTICLE",
			1 => "AGE",
			2 => "SIZES",
			3 => "",
		),
		"OFFER_TREE_PROPS" => array(	// Свойства отбора торговых предложений
			0 => "",
			1 => "SIZES",
			2 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
		"SHOW_MEASURE" => "Y",	// Отображать единицы измерения
		"OFFERS_CART_PROPERTIES" => "",	// Свойства предложений, добавляемые в корзину
		"DISPLAY_WISH_BUTTONS" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",	// Отображать экономию
		"SHOW_OLD_PRICE" => "Y",	// Отображать старую цену
		"SHOW_RATING" => "Y",	// Отображать рейтинг
		"MAX_GALLERY_ITEMS" => "5",	// Количество картинок в галерее
		"SHOW_GALLERY" => "Y",	// Отображать галерею
		"SHOW_PROPS" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",	// Свойство с дополнительными картинками
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"SALE_STIKER" => "SALE_TEXT",	// Свойство со стикером акций
		"FAV_ITEM" => "FAVORIT_ITEM",
		"SHOW_DISCOUNT_TIME" => "Y",	// Отображать срок действия скидки
		"STORES" => array(	// Склады
			0 => "",
			1 => "",
		),
		"STIKERS_PROP" => "",	// Свойство со стикерами
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "Y",	// Отображать процент экономии
		"SHOW_MEASURE_WITH_RATIO" => "Y",	// Выводить единицу измерения с коэффициентом при отображении минимальной цены для товаров с торговыми предложениями
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "Y",	// Отображать срок действия скидки для каждого торгового предложения
		"TITLE_BLOCK" => "Популярные анализы",	// Заголовок блока
		"TITLE_BLOCK_ALL" => "Весь каталог",	// Заголовок на все элементы
		"ALL_URL" => "catalog/",	// Ссылка на все элементы
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"ID_FOR_TABS" => "Y",
		"ADD_PICT_PROP_OFFER" => "MORE_PHOTO",	// Свойство торгового предложения с дополнительными картинками
		"USER_FIELDS" => array(	// Пользовательские поля наличия
			0 => "",
			1 => "",
		),
		"FIELDS" => array(	// Поля наличия
			0 => "",
			1 => "",
		)
	),
	false
);?>