<?php
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$GLOBALS['arrFilter'] = [];

if (!empty($_POST['filters']) && is_array($_POST['filters'])) 
{
    foreach ($_POST['filters'] as $filterItem) 
        {
        if (!empty($filterItem['NAME']) && isset($filterItem['VALUE'])) 
        {
            $GLOBALS['arrFilter'][$filterItem['NAME']] = explode('$', $filterItem['VALUE']);
        }
    }
}

$params = array(
    "IBLOCK_TYPE"        => "aspro_max_content",
    "IBLOCK_ID"          => 80,
    "NEWS_COUNT"         => 12,
    "SORT_BY1"           => "ACTIVE_FROM",
    "SORT_ORDER1"        => "DESC",
    "SORT_BY2"           => "SORT",
    "SORT_ORDER2"        => "ASC",
    "FIELD_CODE"         => array(
        0 => "",
        1 => "",
    ),
    "PROPERTY_CODE"      => array(
        0 => "PROP_POSITION",
        1 => "PROP_EXPERIENCE",
        2 => "PROP_ADDRESS",
        3 => "PROP_CATEGORY",
        4 => "PROP_APPOINTMENT_LINK",
        5 => ""
    ),
    "DETAIL_URL"         => "/doctors/#ELEMENT_CODE#/",
    "SECTION_URL"        => "/doctors/",
    "IBLOCK_URL"         => "/doctors/",
    "SET_TITLE"          => "Y",
    "SET_LAST_MODIFIED"  => "N",
    "MESSAGE_404"        => "",
    "SET_STATUS_404"     => "Y",
    "SHOW_404"           => "Y",
    "FILE_404"           => "",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "CACHE_TYPE"         => "A",
    "CACHE_TIME"         => 36000000,
    "CACHE_FILTER"       => "N",
    "CACHE_GROUPS"       => "Y",
    "DISPLAY_TOP_PAGER"  => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE"        => "Новости",
    "PAGER_TEMPLATE"     => "doctors",
    "PAGER_SHOW_ALWAYS"  => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => 36000,
    "PAGER_SHOW_ALL"     => "N",
    "PAGER_BASE_LINK_ENABLE" => "Y",
    "PAGER_BASE_LINK"      => "/doctors/",
    "PAGER_PARAMS_NAME"    => "",
    "DISPLAY_DATE"         => "Y",
    "DISPLAY_NAME"         => "Y",
    "DISPLAY_PICTURE"        => "Y",
    "DISPLAY_PREVIEW_TEXT"   => "Y",
    "PREVIEW_TRUNCATE_LEN"   => 0,
    "ACTIVE_DATE_FORMAT"     => "d.m.Y",
    "USE_PERMISSIONS"        => "N",
    "GROUP_PERMISSIONS"      => array(
        0 => 1,
    ),
    "FILTER_NAME" => "arrFilter",
    "USE_FILTER" => "Y",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "CHECK_DATES" => "Y",
    "FORM_CODE" => 'MAKE_AN_APPOINTMENT',
);

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"doctors_listing",
	$params,
	$component
);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');