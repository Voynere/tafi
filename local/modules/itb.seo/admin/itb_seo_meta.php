<?php
use Bitrix\Main\Loader;
use Itb\Seo\Table\MetaTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

IncludeModuleLangFile(__FILE__);
Loader::includeModule('itb.seo');

$POST_RIGHT = $APPLICATION->GetGroupRight("itb.seo");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$sTableID = MetaTable::getTableName();

$oSort  = new CAdminSorting($sTableID, "ID", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);

$FilterArr = ["find"];
$lAdmin->InitFilter($FilterArr);

$filter = [];
if (!empty($find)) {
    $filter["%URL"] = $find;
}

// --- Редактирование строк ---
if($lAdmin->EditAction() && $POST_RIGHT=="W") {
    foreach($FIELDS as $ID => $arFields) {
        if(!$lAdmin->IsUpdated($ID)) continue;

        $res = MetaTable::update($ID, $arFields);
        if (!$res->isSuccess()) {
            $lAdmin->AddGroupError("Ошибка сохранения элемента: " . implode(', ', $res->getErrorMessages()), $ID);
        }
    }
}

// --- Групповые действия ---
if(($arID = $lAdmin->GroupAction()) && $POST_RIGHT=="W") {
    if($_REQUEST['action_target'] == 'selected') {
        $arID = [];
        $rsAll = MetaTable::getList([
            'select' => ['ID']
        ]);
        while ($ar = $rsAll->fetch()) {
            $arID[] = $ar['ID'];
        }
    }

    foreach($arID as $ID) {
        if(strlen($ID)<=0) continue;

        switch($_REQUEST['action']) {
            case "delete":
                $res = MetaTable::delete($ID);
                if (!$res->isSuccess()) {
                    $lAdmin->AddGroupError("Ошибка удаления: " . implode(', ', $res->getErrorMessages()), $ID);
                }
                break;
        }
    }
}

// --- Выборка ---
$rsData = MetaTable::getList([
    'filter' => $filter,
    'order'  => [$by => $order],
]);
$rsData = new CAdminResult($rsData, $sTableID);

$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint("Элементов"));

// --- Заголовки таблицы ---
$lAdmin->AddHeaders([
    ["id"=>"ID", "content"=>"ID", "sort"=>"ID", "align"=>"right", "default"=>true],
    ["id"=>"SUBDOMAIN", "content"=>"SUBDOMAIN", "sort"=>"SUBDOMAIN", "default"=>true],
    ["id"=>"URL", "content"=>"URL", "sort"=>"URL", "default"=>true],
    ["id"=>"TITLE", "content"=>"Title", "sort"=>"TITLE", "default"=>true],
    ["id"=>"DESCRIPTION", "content"=>"Description", "sort"=>"DESCRIPTION", "default"=>true],
    ["id"=>"KEYWORDS", "content"=>"Keywords", "sort"=>"KEYWORDS", "default"=>true],
    ["id"=>"H1", "content"=>"H1", "sort"=>"H1", "default"=>true],
]);

// --- Строки ---
while($arRes = $rsData->NavNext(true, "itb_seo_")) {
    $row =& $lAdmin->AddRow($itb_seo_ID, $arRes);

    $arActions = [
        [
            "ICON"    => "edit",
            "DEFAULT" => true,
            "TEXT"    => "Редактировать",
            "ACTION"  => $lAdmin->ActionRedirect("itb_seo_meta_edit.php?ID=".$itb_seo_ID)
        ]
    ];

    if ($POST_RIGHT>="W") {
        $arActions[] = [
            "ICON"  => "delete",
            "TEXT"  => "Удалить",
            "ACTION"=> "if(confirm('Удалить элемент?')) ".$lAdmin->ActionDoGroup($itb_seo_ID, "delete")
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
        "LINK"  => "itb_seo_meta_edit.php?lang=".LANG,
        "TITLE" => "Добавить тег",
        "ICON"  => "btn_new",
    ],
];
$lAdmin->AddAdminContextMenu($aContext);

$APPLICATION->SetTitle("SEO везде");
$lAdmin->CheckListMode();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

// Фильтр
$oFilter = new CAdminFilter(
    $sTableID."_filter",
    ["URL"]
);
?>
<form name="find_form" method="get" action="<?echo $APPLICATION->GetCurPage();?>">
    <?$oFilter->Begin();?>
    <tr>
        <td><b>URL страницы:</b></td>
        <td><input type="text" size="25" name="find" value="<?echo htmlspecialchars($find)?>" title="Поиск"></td>
    </tr>
    <?
    $oFilter->Buttons(["table_id"=>$sTableID, "url"=>$APPLICATION->GetCurPage(), "form"=>"find_form"]);
    $oFilter->End();
    ?>
</form>
<?
$lAdmin->DisplayList();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
