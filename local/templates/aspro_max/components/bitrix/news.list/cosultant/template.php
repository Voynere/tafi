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

<div class="section-consultant-doctor">

	<? foreach ($arResult["ITEMS"] as $arItem) {?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$arSectionImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["IMG_ONE"]["VALUE"], BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arSectionImageM = CFile::ResizeImageGet($arItem["PROPERTIES"]["IMG_ONE_M"]["VALUE"], BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arSectionImage2 = CFile::ResizeImageGet($arItem["PROPERTIES"]["IMG_TWO"]["VALUE"], BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
		
		<div class="section-consultant-doctor__item" id="<?=$this->GetEditAreaId($arItem['ID'])?>" 
			style="background-image: url('<?= $arItem["PREVIEW_PICTURE"]['SRC'] ?>');">

			<?if(is_array($arItem["DETAIL_PICTURE"])){?>
			<img src="<?= $arItem["DETAIL_PICTURE"]['SRC'] ?>" alt="" class="section-consultant-doctor__bg-mobile">
			<?}?>


			<div class="section-consultant-doctor__content">

				<div class="section-consultant-doctor__title"><?= $arItem["NAME"] ?></div>		
				<div class="section-consultant-doctor__text-one"><?= $arItem["PROPERTIES"]["TEXT_ONE"]["VALUE"] ?></div>
				<div class="section-consultant-doctor__text-two"><?= $arItem["PROPERTIES"]["TEXT_TWO"]["VALUE"] ?></div>

				<a class="section-consultant-doctor__button" 

					<?if( $arItem["PROPERTIES"]["LINK_ONE"]["VALUE"]){?>
					href="<?= $arItem["PROPERTIES"]["LINK_ONE"]["VALUE"] ?>"
					<?}else{?>
						data-event="jqm" data-param-form_id="SIGN_UP_ONLINE" data-name="SIGN_UP_ONLINE"	
					<?}?>	

				>
					<!--svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.8338 2.18919C11.4441 0.77027 9.52316 0 7.56131 0C3.39237 0 0.040872 3.36486 0.0817439 7.45946C0.0817439 8.75676 0.449591 10.0135 1.06267 11.1486L0 15L3.96458 13.9865C5.06812 14.5946 6.29428 14.8784 7.52044 14.8784C11.6485 14.8784 15 11.5135 15 7.41892C15 5.43243 14.2234 3.56757 12.8338 2.18919ZM7.56131 13.6216C6.45777 13.6216 5.35422 13.3378 4.41417 12.7703L4.16894 12.6486L1.79837 13.2568L2.41144 10.9459L2.24796 10.7027C0.449591 7.82432 1.3079 4.01351 4.25068 2.22973C7.19346 0.445946 10.9946 1.2973 12.7929 4.21622C14.5913 7.13513 13.733 10.9054 10.7902 12.6892C9.85014 13.2973 8.70572 13.6216 7.56131 13.6216ZM11.158 9.12162L10.7084 8.91892C10.7084 8.91892 10.0545 8.63513 9.64578 8.43243C9.60491 8.43243 9.56403 8.39189 9.52316 8.39189C9.40055 8.39189 9.3188 8.43243 9.23706 8.47297C9.23706 8.47297 9.19619 8.51351 8.62398 9.16216C8.58311 9.24324 8.50136 9.28378 8.41962 9.28378H8.37875C8.33788 9.28378 8.25613 9.24324 8.21526 9.2027L8.0109 9.12162C7.56131 8.91892 7.15259 8.67568 6.82561 8.35135C6.74387 8.27027 6.62125 8.18919 6.53951 8.10811C6.25341 7.82432 5.9673 7.5 5.76294 7.13514L5.72207 7.05405C5.6812 7.01351 5.6812 6.97297 5.64033 6.89189C5.64033 6.81081 5.64033 6.72973 5.6812 6.68919C5.6812 6.68919 5.84469 6.48649 5.9673 6.36487C6.04905 6.28378 6.08992 6.16216 6.17166 6.08108C6.25341 5.95946 6.29428 5.7973 6.25341 5.67568C6.21253 5.47297 5.72207 4.37838 5.59946 4.13514C5.51771 4.01351 5.43597 3.97297 5.31335 3.93243H5.19074C5.10899 3.93243 4.98638 3.93243 4.86376 3.93243C4.78202 3.93243 4.70027 3.97297 4.61853 3.97297L4.57766 4.01351C4.49591 4.05405 4.41417 4.13514 4.33243 4.17568C4.25068 4.25676 4.20981 4.33784 4.12807 4.41892C3.84196 4.78378 3.67847 5.22973 3.67847 5.67568C3.67847 6 3.76022 6.32432 3.88283 6.60811L3.92371 6.72973C4.29155 7.5 4.78202 8.18919 5.43597 8.7973L5.59946 8.95946C5.72207 9.08108 5.84469 9.16216 5.92643 9.28378C6.78474 10.0135 7.76567 10.5405 8.86921 10.8243C8.99183 10.8649 9.15531 10.8649 9.27793 10.9054C9.40055 10.9054 9.56403 10.9054 9.68665 10.9054C9.89101 10.9054 10.1362 10.8243 10.2997 10.7432C10.4223 10.6622 10.5041 10.6622 10.5858 10.5811L10.6676 10.5C10.7493 10.4189 10.8311 10.3784 10.9128 10.2973C10.9946 10.2162 11.0763 10.1351 11.1172 10.0541C11.1989 9.89189 11.2398 9.68919 11.2807 9.48649C11.2807 9.40541 11.2807 9.28378 11.2807 9.2027C11.2807 9.2027 11.2398 9.16216 11.158 9.12162Z" fill="#333333"/>
					</svg-->
					<span>Написать врачу</span>
				</a>

			</div>

			<div class="section-consultant-doctor__person">

				<div class="section-consultant-doctor__person-item">

					<div class="section-consultant-doctor__person-image">
						<?if($arSectionImageM){?>
						<img class="section-consultant-doctor__person-img-m" alt="<?=$arItem["PROPERTIES"]["FIO_ONE"]["VALUE"]?>" src='<?= $arSectionImageM["src"] ?>'>
						<?}?>
						<img class="section-consultant-doctor__person-img" alt="<?=$arItem["PROPERTIES"]["FIO_ONE"]["VALUE"]?>" src='<?= $arSectionImage["src"] ?>'>						
					</div>

					<div class="section-consultant-doctor__person-info">
						
						<div class="section-consultant-doctor__person-name">
							<?=$arItem["PROPERTIES"]["FIO_ONE"]["VALUE"]?>	
						</div>

						<div class="section-consultant-doctor__position">
							<?=$arItem["PROPERTIES"]["DOLJNOST_ONE"]["VALUE"]?>
						</div>

						<div class="section-consultant-doctor__person-text">
							<?= $arItem["PROPERTIES"]["TEXT_ONE_IMG"]["VALUE"] ?>
						</div>

					</div>

					
					
				</div>

			</div>

			
		</div>
	<? } ?>

</div>