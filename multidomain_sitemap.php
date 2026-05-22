<?php 

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"]="N";
$APPLICATION->ShowIncludeStat = false;

\Bitrix\Main\Loader::includeModule('itb.multidomains');
$domain = \Bitrix\Main\Config\Option::get('itb.multidomains', "domain");
$geoData = \Itb\MultiDomains\Site::Instance();
$city = $geoData->detectCity();

$protocol_base = \Bitrix\Main\Config\Option::get('itb.multidomains', "main_https") == 'Y' ? 'https://' : 'http://';
$base = $protocol_base.$domain;

$parts = explode('.', $domain);
		
if($parts[0] == 'www'){
	unset($parts[0]);
	$domain2 = implode('.',$parts);
}else{
	$domain2 = 'www.'.$domain;
}

$host = $domain.$city["SITE_DIR"];

$search = array($domain.'/', $domain2.'/', !isSecure() ? 'https:' : 'http:');
$replace =  array($host, $host, isSecure() ? 'https:' : 'http:');



function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

$arItemsHide = array();

if(\Bitrix\Main\Loader::includeModule('iblock') && $city["SETTINGS"]["UF_XML_ID"]){
	
	
	$res = CIBlockElement::GetList(
		[],
		['IBLOCK_ID' => 26, 'PROPERTY_HIDE_CITY' => $city["SETTINGS"]["UF_XML_ID"]],
		false,
		false,
		['ID', 'IBLOCK_ID', 'DETAIL_PAGE_URL']
	);

	while ($row = $res->GetNext())
	{
		
		$arItemsHide[] = 'https://tafimed.ru'.$row['DETAIL_PAGE_URL'];
		//echo '<pre>', mydump($row), '</pre>';
		//https://tafimed.ru
	}
	
}




//$protocol = isSecure() ? 'https' : 'http';
//$adress = $protocol.'://'.$_SERVER['HTTP_HOST'];

$site_map = simplexml_load_file(__DIR__.'/sitemap.xml');

if(count($site_map->sitemap)){
	
	foreach ($site_map->sitemap as $item) {
	
	$url = str_replace($base, __DIR__ , (string)$item->loc);		
	$map_item = simplexml_load_file($url);
	
	
	
	foreach ($map_item->url as $elem){			
			
			if(in_array((string)$elem->loc,$arItemsHide))
				continue;
		
			$loc = str_replace($search, $replace,(string)$elem->loc);		
			
			$itemsMap[] = array(
				'loc' => $loc,
				'lastmod' => (string)$elem->lastmod
			);		
		}	 
	}
	
}else{
	
	foreach ($site_map->url as $elem){			
			
			if(in_array((string)$elem->loc,$arItemsHide))
				continue;
		
			$loc = str_replace($search, $replace,(string)$elem->loc);		
			
			$itemsMap[] = array(
				'loc' => $loc,
				'lastmod' => (string)$elem->lastmod
			);		
		}	 
	
}



$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

foreach($itemsMap as $value){	
	$i = $xml->addChild('url');
	$i->addChild('loc', $value['loc']);
	$i->addChild('lastmod', $value['lastmod']);		
} 

$dom = dom_import_simplexml($xml)->ownerDocument;
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

header('Content-Type: text/xml');

echo $dom->saveXML();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");