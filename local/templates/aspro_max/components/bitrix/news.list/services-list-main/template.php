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
<?if($arResult["ITEMS"]){?>
    <div class="services-list-main">

        <div class="services-list-main__carousel js-services-list-main-carousel swiper">


            <div class="services-list-main__items swiper-wrapper">

                <?foreach($arResult["ITEMS"] as $arItem) {
                    ?>

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
                    ?>

                    <a class="services-list-main__item swiper-slide"

                       <?if($arItem['PROPERTIES']['LINK']['VALUE']){?>
                       href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"
                       <?}else{?>
                       data-event="jqm" data-param-form_id="SIGN_UP_ONLINE" data-name="SIGN_UP_ONLINE"
                       <?}?>
                        id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                        <img class="services-list-main__item__item-img"
                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">

                        <span class="services-list-main__item__item-title"><?=$arItem['PREVIEW_TEXT'] ?: $arItem['NAME']?></span>

                    </a>

                    <?
                }?>


            </div>

        </div>
        
    </div>

    <script>
       
        const swiperServicesList = document.querySelectorAll('.js-services-list-main-carousel');

        if (swiperServicesList.length > 0) {
            swiperServicesList.forEach(function(carousel, index) {            

                const swiper = new Swiper(carousel, {
                    slidesPerView: 'auto',
                    loop: false,
                    spaceBetween: 6,

                    
					 breakpoints: {

						768: {
                            spaceBetween: 20
						},

	
					},

                });
            });
        }
       
    </script>
<?php }?>