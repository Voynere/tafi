<?php
$basePath = '/modules/itb.seo/admin/itb_seo_meta_edit.php';
$localPath = $_SERVER['DOCUMENT_ROOT'] . '/local' . $basePath;
$bitrixPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix' . $basePath;
if(file_exists($localPath)){
    require_once $localPath;
} elseif(file_exists($bitrixPath)) {
    require_once $bitrixPath;
}