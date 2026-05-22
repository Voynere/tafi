<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/subscribe/include.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/subscribe/prolog.php");

use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Itb\Seo\Table\TagTable;
use Itb\Seo\Table\TagsTable;
use Itb\Seo\Table\TagGroupTable;
use Itb\Seo\Table\TagToGroupTable;

global $APPLICATION;

Loader::includeModule('itb.seo');
$arRequest  = HttpApplication::getInstance()->getContext()->getRequest();
$sModuleId  = htmlspecialchars($arRequest['mid'] != '' ? $arRequest['mid'] : $arRequest['id']);
$sRight     = $APPLICATION->GetGroupRight($sModuleId);

if ($sRight == "D") {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$sTable = TagTable::getTableName();

$oSort  = new CAdminSorting($sTable, "ID", "desc");
$lAdmin = new CAdminList($sTable, $oSort);

function CheckFilter() {
    global $FilterArr, $lAdmin;
    foreach ($FilterArr as $f) {
        global $$f;
    }
    return count($lAdmin->arFilterErrors) == 0;
}

$FilterArr = [
    "find_id",
    "find_title",
    "find_url",
    "find_active",
];

$lAdmin->InitFilter($FilterArr);

$arFilter = [];
if (CheckFilter()) {
    if ($find_id)    $arFilter['ID']    = $find_id;
    if ($find_title) $arFilter['%TITLE'] = $find_title;
    if ($find_url)   $arFilter['%URL']   = $find_url;
    if ($find_active) $arFilter['ACTIVE'] = $find_active;
}

// Групповые действия
if (($arID = $lAdmin->GroupAction()) && $sRight == "W") {
    if ($_REQUEST['action_target'] == 'selected') {
        $arID = [];
        $res = TagTable::getList(['select' => ['ID']]);
        while ($row = $res->fetch()) {
            $arID[] = $row['ID'];
        }
    }

    foreach ($arID as $ID) {
        if (!$ID) continue;

        switch ($_REQUEST['action']) {
            case "delete":
                @set_time_limit(0);
                $connection = \Bitrix\Main\Application::getConnection();
                $connection->startTransaction();
                try {
                    TagTable::delete($ID);

                    // связанные данные
                    $tags = TagsTable::getList(['filter' => ['TAG_ID' => $ID]])->fetchAll();
                    foreach ($tags as $t) {
                        TagsTable::delete($t['ID']);
                    }

                    $groups = TagGroupTable::getList([
                        'filter' => ['=TAG_TO_GROUP.TAG_ID' => $ID],
                    ])->fetchAll();
                    foreach ($groups as $g) {
                        TagGroupTable::delete($g['ID']);
                    }

                    $rels = TagToGroupTable::getList(['filter' => ['TAG_ID' => $ID]])->fetchAll();
                    foreach ($rels as $r) {
                        TagToGroupTable::delete($r['ID']);
                    }

                    $connection->commitTransaction();
                } catch (\Throwable $e) {
                    $connection->rollbackTransaction();
                    $lAdmin->AddGroupError("Ошибка удаления записи: ".$e->getMessage(), $ID);
                }
                break;
        }
    }
}

// ORM выборка
$rsData = TagTable::getList([
    'select' => ['*'],
    'filter' => $arFilter,
    'order'  => [$by => $order],
]);

$rsData = new CAdminResult($rsData, $sTable);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Элементов"));

$lAdmin->AddHeaders([
    ["id" => "ID", "content" => "ID", "sort" => "id", "align" => "right", "default" => true],
    ["id" => "URL", "content" => "URL", "sort" => "url", "default" => true],
    ["id" => "TITLE", "content" => "TITLE", "sort" => "title", "default" => true],
    ["id" => "ACTIVE", "content" => "ACTIVE", "sort" => "active", "default" => true],
]);

while ($arRes = $rsData->NavNext(true, "itb_seo_")) {
    $row =& $lAdmin->AddRow($itb_seo_ID, $arRes);

    $arActions = [];
    $arActions[] = [
        "ICON"      => "edit",
        "DEFAULT"   => true,
        "TEXT"      => "Редактировать",
        "ACTION"    => $lAdmin->ActionRedirect("itb_seo_tag_edit.php?ID=".$itb_seo_ID)
    ];

    if ($sRight >= "W") {
        $arActions[] = [
            "ICON"      => "delete",
            "TEXT"      => "Удалить",
            "ACTION"    => "if(confirm('Вы уверены что хотите удалить элемент?')) ".$lAdmin->ActionDoGroup($itb_seo_ID, "delete")
        ];
    }

    $row->AddActions($arActions);
}

$lAdmin->AddGroupActionTable([
    "delete" => GetMessage("MAIN_ADMIN_LIST_DELETE")
]);

$aContext = [
    [
        "TEXT"  => "Добавить",
        "LINK"  => "itb_seo_tag_edit.php?lang=".LANG,
        "TITLE" => "Добавить тег",
        "ICON"  => "btn_new",
    ],
];
$lAdmin->AddAdminContextMenu($aContext);

$APPLICATION->SetTitle("СЕО теги");

$lAdmin->CheckListMode();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$oFilter = new CAdminFilter(
    $sTable . "_filter",
    ["TITLE", "URL", "ACTIVE"]
);
?>

<form name="find_form" method="get" action="<?=$APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td><b>URL страницы:</b></td>
        <td>
            <input type="text" size="25" name="find_url" value="<?=htmlspecialchars($find_url)?>" title="Поиск">
        </td>
    </tr>
    <?$oFilter->Buttons(["table_id" => $sTable, "url" => $APPLICATION->GetCurPage(), "form" => "find_form"]);?>
    <?$oFilter->End();?>
</form>

<?php
$lAdmin->DisplayList();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
