<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<?$bSmallBlock = ($arParams['SMALL_BLOCK'] == 'Y');?>
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
            <div class="checkup-questions__title">
                <h3><?=$arResult['SECTION']['PATH'][0]['NAME']?></h3>
            </div>
			<div class="checkup-questions__list">
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
							<div class="checkup-questions__list_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="checkup-questions__item_header accordion">
                                    <div class="checkup-questions__item_name ">
                                        <h4><?=$arItem['NAME']?></h4>
                                    </div>
                                    <div class="checkup-questions__item_arrow">
                                  <img src="<?=SITE_TEMPLATE_PATH?>/images/questionarrow.png" alt="">
                                    </div>
                                </div>
                                <div class="checkup-questions__item_question panel">
                                    <p><?=$arItem['PREVIEW_TEXT']?></p>
                                </div>
							</div>
						<?endforeach;?>

			</div>
			<?if($arParams['INCLUDE_FILE']):?>
				</div></div></div>
			<?endif;?>
		</div>
	</div>
<?endif;?>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            var arrow = this.querySelector('.checkup-questions__item_arrow');
            arrow.classList.toggle("active");
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
