<div class="allergolog-block second">
    <h2>Все виды анализов</h2>
  <?
  global $arTheme;
  $APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "sections_compact",
    Array(
      "IBLOCK_TYPE" => "aspro_max_catalog",
      "IBLOCK_ID" => 26,
      "SECTION_ID" => 381,
      "SECTION_CODE" => "allergodiagnostika_immunocap",
      "DISPLAY_PANEL" => "",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => 36000,
      "CACHE_GROUPS" => "N",
      "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
      "ADD_SECTIONS_CHAIN" => "N",
      "SHOW_SECTION_LIST_PICTURES" => "N",
      "TOP_DEPTH" => 1,
      "FILTER_NAME" => "arSubSectionFilter",
      "CACHE_FILTER" => "Y",
      "SHOW_ICONS" => "Y",
      "COUNT_ELEMENTS" => "Y",
      "SECTION_USER_FIELDS" => array(
        0 => "UF_CATALOG_ICON",
        1 => "UF_SECTION_LANDING_PAGE"
      ),
      "SECTION_FIELDS" => array(
        0 => "ID",
        1 => "IBLOCK_ID",
        2 => "PICTURE"
      ),
      "NO_MARGIN" => "Y",
      "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE"
    ),
    $component
  );?>
</div>