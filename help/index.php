<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Помощь пациенту «ТАФИ-Диагностика»");
$APPLICATION->SetTitle("Помощь пациенту «ТАФИ-Диагностика»");
?>

<section class="help">
  <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
      "AREA_FILE_SHOW" => "file",
      "AREA_FILE_SUFFIX" => "inc",
      "EDIT_TEMPLATE" => "",
      "PATH" => "/include/recom/prepare.php"
    )
  );?>
  <?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
      "AREA_FILE_SHOW" => "file",
      "AREA_FILE_SUFFIX" => "inc",
      "EDIT_TEMPLATE" => "",
      "PATH" => "/include/recom/recom.php"
    )
  );?>
  <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "recom_for_patients",
    Array(
      "ACTIVE_DATE_FORMAT" => "d.m.Y",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "ALL_URL" => "lookbooks/",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "Y",
      "COMPONENT_TEMPLATE" => "recom_for_patients",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "DISPLAY_DATE" => "Y",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "Y",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "FIELD_CODE" => array(0=>"",1=>"",),
      "FILTER_NAME" => "",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "HIDE_SECTION_NAME" => "Y",
      "IBLOCK_ID" => "76",
      "IBLOCK_TYPE" => "aspro_max_content",
      "IMAGE_POSITION" => "left",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "INCLUDE_SUBSECTIONS" => "Y",
      "MESSAGE_404" => "",
      "MOBILE_TEMPLATE" => "N",
      "NEWS_COUNT" => "20",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => ".default",
      "PAGER_TITLE" => "Новости",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "PREVIEW_TRUNCATE_LEN" => "",
      "PROPERTY_CODE" => array(0=>"",1=>"",),
      "SALE_MODE" => "N",
      "SET_BROWSER_TITLE" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "N",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "N",
      "SHOW_404" => "N",
      "SHOW_DETAIL_LINK" => "Y",
      "SIZE_IN_ROW" => "4",
      "SORT_BY1" => "ACTIVE_FROM",
      "SORT_BY2" => "SORT",
      "SORT_ORDER1" => "DESC",
      "SORT_ORDER2" => "ASC",
      "STRICT_SECTION_CHECK" => "N",
      "S_ASK_QUESTION" => "",
      "S_ORDER_SERVICE" => "",
      "TITLE_BLOCK" => "Новости",
      "TITLE_BLOCK_ALL" => "Все новости",
      "T_DOCS" => "",
      "T_GALLERY" => "",
      "T_GOODS" => "",
      "T_PROJECTS" => "",
      "T_REVIEWS" => "",
      "T_SERVICES" => "",
      "T_STAFF" => "",
      "USE_SHARE" => "N"
    )
  );?>
  <?/*$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
      "AREA_FILE_SHOW" => "file",
      "AREA_FILE_SUFFIX" => "inc",
      "EDIT_TEMPLATE" => "",
      "PATH" => "/include/recom/faq-title.php"
    )
  );?>
  <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "help-faq",
    Array(
      "ACTIVE_DATE_FORMAT" => "",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "N",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "N",
      "COMPONENT_TEMPLATE" => "help-faq",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "Y",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "FIELD_CODE" => array(0=>"",1=>"",),
      "FILTER_NAME" => "",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "IBLOCK_ID" => "5",
      "IBLOCK_TYPE" => "aspro_max_content",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "INCLUDE_SUBSECTIONS" => "Y",
      "MESSAGE_404" => "",
      "NEWS_COUNT" => "",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => "",
      "PAGER_TITLE" => "",
      "PARENT_SECTION" => "10",
      "PARENT_SECTION_CODE" => "",
      "PREVIEW_TRUNCATE_LEN" => "",
      "PROPERTY_CODE" => array(0=>"",1=>"",),
      "SET_BROWSER_TITLE" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "N",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "N",
      "SHOW_404" => "N",
      "SORT_BY1" => "SORT",
      "SORT_BY2" => "ACTIVE_FROM",
      "SORT_ORDER1" => "ASC",
      "SORT_ORDER2" => "ASC",
      "STRICT_SECTION_CHECK" => "N"
    ),
    $component
  );*/?>
  <?$APPLICATION->IncludeComponent(
      "bitrix:main.include",
      "",
      Array(
          "AREA_FILE_SHOW" => "file",
          "AREA_FILE_SUFFIX" => "inc",
          "EDIT_TEMPLATE" => "",
          "PATH" => "/include/recom/help-links.php"
      )
  );?>
  <?$APPLICATION->IncludeComponent(
    "aspro:social.info.max",
    "help_social",
    array(
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "TITLE_BLOCK" => "",
      "COMPONENT_TEMPLATE" => "help_social"
    ),
    false
  );?>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>