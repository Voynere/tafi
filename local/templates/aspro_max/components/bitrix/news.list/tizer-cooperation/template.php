<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>


	<?$bSmallBlock = ($arParams['SMALL_BLOCK'] == 'Y');?>
<div class="tizer-coop__wrapper">
	<div class="content_wrapper_block <?=$templateName;?>">
		<div class="maxwidth-theme only-on-front">
			<?if($arParams['INCLUDE_FILE']):?>
				<div class="with-text-block-wrapper">
					<div class="row">
						<div class="col-md-3">
							<div class="text_before_items font_md">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/mainpage/inc_files/".$arParams['INCLUDE_FILE'],
										"EDIT_TEMPLATE" => ""
									)
								);?>
							</div>
						</div>
                    <div class="col-md-9">
			<?endif;?>
			<?
			$sTemplateMobile = (isset($arParams['MOBILE_TEMPLATE']) ? $arParams['MOBILE_TEMPLATE'] : '');
        	$bList = ($sTemplateMobile === 'list');
        	//var_dump($bList);
        	?>
            <div class="tizer-coop__header">
                <div class="tizer-coop__header_name">
                    <h3><?=$arResult['SECTION']['PATH'][0]['NAME']?></h3>
                </div>
            </div>
			<div class="tizer-coop__row">
                <?foreach($arResult['ITEMS'] as $i => $arItem):?>
                    <?
                    // edit/add/delete buttons for edit mode
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    // use detail link?
                    $bDetailLink = isset($arItem['PROPERTIES']['LINK']['VALUE']) && $arItem['PROPERTIES']['LINK']['VALUE'];

                    // preview image
                    $bImage = ($arItem['FIELDS']['PREVIEW_PICTURE'] ? $arItem['FIELDS']['PREVIEW_PICTURE']['ID'] : '');
                    if(isset($arItem['DISPLAY_PROPERTIES']['ICON']) && $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'])
                        $bImage = $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'];

                    $col = (round(12/$arParams['SIZE_IN_ROW']));?>
                    <div class="tizer-coop__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="tizer-coop__item_img">
                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="">
                        </div>
                        <div class="tizer-coop__item_name">
                            <p><?=$arItem['NAME']?></p>
                        </div>
                    </div>
                <?endforeach;?>
			</div>
			<?if($arParams['INCLUDE_FILE']):?>
				</div>
                    </div>
                </div>
			<?endif;?>
		</div>
	</div>
</div>
<?endif;?>