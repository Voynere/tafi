<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;
?>
<?if($arResult["ITEMS"]){?>
    <div class="section-doctors-main">

        <div class="section-doctors-main__header">

            <div class="section-doctors-main__title">
                Наши специалисты
            </div>
            
            <a href="/doctors/" class="section-doctors-main__all">
                Все специалисты
                <span class="section-doctors-main__arrow">
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9L5 5L1 1" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>

        <div class="section-doctors-main__content">

            <div class="section-doctors-main__container-carousel">

                <div class="doctors-carouser js-doctors-carouser swiper">

                    <div class="doctors-list-items doctors-carouser__wrapper swiper-wrapper">

                        <?foreach($arResult["ITEMS"] as $arItem) {
                        ?>

                            <?
                            $this->AddEditAction(
                                    $arItem['ID'],
                                    $arItem['EDIT_LINK'],
                                    CIBlock::GetArrayByID(
                                            $arItem["IBLOCK_ID"],
                                            "ELEMENT_EDIT"
                                    )
                            );
                            $this->AddDeleteAction(
                                    $arItem['ID'],
                                    $arItem['DELETE_LINK'],
                                    CIBlock::GetArrayByID(
                                            $arItem["IBLOCK_ID"],
                                            "ELEMENT_DELETE"),
                                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
                            );
                            ?>

                            <div class="doctors-list-items__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                                <a class="doctors-list-items__image" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                    <img class="doctors-list-items__img"
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">    
                                </a>
                                
                                <div class="doctors-list-items__title">
                                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                                </div>

                                <?if($arItem['PROPERTIES']['PROP_POSITION']['VALUE']){?>
                                <div class="doctors-list-items-prop doctors-list-items-prop--speciality">
                                    <?=is_array($arItem['PROPERTIES']['PROP_POSITION']['VALUE']) ? implode(', ', $arItem['PROPERTIES']['PROP_POSITION']['VALUE']) : $arItem['PROPERTIES']['PROP_POSITION']['VALUE']?>
                                </div>
                                <?}?>

                                <?if($arItem['PROPERTIES']['PROP_EXPERIENCE']['VALUE']){?>
                                <div class="doctors-list-items-prop doctors-list-items-prop--exp">
                                    Стаж <?=$arItem['PROPERTIES']['PROP_EXPERIENCE']['VALUE']?>
                                </div>
                                <?}?>
                                
                                <?if($arItem['PROPERTIES']['PROP_ADDRESS']['VALUE']){?>
                                <div class="doctors-list-items-prop doctors-list-items-prop--address">
                                    <?=is_array($arItem['PROPERTIES']['PROP_ADDRESS']['VALUE']) ? implode(', ', $arItem['PROPERTIES']['PROP_ADDRESS']['VALUE']) : $arItem['PROPERTIES']['PROP_ADDRESS']['VALUE']?>
                                </div>
                                <?}?>

                                <div class="doctors-list-items__buttons">
                                    <?php if($arItem['PROPERTIES']['PROP_APPOINTMENT_LINK']['VALUE']): ?>
                                        <a class="doctors-list-items_action" target="_blank" href="<?= $arItem['PROPERTIES']['PROP_APPOINTMENT_LINK']['VALUE'] ?>"><?= Loc::getMessage('MSG_APPOINTMENT_LINK') ?></a>
                                    <?php else: ?>
                                    <button type="button" class="doctors-list-items_action"
                                            data-event="jqm"
                                            data-param-form_id="MAKE_AN_APPOINTMENT"
                                            data-name="MAKE_AN_APPOINTMENT"
                                            data-param-DOCTORS_NAME="<?= str_replace(' ', '@', $arItem['NAME']) ?>">Записаться на прием</button>
                                    <?php endif; ?>
                                </div>


                            </div>

                        <?
                        }?>

                    </div>

                    <div class="doctors-carouser__pagination js-pagination"></div>

                </div>

            </div>

        </div>
    </div>
<?php }?>