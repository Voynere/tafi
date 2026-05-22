<?
foreach($arResult['ITEMS'] as $key => $arItem){
	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CMax::FormatNewsUrl($arItem);
    
	if(strlen($arItem['DISPLAY_PROPERTIES']['REDIRECT']['VALUE']))
		unset($arResult['ITEMS'][$key]['DISPLAY_PROPERTIES']['REDIRECT']);
}
$arResult["ITEMS"] = [];




// $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*", "ACTIVE_TO", "DETAIL_PICTURE", "PREVIEW_PICTURE","DETAIL_PAGE_URL");
// $arFilter = Array("IBLOCK_ID"=> 24, "PROPERTY_ARHIVE_VALUE" => "Да");
// $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
// while($ob = $res->GetNextElement())
// {
//  $arFields = $ob->GetFields();
//  $arResult["ITEMS"][] = $arFields;
// // pre($arResult);
// }
// Получаем активные акции из инфоблока
// Получаем активные акции из инфоблока
$arFilter = array(
    "IBLOCK_ID" => 24,
    "PROPERTY_ARHIVE_VALUE" => "Да", // Здесь указываем символьный код свойства "Акция активна"
);

$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL",
	"ACTIVE_TO",
    // Дополнительные поля, которые вам могут понадобиться
);

$rsItems = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);

while ($arItem = $rsItems->GetNext()) {
    // Проверяем окончание активности акции
    $arFields = CIBlockElement::GetByID($arItem["ID"])->GetNext();
    $endDate = $arFields["ACTIVE_TO"]; // Здесь указываем символьный код свойства "Окончание активности"

    // Если окончание активности не заполнено или еще не прошло, выводим информацию об акции
    if (empty($endDate) || strtotime($endDate) <= time()) {
    $arResult["ITEMS"][] = $arFields;
	
    }
}


// pre($arResult['ITEMS'][0]["PROPERTIES"]["ARHIVE"]["VALUE"]);
?>