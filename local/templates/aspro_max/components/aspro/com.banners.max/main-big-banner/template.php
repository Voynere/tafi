<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<div class="main-big-banner js-main-big-banner swiper">

		<div class="main-big-banner__items swiper-wrapper">

			<?foreach($arResult["ITEMS"][$arParams["BANNER_TYPE_THEME"]]["ITEMS"] as $i => $arItem){?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				if($arItem["DETAIL_PICTURE"]['ID']){
					$image = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]['ID'], array('width'=>1920, 'height'=>1500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				}else{
					$image = false;
				}

				if($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE']){
					$image2 = CFile::ResizeImageGet($arItem["PROPERTIES"]['TABLET_IMAGE']['VALUE'], array('width'=>500, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				}else{
					$image2 = false;
				}

				$arItem["NAME"] = strip_tags($arItem["~NAME"]);
				$target = $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"];

			?>

			<div class="main-big-banner__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>" <?if($image){?> style="background-image: url(<?=$image['src']?>)"<?}?>>

				<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
					<a class="main-big-banner__item-target" href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
				<?endif;?>

				<?if($image2){?>
					<img class="main-big-banner__img-mobile" src="<?=$image2['src']?>" alt="">
				<?}?>
				
				<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
					</a>
				<?endif;?>

			</div>

			<?}?>

		</div>

		<div class="main-big-banner__pagination js-pagination"></div>

	</div>

	<script>
		const  swiperBannerMain = document.querySelectorAll('.js-main-big-banner');

		if(swiperBannerMain.length > 0){

			swiperBannerMain.forEach(function(carousel, index){

				const container = carousel;
	
				const pagination = container.querySelector('.js-pagination');

				const swiper= new Swiper(carousel, {

					slidesPerView: 1,
					loop: false,

					pagination: {
						el: pagination,
						clickable: true,
					},


				});

			});

		}
	</script>

<?endif;?>