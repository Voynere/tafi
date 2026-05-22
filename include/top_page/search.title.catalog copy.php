<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"mega_menu", 
	array(
		"CATEGORY_0" => array(
			0 => "no",
			1 => "main",
			2 => "forum",
			3 => "iblock_aspro_max_catalog",
			4 => "iblock_aspro_max_content",
			5 => "iblock_aspro_max_adv",
			6 => "iblock_aspro_max_regionality",
			7 => "iblock_rest_entity",
			8 => "blog",
			9 => "microblog",
		),
		"CATEGORY_0_TITLE" => "ALL",
		"CATEGORY_0_iblock_aspro_max_adv" => array(
			0 => "27",
			1 => "34",
		),
		"CATEGORY_0_iblock_aspro_max_catalog" => array(
			0 => "6",
			1 => "14",
			2 => "18",
			3 => "21",
			4 => "26",
			5 => "28",
			6 => "29",
			7 => "31",
			8 => "all",
		),
		"CATEGORY_0_iblock_aspro_max_content" => array(
			0 => "22",
		),
		"CATEGORY_OTHERS_TITLE" => "OTHER",
		"CHECK_DATES" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTAINER_ID" => "title-search_fixed",
		"CONVERT_CURRENCY" => "N",
		"INPUT_ID" => "title-search-input_fixed",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => CMax::GetFrontParametrValue("CATALOG_PAGE_URL"),
		"PREVIEW_HEIGHT" => "38",
		"PREVIEW_TRUNCATE_LEN" => "50",
		"PREVIEW_WIDTH" => "38",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"SEARCH_ICON" => $arParams["SEARCH_ICON"]=="Y"?"Y":"N",
		"SHOW_ANOUNCE" => "N",
		"SHOW_INPUT" => "Y",
		"SHOW_INPUT_FIXED" => "Y",
		"SHOW_OTHERS" => "N",
		"SHOW_PREVIEW" => "Y",
		"TOP_COUNT" => "10",
		"USE_LANGUAGE_GUESS" => "N",
		"COMPONENT_TEMPLATE" => "mega_menu",
		"CATEGORY_0_main" => array(
		),
		"CATEGORY_0_forum" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_aspro_max_regionality" => array(
			0 => "all",
		),
		"CATEGORY_0_iblock_rest_entity" => array(
			0 => "all",
		),
		"CATEGORY_0_blog" => array(
			0 => "all",
		)
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>