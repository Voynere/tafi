<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if($arResult["ITEMS"]):?>
	<div class="recom__list">
        <? foreach ($arResult["ITEMS"] as $item): ?>
            <div class="recom__item">
                <img class="recom__img" src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" alt="recomendation">
                <div class="recom__name"><?=$item["NAME"]?></div>
                <p class="recom__text"><?=$item["PREVIEW_TEXT"]?></p>
            </div>
        <? endforeach; ?>
    </div>
<?endif;?>