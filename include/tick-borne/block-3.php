<div class="tickborne__second">
  <h2>Узнайте, есть ли иммунитет (антитела) к инфекции</h2>
  
  <?php
  // Устанавливаем фильтр по ID товаров
  $GLOBALS['arrFilter'] = array(
      "ID" => array(4804, 3669)
  );
  ?>

  <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"tick_borne",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_REQUEST" => "N",
		"ALT_TITLE_GET" => "NORMAL",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => 36000,
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DISPLAY_TYPE" => "block",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => 26,
		"IBLOCK_TYPE" => "aspro_max_catalog",
		"INCLUDE_SUBSECTIONS" => "N",
		"IS_CATALOG_PAGE" => "Y",
		"LINE_ELEMENT_COUNT" => 4,
		"MESSAGE_404" => "",
		"PAGE_ELEMENT_COUNT" => 20,
		"PRICE_CODE" => array("BASE"),
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(),
		"SEF_URL_TEMPLATES" => array("sections"=>"","section"=>"#SECTION_CODE_PATH#/","element"=>"#SECTION_CODE_PATH#/#ELEMENT_CODE#/","compare"=>"compare.php?action=#ACTION_CODE#","smart_filter"=>"#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LINE_ELEMENT_COUNT" => null,
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_SKU_TITLE" => null,
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_BIG_BLOCK" => "N",
		"SHOW_COUNTER_LIST" => "Y",
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_QUANTITY" => "Y",
		"SHOW_QUANTITY_COUNT" => "Y",
		"SHOW_UNABLE_SKU_PROPS" => "N",
		"STORES" => array(),
		"TYPE_SKU" => "TYPE_1",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REGION" => "N"
	),
$component,
Array(
	'HIDE_ICONS' => '={$isAjax}'
)
);?>
</div>