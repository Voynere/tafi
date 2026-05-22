<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Itb\MultiDomains\Site;

\Bitrix\Main\Loader::includeModule('itb.multidomains');

	$arResult = array();
	$geoData = Site::Instance();


	/*
	if(!isset($_SESSION["IS_VISITED_SITE"])){	
		
		//setcookie("IS_VISITED_SITE", 1, 0);
		$_SESSION["IS_VISITED_SITE"] = 1;
		$geoData->geoRedirect();
	}*/ 
		
	$city = $geoData->detectCity();
  
  
  
	$arResult['ACTIVE_CITY'] = $city;
  $_SESSION["ACTIVE_USER_CITY"] = $arResult['ACTIVE_CITY']["SETTINGS"]["UF_XML_ID"];
	$arResult['GEO_DATA'] = $geoData;
	
	 $arResult['SHOW_FORM'] = false;	
	
	if(!isset($_SESSION['IS_SHOWED_FORM'])){
		
		
		/* if(!Useragent::isRobot()){
			
			 $cityGeo = $geoData->geoDetectCity();
			 
			
			
			 if($cityGeo && $cityGeo['CITYNAME']){
				 
				 $cityGeo = $geoData->getCityByName($cityGeo['CITYNAME']);
				
				 if( $cityGeo && $arResult['ACTIVE_CITY']['UF_XML_ID'] != $cityGeo['UF_XML_ID']){
					 
					 $url = str_replace('%2F', '', urlencode($APPLICATION->GetCurUri())); 
					 
					 $cityGeo['URL'] =  $geoData->makeCityUrl($cityGeo, $url);					 
					 LocalRedirect($cityGeo['URL']);
					
				 }
				 
				
				 
			 }
			 
			
			
		}  */
		
		$arResult['SHOW_FORM'] = true;
		$_SESSION['IS_SHOWED_FORM'] = 1;
		
		//setcookie("IS_SHOWED_FORM", 1, 0);
	} 


$this->IncludeComponentTemplate();
?>