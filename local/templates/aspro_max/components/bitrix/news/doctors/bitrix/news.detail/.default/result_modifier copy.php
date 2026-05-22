<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$cp = $this->__component;

if (is_array($arResult['PROPERTIES']['PROP_REVIEWS']['VALUE']) && !empty($arResult['PROPERTIES']['PROP_REVIEWS']['VALUE']))
{
    $arResult['REVIEWS'] = $arResult['PROPERTIES']['PROP_REVIEWS']['VALUE'];
}

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
    $cp->SetResultCacheKeys(array('REVIEWS', 'POSITION','CATEGORY'));
}

if (!empty($arResult['PROPERTIES']['PROP_DOCTOR_SERVICES']['VALUE']))
{
    $res = CIBlockElement::GetList(
        [], 
        $arFilter = [
            "IBLOCK_CODE"=>'aspro_max_services', 
            "ACTIVE_DATE"=>"Y", 
            "ACTIVE"=>"Y",
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
            $doctorsIds[] = [
                'ID' => $arFields['ID'],
                'NAME' => $arFields['NAME'],
                'PRICE' => $arFields['PROPERTY_PRICE_VALUE'] ?? '',
                'SECOND' => $arFields['PROPERTY_PRICE_SECOND_VALUE'] ?? ''
            ];
        }
    }

    $arResult['DOCTORS_DIRECTIONS'] = $doctorsIds;
    unset($doctorsIds);
}
?>