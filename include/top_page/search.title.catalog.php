<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"mega_menu", 
	[
		"CATEGORY_0" => [
			0 => "iblock_aspro_max_catalog",
			1 => "iblock_aspro_max_content",
		],
		"CATEGORY_0_TITLE" => "ALL",
		"CATEGORY_0_iblock_aspro_max_adv" => [
			0 => "27",
			1 => "34",
		],
		"CATEGORY_0_iblock_aspro_max_catalog" => [
			0 => "26",
		],
		"CATEGORY_0_iblock_aspro_max_content" => [
			0 => "22",
			1 => "80",
		],
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
		"PRICE_CODE" => [
			0 => "BASE",
		],
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
		"CATEGORY_0_main" => "",
		"CATEGORY_0_forum" => [
			0 => "all",
		],
		"CATEGORY_0_iblock_aspro_max_regionality" => [
			0 => "all",
		],
		"CATEGORY_0_iblock_rest_entity" => [
			0 => "all",
		],
		"CATEGORY_0_blog" => [
			0 => "all",
		]
	],
	false,
	[
		"ACTIVE_COMPONENT" => "Y"
	]
);?>