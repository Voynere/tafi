<?
$count=count($arResult["ITEMS"]);
$diff=5-$count;
if($count<5){
	for($i=1;$i<=$diff;$i++){
		$arResult["ITEMS"][]='';
	}
}

$geoData = \Itb\MultiDomains\Site::Instance();
$city = $geoData->detectCity();



//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
//["PRODUCT_ID"]

foreach($arResult["ITEMS"] as $k => $arItem){
	
	if($arItem["PRODUCT_ID"]){
		
		$arResult["ITEMS"][$k]['PRICE'] = $price = \CCatalogProduct::GetOptimalPrice($arItem["PRODUCT_ID"], 1);
		
		/* if($price["DISCOUNT_PRICE"]){
			$arResult["ITEMS"][$k]['PRICE']["PRINT_DISCOUNT_PRICE"] = CCurrencyLang::CurrencyFormat($price["DISCOUNT_PRICE"], $price ["RESULT_PRICE"]["CURRENCY"], true);
		}    
		 */
		$VALUES = array();
		$res = CIBlockElement::GetProperty(26, $arItem["PRODUCT_ID"], "sort", "asc", array("CODE" => "HIDE_CITY"));
		$arResult["ITEMS"][$k]['HIDE_CITY'] = [];
		while ($ob = $res->GetNext())
		{
			
			$arResult["ITEMS"][$k]['HIDE'] = ($city["SETTINGS"]["UF_XML_ID"] && $ob['VALUE'] && in_array($city["SETTINGS"]["UF_XML_ID"], $ob['VALUE']));			
			$arResult["ITEMS"][$k]['HIDE_CITY'] = $ob['VALUE'];
		}
		
	}
}

//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";

//["RESULT_PRICE"]["DISCOUNT_PRICE"]
?>