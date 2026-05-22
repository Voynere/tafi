<?php
use function Itb\Licencecheck\getDocumentRoot;

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);

require_once __DIR__ . '/../include.php';

$_SERVER['DOCUMENT_ROOT'] = getDocumentRoot();

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die('Bitrix Framework not initialized');
}
