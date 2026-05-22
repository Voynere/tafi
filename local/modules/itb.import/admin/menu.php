<?
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu = array(
        'parent_menu' => 'global_menu_services',
        'sort' => 1,
        'text' => "ITB import",
        "items_id" => "menu_webforms",
        "icon" => "form_menu_icon",
);

$aMenu["items"][] =  array(
        'text' => 'Module`s page',
        'url' => 'hmarketing.php?lang=' . LANGUAGE_ID
);

$aMenu["items"][] =  array(
        'text' => 'Module`s settings',
        'url' => 'settings.php?lang=ru&mid=itb.import'
);

return $aMenu;
