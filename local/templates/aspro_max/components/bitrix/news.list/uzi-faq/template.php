<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>

<?if($arResult['ITEMS']):?>
    <div class="recom-faq">
        <?foreach($arResult['ITEMS'] as $SID => $arSection):?>
            <div class="recom-faq__item">
                <div id="<?=$SID?>" class="recom-faq__title">
                    <span class="recom-faq__name"><?=$arSection["NAME"];?></span>
                    <span class="arrow_open pull-right colored_theme_hover_bg-el"></span>
                </div>
                <div class="recom-faq__answer hidden"><?=$arSection["PREVIEW_TEXT"]?></div>
            </div>
        <?endforeach;?>
    </div>
<?endif;?>