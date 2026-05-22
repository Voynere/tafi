<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    "NAME" => Loc::getMessage('ITB_UPDATE_BASKET_COMPONENT_NAME'),
    "DESCRIPTION" => Loc::getMessage('ITB_UPDATE_BASKET_COMPONENT_DESCR'),
    "ICON" => '/images/icon.gif',
    "SORT" => 20,
    "PATH" => array(
        "ID" => 'ITB_CONTENT',
        "NAME" => Loc::getMessage('ITB_COMPONENTS_MAIN_FOLDER'),
        "SORT" => 10,
        "CHILD" => array(
            "ID" => 'ITB_ORDERS',
            "NAME" => Loc::getMessage('ITB_ORDERS_FOLDER'),
            "SORT" => 10
        )
    ),
);