<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>


<?if($arResult['ITEMS']):?>

    <div class="main-sale">

        <div class="main-sale__header">

            <div class="main-sale__header-title">
               <?=$arParams['TITLE_BLOCK']?>
            </div>

            <div class="main-sale__header-link">
                <a href="<?=SITE_DIR.$arParams['ALL_URL'];?>">
                    Посмотреть все акции
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9L5 5L1 1" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>

        </div>    

        <div class="main-sale__body">
            <div class="sales-carousel swiper js-sales-carousel">

                <div class="sales-list-items sales-carousel-wrapper swiper-wrapper">
                    <?foreach($arResult['ITEMS'] as $i => $arItem){?>
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
                            $image = CFile::ResizeImageGet($imageId, array('width'=>500, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        }else{
                            $image = false;
                        }    

                        ?>
                        <div class="sales-list-items__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                            <a class="sales-list-items__image" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?if(is_array($arItem["PREVIEW_PICTURE"])){?>
                                <img class="sales-list-items__img"
                                src="<?=$image['src'] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">    
                                <?}?>    
                            </a>
                            
                            <div class="sales-list-items__date">
                                <?echo $arItem["DISPLAY_ACTIVE_FROM"]?> <?echo $arItem["DISPLAY_ACTIVE_TO"] ? ' — '.$arItem["DISPLAY_ACTIVE_TO"] : ''?>
                            </div>

                            <div class="sales-list-items__title">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            </div>

                        </div>

                    <?}?>
              </div>
               
            </div>
        </div>

    </div>

    <script>
       
        const swiperSales = document.querySelectorAll('.js-sales-carousel');

        if (swiperSales.length > 0) {
            swiperSales.forEach(function(carousel, index) {            

                const swiper = new Swiper(carousel, {
                    slidesPerView: 'auto',
                    loop: false,
                    spaceBetween: 8,
                    
                     breakpoints: {
                        768: {
                           spaceBetween: 20
                        },            
                    },


                });
            });
        }
       
    </script>


<?endif;?>