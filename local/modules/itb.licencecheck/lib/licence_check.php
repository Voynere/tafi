<?php
require_once(__DIR__ . '/../include/prolog.php');

use Bitrix\Main\Loader;
use Itb\Licencecheck\LicenceCheckAgent;
use Itb\Licencecheck\Options;

try {
    if (!Loader::includeModule('itb.licencecheck')) {
        throw new Exception('Module itb.licencecheck not found');
    }
    
    $result = LicenceCheckAgent::exec();
    
} catch (Exception $e) {
    \AddMessage2Log(date('Y-m-d H:i:s') . ' - ' . $e->getMessage(), Options::getModuleId());
}

require_once(__DIR__ . '/../include/epilog.php');
