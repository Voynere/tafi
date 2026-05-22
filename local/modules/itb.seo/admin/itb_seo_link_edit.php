<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/include.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/prolog.php");

use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Itb\Seo\Table\LinkTable;

global $APPLICATION;

Loader::includeModule('itb.seo');
$arRequest  = HttpApplication::getInstance()->getContext()->getRequest();
$sModuleId  = htmlspecialchars($arRequest['mid'] != '' ? $arRequest['mid'] : $arRequest['id']);
$sRight     = $APPLICATION->GetGroupRight($sModuleId);

$ID = (int)$arRequest['ID'];

if ($sRight == "D") {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$aTabs = [[
    "DIV"   => "edit1",
    "TAB"   => "Общие",
    "ICON"  => "main_user_edit",
    "TITLE" => "Форма добавления ссылок"
]];
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if ($arRequest->isPost() && ($save != "" || $apply != "") && $sRight == "W" && check_bitrix_sessid()) {
    $res = true;

    $arFields = [
        "URL_OLD" => trim($arRequest['URL_OLD']),
        "URL_NEW" => trim($arRequest['URL_NEW']),
    ];

    if ($ID > 0) {
        $result = LinkTable::update($ID, $arFields);
        $res = $result->isSuccess();
    } else {
        $result = LinkTable::add($arFields);
        if ($result->isSuccess()) {
            $ID = $result->getId();
            $res = true;
        } else {
            $res = false;
        }
    }

    if ($res) {
        if ($apply != "") {
            LocalRedirect("/bitrix/admin/itb_seo_link_edit.php?ID=" . $ID . "&mess=ok&lang=" . LANG . "&" . $tabControl->ActiveTabParam());
        } else {
            LocalRedirect("/bitrix/admin/itb_seo_link.php?lang=" . LANG);
        }
    } else {
        if ($e = $APPLICATION->GetException()) {
            $message = new CAdminMessage("Ошибка сохранения элемента", $e);
        } elseif ($result && !$result->isSuccess()) {
            $message = new CAdminMessage("Ошибка сохранения элемента", implode("; ", $result->getErrorMessages()));
        }
        $bVarsFromForm = true;
    }
}

$arFields = [
    'URL_OLD' => '',
    'URL_NEW' => ''
];

if ($ID > 0) {
    $record = LinkTable::getById($ID)->fetch();
    if ($record) {
        $arFields = $record;
    } else {
        $ID = 0;
    }
}

$APPLICATION->SetTitle(($ID > 0 ? "Редактирование записи: " . $ID : "Добавление записи"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$aMenu = [
    [
        "TEXT"  => "Список ссылок",
        "TITLE" => "Список ссылок",
        "LINK"  => "itb_seo_link.php?lang=" . LANG,
        "ICON"  => "btn_list",
    ]
];

if ($ID > 0) {
    $aMenu[] = ["SEPARATOR" => "Y"];
    $aMenu[] = [
        "TEXT"  => "Добавить элемент",
        "TITLE" => "Добавить элемент",
        "LINK"  => "itb_seo_link.php?lang=" . LANG,
        "ICON"  => "btn_new",
    ];
    $aMenu[] = [
        "TEXT"  => "Удалить элемент",
        "TITLE" => "Удалить элемент",
        "LINK"  => "javascript:if(confirm('Вы уверены что хотите удалить элемент?'))window.location='itb_seo_link.php?ID=" . $ID . "&action=delete&lang=" . LANG . "&" . bitrix_sessid_get() . "';",
        "ICON"  => "btn_delete",
    ];
}

$context = new CAdminContextMenu($aMenu);
$context->Show();

if ($_REQUEST["mess"] == "ok" && $ID > 0) {
    CAdminMessage::ShowMessage(["MESSAGE" => "Ссылка сохранена", "TYPE" => "OK"]);
}
?>

<form method="POST" action="<?php echo $APPLICATION->GetCurPage() ?>" ENCTYPE="multipart/form-data" name="post_form">
    <?= bitrix_sessid_post() ?>
    <?php $tabControl->Begin(); ?>
    <?php $tabControl->BeginNextTab(); ?>
    <tr>
        <td>URL_OLD</td>
        <td><input type="text" name="URL_OLD" value="<?php echo htmlspecialcharsbx($arFields['URL_OLD']); ?>" size="50"></td>
    </tr>
    <tr>
        <td>URL_NEW</td>
        <td><input type="text" name="URL_NEW" value="<?php echo htmlspecialcharsbx($arFields['URL_NEW']); ?>" size="50"></td>
    </tr>
    <?php
    $tabControl->Buttons([
        "disabled" => ($sRight < "W"),
        "back_url" => "itb_seo_link.php?lang=" . LANG,
    ]);
    ?>
    <input type="hidden" name="lang" value="<?= LANG ?>">
    <?php if ($ID > 0 && !$bCopy): ?>
        <input type="hidden" name="ID" value="<?= $ID ?>">
    <?php endif; ?>
    <?php $tabControl->End(); ?>
    <?php $tabControl->ShowWarnings("post_form", $message); ?>
</form>
