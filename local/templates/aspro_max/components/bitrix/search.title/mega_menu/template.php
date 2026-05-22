<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?
// Настройка ID элементов
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
    $INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
    $CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

global $isFixedTopSearch;
if($isFixedTopSearch) {
    $CONTAINER_ID .= 'tf';
    $INPUT_ID .= 'tf';
}
?>

<?if($arParams["SHOW_INPUT"] !== "N"):?>
    <?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
        <div class="inline-search-block with-close fixed">
            <div class="maxwidth-theme">
                <div class="row">
                    <div class="col-md-12">
    <?endif;?>
            <div class="search-wrapper">
                <div id="<?=$CONTAINER_ID?>">
                    <form action="<?=$arResult["FORM_ACTION"]?>" class="search">
                        <div class="search-input-div">
                            <input class="search-input" id="<?=$INPUT_ID?>" type="text" name="q" value="" 
                                   placeholder="Поиск на сайте" size="20" maxlength="50" autocomplete="off" />
                        </div>
                        <div class="search-button-div">
                            <button class="btn btn-search round-ignore" type="submit" name="s" value="<?=GetMessage("CT_BST_SEARCH_BUTTON2")?>">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.7504 18.75L14.4004 14.4M16.75 8.75C16.75 13.1683 13.1683 16.75 8.75 16.75C4.33172 16.75 0.75 13.1683 0.75 8.75C0.75 4.33172 4.33172 0.75 8.75 0.75C13.1683 0.75 16.75 4.33172 16.75 8.75Z" stroke="#9EA4AD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <span class="close-block inline-search-hide"><span class="svg svg-close close-icons"></span></span>
                        </div>
                    </form>
                </div>

                <div class="search-top-popup">

                    <div class="search-helper">

                    <?if($arResult['POPULAR_SERVICES']){?>
                    <div class="search-popular-services">
                        <div class="search-popular-services__header">Популярные услуги</div>
                        <div class="search-popular-services__items">
                            <?foreach($arResult['POPULAR_SERVICES'] as $popularItem){?>
                            <div class="search-popular-services__item">
                                <a class="search-popular-services__item-link" href="<?=$popularItem['UF_LINK']?>"><?=$popularItem['UF_NAME']?></a>
                            </div>
                            <?}?>
                        </div>
                    </div>
                    <?}?>

                    <?if($arResult['DOCTORS']){?>
                    <div class="search-doctors">
                        <div class="search-doctors__header">Врачи</div>
                        <div class="search-doctors__items">
                            <?foreach($arResult['DOCTORS'] as $doctor){?>
                            <div class="search-doctors__item">

                                <a class="search-doctors__item-photo" href="<?=$doctor['LINK']?>">
                                    <?if($doctor['PREVIEW_PICTURE']){?>
                                    <img src="<?=$doctor['PREVIEW_PICTURE']['src']?>" alt="<?=$doctor['NAME']?>">
                                    <?}else{?>
                                    <img src="<?=$this->GetFolder().'/images/no-image-search.png'?>" alt="<?=$doctor['NAME']?>">
                                    <?}?>    
                                </a>

                                <div class="search-doctors__item-info">
                                    <div class="search-doctors__item-name">
                                        <a href="<?=$doctor['LINK']?>"><?=$doctor['NAME']?></a>
                                    </div>
                                    <?if($doctor['POSITION']){?>
                                    <div class="search-doctors__item-specialty"><?=$doctor['POSITION']?></div>
                                    <?}?>
                                </div>

                            </div>
                            <?}?>
                        </div>
                    </div>
                    <?}?>

                </div>


                </div>
                
            </div>
    <?if($arParams["SHOW_INPUT_FIXED"] != "Y"):?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>
<?endif;?>

<?if(!empty($arResult["CATEGORIES"])):?>
<div class="bx_searche scrollbar">
    <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
        <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
            <?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]]) && $category_id !== "all"):
                $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
                <a class="bx_item_block" href="<?=$arItem["URL"]?>">
                    <div class="maxwidth-theme">
                        <div class="bx_item_element">
                            <span><?=htmlspecialcharsbx($arItem["NAME"])?></span>
                            <?if($arParams["SHOW_PREVIEW"] == "Y" && !empty($arElement["PRICES"])):?>
                                <div class="price cost prices">
                                    <div class="title-search-price">
                                        <?/* Оригинальный код вывода цен */?>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                    </div>
                </a>
            <?elseif($category_id !== "all" && $arItem["MODULE_ID"]):?>
                <a class="bx_item_block others_result" href="<?=$arItem["URL"]?>">
                    <div class="maxwidth-theme">
                        <div class="bx_item_element">
                            <span><?=htmlspecialcharsbx($arItem["NAME"])?></span>
                        </div>
                    </div>
                </a>
            <?endif;?>
        <?endforeach;?>
    <?endforeach;?>
</div>
<?endif;?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Инициализация стандартного поиска Aspro
    if(typeof JCTitleSearchTop === 'function') {
        new JCTitleSearchTop({
            'AJAX_PAGE': '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?=$CONTAINER_ID?>',
            'INPUT_ID': '<?=$INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    }
    
    // Удаление title-атрибутов для устранения SEO-тегов
    setTimeout(function() {
        document.querySelectorAll('.bx_item_block[title]').forEach(function(el) {
            el.removeAttribute('title');
        });
    }, 500);
});
</script>