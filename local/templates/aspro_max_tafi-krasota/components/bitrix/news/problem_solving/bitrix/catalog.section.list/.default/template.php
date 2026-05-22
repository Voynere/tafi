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
<div class="section-compact-list">
	<div class="row margin0 flexbox">
        <?
        foreach ($arResult['SECTIONS'] as &$arSection)
        {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

        if (false === $arSection['PICTURE'])
        $arSection['PICTURE'] = array(
        'SRC' => $arCurView['EMPTY_IMG'],
        'ALT' => (
        '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
        ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
        : $arSection["NAME"]
        ),
        'TITLE' => (
        '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
        ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
        : $arSection["NAME"]
        )
        );
        ?>
		<div class="col-lg-3 col-md-4 col-xs-6 col-xxs-12">
			<div class="section-compact-list__item item bordered box-shadow flexbox flexbox--row" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<div class="section-compact-list__info">
 <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="section-compact-list__link dark_link option-font-bold"><? echo $arSection['NAME']; ?></a>


                    <div class="name<?=($bBigBlock ? ' text-center' : '');?>"></div>



				</div>
			</div>
		</div>
        <?}?>
	</div>
</div>