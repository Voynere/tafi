<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); ?>

<? if(count($arResult['SECTIONS'])): ?>
    <?
    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <div class="maxwidth-theme">
        <div class="kids-sections">
            <h2 class="kids-sections__title" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"><?=GetMessage("KIDS_TITLE")?></h2>
            <div class="kids-sections__blocks">
                <? foreach ($arResult['SECTIONS'] as &$arSection): ?>
                    <?
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                    $image = !empty($arSection["PICTURE"]["SRC"]) ? $arSection["PICTURE"]["SRC"] : '/images/kids/kids-no-photo.png';
                    $imageAlt = $arSection["PICTURE"]["ALT"];
                    ?>
                    <a class="kids-sections__block" href="<?=$arSection['SECTION_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
                        <div class="kids-sections__image-block">
                            <img src="<?=$image?>" alt="<?=$imageAlt?>">
                        </div>
                        <div class="kids-sections__link">
                            <?=$arSection['NAME']?>
                        </div>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>