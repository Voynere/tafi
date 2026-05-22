<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>


<?if($arResult['ITEMS']):?>

    <div class="main-brands">

        <div class="main-brands__header">

            <div class="main-brands__header-title">
               <?= htmlspecialcharsBack($arParams['TITLE_BLOCK'])?>
            </div>

            <div class="main-brands__header-link">
                <a href="<?=SITE_DIR.$arParams['ALL_URL'];?>">
					<?=$arParams['TITLE_BLOCK_ALL'] ;?>
					<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 9L5 5L1 1" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
            </div>

        </div>    

        <div class="main-brands__body">
          
                <div class="brands-list-items">
                    <?foreach($arResult['ITEMS'] as $i => &$arItem){?>
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
                        
                        $imageId = $arItem["PREVIEW_PICTURE"]['ID'] ?? '';

                        if(!$imageId && $arItem["PREVIEW_PICTURE"] > 0){
                            $imageId = $arItem["PREVIEW_PICTURE"]; 
                            $arItem["PREVIEW_PICTURE"] = CFile::GetFileArray($imageId);          
                        }    

                        if($imageId){                            
                           $arItem['IMAGE'] = CFile::ResizeImageGet($imageId, array('width'=>500, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
             
                        }else{
                            $arItem['IMAGE']  = false;
                        }    

                        ?>
                        <div class="brands-list-items__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                            <a class="brands-list-items__image" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?if(is_array($arItem["PREVIEW_PICTURE"])){?>
                                <img class="brands-list-items__img"
                                src="<?=$arItem['IMAGE']['src'] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">    
                                <?}?>    
                            </a>

                        </div>

                    <?}?>
                    <?unset($arItem)?>
              </div>



              <div class="brands-carousel swiper brands-carousel--mobile js-brands-carousel">

                    <div class="brands-carousel__items swiper-wrapper">
                       <?foreach($arResult['ITEMS'] as $i => $arItem){?>
                       <?
                        $imageId = $arItem["PREVIEW_PICTURE"]['ID'] ?? '';

                        if(!$imageId && $arItem["PREVIEW_PICTURE"] > 0){
                            $imageId = $arItem["PREVIEW_PICTURE"]; 
                            $arItem["PREVIEW_PICTURE"] = CFile::GetFileArray($imageId);          
                        }    

                        ?>
                        <div class="brands-carousel__item swiper-slide">

                            <a class="brands-carousel__image" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?if(is_array($arItem["PREVIEW_PICTURE"])){?>
                                <img class="brands-carousel__img"
                                src="<?=$arItem['IMAGE']['src'] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">    
                                <?}?>    
                            </a>

                        </div>

                    <?}?>                 

                    </div>                
                    
              </div>
               
            
        </div>

    </div>


    <script>
       
        const swiperBrands = document.querySelectorAll('.js-brands-carousel');

        if (swiperBrands.length > 0) {
            swiperBrands.forEach(function(carousel, index) {  
							

                const swiper = new Swiper(carousel, {
                    slidesPerView: 'auto',
                    loop: false,
                    spaceBetween: 8,
                });
            });
        }
       
    </script>


<?endif;?>