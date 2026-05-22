<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Itb\Import\FormGenerator as FormGenerator;
use Itb\Import\OtionsGeneratorParams as OtionsGeneratorParams;
use Itb\Import\ProductImport as ProductImport;


Loc::loadMessages(__FILE__);
$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

$options = \Bitrix\Main\Config\Option::getForModule($module_id);
$options = array_change_key_case($options, CASE_UPPER);

$OPTION_IBLOCK_ID = $options["ITB_IBLOCK_ID_IMPORT"];
$OPTION_FILE["ITB_FILE_EXEL"] = $options["ITB_FILE_EXEL"];
$OPTION_FILE["ITB_FILE_EXEL_LINK_OFFERS"] = $options["ITB_FILE_EXEL_LINK_OFFERS"];
$OPTION_FILE["ITB_FILE_EXEL_LINK_PRODUCT"] = $options["ITB_FILE_EXEL_LINK_PRODUCT"];


$POST_RIGHT = $APPLICATION->GetGroupRight($module_id);

if ($POST_RIGHT < "S") {
    $APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

Loader::includeModule($module_id);


$Options_form = new FormGenerator\OtionsGenerate($module_id);


$aTabs = new OtionsGeneratorParams\OtionsGenerate($OPTION_IBLOCK_ID, $OPTION_FILE);
$aTabs = $aTabs->aTabs;


if ($request->isPost() && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) {
        foreach ($aTab["OPTIONS"] as $arOption) {

            $optionValue = $request->getPost($arOption[0]);

            if (($arOption[0] == "ITB_FILE_EXEL_LINK_OFFERS" || $arOption[0] == "ITB_FILE_EXEL_LINK_PRODUCT" || $arOption[0] == "ITB_FILE_EXEL") && !empty($request->getFile($arOption[0])["name"])) {
                $fid = CFile::SaveFile($request->getFile($arOption[0]), "ITB_IMPORT");
                Option::set($module_id, $arOption[0], CFile::GetPath($fid));
            }
            if (!is_array($arOption) || empty($optionValue)) {
                continue;
            }
            if ($request["Update"]) {
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            }
            if ($request["default"]) {
                Option::delete($module_id);
            }
        }
    }

}


$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);
$tabControl->Begin();
?>

<form enctype="multipart/form-data"
      action="<?= ($APPLICATION->GetCurPage()); ?>?mid=<?= ($module_id); ?>&lang=<?= (LANG); ?>"
      method="post">
    <? foreach ($aTabs as $aTab) {
        if ($aTab["OPTIONS"]) {
            $tabControl->BeginNextTab();
            foreach ($aTab["OPTIONS"] as $Option) {
                $Options_form->InputGenerator($Option);
            }
        }
    }
    $tabControl->BeginNextTab();
    require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php";
    $tabControl->Buttons();

    echo(bitrix_sessid_post());
    ?>
    <input class="adm-btn-save" type="submit" name="Update" value="Применить"/>


    <input type="submit" name="default" value="По умолчанию"/>
</form>
<?
$tabControl->End();
?>
