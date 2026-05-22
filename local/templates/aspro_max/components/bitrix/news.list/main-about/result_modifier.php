<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Iblock\IblockTable;

$q = IblockTable::query()
    ->setFilter(['ID' => $arParams['IBLOCK_ID']])
    ->setSelect([
        'NAME',
        'DESCRIPTION'
    ]);

$dbRes = $q->exec();

if($arItem = $dbRes->fetch()){
   $arResult['IBLOCK_INFO'] = $arItem;
}