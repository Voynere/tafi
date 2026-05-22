<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>

<?pre($arResult)?>
<?if($arResult['ITEMS']):?>

		<?foreach($arResult['ITEMS'] as $i => $arItem):?>
			<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// show preview picture?
                $imageSrc = CFile::GetPath($arItem["PROPERTIES"]["BANNER_DESK_IMG"]["VALUE"]);
                $imageSrcM = CFile::GetPath($arItem["PROPERTIES"]["BANNER_MOB_IMG"]["VALUE"]);
			?>
			<div class="banner item <?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']?> <?=$arParams['POSITION']?> <?=($arItem['PROPERTIES']['HIDDEN_SM']['VALUE_XML_ID']=='Y'?'hidden-sm':'')?> <?=($arItem['PROPERTIES']['HIDDEN_XS']['VALUE_XML_ID']=='Y'?'hidden-xs':'')?>" <?=($arItem['PROPERTIES']['BGCOLOR']['VALUE']?' style=" background:'.$arItem['PROPERTIES']['BGCOLOR']['VALUE'].';"':'')?> id="<?=$this->GetEditAreaId($arItem['ID'])?>">
				<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
					<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" <?=($arItem["PROPERTIES"]["TARGET"]["VALUE_XML_ID"] ? "target='".$arItem["PROPERTIES"]["TARGET"]["VALUE_XML_ID"]."'" : "");?>>
				<?endif;?>
					<?if($arParams['SLIDER_MODE'] === 'Y'):?>
						<span class="lazy set-position center" data-src="<?=$imageSrc?>" title="<?=$arItem['NAME']?>" style="background-image:url('<?=\Aspro\Functions\CAsproMax::showBlankImg($imageSrc);?>')"></span>
					<?else:?>
						<img src="<?=$imageSrc?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="<?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']=='CROP'?'':'img-responsive'?> desktop-banner" />
                        <img src="<?=$imageSrcM?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="<?=$arItem['PROPERTIES']['SIZING']['VALUE_XML_ID']=='CROP'?'':'img-responsive'?> mobile-banner" />
					<?endif;?>
				<?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
					</a>
				<?endif;?>
			</div>
		<?endforeach;?>

<?endif;?>