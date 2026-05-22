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
    <div class="popular-services-main">

        <?php if (!$arParams['IS_SERVICES_PAGE']): ?>
            <div class="popular-services-main__header">
                Популярные услуги
            </div>
        <?php endif; ?>

        <div class="popular-services-main__items">

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
                $link = !empty($arItem['PROPERTIES']['LINK']['VALUE']) 
                    ? $arItem['PROPERTIES']['LINK']['VALUE'] 
                    : $APPLICATION->getCurDir() . $arItem["CODE"];
                ?>

                <a class="popular-services-main__item" href="<?= $link ?>" 
                    id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                    <img class="popular-services-main__item-img"
                         src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                         alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                         title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">

                    <span class="popular-services-main__item-title"><?=$arItem['NAME']?></span>

                </a>

                <?
            }?>


        </div>
    </div>
<?php }?>