<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Функция для склонения слов (год/года/лет)
function getYearDeclension($number) {
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

foreach($arResult['ITEMS'] as $key => $item) {
    // Расчет стажа для каждого врача
    if (!empty($item['PROPERTIES']['PROP_EXPERIENCE']['VALUE'])) {
        $startYear = (int)$item['PROPERTIES']['PROP_EXPERIENCE']['VALUE'];
        $currentYear = (int)date('Y');
        
        if ($startYear > 1900 && $startYear <= $currentYear) {
            $experience = $currentYear - $startYear;
            $arResult['ITEMS'][$key]['DISPLAY_EXPERIENCE'] = 'Стаж ' . getYearDeclension($experience);
        } else {
            $arResult['ITEMS'][$key]['DISPLAY_EXPERIENCE'] = 'Стаж ' . htmlspecialchars($item['PROPERTIES']['PROP_EXPERIENCE']['VALUE']);
        }
    }
}
?>