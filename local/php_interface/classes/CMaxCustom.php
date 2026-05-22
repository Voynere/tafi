<?php
CModule::IncludeModule("aspro.max");
class CMaxcustom extends CMax
{
  public static function getMenuChildsExt($arParams, &$aMenuLinksExt){
    if ($handler = \Aspro\Functions\CAsproMax::getCustomFunc(__FUNCTION__)) {
      call_user_func_array($handler, [$arParams, &$aMenuLinksExt]);
      return;
    }

    $catalog_id = \Bitrix\Main\Config\Option::get('aspro.max', 'CATALOG_IBLOCK_ID', CMaxCache::$arIBlocks[SITE_ID]['aspro_max_catalog']['aspro_max_catalog'][0]);
    $bIsCatalog = $arParams['IBLOCK_ID'] == $catalog_id;

    $arParams['CATALOG_IBLOCK_ID'] = $catalog_id;
    $arParams['IS_CATALOG_IBLOCK'] = $bIsCatalog;

    foreach(GetModuleEvents(ASPRO_MAX_MODULE_ID, 'BeforeAsproGetMenuChildsExt', true) as $arEvent)
      ExecuteModuleEventEx($arEvent, array($arParams, &$aMenuLinksExt));

    $arSectionFilter = array(
      'IBLOCK_ID' => $arParams['IBLOCK_ID'],
      'ACTIVE' => 'Y',
      'GLOBAL_ACTIVE' => 'Y',
      'ACTIVE_DATE' => 'Y',
      '<DEPTH_LEVEL' => \Bitrix\Main\Config\Option::get("aspro.max", "MAX_DEPTH_MENU", 2),
    );
    $arSectionSelect = array(
      'ID',
      'SORT',
      'ACTIVE',
      'IBLOCK_ID',
      'NAME',
      'SECTION_PAGE_URL',
      'DEPTH_LEVEL',
      'IBLOCK_SECTION_ID',
      'PICTURE',
      'UF_REGION',
      'UF_MOBILE_LINK'
    );

    if($bIsCatalog) {
      // $arSectionFilter = array_merge($arSectionFilter, array(  ));
      $arSectionSelect = array_merge($arSectionSelect, array( 'UF_MENU_BANNER', 'UF_MENU_BRANDS', 'UF_CATALOG_ICON', ));
    }

    if(array_key_exists('SECTION_FILTER', $arParams) && $arParams['SECTION_FILTER']) {
      $arSectionFilter = array_merge($arSectionFilter, $arParams['SECTION_FILTER']);
    }
    if(array_key_exists('SECTION_SELECT', $arParams) && $arParams['SECTION_SELECT']) {
      $arSectionSelect = array_merge($arSectionSelect, $arParams['SECTION_SELECT']);
    }

    if($arParams['MENU_PARAMS']['MENU_SHOW_SECTIONS'] == 'Y')
    {
      $arSections = CMaxCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CMaxCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arSectionFilter, false, $arSectionSelect);

      foreach ($arSections as $key => &$item)
      {
        if (!empty($item["UF_MOBILE_LINK"]))
        {
          $item["SECTION_PAGE_URL"] = $item["UF_MOBILE_LINK"];
          $item["~SECTION_PAGE_URL"] = $item["UF_MOBILE_LINK"];
        }
      }

      $arSectionsByParentSectionID = CMaxCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
    }

    if(!$bIsCatalog) {
      if($arParams['MENU_PARAMS']['MENU_SHOW_ELEMENTS'] == 'Y'){
        $arElementFilter = array(
          'IBLOCK_ID' => $arParams['IBLOCK_ID'],
          'ACTIVE' => 'Y',
          'ACTIVE_DATE' => 'Y',
          'INCLUDE_SUBSECTIONS' => 'Y',
        );
        $useGlobalActive = \Bitrix\Main\Config\Option::get('aspro.max', 'USE_SECTION_GLOBAL_ACTIVE', 'N') === 'Y';
        if($useGlobalActive){
          $arElementFilter['SECTION_GLOBAL_ACTIVE'] = 'Y';
        }
        $arElementSelect = array(
          'ID',
          'SORT',
          'ACTIVE',
          'IBLOCK_ID',
          'NAME',
          'DETAIL_PAGE_URL',
          'DEPTH_LEVEL',
          'IBLOCK_SECTION_ID',
          'PROPERTY_LINK_REGION',
        );

        if(array_key_exists('ELEMENT_FILTER', $arParams) && $arParams['ELEMENT_FILTER']) {
          $arSectionFilter = array_merge($arSectionFilter, $arParams['ELEMENT_FILTER']);
        }
        if(array_key_exists('ELEMENT_SELECT', $arParams) && $arParams['ELEMENT_SELECT']) {
          $arSectionSelect = array_merge($arSectionSelect, $arParams['ELEMENT_SELECT']);
        }

        $arItems = CMaxCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CMaxCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arElementFilter, false, false, $arElementSelect);
        /*filter by region*/
        global $arRegion;
        if($arItems)
        {
          foreach($arItems as $key => $arItem)
          {
            $arTmpProp = array();
            $rsPropRegion = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array('sort' => 'asc'), Array('CODE'=>'LINK_REGION'));
            while($arPropRegion = $rsPropRegion->Fetch())
            {
              if($arPropRegion['VALUE'])
                $arTmpProp[] = $arPropRegion['VALUE'];
            }
            $arItems[$key]['LINK_REGION'] = $arTmpProp;
          }
        }

        if($arParams['MENU_PARAMS']['MENU_SHOW_SECTIONS'] == 'Y'){
          $arItemsBySectionID = CMaxCache::GroupArrayBy($arItems, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
        }
        else{
          $arItemsRoot = CMaxCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CMaxCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => 0));
          $arItems = array_merge((array)$arItems, (array)$arItemsRoot);
        }
      }
    }

    foreach(GetModuleEvents(ASPRO_MAX_MODULE_ID, 'OnAsproGetMenuChildsExt', true) as $arEvent) // event for manipulation store quantity block
      ExecuteModuleEventEx($arEvent, array($arParams, &$aMenuLinksExt));

    if($arSections) {
      static::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
    }

    if(!$bIsCatalog) {
      if($arItems && $arParams['MENU_PARAMS']['MENU_SHOW_SECTIONS'] != 'Y'){
        foreach($arItems as $arItem){
          $arExtParam = array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => 1);
          if(isset($arItem['LINK_REGION']))
            $arExtParam['LINK_REGION'] = $arItem['LINK_REGION'];
          $aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), $arExtParam);
        }
      }
    }

    foreach(GetModuleEvents(ASPRO_MAX_MODULE_ID, 'AfterAsproGetMenuChildsExt', true) as $arEvent) // event for manipulation store quantity block
      ExecuteModuleEventEx($arEvent, array($arParams, &$aMenuLinksExt));
  }

  public static function drawFormField($FIELD_SID, $arQuestion){
		?>
		<?$arQuestion["HTML_CODE"] = str_replace('name=', 'data-sid="'.$FIELD_SID.'" name=', $arQuestion["HTML_CODE"]);?>
		<?$arQuestion["HTML_CODE"] = str_replace('left', '', $arQuestion["HTML_CODE"]);?>
		<?$arQuestion["HTML_CODE"] = str_replace('size="0"', '', $arQuestion["HTML_CODE"]);?>
		<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):?>
			<?=$arQuestion["HTML_CODE"];?>
		<?else:?>
			<div class="form-control">
				<label class="form-reiview__label"><span><?=$arQuestion["CAPTION"]?><?=($arQuestion["REQUIRED"] == "Y" ? '&nbsp;<span class="star">*</span>' : '')?></span></label>
				<?
				if(strpos($arQuestion["HTML_CODE"], "class=") === false){
          $arQuestion["HTML_CODE"] = str_replace('input', 'input class=""', $arQuestion["HTML_CODE"]);
        }
					

				if(is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS']))
					$arQuestion["HTML_CODE"] = str_replace('class="', 'class="error ', $arQuestion["HTML_CODE"]);

				if($arQuestion["REQUIRED"] == "Y")
					$arQuestion["HTML_CODE"] = str_replace('name=', 'required name=', $arQuestion["HTML_CODE"]);

				if($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "email")
					$arQuestion["HTML_CODE"] = str_replace('type="text"', 'type="email" placeholder="mail@domen.com"', $arQuestion["HTML_CODE"]);

				if((strpos($arQuestion["HTML_CODE"], "phone") !== false) || (strpos(strToLower($FIELD_SID), "phone") !== false))
					$arQuestion["HTML_CODE"] = str_replace('type="text"', 'type="tel"', $arQuestion["HTML_CODE"]);

        if(!empty($arQuestion['PLACEHOLDER'])){
          $arQuestion["HTML_CODE"] = str_replace(array('<input', '<textarea'), array('<input placeholder="'.$arQuestion["PLACEHOLDER"].'" ', '<textarea placeholder="'.$arQuestion["PLACEHOLDER"].'" '), $arQuestion["HTML_CODE"]);
        }
        
        $arQuestion["HTML_CODE"] = str_replace(
            'class="', 
            'class="'.strtolower($FIELD_SID).' ', 
            $arQuestion["HTML_CODE"]
        );
				?>
				<?if($FIELD_SID == 'RATING'):?>
					<div class="votes_block nstar big with-text">
						<div class="ratings">
							<div class="inner_rating">
								<?for($i=1;$i<=5;$i++):?>
									<div class="item-rating" data-message="<?=GetMessage('RATING_MESSAGE_'.$i)?>"><?=static::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/star2.svg");?></div>
								<?endfor;?>
							</div>
						</div>
						<div class="rating_message muted" data-message="<?=GetMessage('RATING_MESSAGE_0')?>"><?=GetMessage('RATING_MESSAGE_0')?></div>
						<?=str_replace('type="text"', 'type="hidden"', $arQuestion["HTML_CODE"])?>
					</div>
				<?else:?>
					<?=$arQuestion["HTML_CODE"]?>
				<?endif;?>
			</div>
		<?endif;?>
		<?
	}
}