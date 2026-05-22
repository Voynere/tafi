<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? use \Bitrix\Main\Localization\Loc; ?>
<? if ($arResult['ITEMS']): ?>
    <? $bSmallBlock = ($arParams['SMALL_BLOCK'] == 'Y'); ?>
    <div class="content_wrapper_block <?= $templateName; ?>">
        <div class="maxwidth-theme only-on-front">
            <? if ($arParams['INCLUDE_FILE']): ?>
            <div class="with-text-block-wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text_before_items font_md">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/mainpage/inc_files/" . $arParams['INCLUDE_FILE'],
                                    "EDIT_TEMPLATE" => ""
                                )
                            ); ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <? endif; ?>
                        <?
                        $sTemplateMobile = (isset($arParams['MOBILE_TEMPLATE']) ? $arParams['MOBILE_TEMPLATE'] : '');
                        $bList = ($sTemplateMobile === 'list');
                        //var_dump($bList);
                        ?>
                        <div class="dmc-companys__header">
                            <div class="dmc-companys__header_title">
                                <h3>Мы сотрудничаем со страховыми компаниями</h3>
                            </div>
                        </div>
                        <div class="dmc-companys__row">
                            <? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
                                <?
                                // edit/add/delete buttons for edit mode
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                // use detail link?
                                $bDetailLink = isset($arItem['PROPERTIES']['LINK']['VALUE']) && $arItem['PROPERTIES']['LINK']['VALUE'];

                                // preview image
                                $bImage = ($arItem['FIELDS']['PREVIEW_PICTURE'] ? $arItem['FIELDS']['PREVIEW_PICTURE']['ID'] : '');
                                if (isset($arItem['DISPLAY_PROPERTIES']['ICON']) && $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'])
                                    $bImage = $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'];

                                $col = (round(12 / $arParams['SIZE_IN_ROW'])); ?>
                                <a href="<?= $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'] ?>">
                                    <div class="dmc-companys__row_item"
                                         id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                                        <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
                                        <p><?= $arItem["NAME"] ?></p>
                                    </div>
                                </a>
                            <? endforeach; ?>
                        </div>
                        <? if ($arParams['INCLUDE_FILE']): ?>
                    </div>
                </div>
            </div>
        <? endif; ?>
        </div>
    </div>
<? endif; ?>
