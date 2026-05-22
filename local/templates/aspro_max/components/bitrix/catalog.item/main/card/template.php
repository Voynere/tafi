<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array|null $price
 * @var float|int|null $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */

?>

<div class="catalog-item">

    <div class="catalog-item__header">

        <?if($item['PROPERTIES']['KOD']['VALUE']){?>
        <div class="catalog-item__article">№<?=$item['PROPERTIES']['KOD']['VALUE']?></div>
        <?}?>

        <div class="catalog-item__labels">

            <?if(
                    isset($item['PROPERTIES']['HIT']['VALUE_XML_ID']) &&
                    is_array($item['PROPERTIES']['HIT']['VALUE_XML_ID']) &&
                    in_array( 'HIT',$item['PROPERTIES']['HIT']['VALUE_XML_ID'])){?>
                <div class="catalog-item__label catalog-item__label--hit">Хит</div>
            <?}?>

        </div>

    </div>

    <div class="catalog-item__content">

        <div class="catalog-item__title">
            <a class="catalog-item__title-link" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>">
                <?=$productTitle?>
            </a>
        </div>

        <?if($item['PROPERTIES']['HELP_TEXT']['VALUE']){?>
        <div class="catalog-item__info">
            <?=$item['PROPERTIES']['HELP_TEXT']['VALUE']?>
        </div>
        <?}?>

        <div class="catalog-item__footer">

            <div class="catalog-item__price" data-entity="price-block">
                <?
                if ($arParams['SHOW_OLD_PRICE'] === 'Y' && !empty($price))
                {
                    ?>
                    <span class="catalog-item__price-old" id="<?=$itemIds['PRICE_OLD']?>"
                            <?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
                            <?=$price['PRINT_RATIO_BASE_PRICE']?>
                        </span>&nbsp;
                    <?
                }
                ?>
                <span class="catalog-item__price-current" id="<?=$itemIds['PRICE']?>">
                <?
                if (!empty($price))
                {
                    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
                    {
                        echo Loc::getMessage(
                            'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                            array(
                                '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                '#VALUE#' => $measureRatio,
                                '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                            )
                        );
                    }
                    else
                    {
                        echo $price['PRINT_RATIO_PRICE'];
                    }
                }
                ?>
                </span>

            </div>


            <div class="catalog-item__actions">
                <button class="catalog-item__basket js-basket-add" data-id="<?=$item['ID']?>">В корзину</button>
            </div>


        </div>


    </div>


</div>