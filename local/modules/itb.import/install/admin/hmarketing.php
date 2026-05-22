<?
if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/itb.import/")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/itb.import/admin/hmarketing.php");
}

if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/local/modules/itb.import/")) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/local/modules/itb.import/admin/hmarketing.php");
}
