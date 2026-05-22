<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock'))
	return;


$arTemplateParameters['SECTION_TITLE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_SECTION_TITLE'),
	'TYPE' => 'STRING',
	'DEFAULT' => '',
);

$arTemplateParameters['SECTION_LINK_ALL'] = array(
    'PARENT' => 'VISUAL',
    'NAME' => GetMessage('CP_BCE_TPL_SECTION_LINK_ALL'),
    'TYPE' => 'STRING',
    'DEFAULT' => '',
);