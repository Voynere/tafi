<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");?>

<? if($arResult["NEW_TEMPLATE"] == "Y"): ?>
    <?php if($arResult['TICK_BORNE_TEMPLATE'] == "Y"): ?>
        <div class="new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/tick-borne/block-1.php"
            )
          );?>
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/tick-borne/block-2.php"
            )
          );?>
          <? if (!empty($arResult['TICK_BORNE_ELEMENTS']))
          {
            $APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "ELEMENTS" => $arResult['TICK_BORNE_ELEMENTS'],
                "PATH" => SITE_DIR . "include/tick-borne/block-3.php"
              )
            );
          }
          ?>
        </div>
        <?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => SITE_DIR . "include/tick-borne/block-4.php"
          )
        );?>
        <div class="new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/tick-borne/block-5.php"
            )
          );?>
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/tick-borne/block-6.php"
            )
          );?>
        </div>
    <?$APPLICATION->IncludeComponent(
      "bitrix:main.include",
      "",
      Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => SITE_DIR . "include/tick-borne/block-7.php"
      )
    );?>
    <?php endif; ?>

    <?php if ($arResult["ALLERGOLOGICAL_TEMPLATE"] == "Y"):?>
        <div class="new-template__container">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_DIR . "include/allergolog/block-1.php"
              )
            );?>
        </div>
        <div class="new-template__container">
            <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_DIR . "include/allergolog/block-2.php"
                )
            );?>
        </div>
        <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
          "AREA_FILE_SHOW" => "file",
          "AREA_FILE_SUFFIX" => "inc",
          "EDIT_TEMPLATE" => "",
          "PATH" => SITE_DIR . "include/allergolog/block-3.php"
        )
        );?>
        <div class="new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "ELEMENTS" => $arResult['ALLERGOLOGICAL_ELEMENTS_1'],
              "PATH" => SITE_DIR . "include/allergolog/block-4.php"
            )
          );?>
        </div>
        <div class="new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "ELEMENTS" => $arResult['ALLERGOLOGICAL_ELEMENTS_2'],
              "PATH" => SITE_DIR . "include/allergolog/block-5.php"
            )
          );?>
        </div>

        <div class="new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/allergolog/block-6.php"
            )
          );?>
        </div>

    <?endif;?>

    <? if($arResult["TREATMENT_ROOM_TEMPLATE"] == "Y"): ?>
        <div class="advantages-text new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/cabinet_adv.php"
            )
          );?>
        </div>
    <? endif; ?>

<? if(!empty($arResult["ADVANTAGES"])):?>
            <div class="new-template__advantages home new-template__container">
                <h2 class="adaptive-h2">Почему стоит обратиться именно к нам?</h2>
                <div class="advantages">
                  <? foreach ($arResult["ADVANTAGES"] as $advantage): ?>
                      <div class="new-template__advantage advantage">
                        <? if(!empty($advantage["PREVIEW_PIC"]["SRC"])): ?>
                            <img class="advantage__img" src="<?=$advantage["PREVIEW_PIC"]["SRC"]?>" alt="<?=$advantage["PREVIEW_PIC"]["FILE_NAME"]?>">
                        <? endif; ?>
                          <span class="advantage__name"><?=$advantage["NAME"];?></span>
                        <? if(!empty($advantage["PREVIEW_TEXT"])): ?>
                            <p class="advantage__descr"><?=$advantage["PREVIEW_TEXT"];?></p>
                        <? endif; ?>
                      </div>
                  <? endforeach; ?>
                </div>
            </div>
        <?endif; ?>

    <? if ($arResult["HOME_TESTS_TEMPLATE"] == "Y"): ?>
        <div class="advantages-text new-template__container">
            <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/work_scheme.php"
            )
            );?>
        </div>

        <div class="advantages-text new-template__container">
          <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
              "AREA_FILE_SHOW" => "file",
              "AREA_FILE_SUFFIX" => "inc",
              "EDIT_TEMPLATE" => "",
              "PATH" => SITE_DIR . "include/features_of_proc.php"
            )
          );?>
        </div>

<?
// Подключаем модуль инфоблоков
if(CModule::IncludeModule("iblock")) {
    
    // ID инфоблока преимуществ
    $iblock_id = 77;
    
    // Массив ID элементов, которые нужно получить
    $required_ids = [3591, 3592, 3593, 3594, 3595, 3596]; // Ваши ID
    
    // Параметры выборки
    $arFilter = array(
        "IBLOCK_ID" => $iblock_id,
        "ACTIVE" => "Y",
        "ID" => $required_ids // Фильтруем по нужным ID
    );
    
    $arSelect = array(
        "ID",
        "NAME",
        "PREVIEW_TEXT",
        "PREVIEW_PICTURE",
        "DETAIL_PICTURE"
    );
    
    $res = CIBlockElement::GetList(
        array("SORT" => "ASC"), // Сортировка
        $arFilter,
        false,
        false,
        $arSelect
    );
    
    $advantages = array();
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        
        // Получаем URL картинки если есть
        if($arFields["PREVIEW_PICTURE"]) {
            $arFields["PREVIEW_PIC"] = array(
                "SRC" => CFile::GetPath($arFields["PREVIEW_PICTURE"]),
                "FILE_NAME" => $arFields["PREVIEW_PICTURE"]
            );
        }
        
        $advantages[] = $arFields;
    }
    
    if(!empty($advantages)): ?>
        <div class="new-template__advantages home new-template__container">
            <h2 class="adaptive-h2">Почему это удобно?</h2>
            <div class="advantages">
                <? foreach ($advantages as $advantage): ?>
                    <div class="new-template__advantage advantage">
                        <? if(!empty($advantage["PREVIEW_PIC"]["SRC"])): ?>
                            <img class="advantage__img" src="<?=$advantage["PREVIEW_PIC"]["SRC"]?>" alt="<?=$advantage["NAME"]?>">
                        <? endif; ?>
                        <span class="advantage__name"><?=$advantage["NAME"];?></span>
                        <? if(!empty($advantage["PREVIEW_TEXT"])): ?>
                            <p class="advantage__descr"><?=$advantage["PREVIEW_TEXT"];?></p>
                        <? endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <? endif;
}
?>
<? 
// Массив с услугами и ценами
$prices = [
    [
        "name" => "Выезд медицинской сестры на дом для взятия анализов",
        "price" => "1850 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-терапевта первичный",
        "price" => "5000 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-педиатра первичный",
        "price" => "3500 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-невролога первичный",
        "price" => "5000 руб."
    ],
    [
        "name" => "Электрокардиография (ЭКГ)",
        "price" => "2700 руб."
    ],
    [
        "name" => "СМАД (суточное мониторирование артериального давления)",
        "price" => "3800 руб."
    ],
    [
        "name" => "Холтер ЭКГ (суточное мониторирование сердечного ритма)",
        "price" => "4800 руб."
    ]
];
?>

<div class="new-template__price home new-template__container">
    <h2 class="adaptive-h2">Стоимость по Владивостоку</h2>
    <div class="prices-list">
        <? foreach ($prices as $item): ?>
            <div class="price-item">
                <span class="price-item__name"><?= $item["name"] ?></span>
                <span class="price-item__value"><?= $item["price"] ?></span>
            </div>
        <? endforeach; ?>
        

    </div>
</div>

<style>
.new-template__price {
    margin-top: 40px;
    margin-bottom: 40px;
}

.prices-list {

    margin: 0 auto;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
    font-size: 16px;
    line-height: 1.4;
}

.price-item:last-child {
    border-bottom: none;
}

.price-item__name {
    color: #333;
    padding-right: 20px;
}

.price-item__value {
    font-weight: bold;
    color: #000;
    white-space: nowrap;
}

.price-item--special {
    margin-top: 10px;
    padding-top: 15px;
    border-top: 2px solid #007bff;
}

.price-item--special .price-item__name {
    font-weight: 500;
}

.price-item--special .price-item__value {
    color: #007bff;
    font-size: 18px;
}
</style>

        <div class="get-results">
            <div class="new-template__container">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => SITE_DIR . "include/get_results.php"
                )
              );?>
            </div>
        </div>
    <? endif; ?>

      <?php if (!$arResult["ALLERGOLOGICAL_TEMPLATE"] == "Y" && !$arResult['TICK_BORNE_TEMPLATE'] == "Y"):?>
        <div class="reviews new-template__container <?= $arResult["HOME_TESTS_TEMPLATE"] == "Y" ? 'hometest' : '' ?>">
            <div class="kids-reviews maxwidth-theme">
                <div class="kids-reviews__top">
                    <div class="kids-reviews__left">
                        <h2 class="kids-reviews__title">Отзывы</h2>
                        <span class="btn btn-default btn-lg animate-load has-ripple" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1035_15)">
                                <path d="M7.33333 6.94267V8C7.33333 8.368 7.63133 8.66667 8 8.66667H9.05733C9.76933 8.66667 10.4393 8.38867 10.9427 7.88533L15.414 3.414C15.7913 3.036 16 2.534 16 1.99933C16 1.46467 15.7913 0.962667 15.414 0.585333C14.634 -0.194667 13.366 -0.194667 12.586 0.585333L8.11466 5.05667C7.61066 5.56 7.33333 6.23067 7.33333 6.94267ZM8.66666 6.94267C8.66666 6.592 8.80933 6.248 9.05733 6L13.5287 1.52867C13.7893 1.26867 14.2107 1.26867 14.4713 1.52867C14.5973 1.654 14.6667 1.82133 14.6667 2C14.6667 2.17867 14.5973 2.34533 14.4713 2.47133L10 6.94267C9.748 7.19467 9.41333 7.33333 9.05733 7.33333H8.66666V6.94267ZM16 6.66667V10.6667C16 12.1373 14.804 13.3333 13.3333 13.3333H11.4313L8.86666 15.4533C8.626 15.668 8.31733 15.776 8.00533 15.776C7.688 15.776 7.36866 15.664 7.114 15.4373L4.61466 13.3333H2.666C1.19533 13.3333 -0.000671387 12.1373 -0.000671387 10.6667V2.66667C-4.72e-06 1.196 1.196 0 2.66666 0H9.33333C9.702 0 10 0.298667 10 0.666667C10 1.03467 9.702 1.33333 9.33333 1.33333H2.66666C1.93133 1.33333 1.33333 1.93133 1.33333 2.66667V10.6667C1.33333 11.402 1.93133 12 2.66666 12H4.85866C5.01533 12 5.168 12.0553 5.28866 12.1567L7.98733 14.4293L10.768 12.1527C10.8873 12.054 11.0373 12 11.1927 12H13.334C14.0693 12 14.6673 11.402 14.6673 10.6667V6.66667C14.6673 6.29867 14.9653 6 15.334 6C15.7027 6 16 6.29867 16 6.66667Z" fill="#1063C0"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_1035_15">
                                <rect width="16" height="16" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                            Оставить отзыв
                        </span>
                    </div>
                    <a class="kids-reviews__link" target="_blank" href="/company/reviews/">Все отзывы</a>
                    </div>
                  <?
                  $GLOBALS['arrFilter'] = ['ACTIVE' => 'Y', "PROPERTY_SHOW_IN_CAB" => 324];
                  if ($arResult["HOME_TESTS_TEMPLATE"] == "Y")
                  {
                    $GLOBALS['arrFilter'] = ['ACTIVE' => 'Y', "PROPERTY_SHOW_IN_HOME" => 329];
                  }
                  ?>
                  <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "kids_reviews",
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
        </div>
      <?php endif; ?>

    <?php $parent_section = 761; ?>
    <? if($arResult["HOME_TESTS_TEMPLATE"] == "Y"): ?>
        <?php $parent_section = 762; ?>
        <div class="contact-us">
            <div class="new-template__container">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => SITE_DIR . "include/contact_us.php"
                )
              );?>
            </div>
        </div>

    <? endif; ?>

    <?php if ($arResult["ALLERGOLOGICAL_TEMPLATE"] == "Y") $parent_section = 764; ?>
	<?php if ($arResult['TICK_BORNE_TEMPLATE'] == "Y") $parent_section = 767; ?>
    <div class="faq new-template__container">
        <div class="kids-faq maxwidth-theme">
            <h2 class="kids-faq__title">Часто задаваемые вопросы</h2>
            <div class="kids-faq__container">
                <div class="kids-faq__left">
                  <?$APPLICATION->IncludeComponent("bitrix:news.list", "kids-faq", Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                      0 => "PREVIEW_PICTURE",
                      1 => "",
                    ),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "HIDE_SECTION_NAME" => "N",
                    "IBLOCK_ID" => "5",
                    "IBLOCK_TYPE" => "aspro_max_content",
                    "IMAGE_POSITION" => "left",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "20",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => $parent_section,
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                      0 => "",
                      1 => "",
                    ),
                    "SALE_MODE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SHOW_DETAIL_LINK" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "S_ASK_QUESTION" => "",
                    "S_ORDER_SERVICE" => "",
                    "T_DOCS" => "",
                    "T_GALLERY" => "",
                    "T_GOODS" => "",
                    "T_PROJECTS" => "",
                    "T_REVIEWS" => "",
                    "T_SERVICES" => "",
                    "T_STAFF" => "",
                    "USE_SHARE" => "N",
                  ),
                    false
                  );?>
                </div>
                <div class="kids-faq__right">
                    <div class="kids-ask loyal-ask">
                        <div class="loyal-ask__block">
                            <img class="loyal-ask__question q1" src="/images/kids-ask1.png" alt="ask">
                            <img class="loyal-ask__question q2" src="/images/kids-ask2.png" alt="ask">
                            <img class="loyal-ask__question q3" src="/images/kids-ask3.png" alt="ask">
                            <h2 class="loyal-ask__title">Остались вопросы?</h2>
                            <p class="loyal-ask__text">Напишите нам и мы ответим на все интересующие вас вопросы</p>
                            <a class="loyal-ask__link" target="_blank" href="https://max.ru/u/f9LHodD0cOLaGoeOnfRz3hNOnmlxOABlmeZ9tOcGy1wXt7sz85lrhfANCMo">
                                <!--svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.1785 3.35676C18.0477 1.18108 15.1022 0 12.094 0C5.70163 0 0.56267 5.15946 0.625341 11.4378C0.625341 13.427 1.18937 15.3541 2.12943 17.0946L0.5 23L6.57902 21.4459C8.27112 22.3784 10.1512 22.8135 12.0313 22.8135C18.361 22.8135 23.5 17.6541 23.5 11.3757C23.5 8.32973 22.3093 5.47027 20.1785 3.35676ZM12.094 20.8865C10.4019 20.8865 8.70981 20.4514 7.26839 19.5811L6.89237 19.3946L3.25749 20.327L4.19755 16.7838L3.94687 16.4108C1.18937 11.9973 2.50545 6.15405 7.01771 3.41892C11.53 0.683784 17.3583 1.98919 20.1158 6.46486C22.8733 10.9405 21.5572 16.7216 17.045 19.4568C15.6035 20.3892 13.8488 20.8865 12.094 20.8865ZM17.609 13.9865L16.9196 13.6757C16.9196 13.6757 15.9169 13.2405 15.2902 12.9297C15.2275 12.9297 15.1648 12.8676 15.1022 12.8676C14.9142 12.8676 14.7888 12.9297 14.6635 12.9919C14.6635 12.9919 14.6008 13.0541 13.7234 14.0486C13.6608 14.173 13.5354 14.2351 13.4101 14.2351H13.3474C13.2847 14.2351 13.1594 14.173 13.0967 14.1108L12.7834 13.9865C12.094 13.6757 11.4673 13.3027 10.9659 12.8054C10.8406 12.6811 10.6526 12.5568 10.5272 12.4324C10.0886 11.9973 9.64986 11.5 9.33651 10.9405L9.27384 10.8162C9.21117 10.7541 9.21117 10.6919 9.1485 10.5676C9.1485 10.4432 9.1485 10.3189 9.21117 10.2568C9.21117 10.2568 9.46185 9.94595 9.64986 9.75946C9.7752 9.63514 9.83787 9.44865 9.96321 9.32432C10.0886 9.13784 10.1512 8.88919 10.0886 8.7027C10.0259 8.39189 9.27384 6.71351 9.08583 6.34054C8.96049 6.15405 8.83515 6.09189 8.64714 6.02973H8.45913C8.33379 6.02973 8.14578 6.02973 7.95777 6.02973C7.83242 6.02973 7.70708 6.09189 7.58174 6.09189L7.51907 6.15405C7.39373 6.21622 7.26839 6.34054 7.14305 6.4027C7.01771 6.52703 6.95504 6.65135 6.8297 6.77568C6.39101 7.33513 6.14033 8.01892 6.14033 8.7027C6.14033 9.2 6.26567 9.6973 6.45368 10.1324L6.51635 10.3189C7.08038 11.5 7.83242 12.5568 8.83515 13.4892L9.08583 13.7378C9.27384 13.9243 9.46185 14.0486 9.58719 14.2351C10.9033 15.3541 12.4074 16.1622 14.0995 16.5973C14.2875 16.6595 14.5381 16.6595 14.7262 16.7216C14.9142 16.7216 15.1649 16.7216 15.3529 16.7216C15.6662 16.7216 16.0422 16.5973 16.2929 16.473C16.4809 16.3486 16.6063 16.3486 16.7316 16.2243L16.8569 16.1C16.9823 15.9757 17.1076 15.9135 17.233 15.7892C17.3583 15.6649 17.4837 15.5405 17.5463 15.4162C17.6717 15.1676 17.7343 14.8568 17.797 14.5459C17.797 14.4216 17.797 14.2351 17.797 14.1108C17.797 14.1108 17.7343 14.0486 17.609 13.9865Z" fill="#3B61B9"/>
                                </svg-->
                                Написать нам
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<? 
// Массив с услугами и ценами
$prices = [
    [
        "name" => "Выезд медицинской сестры на дом для взятия анализов",
        "price" => "1850 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-терапевта первичный",
        "price" => "5000 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-педиатра первичный",
        "price" => "3500 руб."
    ],
    [
        "name" => "Прием (осмотр, консультация) врача-невролога первичный",
        "price" => "5000 руб."
    ],
    [
        "name" => "Электрокардиография (ЭКГ)",
        "price" => "2700 руб."
    ],
    [
        "name" => "СМАД (суточное мониторирование артериального давления)",
        "price" => "3800 руб."
    ],
    [
        "name" => "Холтер ЭКГ (суточное мониторирование сердечного ритма)",
        "price" => "4800 руб."
    ]
];
?>


<!-- БЛОК SEO-ТЕКСТ -->
<div class="new-template__seo-text home new-template__container">
    <div class="seo-text-content">
        <p>Мы предлагаем забор анализов на дому во Владивостоке, включая кровь, мочу и другие лабораторные исследования. Все процедуры проводятся профессионально, с соблюдением санитарных норм и безопасности. Выезд врача с забором анализов во Владивостоке позволяет получить точные результаты без лишних визитов в медицинский центр, экономя ваше время и снижая стресс для всей семьи.</p>
        
        <p>Также в «ТАФИ» доступна услуга вызова врача на дом во Владивостоке. Наши специалисты приедут к вам в удобное время для осмотра, проведения диагностики и назначения лечения. Доступен вызов терапевта, педиатра, невролога на дом, что особенно важно для пациентов с ограниченной подвижностью, детей и пожилых людей.</p>
        
        <p>Кроме того, врач может провести медицинский осмотр на дому, снять ЭКГ, поставить Холтер, дать рекомендации по лечению и профилактике заболеваний. Благодаря этому вы получаете полноценную медицинскую помощь на дому во Владивостоке, включая консультации, диагностику и наблюдение за состоянием здоровья.</p>
        
        <p>Выбирая «ТАФИ», вы доверяете своё здоровье профессионалам, которые обеспечивают комплексную диагностику на дому, быстрые результаты анализов и индивидуальный подход к каждому пациенту. Забота о здоровье теперь доступна прямо у вас дома.</p>
    </div>
</div>

<style>
/* Стили для блока стоимости */
.new-template__price {
    margin-top: 40px;
    margin-bottom: 40px;
}

.prices-list {
    max-width: 1340px;
    margin: 0 auto;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
    font-size: 16px;
    line-height: 1.4;
}

.price-item:last-child {
    border-bottom: none;
}

.price-item__name {
    color: #333;
    padding-right: 20px;
}

.price-item__value {
    font-weight: bold;
    color: #000;
    white-space: nowrap;
}

.price-item--special {
    margin-top: 10px;
    padding-top: 15px;
    border-top: 2px solid #007bff;
}

.price-item--special .price-item__name {
    font-weight: 500;
}

.price-item--special .price-item__value {
    color: #007bff;
    font-size: 18px;
}

/* Стили для SEO-текста */
.new-template__seo-text {
    margin-top: 60px;
    margin-bottom: 40px;
    padding: 30px 0;
    border-top: 1px solid #e0e0e0;
}

.seo-text-content {
    max-width: 900px;
    margin: 0 auto;
    font-size: 16px;
    line-height: 1.6;
    color: #444;
}

.seo-text-content p {
    margin-bottom: 20px;
}

.seo-text-content p:last-child {
    margin-bottom: 0;
}

/* Адаптивность для мобильных */
@media (max-width: 768px) {
    .price-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .price-item__name {
        padding-right: 0;
    }
    
    .seo-text-content {
        font-size: 15px;
        padding: 0 15px;
    }
}
</style>


    <div class="new-template__container new-template__social">
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
    </div>
    <? if($arResult["HOME_TESTS_TEMPLATE"] != "Y" && $arResult['TICK_BORNE_TEMPLATE'] != "Y"): ?>
        <div id="hiddenBreads" class="new-template__breads hidden">
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
    <? endif; ?>
<? endif; ?>

<?if (isset($templateData['SECTION_BNR_CONTENT']) && $templateData['SECTION_BNR_CONTENT'] == true)
{
	global $SECTION_BNR_CONTENT, $bLongBannerContents;
	$SECTION_BNR_CONTENT = true;
	if(isset($templateData['BNR_ON_HEAD']) && $templateData['BNR_ON_HEAD'] == true){
		global $arTheme;
		if( isset($arTheme['HEADER_TYPE']['LIST'][ $arTheme['HEADER_TYPE']['VALUE'] ]['ADDITIONAL_OPTIONS'])  && isset($arTheme['HEADER_TYPE']['LIST'][ $arTheme['HEADER_TYPE']['VALUE'] ]['ADDITIONAL_OPTIONS']['TOP_HEADER_OPACITY']) ) {
			$bTopHeaderOpacity = $arTheme['HEADER_TYPE']['LIST'][ $arTheme['HEADER_TYPE']['VALUE'] ]['ADDITIONAL_OPTIONS']['TOP_HEADER_OPACITY']['VALUE'] == 'Y';
		}

		if($bTopHeaderOpacity) {
			global $dopBodyClass;
			$dopBodyClass .= ' top_header_opacity';
		}
		$bLongBannerContents = true;
		if ($templateData['BNR_DARK_MENU_COLOR']['VALUE'] != 'Y') {
			global $dopClass;
			$dopClass .= ' light-menu-color';
		}
	}
}?>

<?global $isHideLeftBlock; ?>

<?$bHideLeftBlock = ($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") == "Y");?>

<?$arBlockOrder = explode(",", $arParams["DETAIL_BLOCKS_ALL_ORDER"]);?>

<?if($templateData['SHOW_PERIOD_LINE']):?>
<div class="period_wrapper in-detail-news1">
<?$APPLICATION->ShowViewContent('share_in_contents');?>
<?/*period line*/
$APPLICATION->ShowViewContent('PERIOD_LINE');?>
</div>
<div class="line-after in-detail-news1"></div>
<?endif;?>

<?if($arParams["PARTNERS_MODE"] == "Y" && ($isHideLeftBlock || $APPLICATION->GetProperty("HIDE_LEFT_BLOCK_DETAIL") == "Y")):?>
	<div class="line-after"></div>
<?endif;?>

<?$APPLICATION->ShowViewContent('DETAIL_IMG');?>

<?foreach($arBlockOrder as $code):?>
	<?//news?>
        <?if($code == 'news' && $templateData['LINK_NEWS']):?>
		<?ob_start();?>
			<?$GLOBALS['arrNewsFilter'] = array('ID' => $templateData['LINK_NEWS']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-list",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_NEWS_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrNewsFilter",
					"FIELD_CODE" => array(
					    0 => "NAME",
					    1 => "DETAIL_PAGE_URL",
					    2 => "PREVIEW_TEXT",
					    3 => "PREVIEW_PICTURE",
					    4 => "DATE_ACTIVE_FROM",
					),
					"PROPERTY_CODE" => array(
					    0 => "PERIOD",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_NEWS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//services?>
	<?elseif($code == 'services' && $templateData['LINK_SERVICES']):?>
		<?ob_start();?>
			<?$GLOBALS['arrServicesFilter'] = array('ID' => $templateData['LINK_SERVICES']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-list",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_SERVICES_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrServicesFilter",
					"FIELD_CODE" => array(
					    0 => "NAME",
					    1 => "DETAIL_PAGE_URL",
					    2 => "PREVIEW_TEXT",
					    3 => "PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
					    0 => "PRICE",
					    1 => "PRICE_OLD",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_SERVICES_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//tizers?>
	<?elseif($code == 'tizers' && $templateData['LINK_TIZERS']):?>
		<?ob_start()?>
			<?
			$GLOBALS['arrTizersFilter'] = array('ID' => $templateData['LINK_TIZERS']);
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"front_tizers",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_TIZERS_ID'],
					"NEWS_COUNT" => ($bHideLeftBlock ? '4' : '3'),
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrTizersFilter",
					"FIELD_CODE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "PREVIEW_TEXT",
						2 => "DETAIL_PICTURE",
						3 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "ICON",
						1 => "URL",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "250",
					"ACTIVE_DATE_FORMAT" => "d F Y",
					"SET_TITLE" => "N",
					"SHOW_DETAIL_LINK" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "ajax",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "N",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COMPONENT_TEMPLATE" => "front_tizers",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"STRICT_SECTION_CHECK" => "N",
					"TYPE_IMG" => "left",
					"CENTERED" => "Y",
					"SIZE_IN_ROW" => ($bHideLeftBlock ? '4' : '3'),
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block tizers-block in-detail-news1 ">
				<?if($arParams["BLOCK_TIZERS_NAME"]):?>
					<div class="ordered-block__title option-font-bold font_lg">
						<?=$arParams["BLOCK_TIZERS_NAME"];?>
					</div>
				<?endif;?>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//preview_text block ?>
	<?elseif($code == 'preview_text'):?>
                <div class="ordered-block">
					<?$APPLICATION->ShowViewContent('PREVIEW_TEXT_BLOCK');?>
				</div>
				<div class="line-after"></div>
	<?//detail description block?>
	<?elseif($code == 'desc'):?>
                <?$APPLICATION->ShowViewContent('DETAIL_CONTENT')?>
	<?//form_order block?>
	<?elseif($code == 'form_order'):?>
                <?$APPLICATION->ShowViewContent('CONTENT_ORDER_FORM')?>
        <?//props block?>
        <?elseif($code == 'char'):?>
                <?$APPLICATION->ShowViewContent('CONTENT_PROPS_INFO')?>
	<?//brands?>
	<?elseif($code == 'brands' && $templateData['LINK_BRANDS']):?>
		<?ob_start()?>
			<?
			$GLOBALS['arrBrandsFilter'] = array('ID' => $templateData['LINK_BRANDS']);
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"front_brands_slider",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_BRANDS_ID'],
					"NEWS_COUNT" => "",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FILTER_NAME" => "arrBrandsFilter",
					"FIELD_CODE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "",
						1 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "N",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COMPONENT_TEMPLATE" => "front_brands_slider",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"STRICT_SECTION_CHECK" => "N",
					"TITLE_BLOCK" => '',
					//"TITLE_BLOCK_ALL" => "",
					"ALL_URL" => "",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"BORDERED" => ($bHideLeftBlock ? "N" : "Y"),
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> brands-block with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_BRANDS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//projects?>
	<?elseif($code == 'projects' && $templateData['LINK_PROJECTS']):?>
		<?ob_start()?>
			<?
			$GLOBALS['arrProjectsFilter'] = array('ID' => $templateData['LINK_PROJECTS']);
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"front_news",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_PROJECTS_ID'],
					"NEWS_COUNT" => '',
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FILTER_NAME" => "arrProjectsFilter",
					"FIELD_CODE" => array(
					    0 => "PREVIEW_PICTURE",
					    1 => "DATE_ACTIVE_FROM",
					),
					"PROPERTY_CODE" => array(
					    0 => "PERIOD",
					    1 => "REDIRECT",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d F Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "ajax",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
					"PAGER_SHOW_ALL" => "N",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "N",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"COMPONENT_TEMPLATE" => "front_news",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_LAST_MODIFIED" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"STRICT_SECTION_CHECK" => "N",
					"TITLE_BLOCK" => '',
					//"TITLE_BLOCK_ALL" => "",
					"ALL_URL" => "",
					"SIZE_IN_ROW" => ($bHideLeftBlock ? '3' : '2'),
					"TYPE_IMG" => "lg",
					"BORDERED" => "Y",
					"SHOW_SUBSCRIBE" => "Y",
					"TITLE_SUBSCRIBE" => "",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SHOW_404" => "N",
					//"IS_AJAX" => CMax::checkAjaxRequest(),
					"MESSAGE_404" => "",
					"FON_BLOCK_2_COLS" => 'N',
					"ALL_BLOCK_BG" => 'Y',
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block projects-block with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_PROJECTS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//comments block?>
	<?elseif($code == 'comments' && $arParams["DETAIL_USE_COMMENTS"] == "Y"):?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rating_likes.js"); ?>
		<?ob_start()?>
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.comments",
				"main",
				array(
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					"COMMENTS_COUNT" => $arParams['COMMENTS_COUNT'],
					"ELEMENT_CODE" => "",
					"ELEMENT_ID" => $arResult["ID"],
					"FB_USE" => $arParams["DETAIL_FB_USE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"IBLOCK_TYPE" => "aspro_max_catalog",
					"SHOW_DEACTIVATED" => "N",
					"TEMPLATE_THEME" => "blue",
					"URL_TO_COMMENT" => "",
					"VK_USE" => $arParams["DETAIL_VK_USE"],
					"AJAX_POST" => "Y",
					"WIDTH" => "",
					"COMPONENT_TEMPLATE" => ".default",
					"BLOG_USE" => $arParams["DETAIL_BLOG_USE"],
					"BLOG_TITLE" => $arParams["BLOG_TITLE"],
					"BLOG_URL" => $arParams["DETAIL_BLOG_URL"],
					"PATH_TO_SMILE" => '/bitrix/images/blog/smile/',
					"EMAIL_NOTIFY" => $arParams["DETAIL_BLOG_EMAIL_NOTIFY"],
					"SHOW_SPAM" => "Y",
					"SHOW_RATING" => "Y",
					"RATING_TYPE" => "like_graphic",
					"FB_TITLE" => $arParams["FB_TITLE"],
					"FB_USER_ADMIN_ID" => "",
					"FB_APP_ID" => $arParams["DETAIL_FB_APP_ID"],
					"FB_COLORSCHEME" => "light",
					"FB_ORDER_BY" => "reverse_time",
					"VK_TITLE" => $arParams["VK_TITLE"],
					"VK_API_ID" => $arParams["DETAIL_VK_API_ID"]
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block comments-block">
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>

	<?//reviews block?>
	<?elseif($code == 'reviews' && $templateData['LINK_REVIEWS']):?>
		<?ob_start()?>
			<?
			$GLOBALS['arrReviewsFilter'] = array('ID' => $templateData['LINK_REVIEWS']);
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"front_review",
				array(
				    "IBLOCK_TYPE" => "aspro_max_content",
				    "IBLOCK_ID" => $arParams['IBLOCK_LINK_REVIEWS_ID'],
				    "NEWS_COUNT" => "",
				    "SORT_BY1" => "SORT",
				    "SORT_ORDER1" => "ASC",
				    "SORT_BY2" => "ID",
				    "SORT_ORDER2" => "DESC",
				    "FILTER_NAME" => "arrReviewsFilter",
				    "FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "PREVIEW_TEXT",
					2 => "DETAIL_PICTURE",
					3 => "",
				    ),
				    "PROPERTY_CODE" => array(
					0 => "POST",
					1 => "RATING",
				    ),
				    "CHECK_DATES" => "Y",
				    "DETAIL_URL" => "",
				    "AJAX_MODE" => "N",
				    "AJAX_OPTION_JUMP" => "N",
				    "AJAX_OPTION_STYLE" => "Y",
				    "AJAX_OPTION_HISTORY" => "N",
				    "CACHE_TYPE" => "A",
				    "CACHE_TIME" => "36000000",
				    "CACHE_FILTER" => "Y",
				    "CACHE_GROUPS" => "N",
				    "PREVIEW_TRUNCATE_LEN" => "250",
				    "ACTIVE_DATE_FORMAT" => "d F Y",
				    "SET_TITLE" => "N",
				    "SHOW_DETAIL_LINK" => "N",
				    "SET_STATUS_404" => "N",
				    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				    "ADD_SECTIONS_CHAIN" => "N",
				    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
				    "PARENT_SECTION" => "",
				    "PARENT_SECTION_CODE" => "",
				    "DISPLAY_TOP_PAGER" => "N",
				    "DISPLAY_BOTTOM_PAGER" => "Y",
				    "PAGER_TITLE" => "",
				    "PAGER_SHOW_ALWAYS" => "N",
				    "PAGER_TEMPLATE" => "ajax",
				    "PAGER_DESC_NUMBERING" => "N",
				    "PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
				    "PAGER_SHOW_ALL" => "N",
				    "DISPLAY_DATE" => "Y",
				    "DISPLAY_NAME" => "Y",
				    "DISPLAY_PICTURE" => "N",
				    "DISPLAY_PREVIEW_TEXT" => "N",
				    "AJAX_OPTION_ADDITIONAL" => "",
				    "COMPONENT_TEMPLATE" => "front_review",
				    "SET_BROWSER_TITLE" => "N",
				    "SET_META_KEYWORDS" => "N",
				    "SET_META_DESCRIPTION" => "N",
				    "SET_LAST_MODIFIED" => "N",
				    "INCLUDE_SUBSECTIONS" => "Y",
				    "STRICT_SECTION_CHECK" => "N",
				    "TITLE_BLOCK" => '',
				    //"TITLE_BLOCK_ALL" => "",
				    "SHOW_ADD_REVIEW" => "N",
				    "TITLE_ADD_REVIEW" => "",
				    "ALL_URL" => "",
				    "PAGER_BASE_LINK_ENABLE" => "N",
				    "SHOW_404" => "N",
				    "COMPACT" => "Y",
				    "SIZE_IN_ROW" => "1",
				    "MESSAGE_404" => "",
				    "LINKED_MODE" => 'Y',
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block reviews-block with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_REVIEWS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>

	<?//staff?>
	<?elseif($code == 'staff' && $templateData['LINK_STAFF']):?>
		<?ob_start()?>
			<?
			$GLOBALS['arrStaffFilter'] = array('ID' => $templateData['LINK_STAFF']);
			if($arParams['STAFF_TYPE'] == 'block'):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"staff_block",
					array(
						"IBLOCK_TYPE" => "",
						"IBLOCK_ID" => $arParams['IBLOCK_LINK_STAFF_ID'],
						"NEWS_COUNT" => "",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "DESC",
						"FILTER_NAME" => "arrStaffFilter",
						"FIELD_CODE" => array(
						    0 => "PREVIEW_PICTURE",
						    1 => "NAME",
						    2 => "",
						),
						"PROPERTY_CODE" => array(
						    0 => "POST",
						    1 => "PHONE",
						    2 => "EMAIL",
						    3 => "SEND_MESSAGE_BUTTON",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						"CACHE_FILTER" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"LINKED_MODE" => "Y",
						"TITLE_BLOCK" => '',
						"COUNT_IN_LINE" => ($bHideLeftBlock ? '4' : '3'),
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			<?else:?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"staff_list",
					array(
						"IBLOCK_TYPE" => "",
						"IBLOCK_ID" => $arParams['IBLOCK_LINK_STAFF_ID'],
						"NEWS_COUNT" => "",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "DESC",
						"FILTER_NAME" => "arrStaffFilter",
						"FIELD_CODE" => array(
							0 => "PREVIEW_PICTURE",
							1 => "NAME",
							2 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "POST",
							1 => "PHONE",
							2 => "EMAIL",
							3 => "SEND_MESSAGE_BUTTON",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						"CACHE_FILTER" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"LINKED_MODE" => "Y",
						"TITLE_BLOCK" => '',
						"COUNT_IN_LINE" => ($bHideLeftBlock ? '4' : '3'),
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			<?endif;?>
		<?$html=ob_get_clean();?>
		<?if($html && strpos($html, 'error') === false):?>
			<div class="ordered-block staff-block type_<?=$arParams['STAFF_TYPE'];?>  with-title">
				<div class="ordered-block__title option-font-bold font_lg">
					<?=$arParams["BLOCK_STAFF_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//video block?>
	<?elseif($code == 'video' && $templateData['VIDEO']):?>
		<div class="wraps video-block ordered-block with-title">
			<div class="ordered-block__title option-font-bold font_lg ">
				<?=($arParams["T_VIDEO"] ? $arParams["T_VIDEO"] : GetMessage("T_VIDEO"));?>
			</div>
			<div class="hidden_print">
				<div class="video_block row">
					<?if(count($templateData['VIDEO']) > 1):?>
						<?foreach($templateData['VIDEO'] as $v => $value):?>
							<div class="col-sm-6 col-xs-12">
								<?=str_replace('src=', 'width="660" height="457" src=', str_replace(array('width', 'height'), array('data-width', 'data-height'), $value));?>
							</div>
						<?endforeach;?>
					<?else:?>
						<div class="col-md-12"><?=$templateData['VIDEO'][0]?></div>
					<?endif;?>
				</div>
			</div>
		</div>
		<div class="line-after"></div>
	<?//docs block?>
	<?elseif($code == 'docs' && $templateData['DOCUMENTS']):?>
		<div class="wraps docs-block ordered-block with-title">
			<div class="ordered-block__title option-font-bold font_lg ">
				<?=($arParams["T_DOCS"] ? $arParams["T_DOCS"] : GetMessage("T_DOCS"));?>
			</div>
				<div class="docs_wrap files_block">
					<div class="row flexbox">
					<?foreach($templateData['DOCUMENTS'] as $docID):?>
						<?$arItem = CMax::GetFileInfo($docID);?>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<?
							$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
							$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);

							?>
							<div class="file_type clearfix <?=$arItem["TYPE"];?>">
								<i class="icon"></i>
								<div class="description">
									<a href="<?=$arItem['SRC']?>" class="dark-color text" target="_blank"><?=$fileTitle?></a>
									<span class="size font_xs muted">
										<?=$arItem["FILE_SIZE_FORMAT"];?>
									</span>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
		<div class="line-after"></div>
    <?//gallery block?>
    <?elseif($code == 'gallery' && (is_array($templateData['GALLERY_BIG']) && count($templateData['GALLERY_BIG']))):?>
		<?
		$bShowSmallGallery = $templateData['GALLERY_TYPE'] === 'small';
		?>
		<div class="wraps galerys-block swipeignore  muted777 ordered-block with-title">
			<div class="ordered-block__title option-font-bold font_lg">
				<?=GetMessage("T_GALLERY");?>
			</div>
			<?//switch gallery?>
			<div class="switch-item-block">
			    <div class="flexbox flexbox--row">
				<div class="switch-item-block__count muted777 font_xs">
				    <div class="switch-item-block__count-wrapper switch-item-block__count-wrapper--small" <?=($bShowSmallGallery ? "" : "style='display:none;'");?>>
					<span class="switch-item-block__count-value"><?=count($templateData['GALLERY_BIG']);?></span>
					<?=GetMessage('T_GALLERY_TITLE');?>
					<span class="switch-item-block__count-separate">&mdash;</span>
				    </div>
				    <div class="switch-item-block__count-wrapper switch-item-block__count-wrapper--big" <?=($bShowSmallGallery ? "style='display:none;'" : "");?>>
					<span class="switch-item-block__count-value">1/<?=count($templateData['GALLERY_BIG']);?></span>
					<?=GetMessage('T_GALLERY_TITLE');?>
					<span class="switch-item-block__count-separate">&mdash;</span>
				    </div>
				</div>
				<div class="switch-item-block__icons-wrapper">
				    <span class="switch-item-block__icons<?=(!$bShowSmallGallery ? ' active' : '');?> switch-item-block__icons--big" title="<?=GetMessage("BIG_GALLERY");?>"><?=CMax::showIconSvg("gallery", SITE_TEMPLATE_PATH."/images/svg/gallery_alone.svg", "", "colored_theme_hover_bg-el-svg", true, false);?></span>
				    <span class="switch-item-block__icons<?=($bShowSmallGallery ? ' active' : '');?> switch-item-block__icons--small" title="<?=GetMessage("SMALL_GALLERY");?>"><?=CMax::showIconSvg("gallery", SITE_TEMPLATE_PATH."/images/svg/gallery_list.svg", "", "colored_theme_hover_bg-el-svg", true, false);?></span>
				</div>
			    </div>
			</div>

			<?//big gallery?>
			<div class="big-gallery-block "<?=($bShowSmallGallery ? ' style="display:none;"' : '');?> >
			    <div class="owl-carousel owl-theme owl-bg-nav short-nav" data-slider="content-detail-gallery__slider" data-plugin-options='{"items": "1", "autoplay" : false, "autoplayTimeout" : "3000", "smartSpeed":1000, "dots": true, "nav": true, "loop": false, "rewind":true, "index": true, "margin": 10}'>
				<?foreach($templateData['GALLERY_BIG'] as $i => $arPhoto):?>
				    <div class="item">
					<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancy" data-fancybox="big-gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
					    <img data-src="<?=$arPhoto['PREVIEW']['src']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arPhoto['PREVIEW']['src']);?>" class="img-responsive inline lazy" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
					</a>
				    </div>
				<?endforeach;?>
			    </div>
			</div>

			<?//small gallery?>
			<div class="small-gallery-block"<?=($bShowSmallGallery ? '' : ' style="display:none;"');?>>
			    <div class="front bigs">
				<div class="items row">
				    <?foreach($templateData['GALLERY_BIG'] as $i => $arPhoto):?>
					<div class="col-md-3 col-sm-4 col-xs-6">
					    <div class="item">
						<div class="wrap"><a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancy" data-fancybox="small-gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
						    <img data-src="<?=$arPhoto['PREVIEW']['src']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arPhoto['PREVIEW']['src']);?>" class="lazy img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" /></a>
						</div>
					    </div>
					</div>
				    <?endforeach;?>
				</div>
			    </div>
			</div>

		</div>
		<div class="line-after"></div>
	<?//vacancy?>
	<?elseif($code == 'vacancy' && $templateData['LINK_VACANCY']):?>
		<?ob_start();?>
			<?$GLOBALS['arrVacancyFilter'] = array('ID' => $templateData['LINK_VACANCY']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"vacancy",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_VACANCY_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrVacancyFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "DETAIL_PAGE_URL",
						2 => "PREVIEW_TEXT",
						3 => "PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
						0 => "PAY",
						1 => "CITY",
						2 => "WORK_TYPE",
						3 => "QUALITY",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && trim($html) && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg ">
					<?=$arParams["BLOCK_VACANCY_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
	<?//blog?>
	<?elseif($code == 'blog' && $templateData['LINK_BLOG']):?>
		<?ob_start();?>
			<?$GLOBALS['arrBlogFilter'] = array('ID' => $templateData['LINK_BLOG']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-list",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_BLOG_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrBlogFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "DETAIL_PAGE_URL",
						2 => "PREVIEW_TEXT",
						3 => "PREVIEW_PICTURE",
						4 => "DATE_ACTIVE_FROM",
					),
					"PROPERTY_CODE" => array(
						0 => "PERIOD",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && trim($html) && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg ">
					<?=$arParams["BLOCK_BLOG_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>

	<?//landings?>
	<?elseif($code == 'landings' && $templateData['LINK_LANDINGS']):?>
		<?ob_start();?>
			<?$GLOBALS['arrLandingsFilter'] = array('ID' => $templateData['LINK_LANDINGS']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-list",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_LANDINGS_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrLandingsFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "DETAIL_PAGE_URL",
						2 => "PREVIEW_TEXT",
						3 => "PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
						0 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && trim($html) && strpos($html, 'error') === false):?>
			<div class="ordered-block with-title">
				<div class="ordered-block__title option-font-bold font_lg ">
					<?=$arParams["BLOCK_LANDINGS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>

	<?//partners?>
	<?elseif($code == 'partners' && $templateData['LINK_PARTNERS']):?>
		<?ob_start();?>
			<?$GLOBALS['arrPartnersFilter'] = array('ID' => $templateData['LINK_PARTNERS']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-list",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_PARTNERS_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrPartnersFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "DETAIL_PAGE_URL",
						2 => "PREVIEW_TEXT",
						3 => "PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
						0 => "SITE",
						1 => "PHONE",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"BORDERED" => "Y",
					"LINKED_MODE" => "Y",
					"HIDE_SECTION_NAME" => "Y",
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?if($html && trim($html) && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg ">
					<?=$arParams["BLOCK_PARTNERS_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>
    <?//goods?>
	<?elseif($code == 'goods'):?>
		<?if((in_array('LINK_GOODS', $arParams['PROPERTY_CODE']) || ($arParams['SHOW_LINKED_PRODUCTS'] == 'Y' && strlen($arParams['LINKED_PRODUCTS_PROPERTY'])))
			&& (isset($GLOBALS['arrProductsFilter']) || (isset($arParams['CONTENT_LINKED_FILTER_BY_FILTER']) && $arParams['CONTENT_LINKED_FILTER_BY_FILTER']))):?>
			<?
			$filter_by_filter = (isset($arParams['CONTENT_LINKED_FILTER_BY_FILTER']) && $arParams['CONTENT_LINKED_FILTER_BY_FILTER']);
			if($filter_by_filter){
				$cond = new CMaxCondition();
				try{
					$arTmpGoods = \Bitrix\Main\Web\Json::decode($arParams["~CONTENT_LINKED_FILTER_BY_FILTER"]);
					$arExGoodsFilter = $cond->parseCondition($arTmpGoods, $arParams);
				}
				catch(\Exception $e){
					$arExGoodsFilter = array();
				}
				unset($arTmpGoods);

				$GLOBALS['arrProductsFilter'] = array($arExGoodsFilter);
				unset($arParams['CONTENT_LINKED_FILTER_BY_FILTER']);
			}

			global $arTheme;
			$catalogIBlockID = ($arParams["IBLOCK_CATALOG_ID"] ? $arParams["IBLOCK_CATALOG_ID"] : $arTheme["CATALOG_IBLOCK_ID"]["VALUE"]);
			$arItemsFilter = array("IBLOCK_ID" => $catalogIBlockID, "ACTIVE" => "Y", 'SECTION_GLOBAL_ACTIVE' => 'Y');
			$arItemsFilter = array_merge($arItemsFilter, $GLOBALS['arrProductsFilter']);

			// if(is_array($GLOBALS['arRegionLink'])){
			// 	$arItemsFilter = array_merge($arItemsFilter, $GLOBALS['arRegionLink']);
			// }
			if($GLOBALS['arRegion']){
				if(CMax::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y' && CMax::GetFrontParametrValue('REGIONALITY_FILTER_CATALOG') == 'Y'){
					$arItemsFilter['PROPERTY_LINK_REGION'] = $GLOBALS['arRegion']['ID'];
					CMax::makeElementFilterInRegion($arItemsFilter);
				}
			}

			$arItems = CMaxCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CMaxCache::GetIBlockCacheTag($arTheme["CATALOG_IBLOCK_ID"]["VALUE"]))), $arItemsFilter, false, false, array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID"));
			?>
			<?if($arItems):?>
				<div class="ordered-block <?=$code?> cur with-title">
				<?if($arParams["T_GOODS"]):?>
					<div class="ordered-block__title option-font-bold font_lg">
						<?=$arParams["T_GOODS"];?>
					</div>
				<?endif;?>
			<?endif;?>

				<?if($arParams['SHOW_SECTIONS_FILTER']!="N"):?>
					<div class="sections_wrap_detail">
						<?
						if($arItems)
						{
							$arSectionsID = array();
							foreach($arItems as $arItem)
							{
								if($arItem["IBLOCK_SECTION_ID"])
								{
									if(is_array($arItem["IBLOCK_SECTION_ID"]))
										$arSectionsID = array_merge($arSectionsID, $arItem["IBLOCK_SECTION_ID"]);
									else
										$arSectionsID[] = $arItem["IBLOCK_SECTION_ID"];
								}
							}

							if($arSectionsID){
								$arSectionsID = array_unique($arSectionsID);
							}

							if($arSectionsID):?>
									<?$GLOBALS["arDetailSections"] = array("ID" => $arSectionsID);?>
									<?$APPLICATION->IncludeComponent(
										"aspro:catalog.section.list.max",
										"sections_tags",
										Array(
											"IBLOCK_TYPE" => "aspro_max_catalog",
											"IBLOCK_ID" => $arTheme["CATALOG_IBLOCK_ID"]["VALUE"],
											"SECTION_ID" => '',
											"SECTION_CODE" => '',
											"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
											"CACHE_TYPE" => $arParams["CACHE_TYPE"],
											"CACHE_TIME" => $arParams["CACHE_TIME"],
											"CACHE_GROUPS" => 'N',
											"SECTION_URL" => '',
											"COUNT_ELEMENTS" => "N",
											"ADD_SECTIONS_CHAIN" => "N",
											"SHOW_SECTION_LIST_PICTURES" => 'N',
											"TOP_DEPTH" => $arParams["SECTIONS_TAGS_DEPTH_LEVEL"],
											"FILTER_NAME" => "arDetailSections",
											"CACHE_FILTER" => "Y",
											"COUNT_ELEMENTS" => $arParams["SHOW_COUNT_ELEMENTS"],
											"SECTION_USER_FIELDS" => array("UF_CATALOG_ICON"),
											"SHOW_COUNT" => $arParams["TAGS_SECTION_COUNT"],
											"FILTER_ELEMENTS_CNT" => $arItemsFilter,
										),
										false, array("HIDE_ICONS" => "Y")
									);?>
							<?endif;
						}?>
					</div>
				<?endif;?>

				<div class="assoc-block js-load-block tabs_slider loader_circle content_linked_goods" data-sections-ids="" data-block="assoc" data-file="<?=$APPLICATION->GetCurPage()?>">
					<div class="stub"></div>
					<?if($arParams['IS_AJAX_SECTIONS']=="Y" || $arParams['FROM_AJAX'] == 'Y'){
						$APPLICATION->RestartBuffer();

						$arFilterSectionsIDs = json_decode($_REQUEST['ajax_section_id']);
						if($arParams['SHOW_SECTIONS_FILTER']!="N" && isset($arFilterSectionsIDs) && is_array($arFilterSectionsIDs) && count($arFilterSectionsIDs)>0){
							$GLOBALS["arrProductsFilter"]['SECTION_ID'] = $arFilterSectionsIDs;
							$GLOBALS["arrProductsFilter"]['INCLUDE_SUBSECTIONS'] = 'Y';
							$GLOBALS["arrProductsFilter"]['SECTION_GLOBAL_ACTIVE'] = 'Y';
						}
					}else{
						CMax::checkRestartBuffer(true, 'assoc');
					}?>
						<?if(CMax::checkAjaxRequest() || CMax::checkAjaxRequest2()):?>
							<?$APPLICATION->ShowAjaxHead();?>
							<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/detail.linked_products_block.php');?>
						<?endif;?>
					<?if($arParams['IS_AJAX_SECTIONS']=="Y" || $arParams['FROM_AJAX'] == 'Y'){
						die();
					}else{
						CMax::checkRestartBuffer(true, 'assoc');
					}?>
				</div>
			<?if($arItems):?>
				</div>
				<div class="line-after"></div>
			<?endif;?>
		<?endif;?>
	<?//goods sectios?>
	<?elseif($code == 'goods_sections'):?>
		<?if((in_array('LINK_GOODS', $arParams['PROPERTY_CODE']) || ($arParams['SHOW_LINKED_PRODUCTS'] == 'Y' && strlen($arParams['LINKED_PRODUCTS_PROPERTY'])))):?>
				<?$APPLICATION->ShowViewContent('only_sections_block')?>
		<?endif;?>
	<?//sale?>
	<?elseif($code == 'sale' && $templateData['LINK_SALE']):?>
		<?ob_start();?>
		<?$GLOBALS['arrSaleFilter'] = array('ID' => $templateData['LINK_SALE']);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"news-list",
			array(
				"IBLOCK_TYPE" => "aspro_max_content",
				"IBLOCK_ID" => $arParams['IBLOCK_LINK_SALE_ID'],
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "arrSaleFilter",
				"FIELD_CODE" => array(
					0 => "NAME",
					1 => "DETAIL_PAGE_URL",
					2 => "PREVIEW_TEXT",
					3 => "PREVIEW_PICTURE",
					4 => "ACTIVE_TO",
					5 => "DATE_ACTIVE_FROM",
				),
				"PROPERTY_CODE" => array(
					0 => "PERIOD",
					1 => "SALE_NUMBER",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"VIEW_TYPE" => "list",
				"IMAGE_POSITION" => "left",
				"COUNT_IN_LINE" => "3",
				"SHOW_TITLE" => "Y",
				"AJAX_OPTION_ADDITIONAL" => "",
				"BORDERED" => "Y",
				"LINKED_MODE" => "Y",
				"SALE_MODE" => "Y",
			),
			false, array("HIDE_ICONS" => "Y")
		);?>
		<?$html=ob_get_clean();?>
		<?if($html && trim($html) && strpos($html, 'error') === false):?>
			<div class="ordered-block <?=$code?> with-title">
				<div class="ordered-block__title option-font-bold font_lg ">
					<?=$arParams["BLOCK_SALE_NAME"];?>
				</div>
				<?=$html;?>
			</div>
			<div class="line-after"></div>
		<?endif;?>

	<?//goods catalog?>
	<?elseif($code == 'goods_catalog'):?>
		<?if((in_array('LINK_GOODS', $arParams['PROPERTY_CODE']) || ($arParams['SHOW_LINKED_PRODUCTS'] == 'Y' && strlen($arParams['LINKED_PRODUCTS_PROPERTY'])))):?>
				<?$APPLICATION->ShowViewContent('goods_catalog_block_prolog')?>
				<?$APPLICATION->ShowViewContent('goods_catalog_block')?>
				<?$APPLICATION->ShowViewContent('goods_catalog_block_epilog')?>
		<?endif;?>
	<?endif;?>
<?endforeach;?>


























	<div style="clear:both"></div>



</div><?//detail close?>

<?
//form question data
//$APPLICATION->SetPageProperty("ask_product_name", CMax::formatJsName($arResult['NAME']));
?>
<? if(!empty($arResult["BRING_OUT_RESEARCH"])): ?>
    <h2 class="research__title"><?=GetMessage("RESEARCH_LIST")?></h2>
    <?php
        $GLOBALS["RESEARCH"] = array("ID" => $arResult["BRING_OUT_RESEARCH"]);
        $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "catalog_block_stock",
            Array(
              "ACTION_VARIABLE" => "action",
              "ADD_PROPERTIES_TO_BASKET" => "Y",
              "ADD_SECTIONS_CHAIN" => "N",
              "ADD_TO_BASKET_ACTION" => "ADD",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "BACKGROUND_IMAGE" => "-",
              "BASKET_URL" => "/personal/basket.php",
              "BROWSER_TITLE" => "-",
              "CACHE_FILTER" => "N",
              "CACHE_GROUPS" => "Y",
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "COMPATIBLE_MODE" => "Y",
              "CONVERT_CURRENCY" => "N",
              "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
              "DETAIL_URL" => "",
              "DISABLE_INIT_JS_IN_COMPONENT" => "N",
              "DISPLAY_BOTTOM_PAGER" => "Y",
              "DISPLAY_COMPARE" => "N",
              "DISPLAY_TOP_PAGER" => "N",
              "ELEMENT_SORT_FIELD" => "sort",
              "ELEMENT_SORT_FIELD2" => "id",
              "ELEMENT_SORT_ORDER" => "asc",
              "ELEMENT_SORT_ORDER2" => "desc",
              "ENLARGE_PRODUCT" => "STRICT",
              "FILTER_NAME" => "RESEARCH",
              "HIDE_NOT_AVAILABLE" => "N",
              "HIDE_NOT_AVAILABLE_OFFERS" => "N",
              "IBLOCK_ID" => "26",
              "IBLOCK_TYPE" => "aspro_max_catalog",
              "INCLUDE_SUBSECTIONS" => "Y",
              "LAZY_LOAD" => "N",
              "LINE_ELEMENT_COUNT" => "5",
              "LOAD_ON_SCROLL" => "N",
              "MESSAGE_404" => "",
              "MESS_BTN_ADD_TO_BASKET" => "В корзину",
              "MESS_BTN_BUY" => "Купить",
              "MESS_BTN_DETAIL" => "Подробнее",
              "MESS_BTN_LAZY_LOAD" => "Показать ещё",
              "MESS_BTN_SUBSCRIBE" => "Подписаться",
              "MESS_NOT_AVAILABLE" => "Нет в наличии",
              "META_DESCRIPTION" => "-",
              "META_KEYWORDS" => "-",
              "OFFERS_CART_PROPERTIES" => array(),
              "OFFERS_FIELD_CODE" => array("",""),
              "OFFERS_LIMIT" => "5",
              "OFFERS_PROPERTY_CODE" => array("","1346","ARTICLE","POPUP_VIDEO","MORE_PHOTO","WEIGHT","AGE","SIZES2","RUKAV","FRCOLLECTION","FRLINE","VOLUME","FRMADEIN","FRELITE","SIZES3","SIZES4","SIZES5","TALL","FRTYPE",""),
              "OFFERS_SORT_FIELD" => "sort",
              "OFFERS_SORT_FIELD2" => "id",
              "OFFERS_SORT_ORDER" => "asc",
              "OFFERS_SORT_ORDER2" => "desc",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => ".default",
              "PAGER_TITLE" => "Товары",
              "PAGE_ELEMENT_COUNT" => "18",
              "PARTIAL_PRODUCT_PROPERTIES" => "N",
              "PRICE_CODE" => array("BASE"),
              "PRICE_VAT_INCLUDE" => "Y",
              "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
              "PRODUCT_ID_VARIABLE" => "id",
              "PRODUCT_PROPERTIES" => array(),
              "PRODUCT_PROPS_VARIABLE" => "prop",
              "PRODUCT_QUANTITY_VARIABLE" => "quantity",
              "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
              "PRODUCT_SUBSCRIPTION" => "Y",
              "PROPERTY_CODE" => array("","1347","MINIMUM_PRICE","MAXIMUM_PRICE","GORODA_GDE_NE_POKAZYVAT","HIT","YM_ELEMENT_ID","EXPANDABLES_FILTER","LINK_SALE","IN_STOCK","ASSOCIATED_FILTER","LINK_REGION","BLOG_POST_ID","QR_KOD_IE_QR_CODE_IMAGE","EXPANDABLES","CML2_ARTICLE","CML2_BASE_UNIT","BIG_BLOCK","LINK_VACANCY","VIDEO_YOUTUBE","POPUP_VIDEO","TO_BASKET_TO","PROP_2104","KOD","BLOG_COMMENTS_CNT","FORUM_MESSAGE_CNT","EXTENDED_REVIEWS_COUNT","vote_count","LINK_NEWS","PODBORKI","ASSOCIATED","HELP_TEXT","rating","EXTENDED_REVIEWS_RAITING","CML2_TRAITS","HIDE_CITY","LINK_STAFF","CML2_TAXES","LINK_BLOG","vote_sum","SALE_TEXT","FORUM_TOPIC_ID","PROP_2033","FAVORIT_ITEM","SERVICES","CML2_ATTRIBUTES","COLOR_REF2","TSVET_PROBIRKI","PRICE_BIROBIDZHAN","PRICE_HABAROVSK",""),
              "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
              "RCM_TYPE" => "personal",
              "SECTION_CODE" => "",
              "SECTION_ID" => "",
              "SECTION_ID_VARIABLE" => "SECTION_ID",
              "SECTION_URL" => "",
              "SECTION_USER_FIELDS" => array("","UF_YAMARKET_CATEGORY","UF_SECTION_DESCR","UF_SECTION_TEMPLATE","UF_POPULAR","UF_CATALOG_ICON","UF_OFFERS_TYPE","UF_TABLE_SIZES","UF_ELEMENT_DETAIL","UF_SECTION_BG_IMG","UF_SECTION_BG_DARK","UF_SECTION_TIZERS","UF_HELP_TEXT","UF_MENU_BANNER","UF_REGION","UF_PICTURE_RATIO","UF_LINE_ELEMENT_CNT","UF_SECTION_LANDING_PAGE","UF_MENU_BRANDS","UF_LINKED_BLOG","UF_BLOG_BOTTOM","UF_BLOG_WIDE","UF_BLOG_MOBILE","UF_LINKED_BANNERS","UF_BANNERS_BOTTOM","UF_BANNERS_WIDE","UF_BANNERS_MOBILE",""),
              "SEF_MODE" => "N",
              "SET_BROWSER_TITLE" => "Y",
              "SET_LAST_MODIFIED" => "N",
              "SET_META_DESCRIPTION" => "Y",
              "SET_META_KEYWORDS" => "Y",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "Y",
              "SHOW_404" => "N",
              "SHOW_ALL_WO_SECTION" => "N",
              "SHOW_CLOSE_POPUP" => "N",
              "SHOW_DISCOUNT_PERCENT" => "N",
              "SHOW_FROM_SECTION" => "N",
              "SHOW_MAX_QUANTITY" => "N",
              "SHOW_OLD_PRICE" => "N",
              "SHOW_PRICE_COUNT" => "1",
              "SHOW_RATING" => "Y",
              "SHOW_SLIDER" => "Y",
              "TEMPLATE_THEME" => "blue",
              "USE_ENHANCED_ECOMMERCE" => "N",
              "USE_MAIN_ELEMENT_SECTION" => "N",
              "USE_PRICE_COUNT" => "N",
              "USE_PRODUCT_QUANTITY" => "N"
            )
        );
endif; ?>
