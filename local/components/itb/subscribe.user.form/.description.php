<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME'        => Loc::getMessage("ITB_SUBSCRIBE_USER_COMPONENT_NAME"),
    'DESCRIPTION' => Loc::getMessage("ITB_SUBSCRIBE_USER_COMPONENT_DESCRIPTION"),
    'PATH'        => [
        'ID'    => 'itb',
        'NAME'  => 'ITB',
        'CHILD' => [
            'ID'   => 'itb.subscribe.user',
            'NAME' => Loc::getMessage("ITB_SUBSCRIBE_USER_COMPONENT_NAME"),
        ],
    ],
];