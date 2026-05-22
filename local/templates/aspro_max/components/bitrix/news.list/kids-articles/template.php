<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<? if(!empty($arResult["ITEMS"])): ?>
    <div class="kids-articles__container">
        <div class="swiper kids-articles-swiper">
            <div class="swiper-wrapper">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                if (empty($arItem["PREVIEW_PICTURE"]["SRC"]) || empty($arItem["NAME"])) continue;
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                    <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="swiper-slide slide">
                        <img class="kids-articles__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>" alt="<?=$arItem["NAME"];?>">
                        <div class="kids-articles__bottom">
                            <div class="kids-articles__title"><?=$arItem["NAME"];?></div>
                            <a class="kids-articles__link" href="<?=$arItem["LIST_PAGE_URL"].$arItem["CODE"].'/';?>">Читать далее</a>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="kids-articles-next">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M21 30L27 24L21 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="kids-articles-prev">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M27 30L21 24L27 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>

    <script>
        let countItemsAricle = '<?=count($arResult["ITEMS"])?>';

        if (countItemsAricle >= 3) countItemsAricle = 3;

        var swiper = new Swiper(".kids-articles-swiper", {
            navigation: {
                nextEl: ".kids-articles-next",
                prevEl: ".kids-articles-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                576: {
                    slidesPerView: countItemsAricle - 1,
                    spaceBetween: 30
                },
                1200: {
                    slidesPerView: countItemsAricle,
                    spaceBetween: 24,
                }
            }
        });
    </script>
<? endif; ?>
