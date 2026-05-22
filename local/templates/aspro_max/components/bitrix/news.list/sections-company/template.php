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
<div class="sections-company">
    <div class="sections-company__items">

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

            <a class="sections-company__item" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" 
                id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                <span class="sections-company__item-title"><?=$arItem['NAME']?></span>
                
                <img class="sections-company__item-img"
                     src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                     alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                     title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                >

            </a>

            <?
        }?>


    </div>
</div>
<?php }?>