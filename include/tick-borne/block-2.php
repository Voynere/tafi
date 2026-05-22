<div class="tickborne__second">
  <h2>Выберите подходящее исследование</h2>
  
  <?php
  // Устанавливаем фильтр по ID товаров
  $GLOBALS['arrFilter'] = array(
      "ID" => array(1905, 1922, 1923, 1925, 1927, 1928, 1931, 1355, 1359)
  );
  ?>

  <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"tick_borne",
	Array(
		"AJAX_REQUEST" => "N",
		"ALT_TITLE_GET" => "NORMAL",
		"COMPATIBLE_MODE" => "Y",
		"DISPLAY_TYPE" => "block",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter",
		"IBLOCK_ID" => 26,
		"IBLOCK_TYPE" => "aspro_max_catalog",
		"INCLUDE_SUBSECTIONS" => "N",
		"IS_CATALOG_PAGE" => "Y",
		"LINE_ELEMENT_COUNT" => 4,
		"PAGE_ELEMENT_COUNT" => 20,
		
		// ВАЖНО: Добавляем эти параметры
		"SHOW_ALL_WO_SECTION" => "Y", // Показывать товары без привязки к разделу
		"SET_TITLE" => "N", // Не устанавливать заголовок
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N", // Не добавлять раздел в навигационную цепочку
		"SET_STATUS_404" => "N", // Не выдавать 404, если товары не найдены
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		
		// Добавляем базовые параметры для каталога
		"PRICE_CODE" => array("BASE"), // Укажите код вашей цены
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		
		// Параметры для работы с количеством
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SHOW_QUANTITY" => "Y",
		"SHOW_QUANTITY_COUNT" => "Y",
		
		// Добавляем настройки кэширования
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => 36000,
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "Y",
		
		"PROPERTY_CODE" => array(), // Оставьте пустым или укажите нужные свойства
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"SET_LINE_ELEMENT_COUNT" => null,
		"SET_SKU_TITLE" => null,
		"SHOW_BIG_BLOCK" => "N",
		"SHOW_COUNTER_LIST" => "Y",
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_UNABLE_SKU_PROPS" => "N",
		"STORES" => array(),
		"TYPE_SKU" => "TYPE_1",
		"USE_REGION" => "N"
	),
	$component,
	Array('HIDE_ICONS' => '={$isAjax}')
);?>
</div>