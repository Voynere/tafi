<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? use \Bitrix\Main\Localization\Loc; ?>
<? if ($arResult['ITEMS']): ?>
    <div class="banners__row">
        <? foreach ($arResult['ITEMS'] as $i => $arItem): ?>
            <?

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $imageSrc = CFile::GetPath($arItem["PROPERTIES"]["BANNER_DESK_IMG"]["VALUE"]);
            $imageSrcM = CFile::GetPath($arItem["PROPERTIES"]["BANNER_MOB_IMG"]["VALUE"]);
            ?>
            <div class="banners__row_item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="banners__item_title">
                    <h3><?=$arItem["NAME"]?></h3>
                </div>
                <div class="banners__item_text">
                    <p><?=$arItem["DETAIL_TEXT"]?></p>
                </div>
                <div class="banners__item_stock">
                    <p><?=$arItem["PROPERTIES"]["BANNER_STOCK"]["VALUE"]?></p>
                </div>
                <img class="desktop-banner" src="<?=$imageSrc?>" alt="">
                <img class="mobile-banner" src="<?=$imageSrcM?>" alt="">
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>
<script>
    $('.banners__row').slick({
        arrows: false,
        responsive: [
            {
                breakpoint: 530,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 434,
                settings: {
                    arrows: false,
                    centerMode: false,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
</script>
