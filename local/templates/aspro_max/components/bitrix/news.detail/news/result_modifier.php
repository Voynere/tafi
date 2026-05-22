
<?
use \Bitrix\Currency,
  \Bitrix\Catalog,
  Bitrix\Highloadblock\HighloadBlockTable;

if ( !empty($arResult["PROPERTIES"]["BRING_OUT_RESEARCH"]["VALUE"]) )
{
  $cp = $this->__component;
  if (is_object($cp))
  {
    $cp->arResult['BRING_OUT_RESEARCH'] = $arResult["PROPERTIES"]["BRING_OUT_RESEARCH"]["VALUE"];
    if ($arResult["PROPERTIES"]["BRING_OUT_RESEARCH"]["ACTIVE"] == "Y")
    {
      $cp->SetResultCacheKeys(array('BRING_OUT_RESEARCH'));
    }
  }
}

if($arResult["PROPERTIES"]["NEW_TEMPLATE"]["VALUE"] == 'Y')
{

  if ($arResult["PROPERTIES"]["HOME_TESTS_TEMPLATE"]["VALUE"] == "Y")
  {
    $url = 'vladivistok';
    if (isset($_SESSION["ACTIVE_USER_CITY"])) $url = $_SESSION["ACTIVE_USER_CITY"];
    \Bitrix\Main\Loader::includeModule("highloadblock");
    $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
      array(
        "filter" => array(
          '=TABLE_NAME' => 'b_hlbd_city_prices'
        )
      )
    )->fetch();
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    $res = $entity_data_class::getList(array(
      'select' => array('ID', 'UF_PRICES', 'UF_URL', 'UF_DATIVE_CASE'),
    ));
    while ($arItem = $res->Fetch()) {
      $hlblock_prices_id[$arItem["UF_URL"]] = [
        'case' => $arItem["UF_DATIVE_CASE"],
        'prices' => $arItem["UF_PRICES"]
      ];
    }
    $array_prices_id = $hlblock_prices_id["vladivostok"];
    if (array_key_exists($url, $hlblock_prices_id))
    {
      $array_prices_id = $hlblock_prices_id[$url];
    }
    $price_iblock_id = 78;
    $city_prices["case"] = $array_prices_id['case'];
    $ar_select = Array("ID", "NAME", "PROPERTY_PRICE");
    $ar_filter = Array("IBLOCK_ID"=>$price_iblock_id, "ID" => $array_prices_id["prices"], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $ar_filter, false, Array(), $ar_select);
    while($ob = $res->GetNextElement())
    {
      $ar_fields = $ob->GetFields();
      $city_prices["prices"][] = [
        "name" => $ar_fields["NAME"],
        "price" => $ar_fields["PROPERTY_PRICE_VALUE"]
      ];
    }
  }

    $cp = $this->__component;
    if (is_object($cp))
    {
        $cp->arResult["CITY_PRICES"] = $city_prices;
        $cp->arResult['NEW_TEMPLATE'] = $arResult["PROPERTIES"]["NEW_TEMPLATE"]["VALUE"];
        $cp->arResult['TREATMENT_ROOM_TEMPLATE'] = $arResult["PROPERTIES"]["TREATMENT_ROOM_TEMPLATE"]["VALUE"];
        $cp->arResult["HOME_TESTS_TEMPLATE"] = $arResult["PROPERTIES"]["HOME_TESTS_TEMPLATE"]["VALUE"];
        $cp->arResult["ALLERGOLOGICAL_TEMPLATE"] = $arResult["PROPERTIES"]["ALLERGOLOGICAL_TEMPLATE"]["VALUE"];
        $cp->arResult["TICK_BORNE_TEMPLATE"] = $arResult["PROPERTIES"]["TICK_BORNE_TEMPLATE"]["VALUE"];
        $cp->arResult["TICK_BORNE_ELEMENTS"] = $arResult['PROPERTIES']['TICKBORNE_ELEMENTS']['VALUE'];
        $cp->arResult['ALLERGOLOGICAL_ELEMENTS_1'] = $arResult['PROPERTIES']['ALLERGOLOGICAL_ELEMENTS_1']['VALUE'];
        $cp->arResult['ALLERGOLOGICAL_ELEMENTS_2'] = $arResult['PROPERTIES']['ALLERGOLOGICAL_ELEMENTS_2']['VALUE'];

        $cp->SetResultCacheKeys(array(
          'NEW_TEMPLATE',
          'TREATMENT_ROOM_TEMPLATE',
          'HOME_TESTS_TEMPLATE',
          'CITY_PRICES',
          'ALLERGOLOGICAL_TEMPLATE',
          'TICK_BORNE_TEMPLATE',
          'TICK_BORNE_ELEMENTS',
          'ALLERGOLOGICAL_ELEMENTS_1',
          'ALLERGOLOGICAL_ELEMENTS_2'
        ));
    }

    $img_res = CFile::GetByID($arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_IMAGE"]["VALUE"])->Fetch();
    if ($img_res) $bannerImgSrc = '/upload/' . $img_res['SUBDIR'] . '/' . $img_res['FILE_NAME'];

    $mobImg_res = CFile::GetByID($arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_IMAGE_MOBILE"]["VALUE"])->Fetch();
    if ($mobImg_res) $bannerMobileImgSrc = '/upload/' . $mobImg_res['SUBDIR'] . '/' . $mobImg_res['FILE_NAME'];

    $img_add_res = CFile::GetByID($arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_ADDIT"]["VALUE"])->Fetch();
    if ($img_add_res) $bannerAddImgSrc = '/upload/' . $img_add_res['SUBDIR'] . '/' . $img_add_res['FILE_NAME'];

    $mobAddImg_res = CFile::GetByID($arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_ADDIT_MOBILE"]["VALUE"])->Fetch();
    if ($mobAddImg_res) $bannerAddMobileImgSrc = '/upload/' . $mobAddImg_res['SUBDIR'] . '/' . $mobAddImg_res['FILE_NAME'];

    $arResult["BANNER"] = [
        "NAME" => $arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_NAME"]["VALUE"],
        "DESCR" => $arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_DESC"]["~VALUE"]["TEXT"],
        "BACKGROUND" => $arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_BACK"]["VALUE"],
        "IMAGE" => $bannerImgSrc,
        "MOBILE_IMAGE" => $bannerMobileImgSrc,
        "ADDITIONAL_IMAGE" => $bannerAddImgSrc,
        "ADDITIONAL_IMAGE_MOBILE" => $bannerAddMobileImgSrc,
        "BUTTON" => $arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_BUTTON"]["VALUE"],
        "BUTTON_LINK" => $arResult["PROPERTIES"]["NEW_TEMPLATE_BAN_BUTTON_LINK"]["VALUE"]
    ];

    $advantages = [];
    $elementIDs = $arResult["PROPERTIES"]["NEW_TEMPLATE_ADV"]["VALUE"];

    if (!empty($elementIDs))
    {
    $filter = ["ID" => $elementIDs];
    $select = [
      "ID",
      "NAME",
      "PREVIEW_TEXT",
      "PREVIEW_PICTURE"
    ];

    $res = CIBlockElement::GetList([], $filter, false, false, $select);
    $pictureIDs = [];

    while ($ar_res = $res->Fetch())
    {
        if ($ar_res["PREVIEW_PICTURE"])
        {
            $pictureIDs[$ar_res["ID"]] = $ar_res["PREVIEW_PICTURE"];
        }

        $advantages[$ar_res["ID"]] = [
            "NAME" => $ar_res["NAME"],
            "PREVIEW_TEXT" => $ar_res["PREVIEW_TEXT"],
            "PREVIEW_PIC" => [
              "FILE_NAME" => '',
              "SRC" => ''
            ]
        ];
    }
    if (!empty($pictureIDs))
    {
        $rsFile = CFile::GetList([], ["@ID" => implode(',', $pictureIDs)]);
        while ($arFile = $rsFile->Fetch()) {
            $key = array_search($arFile["ID"], $pictureIDs);
            if (isset($advantages[$key]))
            {
                $advantages[$key]["PREVIEW_PIC"]["FILE_NAME"] = $arFile["FILE_NAME"];
                $advantages[$key]["PREVIEW_PIC"]["SRC"] = '/upload/' . $arFile['SUBDIR'] . '/' . $arFile['FILE_NAME'];
            }
        }
    }
    }

    if (is_object($cp))
    {
      $cp->arResult["ADVANTAGES"] = $advantages;
      $cp->SetResultCacheKeys(array('ADVANTAGES'));
    }

    $arResult["ADVANTAGES"] = $advantages;
    unset($filter);
    unset($select);
    unset($pictureIDs);

  if (!empty($arResult["PROPERTIES"]["NEW_TEMPLATE_PRICE"]["VALUE"]))
  {
      $prices = [];
      $filter = ["ID" => $arResult["PROPERTIES"]["NEW_TEMPLATE_PRICE"]["VALUE"]];
      $select = [
          "ID",
          "NAME",
          "PROPERTY_PRICE"
      ];

      $res = CIBlockElement::GetList([], $filter, false, false, $select);

      while ($ar_res = $res->Fetch())
      {
          $prices[$ar_res["ID"]]["NAME"] = $ar_res["NAME"];
          $prices[$ar_res["ID"]]["PRICE"] = $ar_res["PROPERTY_PRICE_VALUE"];
      }

      $arResult["PRICES"] = $prices;
      unset($filter);
      unset($select);
  }
  if (!empty($arResult["PROPERTIES"]["NEW_TEMPLATE_CONDITION"]["VALUE"]))
  {
      $conditions = [];
      $filter = ["ID" => $arResult["PROPERTIES"]["NEW_TEMPLATE_CONDITION"]["VALUE"]];
      $select = [
          "ID",
          "NAME",
          "PREVIEW_PICTURE"
      ];

      $res = CIBlockElement::GetList([], $filter, false, false, $select);
      $pictureIDs = [];

      while ($ar_res = $res->Fetch())
      {
          if ($ar_res["PREVIEW_PICTURE"])
          {
              $pictureIDs[$ar_res["ID"]] = $ar_res["PREVIEW_PICTURE"];
          }

          $conditions[$ar_res["ID"]] = [
              "NAME" => $ar_res["NAME"],
              "PREVIEW_PIC" => [
                  "FILE_NAME" => '',
                  "SRC" => ''
              ]
          ];
      }
      if (!empty($pictureIDs))
      {
          $rsFile = CFile::GetList([], ["@ID" => implode(',', $pictureIDs)]);
          while ($arFile = $rsFile->Fetch()) {
              $key = array_search($arFile["ID"], $pictureIDs);
              if (isset($conditions[$key])) {
                  $conditions[$key]["PREVIEW_PIC"]["FILE_NAME"] = $arFile["FILE_NAME"];
                  $conditions[$key]["PREVIEW_PIC"]["SRC"] = '/upload/' . $arFile['SUBDIR'] . '/' . $arFile['FILE_NAME'];
              }
          }
      }

      $arResult["CONDITIONS"] = $conditions;
      unset($filter);
      unset($select);
  }
}
else {
  CMax::getFieldImageData($arResult, array('DETAIL_PICTURE'));

  /*landings*/
  if (isset($arParams["IS_LANDING"]) && $arParams["IS_LANDING"] == 'Y') {
    $arResult['IS_LANDING'] = 'Y';
  }

  /*set prop for galery*/
  $smallGaleryCode = (isset($arParams["TOP_GALLERY_PROPERTY_CODE"]) && $arParams["TOP_GALLERY_PROPERTY_CODE"] != '-' ? $arParams["TOP_GALLERY_PROPERTY_CODE"] : 'PHOTOS');
  $bigGaleryCode = (isset($arParams["MAIN_GALLERY_PROPERTY_CODE"]) && $arParams["MAIN_GALLERY_PROPERTY_CODE"] != '-' ? $arParams["MAIN_GALLERY_PROPERTY_CODE"] : 'PHOTOS');
  $bTopImage = ($arResult['FIELDS']['DETAIL_PICTURE'] && $arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP');

  //echo var_dump($arParams["TOP_GALLERY_PROPERTY_CODE"]);
  $arResult['GALLERY'] = array();

  if (is_array($arResult['FIELDS']['DETAIL_PICTURE']) && $arParams["SHOW_TOP_PROJECT_BLOCK"] == "Y" && !$bTopImage) {
    $arResult['GALLERY'][] = array(
      'DETAIL' => $arResult['DETAIL_PICTURE'],
      'PREVIEW' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
      'TITLE' => (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME'])),
      'ALT' => (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME'])),
    );
  }

  if ($arResult['DISPLAY_PROPERTIES']) {
    //$arResult['GALLERY'] = array();
    $arResult['VIDEO'] = array();

    if ($arResult['DISPLAY_PROPERTIES'][$smallGaleryCode]['VALUE'] && is_array($arResult['DISPLAY_PROPERTIES'][$smallGaleryCode]['VALUE'])) {
      foreach ($arResult['DISPLAY_PROPERTIES'][$smallGaleryCode]['VALUE'] as $img) {
        $arResult['GALLERY'][] = array(
          'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
          'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 1500, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
          'THUMB' => CFile::ResizeImageGet($img, array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
          'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
          'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
        );
      }
    }

    if ($arResult['DISPLAY_PROPERTIES'][$bigGaleryCode]['VALUE'] && is_array($arResult['DISPLAY_PROPERTIES'][$bigGaleryCode]['VALUE'])) {
      foreach ($arResult['DISPLAY_PROPERTIES'][$bigGaleryCode]['VALUE'] as $img) {
        $arResult['GALLERY_BIG'][] = array(
          'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
          'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 1500, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
          'THUMB' => CFile::ResizeImageGet($img, array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
          'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
          'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
        );
      }
    }

    foreach ($arResult['DISPLAY_PROPERTIES'] as $i => $arProp) {
      if ($arProp['VALUE'] || strlen($arProp['VALUE'])) {
        if ($arProp['USER_TYPE'] == 'video') {
          if (count($arProp['PROPERTY_VALUE_ID']) > 1) {
            foreach ($arProp['VALUE'] as $val) {
              if ($val['path']) {
                $arResult['VIDEO'][] = $val;
              }
            }
          } elseif ($arProp['VALUE']['path']) {
            $arResult['VIDEO'][] = $arProp['VALUE'];
          }
          unset($arResult['DISPLAY_PROPERTIES'][$i]);
        }
      }
    }

    if ($arParams["STAFF_MODE"]) {
      foreach ($arResult['DISPLAY_PROPERTIES'] as $key2 => $arProp) {
        /*if(($key2 == 'EMAIL' || $key2 == 'PHONE') && $arProp['VALUE']){
          $arResult['MIDDLE_PROPS'][$key2] = $arProp;
          unset($arResult['DISPLAY_PROPERTIES'][$key2]);
        }*/
        if (strpos($key2, 'SOCIAL') !== false && $arProp['VALUE']) {
          switch ($key2) {
            case('SOCIAL_VK'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_vk.svg';
              break;
            case('SOCIAL_ODN'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_odnoklassniki.svg';
              break;
            case('SOCIAL_FB'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_facebook.svg';
              break;
            case('SOCIAL_MAIL'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_mail.svg';
              break;
            case('SOCIAL_TW'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_twitter.svg';
              break;
            case('SOCIAL_INST'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_instagram.svg';
              break;
            case('SOCIAL_GOOGLE'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_google.svg';
              break;
            case('SOCIAL_SKYPE'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_skype.svg';
              break;
            case('SOCIAL_BITRIX'):
              $arProp['FILE'] = SITE_TEMPLATE_PATH . '/images/svg/social/social_bitrix24.svg';
              break;
          }
          $arResult['SOCIAL_PROPS'][] = $arProp;
          unset($arResult['DISPLAY_PROPERTIES'][$key2]);
        }
      }
    }

  }

  /*get price and avaible */
  $arResult["SHOW_BUY_BUTTON"] = false;
  if ($arResult['PROPERTIES']['ALLOW_BUY']['VALUE'] === 'Y') {
    $product_data = CCatalogProduct::GetByID($arResult['ID']);
    if ($product_data['AVAILABLE'] === 'Y') {

      $arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
      $arResult['PRICES_ALLOW'] = \CIBlockPriceTools::GetAllowCatalogPrices($arResult["PRICES"]);

      $select = array(
        'ID', 'PRODUCT_ID', 'CATALOG_GROUP_ID', 'PRICE', 'CURRENCY',
        'QUANTITY_FROM', 'QUANTITY_TO'
      );

      if ($arResult['PRICES_ALLOW']) {
        $iterator = \Bitrix\Catalog\PriceTable::getList(array(
          'select' => $select,
          'filter' => array('@PRODUCT_ID' => $arResult['ID'], '@CATALOG_GROUP_ID' => $arResult['PRICES_ALLOW']),
          'order' => array('PRODUCT_ID' => 'ASC', 'CATALOG_GROUP_ID' => 'ASC')
        ));

        $arPrices = array();

        while ($row = $iterator->fetch()) {
          if ($row['QUANTITY_FROM'] && $row['QUANTITY_FROM'] !== '1')
            continue;

          $arPrices[$row['CATALOG_GROUP_ID']] = $row;

        }

        $vatData = array();
        $vatIterator = Catalog\VatTable::getList([
          'select' => ['ID', 'RATE'],
          'order' => ['ID' => 'ASC']
        ]);
        while ($rowVat = $vatIterator->fetch())
          $vatData[(int)$rowVat['ID']] = (float)$rowVat['RATE'];

        $vatRate = (float)$vatData[$product_data['VAT_ID']];


        $arMinimalPrice = \Aspro\Functions\CAsproMaxItem::getServicePrices($arParams, $arPrices, $product_data, $vatRate);
        if (is_array($arMinimalPrice) && isset($arMinimalPrice['PRICE']) && $arMinimalPrice['PRICE'] > 0) {
          $arResult["BUTTON_RESULT_PRICE"] = $arMinimalPrice;
          $arResult["SHOW_BUY_BUTTON"] = true;
        }
      }
    }
  }

  /* */

  $arResult['DISPLAY_PROPERTIES_FORMATTED'] = CMax::PrepareItemProps($arResult['DISPLAY_PROPERTIES']);
}