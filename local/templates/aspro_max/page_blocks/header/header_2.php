<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $arRegion, $bLongHeader, $bColoredHeader;
$arRegions = CMaxRegionality::getRegions();
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
$bLongHeader = true;
$bColoredHeader = true;
?>

<div class="main-header">

    <div class="maxwidth-theme">

        <div class="main-header__wrapper">

            <div class="main-header__top">

                <div class="main-header__logo">
                    <?=CMax::ShowLogo();?>
                </div>

                <div class="main-header__city">

                    <?$APPLICATION->IncludeComponent(
                            "itb:multidomain.city.list",
                            "",
                            Array(
                                    "COMPONENT_TEMPLATE" => ".default"
                            )
                    );?>

                </div>

                <div class="main-header__search">

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

                </div>
                
                <div class="main-header__phone">

                    <div class="main-header__phone-value">
                        <?$APPLICATION->IncludeFile(
                        "/include/phone_header.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "Телефон"));?>
                        
                    </div>

                    <div class="main-header__phone-caption">
                        Контактный центр
                    </div>
                    
                </div>


                <div class="main-header__callback">
					<a href="https://tafimed.ru/booking/"> <button class="header-callback-btn" type="button">Онлайн-запись к врачу</button></a>
					<!--data-event="jqm" data-param-form_id="SIGN_UP_ONLINE" data-name="SIGN_UP_ONLINE"-->
                </div>

            </div>


            <div class="main-header__row">

                <div class="main-header__menu">
               
                    <?$APPLICATION->IncludeComponent(
        "bitrix:menu", 
                        "main-nav-menu", 
                        array(
                            "CHILD_MENU_TYPE" => "left",
                            "COMPONENT_TEMPLATE" => "main-nav-menu",
                            "COUNT_ITEM" => "6",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "4",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "36000",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "ROOT_MENU_TYPE" => "top_content_multilevel",
                            "USE_EXT" => "Y",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                        ),
                        false
                    );?>             

                </div>

                <div class="main-header__personal">

                    <div class="main-header__personal-view tooltip-block">
                        <button type="button" class="bvi-speech bvi-open main-header__personal-view-btn">
                            <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.5417 8C13.5417 9.65685 12.1986 11 10.5417 11C8.88489 11 7.54175 9.65685 7.54175 8C7.54175 6.34315 8.88489 5 10.5417 5C12.1986 5 13.5417 6.34315 13.5417 8Z" stroke="#9EA4AD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 7.99997C2.27427 3.94288 6.06456 1 10.5422 1C15.0198 1 18.8101 3.94291 20.0844 8.00004C18.8101 12.0571 15.0198 15 10.5422 15C6.06455 15 2.27425 12.0571 1 7.99997Z" stroke="#9EA4AD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                               
                        </button>

                        <div class="tooltip-block__text">Версия для слабовидящих</div>
                    </div>

                    <div class="main-header__personal-link">

                        <?if(\Bitrix\Main\Engine\CurrentUser::get()->getId()){?>
                            <?=CMax::showCabinetLink(false, false, 'big');?>
                        <?}else{?>    
                        <?$url = ((isset($_GET['backurl']) && $_GET['backurl']) ? $_GET['backurl'] : $APPLICATION->GetCurUri());
                        ?>
                        <div class="auth_wr_inner tooltip-block">

                            <a class="personal-link"
                                    data-event="jqm" data-param-type="auth"
                                    data-param-backurl="<?=htmlspecialcharsbx($url)?>"
                                    data-name="auth" href="/personal/"
                            ></a>
                             <div class="tooltip-block__text">

                                <a rel="nofollow" title="Мой кабинет"
                                    data-event="jqm" data-param-type="auth" 
                                    data-param-backurl="<?=htmlspecialcharsbx($url)?>"
                                    data-name="auth" href="/personal/">Вход
                                </a>/<a href="/auth/registration/?register=yes&backurl=<?=htmlspecialcharsbx($url)?>">Регистрация</a>

                             </div>
                            
                        </div>
                        <?}?>

                        
                    </div>

                </div>

            </div>


        </div>

    </div>
</div>