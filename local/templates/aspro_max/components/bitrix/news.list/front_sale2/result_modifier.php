<?
foreach($arResult['ITEMS'] as $key => $arItem){
	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CMax::FormatNewsUrl($arItem);
    
	if(strlen($arItem['DISPLAY_PROPERTIES']['REDIRECT']['VALUE']))
		unset($arResult['ITEMS'][$key]['DISPLAY_PROPERTIES']['REDIRECT']);
}
$arFilter = array(
    "IBLOCK_ID" => 24,
	"ACTIVE" => "Y",
);
$arResult["ITEMS"] = [];
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
	$endDate  = DateTime::createFromFormat('d.m.Y H:i:s', $arFields["ACTIVE_TO"], new DateTimeZone('UTC'));
    $endDateMs = $endDate->getTimestamp() * 1000; // если нужна миллисекундная точность

    $todayMs = (new DateTime('today', new DateTimeZone('UTC')))->getTimestamp() * 1000;

    // Если окончание активности не заполнено или еще не прошло, выводим информацию об акции
    if (empty($endDate) || $endDateMs >= $todayMs) {
    $arResult["ITEMS"][] = $arFields;
	
    }
}


?>