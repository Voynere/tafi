<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
use \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Web\Json;
?>

<? if (count($arResult["ITEMS"]) >= 1) { ?>
    <div class="display_list <?= ($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props"); ?> js_append <?= $arParams["TYPE_VIEW_CATALOG_LIST"]; ?>  flexbox flexbox--row">

  <?
  $currencyList = '';
  if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
  }
  $templateData = array(
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList
  );
  unset($currencyList, $templateLibrary);

  $arParams["BASKET_ITEMS"] = ($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

  $arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

  $bNormalView = ($arParams["TYPE_VIEW_CATALOG_LIST"] == "TYPE_1");

  $arParamsCE_CMP = $arParams;
  $arParamsCE_CMP['TYPE_SKU'] = 'N';
  ?>

  <? foreach ($arResult["ITEMS"] as $arItem) {

    $pre_text = $arItem['PREVIEW_TEXT'] ? $arItem['PREVIEW_TEXT'] : $arItem['DETAIL_TEXT'];
    $arItem['PREVIEW_TEXT'] = strip_tags(TruncateText($pre_text, 255));
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
    $emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
    $arItem["EMPTY_PROPS_JS"] = (!$emptyProductProperties ? "N" : "Y");

    $item_id = $arItem["ID"];

    $arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
    $arItemIDs = CMax::GetItemsIDs($arItem);

    $totalCount = CMax::GetTotalCount($arItem, $arParams);
    $arQuantityData = CMax::GetQuantityArray($totalCount, array('ID' => $item_id), 'N', (($arItem["OFFERS"] || $arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || $bSlide || !$arResult['STORES_COUNT']) ? false : true));

    $strMeasure = '';
    $arAddToBasketData = array();

    $arCurrentSKU = array();

    $elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);

    $bUseSkuProps = ($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP']));

    if (!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1') {
      if ($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]) {
        $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
        $strMeasure = $arMeasure["SYMBOL_RUS"];
      }
      $arAddToBasketData = CMax::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], '', $arParams);
    } elseif ($arItem["OFFERS"]) {
      $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
      if ($arParams['TYPE_SKU'] == 'TYPE_1' && $arItem['OFFERS_PROP']) {
        $currentSKUIBlock = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["IBLOCK_ID"];
        $currentSKUID = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["ID"];

        $totalCount = CMax::GetTotalCount($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], $arParams);
        $arQuantityData = CMax::GetQuantityArray($totalCount, array('ID' => $currentSKUID), 'N', (($arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || $bSlide || !$arResult['STORES_COUNT']) ? false : true), 'ce_cmp_hidden');

        if ($arItem["OFFERS"]) {
          $totalCountCMP = CMax::GetTotalCount($arItem, $arParamsCE_CMP);
          $arQuantityDataCMP = CMax::GetQuantityArray($totalCountCMP, array('ID' => $item_id), 'N', false, 'ce_cmp_visible');
        }

        $arItem["DETAIL_PAGE_URL"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DETAIL_PAGE_URL"];
        if ($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
          $arItem["PREVIEW_PICTURE"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"];
        if ($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
          $arItem["DETAIL_PICTURE"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DETAIL_PICTURE"];

        if ($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']) {
          $arItem['SELECTED_SKU_IPROPERTY_VALUES'] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES'];
        }

        if ($arParams["SET_SKU_TITLE"] == "Y")
          $arItem["NAME"] = $elementName = ((isset($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['NAME']);
        $item_id = $currentSKUID;

        // ARTICLE
        if ($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) {
          $arItem["ARTICLE"]["NAME"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["NAME"];
          $arItem["ARTICLE"]["VALUE"] = (is_array($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) ? reset($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) : $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]);
          unset($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]);
        }

        $arCurrentSKU = $arItem["JS_OFFERS"][$arItem["OFFERS_SELECTED"]];
        $strMeasure = $arCurrentSKU["MEASURE"];

        $arAddToBasketData = CMax::GetAddToBasketArray($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], '', $arParams);
      }
    }
    ?>
        <div class="list_item <?= ($arItem["OFFERS"] ? 'has-sku' : '') ?>" id="<?= $arItemIDs["strMainID"]; ?>">

            <div class="description">
                <a class="item-title" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                   class="dark_link"><?= $elementName; ?></a>
              <? if ($arItem["PREVIEW_TEXT"]): ?>
                  <div class="preview_text"><?= $arItem["PREVIEW_TEXT"] ?></div>
              <? endif; ?>
            </div>

            <div class="info">
                <div class="information <?= ($arItem["OFFERS"] && $arItem['OFFERS_PROP'] ? 'has_offer_prop' : ''); ?>  inner_content js_offers__<?= $arItem['ID']; ?>_<?= $arParams["FILTER_HIT_PROP"] ?>">
                  <? if ($arParams["SHOW_DISCOUNT_TIME"] == "Y" && $arParams['SHOW_COUNTER_LIST'] != 'N') { ?>
                    <? $arDiscount = [] ?>
                    <? $min_price_id = 0;
                    if ($arItem["OFFERS"]) {
                      if ($arCurrentSKU && isset($arCurrentSKU['PRICE_MATRIX']) && $arCurrentSKU['PRICE_MATRIX']) // USE_PRICE_COUNT
                      {
                        if (isset($arCurrentSKU['PRICE_MATRIX']['MATRIX']) && is_array($arCurrentSKU['PRICE_MATRIX']['MATRIX'])) {
                          $arMatrixKey = array_keys($arCurrentSKU['PRICE_MATRIX']['MATRIX']);
                          $min_price_id = current($arMatrixKey);
                        }
                      }
                    } else {
                      if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
                      {
                        $arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
                        $min_price_id = current($arMatrixKey);
                      }
                    } ?>
                    <? \Aspro\Functions\CAsproMax::showDiscountCounter($totalCount, $arDiscount, $arQuantityData, $arItem, $strMeasure, 'v2 grey', $item_id); ?>
                  <? } ?>

                    <div class="cost prices clearfix">
                      <? if ($arItem["OFFERS"]): ?>
                          <div class="ce_cmp_hidden">
                            <?= \Aspro\Functions\CAsproMaxItem::showItemPricesDefault($arParams); ?>
                              <div class="js_price_wrapper">
                                <? if ($arCurrentSKU): ?>
                                  <? $item_id = $arCurrentSKU["ID"];
                                  $arCurrentSKU['PRICE_MATRIX'] = $arCurrentSKU['PRICE_MATRIX_RAW'];
                                  $arCurrentSKU['CATALOG_MEASURE_NAME'] = $arCurrentSKU['MEASURE'];
                                  if (isset($arCurrentSKU['PRICE_MATRIX']) && $arCurrentSKU['PRICE_MATRIX']): // USE_PRICE_COUNT
                                    ?>
                                    <? if ($arCurrentSKU['ITEM_PRICE_MODE'] == 'Q' && count($arCurrentSKU['PRICE_MATRIX']['ROWS']) > 1):?>
                                    <?= CMax::showPriceRangeTop($arCurrentSKU, $arParams, Loc::getMessage("CATALOG_ECONOMY")); ?>
                                  <? endif; ?>
                                    <?= CMax::showPriceMatrix($arCurrentSKU, $arParams, $strMeasure, $arAddToBasketData); ?>
                                  <? else:?>
                                    <? \Aspro\Functions\CAsproMaxItem::showItemPrices($arParams, $arCurrentSKU["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y")); ?>
                                  <? endif; ?>
                                <? else: ?>
                                  <? \Aspro\Functions\CAsproMaxSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, array(), ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y")); ?>
                                <? endif; ?>
                              </div>
                          </div>
                        <? if ($arCurrentSKU): ?>
                              <div class="ce_cmp_visible">
                                <? \Aspro\Functions\CAsproMaxSku::showItemPrices($arParamsCE_CMP, $arItem, $item_id, $min_price_id, $arItemIDs, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y")); ?>
                              </div>
                        <? endif; ?>
                      <? else: ?>
                        <? if (isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']): // USE_PRICE_COUNT?>
                          <? if (\CMax::GetFrontParametrValue('SHOW_POPUP_PRICE') == 'Y' || $arItem['ITEM_PRICE_MODE'] == 'Q' || (\CMax::GetFrontParametrValue('SHOW_POPUP_PRICE') != 'Y' && $arItem['ITEM_PRICE_MODE'] != 'Q' && count($arItem['PRICE_MATRIX']['COLS']) <= 1)): ?>
                            <?= CMax::showPriceRangeTop($arItem, $arParams, Loc::getMessage("CATALOG_ECONOMY")); ?>
                          <? endif; ?>
                          <? if (count($arItem['PRICE_MATRIX']['ROWS']) > 1 || count($arItem['PRICE_MATRIX']['COLS']) > 1): ?>
                            <?= CMax::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData); ?>
                          <? endif; ?>
                        <? elseif ($arItem["PRICES"]): ?>
                          <? \Aspro\Functions\CAsproMaxItem::showItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y")); ?>
                        <? endif; ?>
                      <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
  <? } ?>
    </div>
<? } ?>