<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="doctor-detail__epilog">
    <?php if (is_array($arResult['REVIEWS']) && count($arResult['REVIEWS']) > 0): ?>
        <div class="additional-container">
            <?php
            $GLOBALS['arrFilter'] = ['ACTIVE' => 'Y', 'ID' => $arResult['REVIEWS']];
            ?>
            <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "doctors_reviews",
            array(
                'IBLOCK_TYPE' => 'aspro_max_content',
                'IBLOCK_ID' => 19,
                'NEWS_COUNT' => 20,
                'SORT_BY1' => 'ACTIVE_FROM',
                'FILTER_NAME' => 'arrFilter',
                'SORT_ORDER1' => 'DESC',
                'SORT_BY2' => 'ID',
                'SORT_ORDER2' => 'DESC',
                'FIELD_CODE' => array(
                    'NAME',
                    'PREVIEW_TEXT',
                    'PREVIEW_PICTURE',
                    'DETAIL_TEXT',
                    'DETAIL_PICTURE',
                    'DATE_ACTIVE_FROM',
                ),
                'PROPERTY_CODE' => array(
                    'POST',
                    'VIDEO',
                    'STAFF',
                    'RATING',
                    'COMPANY_RESPONSE',
                    'NAME',
                    'MESSAGE',
                    'FILE',
                ),
                'AJAX_MODE' => 'N',
                'AJAX_OPTION_JUMP' => 'N',
                'AJAX_OPTION_STYLE' => 'Y',
                'AJAX_OPTION_HISTORY' => 'N',
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => 100000,
                'CACHE_FILTER' => 'N',
                'CACHE_GROUPS' => 'N',
                'PREVIEW_TRUNCATE_LEN' => '',
                'ACTIVE_DATE_FORMAT' => 'd.m.Y',
                'DISPLAY_PANEL' => '',
                'SET_TITLE' => 'N',
                'SHOW_DETAIL_LINK' => 'N',
                'SET_STATUS_404' => 'Y',
                'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                'ADD_SECTIONS_CHAIN' => 'N',
                'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
                'CHECK_DATES' => 'Y',
                'PARENT_SECTION' => '',
                'PARENT_SECTION_CODE' => '',
                'DISPLAY_TOP_PAGER' => 'N',
                'DISPLAY_BOTTOM_PAGER' => 'Y',
                'PAGER_SHOW_ALWAYS' => 'N',
                'PAGER_DESC_NUMBERING' => 'N',
                'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
                'PAGER_SHOW_ALL' => 'N',
                'DISPLAY_DATE' => '',
                'DISPLAY_NAME' => 'N',
                'DISPLAY_PICTURE' => '',
                'DISPLAY_PREVIEW_TEXT' => '',
                'USE_PERMISSIONS' => 'N',
                'GROUP_PERMISSIONS' => '',
                'SHOW_SECTION_PREVIEW_DESCRIPTION' => 'Y',
                'AJAX_OPTION_ADDITIONAL' => '',
                'SET_BROWSER_TITLE' => 'N',
                'SET_LAST_MODIFIED' => 'N',
                'INCLUDE_SUBSECTIONS' => 'Y',
                'STRICT_SECTION_CHECK' => 'N',
                'TITLE_BLOCK' => '',
                'TITLE_BLOCK_ALL' => '',
                'SHOW_ADD_REVIEW' => '',
                'TITLE_ADD_REVIEW' => '',
                'ALL_URL' => '',
                'PAGER_BASE_LINK_ENABLE' => 'N',
                'SHOW_404' => 'Y',
                'NOT_SLIDER' => 'N',
                'SIZE_IN_ROW' => '3'
            ),
            $component
        );?>
        </div>
    <?php endif; ?>

    <?php
    $GLOBALS['similarDoctors'] = [];
    $GLOBALS['similarDoctors']['!ID'] = $arResult['ID'];
    if (!empty($arResult['POSITION']))
    {
        $GLOBALS['similarDoctors']['PROPERTY_PROP_POSITION'] = $arResult['POSITION'];
    }
    if (!empty($arResult['CATEGORY']))
    {
        $GLOBALS['similarDoctors']['PROPERTY_PROP_CATEGORY'] = $arResult['CATEGORY'];
    }

    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "doctors_listing",
        array(
        "IS_DETAIL_PAGE" => 'Y',
        "IBLOCK_TYPE"        => "aspro_max_content",
        "IBLOCK_ID"          => 80,
        "NEWS_COUNT"         => 20,
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
            4 => "",
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
        "PAGER_TEMPLATE"     => ".default",
        "PAGER_SHOW_ALWAYS"  => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => 36000,
        "PAGER_SHOW_ALL"     => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_BASE_LINK"      => "",
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
        "FILTER_NAME" => "similarDoctors",
        "USE_FILTER" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "CHECK_DATES" => "Y",
    ),
        $component
    );
    ?>
</div>