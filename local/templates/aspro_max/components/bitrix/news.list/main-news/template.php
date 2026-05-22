<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>


<?if($arResult['ITEMS']):?>

    <div class="main-news">

        <div class="main-news__header">

            <div class="main-news__header-title">
               <?=$arParams['TITLE_BLOCK']?>
            </div>

            <div class="main-news__header-link">
                <a href="<?=SITE_DIR.$arParams['ALL_URL'];?>">
					<?=$arParams['TITLE_BLOCK_ALL'] ;?>
					<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 9L5 5L1 1" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
            </div>

        </div>    

        <div class="main-news__body">
            <div class="news-carousel swiper js-news-carousel">

                <div class="news-list-items news-carousel-wrapper swiper-wrapper">
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
                        <div class="news-list-items__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                            <a class="news-list-items__image" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?if(is_array($arItem["PREVIEW_PICTURE"])){?>
                                <img class="news-list-items__img"
                                src="<?=$image['src'] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">    
                                <?}?>    
                            </a>
                            
                            <div class="news-list-items__date">
                                <?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
                            </div>

                            <div class="news-list-items__title">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                            </div>

                        </div>

                    <?}?>
              </div>
               
            </div>
        </div>

    </div>

    <script>
       
        const swipernews = document.querySelectorAll('.js-news-carousel');

        if (swipernews.length > 0) {
            swipernews.forEach(function(carousel, index) {            

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