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
?>
<?if($arResult["ITEMS"]){?>
    <div class="main-about">

        <div class="main-about__header">

            <div class="main-about__title">
                <?=$arResult['IBLOCK_INFO']['NAME']?>
            </div>
            
            <div class="main-about__desc">
                <?=$arResult['IBLOCK_INFO']['DESCRIPTION']?>
                <div class="main-about__more">
                    <a href="/company/">Подробнее о компании</a>
                </div>
            </div>
        </div>

        <div class="main-about__content">

            <div class="main-about__items">                

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

                        <div class="main-about__item <?=$arItem['PROPERTIES']['CLASS']['VALUE']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >

                            <?if(is_array($arItem["PREVIEW_PICTURE"])){?>
                            <div class="main-about__item-icon">
                                <img class="main-about__item-icon-img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
                            </div>
                            <?}?>        
                            
                            
                            <div class="main-about__item-title">
                                <?=$arItem['NAME']?>
                            </div>

                            <div class="main-about__item-desc">
                                <?=$arItem['PREVIEW_TEXT']?>
                            </div>

                             <?if(is_array($arItem["DETAIL_PICTURE"])){?>
                            <div class="main-about__item-image">
                                <img class="main-about__item-img" src="<?= $arItem["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arItem["DETAIL_PICTURE"]["TITLE"] ?>">
                            </div>
                            <?}?>    

                           
                        </div>

                    <?
                    }?>

            </div>

        </div>
    </div>
<?php }?>