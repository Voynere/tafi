<?
use \Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) {
    return;
}
?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <input type="hidden" name="id" value="itb.import">
    <input type="hidden" name="uninstall" value="Y">
    <input type="hidden" name="step" value="2">
    <p><input type="checkbox" name="save_data" id="save_data" value="Y" checked>
        <label for="save_data">удалить</label></p>
    <input type="submit" name="" value="удалить">
</form>