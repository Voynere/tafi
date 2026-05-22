<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// Получаем все разделы инфоблока
$arSectionsRaw = [];
$rsSection = CIBlockSection::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'],
    false,
    ['ID', 'NAME', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL', 'SORT']
);
while ($arSec = $rsSection->Fetch()) {
    $arSectionsRaw[$arSec['ID']] = $arSec;
}

// Для каждого элемента получаем ВСЕ его разделы
$arItemsBySection = [];
foreach ($arResult['ITEMS'] as $arItem) {
    $rsGroups = CIBlockElement::GetElementGroups($arItem['ID'], true);
    $itemSections = [];
    while ($arGroup = $rsGroups->Fetch()) {
        $itemSections[] = $arGroup['ID'];
    }

    // Если нет доп. разделов — берём основной
    if (empty($itemSections)) {
        $itemSections = [$arItem['IBLOCK_SECTION_ID']];
    }

    // Добавляем элемент в каждый раздел
    foreach ($itemSections as $secId) {
        $arItemsBySection[$secId][] = $arItem;
    }
}

// Рекурсивное построение дерева
function buildPriceTree($sections, $itemsBySection, $parentId = 0) {
    $tree = [];
    foreach ($sections as $id => $sec) {
        if ((int)$sec['IBLOCK_SECTION_ID'] === (int)$parentId) {
            $tree[] = [
                'ID'       => $id,
                'NAME'     => $sec['NAME'],
                'ITEMS'    => $itemsBySection[$id] ?? [],
                'SECTIONS' => buildPriceTree($sections, $itemsBySection, $id),
            ];
        }
    }
    return $tree;
}

$arResult['TREE'] = buildPriceTree($arSectionsRaw, $arItemsBySection, 0);