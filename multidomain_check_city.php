<?
if ($_SERVER['SERVER_NAME'] == 'localhost') return;
$settings = include $_SERVER['DOCUMENT_ROOT'].'/bitrix/.settings.php';	
$dbname   = $settings["connections"]["value"]["default"]["database"];
$user     = $settings["connections"]["value"]["default"]["login"];
$pass     = $settings["connections"]["value"]["default"]["password"];


$parts = array_filter(explode('/', $_SERVER['REQUEST_URI']));
			
if($parts){
	$code = reset($parts);
}




$mysqli = new mysqli('localhost', $user, $pass, $dbname);
	
$code = $mysqli->real_escape_string($code);
$sql = "SELECT CODE FROM itb_domains WHERE CODE='$code' AND ACTIVE='Y' LIMIT 1";


$results = $mysqli->query($sql);

$codeCity = false;

if($results)
{
	if($results->fetch_assoc()) {
		$codeCity = $code;
	}
}


if($codeCity){						
	$_SERVER['REQUEST_URI'] = str_replace('/'.$codeCity,'',$_SERVER['REQUEST_URI']);
	$GLOBALS['CITY_CODE_VALUE'] = $codeCity;
}	
