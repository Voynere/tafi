<?php

namespace Itb\Licencecheck;

use Bitrix\Main\Application;

if (!function_exists('Itb\Licencecheck\getDocumentRoot')) {
    /**
     * @return string
     */
    function getDocumentRoot()
    {
        $documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : null;
        if (!$documentRoot) {
            $documentRoot = Application::getDocumentRoot();
            if (!$documentRoot) {
                $documentRoot = realpath(__DIR__ . '/../../../..');
                if (!$documentRoot) {
                    $documentRoot = '';
                }
            }
        }
        return $documentRoot;
    }
}
