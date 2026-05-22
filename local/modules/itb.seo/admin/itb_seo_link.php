<?php
use Bitrix\Main\Loader;
use Itb\Seo\Table\LinkTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loader::includeModule("itb.seo");

IncludeModuleLangFile(__FILE__);

$POST_RIGHT = $APPLICATION->GetGroupRight("itb.seo");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$sTableID = LinkTable::getTableName();

$oSort = new CAdminSorting($sTableID, "ID", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);

$FilterArr = ["find"];
$lAdmin->InitFilter($FilterArr);

function CheckFilter()
{
    global $FilterArr, $lAdmin;
    foreach ($FilterArr as $f) global $$f;

    return count($lAdmin->arFilterErrors) == 0;
}

// === Редактирование ===
if ($lAdmin->EditAction() && $POST_RIGHT=="W") {
    foreach ($FIELDS as $ID => $arFields) {
        if (!$lAdmin->IsUpdated($ID)) {
            continue;
        }

        $ID = (int)$ID;
        $result = LinkTable::update($ID, $arFields);

        if (!$result->isSuccess()) {
            $lAdmin->AddGroupError("Ошибка сохранения элемента: " . implode("; ", $result->getErrorMessages()), $ID);
        }
    }
}

// === Групповые действия ===
if (($arID = $lAdmin->GroupAction()) && $POST_RIGHT=="W") {
    if ($_REQUEST['action_target'] == 'selected') {
        $arID = [];
        $resAll = LinkTable::getList(['select' => ['ID']]);
        while ($row = $resAll->fetch()) {
            $arID[] = $row['ID'];
        }
    }

    foreach ($arID as $ID) {
        $ID = (int)$ID;
        if ($ID <= 0) {
            continue;
        }

        switch ($_REQUEST['action']) {
            case "delete":
                $result = LinkTable::delete($ID);
                if (!$result->isSuccess()) {
                    $lAdmin->AddGroupError("Ошибка удаления записи: " . implode("; ", $result->getErrorMessages()), $ID);
                }
                break;
        }
    }
}

// === Фильтр ===
$filter = [];
if (CheckFilter()) {
    if (!empty($find)) {
        $filter['%URL_OLD'] = $find;
    }
}

// === Получение данных через ORM ===
$resData = LinkTable::getList([
    'select' => ['ID', 'URL_OLD', 'URL_NEW'],
    'filter' => $filter,
    'order'  => [$by => $order],
]);

$rsData = new CAdminResult($resData, $sTableID);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Элементов"));

// === Заголовки ===
$lAdmin->AddHeaders([
    [
        "id"        => "ID",
        "content"   => "ID",
        "sort"      => "ID",
        "align"     => "right",
        "default"   => true,
    ],
    [
        "id"        => "URL_OLD",
        "content"   => "URL_OLD",
        "sort"      => "URL_OLD",
        "default"   => true,
    ],
    [
        "id"        => "URL_NEW",
        "content"   => "URL_NEW",
        "sort"      => "URL_NEW",
        "default"   => true,
    ]
]);

while ($arRes = $rsData->NavNext(true, "itb_seo_")) {
    $row =& $lAdmin->AddRow($itb_seo_ID, $arRes);

    $arActions = [];

    $arActions[] = [
        "ICON"      => "edit",
        "DEFAULT"   => true,
        "TEXT"      => "Редактировать",
        "ACTION"    => $lAdmin->ActionRedirect("itb_seo_link_edit.php?ID=" . $itb_seo_ID)
    ];

    if ($POST_RIGHT >= "W") {
        $arActions[] = [
            "ICON"      => "delete",
            "TEXT"      => "Удалить",
            "ACTION"    => "if(confirm('Вы уверены что хотите удалить элемент?')) " . $lAdmin->ActionDoGroup($itb_seo_ID, "delete")
        ];
    }

    $row->AddActions($arActions);
}

// === Групповые действия внизу ===
$lAdmin->AddGroupActionTable([
    "delete" => GetMessage("MAIN_ADMIN_LIST_DELETE")
]);

// === Контекстное меню ===
$aContext = [
    [
        "TEXT"  => "Добавить",
        "LINK"  => "itb_seo_link_edit.php?lang=" . LANG,
        "TITLE" => "Добавить ссылку",
        "ICON"  => "btn_new",
    ],
];

$lAdmin->AddAdminContextMenu($aContext);

$APPLICATION->SetTitle("SEO ссылки");

$lAdmin->CheckListMode();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$oFilter = new CAdminFilter(
    $sTableID."_filter",
    ["URL_OLD"]
);
?>

<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td><b>URL страницы:</b></td>
        <td>
            <input type="text" size="25" name="find" value="<?echo htmlspecialchars($find)?>" title="Поиск">
        </td>
    </tr>
    <?
    $oFilter->Buttons(["table_id" => $sTableID, "url" => $APPLICATION->GetCurPage(), "form" => "find_form"]);
    $oFilter->End();
    ?>
</form>

<?php
$lAdmin->DisplayList();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
