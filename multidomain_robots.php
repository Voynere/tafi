<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('itb.multidomains');
	
$geoData = \Itb\MultiDomains\Site::Instance();
$city = $geoData->detectCity();
	
	
function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}




$protocol = isSecure() ? 'https' : 'http';



$file = __DIR__ . "/robots.txt";


$domain = \Bitrix\Main\Config\Option::get('itb.multidomains', "domain");


$parts = explode('.', $domain);
		
if($parts[0] == 'www'){
	unset($parts[0]);
	$domain2 = implode('.',$parts);
}else{
	$domain2 = 'www.'.$domain;
}
			
$host = $domain.$city["SITE_DIR"];

$timestamp = filemtime($file);
$tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
$etag = md5($file . $timestamp);




$result = file_get_contents($file);

$search = array($domain.'/', $domain2.'/', !isSecure() ? 'https:' : 'http:');
$replace =  array($host, $host, isSecure() ? 'https:' : 'http:');



header('Content-Type: text/plain');
//header('Content-Length: '.filesize($file));
//header("Last-Modified: $tsstring");
//header("ETag: \"{$etag}\"");

$result = str_replace($search, $replace , $result);	

echo $result;
