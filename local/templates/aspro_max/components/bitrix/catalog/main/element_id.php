<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?

use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;

Loader::includeModule("iblock");

$arSelect = array("ID", "CODE");
$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["VARIABLES"]["ELEMENT_ID"]);
$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	//var_dump($arFields);
}


$url = str_replace('#SECTION_CODE_PATH#', $arResult["VARIABLES"]["SECTION_CODE_PATH"], $arResult["URL_TEMPLATES"]["element"]);
$url = str_replace('#ELEMENT_CODE#', $arFields["CODE"], $url);
LocalRedirect($arResult["FOLDER"] . $url);
//var_dump($url);
