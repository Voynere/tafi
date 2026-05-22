<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$url = explode('?', $_SERVER['REQUEST_URI'])[0];
if($arResult["NEW_TEMPLATE"] == 1 && $url != '/services/'):?>
    <div class="nsections__container nsections__bottom">
        <?
        $APPLICATION->SetPageProperty("HIDE_LEFT_BLOCK", "Y");?>
        <div class="nsections__faq">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "items-list-faq",
                Array(
                    'COUNT_IN_LINE' => 3,
                    'SHOW_SECTION_PREVIEW_DESCRIPTION' => 'Y',
                    'SHOW_SECTION_NAME' => 'N',
                    'VIEW_TYPE' => 'accordion',
                    'SHOW_TABS' => 'N',
                    'IMAGE_POSITION' => 'left',
                    'IBLOCK_TYPE' => 'aspro_max_content',
                    'IBLOCK_ID' => 5,
                    'NEWS_COUNT' => 20,
                    'SORT_BY1' => 'SORT',
                    'SORT_ORDER1' => 'ASC',
                    'SORT_BY2' => 'ID',
                    'SORT_ORDER2' => 'DESC',
                    'FIELD_CODE' => array(
                        'PREVIEW_TEXT',
                        'PREVIEW_PICTURE',
                    ),
                    'PROPERTY_CODE' => array(
                        'TITLE_BUTTON',
                        'LINK_BUTTON',
                    ),
                    'DISPLAY_PANEL' => '',
                    'SET_TITLE' => 'Y',
                    'SET_STATUS_404' => 'N',
                    'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                    'ADD_SECTIONS_CHAIN' => 'N',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => 100000,
                    'CACHE_FILTER' => 'N',
                    'CACHE_GROUPS' => 'N',
                    'DISPLAY_TOP_PAGER' => 'N',
                    'DISPLAY_BOTTOM_PAGER' => 'Y',
                    'PAGER_TITLE' => 'Новости',
                    'PAGER_TEMPLATE' => '.default',
                    'PAGER_SHOW_ALWAYS' => 'N',
                    'PAGER_DESC_NUMBERING' => 'N',
                    'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
                    'PAGER_SHOW_ALL' => 'N',
                    'DISPLAY_DATE' => '',
                    'DISPLAY_NAME' => 'Y',
                    'DISPLAY_PICTURE' => '',
                    'DISPLAY_PREVIEW_TEXT' => '',
                    'PREVIEW_TRUNCATE_LEN' => '',
                    'ACTIVE_DATE_FORMAT' => 'd.m.Y',
                    'USE_PERMISSIONS' => 'N',
                    'GROUP_PERMISSIONS' => '',
                    'FILTER_NAME' => '',
                    'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
                    'CHECK_DATES' => 'Y',
                    'PARENT_SECTION' => '745',
                    'PARENT_SECTION_CODE' => '',
                    'INCLUDE_SUBSECTIONS' => 'Y',
                    'SHOW_DETAIL_LINK' => 'Y',
                    'SPECIAL_PAGE_TITLE' => 'Правила подготовки к УЗИ',
                ),
                $component
            );
            ?>
        </div>
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/include/uzi/contacts.php"
            )
          );?>
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => "/include/uzi/address.php"
            )
          );?>
        <?
        $APPLICATION->IncludeComponent(
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
        <?/*
        <div id="hiddenBreadcrumbs" class="hidden">
            <?
            $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => SITE_ID,
                "SHOW_SUBSECTIONS" => "N"
            ),
                false
            );
            ?>
        </div>
        */?>
    </div>
<? endif; ?>
