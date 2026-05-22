<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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


<div class="partners-list">
    <div class="item-views items-list1 table table-type-block  image_left ">
        <div class="group-content">
            <div class="tab-pane active">
                <div class="row sid items flexbox">
                    <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="box-shadow bordered colored_theme_hover_bg-block item-wrap col-md-4 col-sm-6 col-xs-12">
                            <div class="item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="image  w-picture">
                                            <a target="_blank" href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" title="">
                                                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="" title="" class="img-responsive lazy">
                                            </a>
                                        </div>
                                        <div class="text">
                                            <a target="_blank" href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" title="" class="title font_mlg ">
                                                <?= $arItem["NAME"] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>