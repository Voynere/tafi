<?php

use function Itb\Licencecheck\getDocumentRoot;

require_once __DIR__ . '/include/functions.php';

if (!defined('LOG_FILENAME')) {
    define("LOG_FILENAME", getDocumentRoot() . "/bitrix/modules/error.log");
}
