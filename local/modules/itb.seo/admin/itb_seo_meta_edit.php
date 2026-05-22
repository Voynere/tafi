<?php

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Itb\Seo\Table\MetaTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

IncludeModuleLangFile(__FILE__);
Loader::includeModule('itb.seo');
$POST_RIGHT = $APPLICATION->GetGroupRight("itb.seo");
if ($POST_RIGHT == "D") {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$aTabs = [
    [
        "DIV"   => "edit1",
        "TAB"   => "Общие",
        "ICON"  => "main_user_edit",
        "TITLE" => "Форма добавление тегов"
    ]
];
$tabControl = new CAdminTabControl("tabControl", $aTabs);

$request       = Context::getCurrent()->getRequest();
$ID            = (int)$request->get("ID");
$message       = null;
$bVarsFromForm = false;

if ($request->isPost() && ($request["save"] != "" || $request["apply"] != "") && $POST_RIGHT == "W" && check_bitrix_sessid()) {
    $arUrl = parse_url($request["URL"]);
    $URL   = $arUrl["path"] . (isset($arUrl["query"]) ? "?" . $arUrl["query"] : "");

    // проверка на уникальность
    $exist = MetaTable::getList([
        'select' => ['ID'],
        'filter' => [
            '=SUBDOMAIN' => trim($request["SUBDOMAIN"]),
            '=URL'       => trim($URL),
            '!ID'        => $ID > 0 ? $ID : null,
        ]
    ])->fetch();

    if ($exist) {
        $message       = new CAdminMessage("Ошибка сохранения элемента, такой URL уже существует");
        $bVarsFromForm = true;
    } else {
        $fields = [
            'SUBDOMAIN'   => trim($request["SUBDOMAIN"]),
            'URL'         => trim($URL),
            'TITLE'       => trim($request["TITLE"]),
            'DESCRIPTION' => trim($request["DESCRIPTION"]),
            'KEYWORDS'    => trim($request["KEYWORDS"]),
            'H1'          => trim($request["H1"]),
            'TEXT'        => $request["TEXT"],
        ];

        if ($ID > 0) {
            $result = MetaTable::update($ID, $fields);
        } else {
            $result = MetaTable::add($fields);
            if ($result->isSuccess()) {
                $ID = $result->getId();
            }
        }

        if ($result->isSuccess()) {
            if ($request["apply"] != "") {
                LocalRedirect("/bitrix/admin/itb_seo_meta_edit.php?ID=" . $ID . "&mess=ok&lang=" . LANG . "&" . $tabControl->ActiveTabParam());
            } else {
                LocalRedirect("/bitrix/admin/itb_seo_meta.php?lang=" . LANG);
            }
        } else {
            $message       = new CAdminMessage("Ошибка сохранения элемента: " . implode("; ", $result->getErrorMessages()));
            $bVarsFromForm = true;
        }
    }
}

// === Значения по умолчанию ===
$str_SUBDOMAIN   = "";
$str_URL         = "";
$str_TITLE       = "";
$str_DESCRIPTION = "";
$str_KEYWORDS    = "";
$str_H1          = "";
$str_TEXT        = "";

// === Загружаем данные ===
if ($ID > 0) {
    $item = MetaTable::getById($ID)->fetch();
    if ($item) {
        foreach ($item as $k => $v) {
            ${"str_" . $k} = $v;
        }
    } else {
        $ID = 0;
    }
}

$APPLICATION->SetTitle(($ID > 0 ? "Редактирование записи: " . $ID : "Добавление записи"));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

// Меню
$aMenu = [
    [
        "TEXT"  => "Список тегов",
        "TITLE" => "Список тегов",
        "LINK"  => "itb_seo_meta.php?lang=" . LANG,
        "ICON"  => "btn_list",
    ]
];

if ($ID > 0) {
    $aMenu[] = ["SEPARATOR" => "Y"];
    $aMenu[] = [
        "TEXT"  => "Добавить элемент",
        "TITLE" => "Добавить элемент",
        "LINK"  => "itb_seo_meta_edit.php?lang=" . LANG,
        "ICON"  => "btn_new",
    ];
    $aMenu[] = [
        "TEXT"  => "Удалить элемент",
        "TITLE" => "Удалить элемент",
        "LINK"  => "javascript:if(confirm('Вы уверены что хотите удалить элемент?'))window.location='itb_seo_meta.php?ID=" . $ID . "&action=delete&lang=" . LANG . "&" . bitrix_sessid_get() . "';",
        "ICON"  => "btn_delete",
    ];
}

$context = new CAdminContextMenu($aMenu);
$context->Show();

if ($_REQUEST["mess"] == "ok" && $ID > 0) {
    CAdminMessage::ShowMessage(["MESSAGE" => "Теги сохранены", "TYPE" => "OK"]);
}

if ($message) {
    echo $message->Show();
}
?>

<form method="POST" action="<?php echo $APPLICATION->GetCurPage() ?>" enctype="multipart/form-data" name="post_form">
    <?= bitrix_sessid_post() ?>
    <?php $tabControl->Begin(); ?>
    <?php $tabControl->BeginNextTab(); ?>
    <tr>
        <td>Поддомен</td>
        <td><input type="text" name="SUBDOMAIN" value="<?php echo htmlspecialchars($str_SUBDOMAIN); ?>" size="50"></td>
    </tr>
    <tr>
        <td></td>
        <td>
            Пустой - для основного домена и любых поддоменов<br/>
            www - только для основного домена<br/>
            Наименование поддомен (пример omsk, nsk, subdomain и т.д.)
        </td>
    </tr>
    <tr>
        <td>URL</td>
        <td><input type="text" name="URL" value="<?php echo htmlspecialchars($str_URL); ?>" size="50"></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><input type="text" name="TITLE" value="<?php echo htmlspecialchars($str_TITLE); ?>" size="50"></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><textarea name="DESCRIPTION" cols="52"><?php echo htmlspecialchars($str_DESCRIPTION); ?></textarea></td>
    </tr>
    <tr>
        <td>Keywords</td>
        <td><input type="text" name="KEYWORDS" value="<?php echo htmlspecialchars($str_KEYWORDS); ?>" size="50"></td>
    </tr>
    <tr>
        <td>H1</td>
        <td><input type="text" name="H1" value="<?php echo htmlspecialchars($str_H1); ?>" size="50"></td>
    </tr>
    <tr>
        <td>Text</td>
        <td>
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:fileman.light_editor",
                "",
                [
                    "CONTENT"            => htmlspecialchars_decode($str_TEXT),
                    "INPUT_NAME"         => "TEXT",
                    "WIDTH"              => "100%",
                    "HEIGHT"             => "300px",
                    "RESIZABLE"          => "Y",
                    "AUTO_RESIZE"        => "Y",
                    "VIDEO_ALLOW_VIDEO"  => "Y",
                    "VIDEO_MAX_WIDTH"    => "640",
                    "VIDEO_MAX_HEIGHT"   => "480",
                    "VIDEO_BUFFER"       => "20",
                    "VIDEO_WMODE"        => "transparent",
                    "VIDEO_WINDOWLESS"   => "Y",
                    "USE_FILE_DIALOGS"   => "Y",
                ]
            );
            ?>
            <br/><br/>
            &lt;!-- PATTERN --&gt; Замена &lt;!-- END_PATTERN --&gt;
        </td>
    </tr>

    <?php
    $tabControl->Buttons([
        "disabled" => ($POST_RIGHT < "W"),
        "back_url" => "itb_seo_meta.php?lang=" . LANG,
    ]);
    ?>

    <input type="hidden" name="lang" value="<?= LANG ?>">
    <?php if ($ID > 0 && !$bCopy): ?>
        <input type="hidden" name="ID" value="<?= $ID ?>">
    <?php endif; ?>
    <?php $tabControl->End(); ?>
    <?php $tabControl->ShowWarnings("post_form", $message); ?>
</form>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
