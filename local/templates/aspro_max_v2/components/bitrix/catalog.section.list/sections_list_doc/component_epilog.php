<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if($arResult['ACTIVE_SECTION']){
	
	//echo "<pre>"; var_dump($arResult['ACTIVE_SECTION']); echo "</pre>";
	
	$APPLICATION->AddChainItem($arResult['ACTIVE_SECTION']['NAME'], $arResult['ACTIVE_SECTION']['SECTION_PAGE_URL']);
	
	
	$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
		$arParams["IBLOCK_ID"],
		$arResult['ACTIVE_SECTION']['ID']
	);
		 
		 
	$seo = $ipropValues->getValues();
	
	echo "<pre>"; var_dump($seo); echo "</pre>";
	
	if( $seo["SECTION_META_TITLE"]){
		$APPLICATION->SetPageProperty("title", $seo["SECTION_META_TITLE"]);
	}
	
	if($seo["SECTION_META_KEYWORDS"]){
		$APPLICATION->SetPageProperty("keywords", $seo["SECTION_META_KEYWORDS"]);
	}
	
	if($seo["SECTION_META_DESCRIPTION"]){
		$APPLICATION->SetPageProperty("description", $seo["SECTION_META_DESCRIPTION"]);
	}
	
	if($seo["SECTION_PAGE_TITLE"]){
		$APPLICATION->SetTitle($seo["SECTION_PAGE_TITLE"]);
	}
	
	
}