<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$cp = $this->__component;

// Функция для склонения слов (год/года/лет)
function getYearDeclensionModifier($number) {
    $number = (int)$number;
    $years = array('год', 'года', 'лет');
    if ($number % 10 == 1 && $number % 100 != 11) {
        return $number . ' ' . $years[0];
    } elseif ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {
        return $number . ' ' . $years[1];
    } else {
        return $number . ' ' . $years[2];
    }
}

// Расчет стажа из поля PROP_EXPERIENCE (год начала)
if (!empty($arResult['PROPERTIES']['PROP_EXPERIENCE']['VALUE'])) {
    $startYear = (int)$arResult['PROPERTIES']['PROP_EXPERIENCE']['VALUE'];
    $currentYear = (int)date('Y');
    
    if ($startYear > 1900 && $startYear <= $currentYear) {
        $experience = $currentYear - $startYear;
        $arResult['DISPLAY_EXPERIENCE'] = getYearDeclensionModifier($experience);
    }
}

// Обработка отзывов
if (is_array($arResult['PROPERTIES']['PROP_REVIEWS']['VALUE']) && !empty($arResult['PROPERTIES']['PROP_REVIEWS']['VALUE']))
{
    $arResult['REVIEWS'] = $arResult['PROPERTIES']['PROP_REVIEWS']['VALUE'];
}

// Работа с компонентом
if (is_object($cp))
{
    if (!empty($arResult['PROPERTIES']['PROP_POSITION']['VALUE']))
    {
        $cp->arResult['POSITION'] = $arResult['PROPERTIES']['PROP_POSITION']['VALUE'];
    }
    
    if (!empty($arResult['PROPERTIES']['PROP_CATEGORY']['VALUE_ENUM_ID']))
    {
        $cp->arResult['CATEGORY'] = $arResult['PROPERTIES']['PROP_CATEGORY']['VALUE_ENUM_ID'];
    }
    
    $cp->arResult['REVIEWS'] = $arResult['REVIEWS'];
    
    // Добавляем стаж в результат компонента
    if (!empty($arResult['DISPLAY_EXPERIENCE'])) {
        $cp->arResult['DISPLAY_EXPERIENCE'] = $arResult['DISPLAY_EXPERIENCE'];
    }
    
    // Добавляем новые ключи для кеширования
    $cp->SetResultCacheKeys(array('REVIEWS', 'POSITION', 'CATEGORY', 'DISPLAY_EXPERIENCE'));
}

// Обработка услуг врача
if (!empty($arResult['PROPERTIES']['PROP_DOCTOR_SERVICES']['VALUE']))
{
    $res = CIBlockElement::GetList(
        [], 
        [
            "IBLOCK_CODE" => 'aspro_max_services', 
            "ACTIVE_DATE" => "Y", 
            "ACTIVE" => "Y",
            "ID" => $arResult['PROPERTIES']['PROP_DOCTOR_SERVICES']['VALUE']
        ], 
        false, 
        [], 
        ['ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_PRICE_SECOND']
    );
    
    $doctorsServices = [];
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        if ($arFields['PROPERTY_PRICE_VALUE'] || $arFields['PROPERTY_PRICE_SECOND_VALUE'])
        {
            $doctorsServices[] = [
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
                'PRICE' => $arFields['PROPERTY_PRICE_VALUE'] ?? '',
                'SECOND' => $arFields['PROPERTY_PRICE_SECOND_VALUE'] ?? ''
            ];
        }
    }

    $arResult['DOCTORS_DIRECTIONS'] = $doctorsServices;
    unset($doctorsServices);
}
?>