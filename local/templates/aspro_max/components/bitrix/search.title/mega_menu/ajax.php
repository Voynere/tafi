<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>

    <div class="top-search-popup">

        <div class="search-top-result">

            <div class="search-top-result__wrapper custom-scrollbar">

                <ul class="search-top-result__items">
                <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory){

                    if($category_id === 'all')
                        continue;
                    ?>

                    <?foreach($arCategory["ITEMS"] as $i => $arItem){
                        if($i > 6 || $arItem["NAME"] === 'остальные') break;

                        if(!isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]]))
                            continue;

                        $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
                        ?>

                        <li class="search-top-result__item">                        
                            <div class="search-top-resul__item-content">
                                <a href="<?echo $arItem["URL"]?>" class="search-top-result-goods__item-name"><?=$arItem['NAME']?></a>

                                <?$section = $arResult["SECTIONS"][$arElement["IBLOCK_SECTION_ID"]]?>
                                <?if($section){?>
                                <a class="search-top-result__item-category" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
                                <?}?>
                            </div>
                        </li>

                    <?}?>
                <?}?>
                </ul>

            </div>
            

            
            <?if(isset($arResult["CATEGORIES"]['all']) ):?>
				<?foreach($arResult["CATEGORIES"]['all']["ITEMS"] as $i => $arItem):?>
					<div class="top-search-popup__all-result">
						<div class="top-search-popup__all-result-item">
							<a class="top-search-popup__all-result-link" href="<?=$arItem["URL"]?>">
								Показать все результаты
							</a>
						</div>
					</div>
				<?endforeach;?>
			<?endif;?>
			
        </div>

    </div>

<?endif;