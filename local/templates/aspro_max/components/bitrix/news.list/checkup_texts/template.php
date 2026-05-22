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
			<div class="checkup-text__row <?=$arParams['TYPE_IMG'];?>">

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
							<div class="checkup-text__row_item hide-after-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<p><?=$arItem['DETAIL_TEXT']?></p>
							</div>
						<?endforeach;?>

			</div>
                            <div id="revealButton">
                               <div class="btn-cont">
                                   <img class="text-arrow" src="<?=SITE_TEMPLATE_PATH?>/images/Chevron.png" alt="">
                                   <div class="soon__text active">Читать далее</div>
                                   <div class="back__text">Скрыть описание</div>
                               </div>
                            </div>

			<?if($arParams['INCLUDE_FILE']):?>
				</div></div></div>
			<?endif;?>

		</div>
	</div>
<?endif;?>



<script>
	console.log('vcvvcv')
        var elementsToHide = document.querySelectorAll('.hide-after-4');
        var btnToHide = document.getElementById('revealButton');
        if(elementsToHide.length <= 2){
            btnToHide.style.display = 'none';
        }
        for (var i = 2; i < elementsToHide.length; i++) {
            elementsToHide[i].style.display = 'none';

        }



        document.getElementById('revealButton').addEventListener('click', function() {
            let soonT = document.querySelector('.soon__text');
            let backT = document.querySelector('.back__text');
            let arrowT = document.querySelector('.text-arrow');
            soonT.classList.toggle('active');
            arrowT.classList.toggle('active')
            backT.classList.toggle('active');
            elementsToHide.forEach(function(element) {
                element.classList.toggle('active');
            });
        });
</script>
