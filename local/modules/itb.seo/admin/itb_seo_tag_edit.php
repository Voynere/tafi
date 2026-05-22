<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/include.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/prolog.php");

use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Itb\Seo\Table\TagGroupTable;
use Itb\Seo\Table\TagsTable;
use Itb\Seo\Table\TagTable;
use Itb\Seo\Table\TagToGroupTable;

global $APPLICATION;

Loader::includeModule('itb.seo');
$arRequest  = HttpApplication::getInstance()->getContext()->getRequest();
$sModuleId  = htmlspecialchars($arRequest['mid'] != '' ? $arRequest['mid'] : $arRequest['id']);
$sRight     = $APPLICATION->GetGroupRight($sModuleId);

$ID                 = intval($ID);
$sTable             = "b_itb_seo_tag";
$sTableTags         = "b_itb_seo_tags";
$sTableTagGroups    = "b_itb_seo_tag_group";
$sTableTagToGroup   = "b_itb_seo_tag_to_group";

if ($sRight == "D") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$connection = Bitrix\Main\Application::getConnection();

$aTabs = [[
        "DIV"   => "edit1",
        "TAB"   => "Общие",
        "ICON"  => "main_user_edit",
        "TITLE" => "Форма добавление тегов"
]];
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if ($REQUEST_METHOD == "POST" && ($save != "" || $apply != "") && $sRight == "W" && check_bitrix_sessid()) {
    $res = true;

    $arFields = [
        "TITLE"  => trim($TITLE),
        "URL"    => trim($URL),
        "ACTIVE" => !empty($ACTIVE) ? 'Y' : 'N',
    ];

    if ($ID > 0) {
        $result = TagTable::update($ID, $arFields);
        if (!$result->isSuccess()) {
            $res = false;
        }
    } else {
        $result = TagTable::add($arFields);
        if ($result->isSuccess()) {
            $ID = $result->getId();
        } else {
            $res = false;
        }
    }

    if ($res) {
        // очистка старых связей
        $rsTags = TagsTable::getList(['filter' => ['TAG_ID' => $ID]]);
        while ($tag = $rsTags->fetch()) {
            TagsTable::delete($tag['ID']);
        }
        $rsGroups = TagGroupTable::getList([
            'filter' => ['TAG_TO_GROUP.TAG_ID' => $ID]
        ]);
        while ($group = $rsGroups->fetch()) {
            TagGroupTable::delete($group['ID']);
        }
        $rsRel = TagToGroupTable::getList(['filter' => ['TAG_ID' => $ID]]);
        while ($rel = $rsRel->fetch()) {
            TagToGroupTable::delete($rel['ID']);
        }

        // новые группы и теги
        foreach ($GROUPS as $group) {
            if (!empty($group['tags'])) {
                // создаём группу
                $resultGroup = TagGroupTable::add([
                    'TITLE' => trim($group['TITLE'])
                ]);
                if ($resultGroup->isSuccess()) {
                    $groupId = $resultGroup->getId();

                    // связь тег-группа
                    TagToGroupTable::add([
                        'GROUP_ID' => $groupId,
                        'TAG_ID'   => $ID
                    ]);

                    // сабтеги
                    foreach ($group['tags'] as $subtag) {
                        if (!empty($subtag['TITLE'])) {
                            TagsTable::add([
                                'TITLE'    => trim($subtag['TITLE']),
                                'URL'      => trim($subtag['URL']),
                                'TAG_ID'   => $ID,
                                'GROUP_ID' => $groupId
                            ]);
                        }
                    }
                }
            }
        }
    }

    if ($res) {
        if ($apply != "")
            LocalRedirect("/bitrix/admin/itb_seo_tag_edit.php?ID=" . $ID . "&mess=ok&lang=" . LANG . "&" . $tabControl->ActiveTabParam());
        else
            LocalRedirect("/bitrix/admin/itb_seo_tag.php?lang=" . LANG);
    } else {
        if ($e = $APPLICATION->GetException())
            $message = new CAdminMessage("Ошибка сохранения элемента", $e);
        $bVarsFromForm = true;
    }
}

$arFields = [
    'TITLE'     => '',
    'URL'       => '',
    'ACTIVE'    => 'Y'
];

if ($ID > 0) {
    $record = TagTable::getByPrimary($ID)->fetch();
    if ($record) {
        $arFields = $record;
        $groups = [];

        $rsGroups = TagGroupTable::getList([
            'filter' => ['TAG_TO_GROUP.TAG_ID' => $ID],
            'select' => ['ID', 'TITLE']
        ]);
        while ($group = $rsGroups->fetch()) {
            $rsSubtags = TagsTable::getList([
                'filter' => ['GROUP_ID' => $group['ID'], 'TAG_ID' => $ID],
                'select' => ['ID', 'TITLE', 'URL']
            ]);
            $group['tags'] = $rsSubtags->fetchAll();
            $groups[] = $group;
        }
    } else {
        $ID = 0;
    }
}


$APPLICATION->SetTitle(($ID > 0 ? "Редактирование записи: " . $ID : "Добавление записи"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$aMenu = array(
    array(
        "TEXT"  => "Список тегов",
        "TITLE" => "Список тегов",
        "LINK"  => "itb_seo_tag.php?lang=" . LANG,
        "ICON"  => "btn_list",
    )
);

if ($ID > 0) {
    $aMenu[] = array("SEPARATOR" => "Y");
    $aMenu[] = array(
        "TEXT"  => "Добавить элемент",
        "TITLE" => "Добавить элемент",
        "LINK"  => "itb_seo_tag.php?lang=" . LANG,
        "ICON"  => "btn_new",
    );
    $aMenu[] = array(
        "TEXT"  => "Удалить элемент",
        "TITLE" => "Удалить элемент",
        "LINK"  => "javascript:if(confirm('" . "Вы уверены что хостите удалить элемент?" . "'))window.location='itb_seo_tag.php?ID=" . $ID . "&action=delete&lang=" . LANG . "&" . bitrix_sessid_get() . "';",
        "ICON"  => "btn_delete",
    );
}

$context = new CAdminContextMenu($aMenu);

$context->Show();

if ($_REQUEST["mess"] == "ok" && $ID > 0)
    CAdminMessage::ShowMessage(array("MESSAGE" => "Тег сохранен", "TYPE" => "OK"));
?>

    <form method="POST" Action="<?php echo $APPLICATION->GetCurPage() ?>" ENCTYPE="multipart/form-data"
          name="post_form">
        <?= bitrix_sessid_post() ?>
        <?php $tabControl->Begin(); ?>
        <?php $tabControl->BeginNextTab(); ?>
        <tr>
            <td>Title</td>
            <td><input type="text" name="TITLE" value="<?php echo $arFields['TITLE']; ?>" size="50"></td>
        </tr>
        <tr>
            <td>URL</td>
            <td><input type="text" name="URL" value="<?php echo $arFields['URL']; ?>" size="50"></td>
        </tr>
        <tr>
            <td>Активность</td>
            <td><input type="checkbox" name="ACTIVE" value="Y"
                    <?php if (!empty($arFields['ACTIVE']) && ($arFields['ACTIVE'] == true || $arFields['ACTIVE'] == 'Y')) echo 'checked' ?>>
            </td>
        </tr>
        <?php foreach ($groups as $group) { ?>
            <tr class="itb_seo_group" data-group="<?= $group['ID'] ?>" data-tags="0">
                <td colspan="2">
                    <table>
                        <tbody>
                        <tr><td colspan="2" class="itb_seo_group_start"></td></tr>
                        <tr>
                            <td class="adm-detail-content-cell-l" width="15%">Заголовок группы</td>
                            <td width="85%">
                                <input type="text" name="GROUPS[<?= $group['ID'] ?>][TITLE]"
                                       value="<?= $group['TITLE'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button" class="remove_itb_seo_group adm-btn-delete" value="Удалить группу">
                            </td>
                        </tr>
                        <?php foreach ($group['tags'] as $subtag) { ?>
                            <tr class="itb_seo_subtag">
                                <td colspan="2">
                                    <table>
                                        <tbody>
                                        <tr><td colspan="2" class="itb_seo_subtag_start"></td></tr>
                                        <tr>
                                            <td class="adm-detail-content-cell-l">Заголовок тэга</td>
                                            <td><input type="hidden" value="<?= $subtag['ID'] ?>"
                                                       name="GROUPS[<?= $group['ID'] ?>][tags][<?= $subtag['ID'] ?>][ID]">
                                                <input type="text" value="<?= $subtag['TITLE'] ?>"
                                                       name="GROUPS[<?= $group['ID'] ?>][tags][<?= $subtag['ID'] ?>][TITLE]">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="adm-detail-content-cell-l">URL</td>
                                            <td><input type="text" value="<?= $subtag['URL'] ?>"
                                                       name="GROUPS[<?= $group['ID'] ?>][tags][<?= $subtag['ID'] ?>][URL]">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%"></td>
                                            <td width="80%">
                                                <input type="button" class="remove_itb_seo_tag adm-btn-delete" value="Удалить тэг">
                                            </td>
                                        </tr>
                                        <tr><td colspan="2" class="itb_seo_subtag_end"></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button" class="add_itb_seo_tag adm-btn-save" value="Добавить тэг">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="itb_seo_group_end"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td width="15%"></td>
            <td width="85%">
                <input type="button" class="add_itb_seo_group adm-btn-save" value="Добавить группу">
            </td>
        </tr>
        <?php
        $tabControl->Buttons(
            array(
                "disabled" => ($sRight < "W"),
                "back_url" => "itb_seo_tag.php?lang=" . LANG,
            )
        );
        ?>

        <input type="hidden" name="lang" value="<?= LANG ?>">
        <?php if ($ID > 0 && !$bCopy): ?>
            <input type="hidden" name="ID" value="<?= $ID ?>">
        <?php endif; ?>
        <?php $tabControl->End(); ?>
        <?php $tabControl->ShowWarnings("post_form", $message); ?>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            var new_groups_count = 0;
            $('.add_itb_seo_group').on('click', function () {
                let $parent_row = $(this).parent().parent();
                let template = `<tr class="itb_seo_group new" data-group="new-${new_groups_count}" data-tags="0">
                                <td colspan="2">
                                    <table>
                                        <tbody>
                                            <tr><td colspan="2" class="itb_seo_group_start"></td></tr>
                                            <tr>
                                                <td class="adm-detail-content-cell-l" width="15%">Заголовок группы</td>
                                                <td width="85%">
                                                    <input type="text" name="GROUPS[new-${new_groups_count}][TITLE]">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="button" class="remove_itb_seo_group adm-btn-delete" value="Удалить группу"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input type="button" class="add_itb_seo_tag adm-btn-save" value="Добавить тэг"></td>
                                            </tr>
                                            <tr><td colspan="2" class="itb_seo_group_end"></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>`;
                $parent_row.before(template);
                new_groups_count++;
            });
            $('body').delegate('.add_itb_seo_tag', 'click', function () {
                let $parent_row = $(this).parent().parent(),
                    group_id    = $(this).parents('.itb_seo_group').data('group'),
                    tag_id      = $(this).parents('.itb_seo_group').data('tags'),
                    template    = `<tr class="itb_seo_subtag new">
                                <td colspan="2">
                                    <table>
                                        <tbody>
                                            <tr><td colspan="2" class="itb_seo_subtag_start"></td></tr>
                                            <tr>
                                                <td class="adm-detail-content-cell-l">Заголовок тэга</td>
                                                <td><input type="text" name="GROUPS[${group_id}][tags][${tag_id}][TITLE]"></td>
                                            </tr>
                                            <tr>
                                                <td class="adm-detail-content-cell-l">URL</td>
                                                <td><input type="text" name="GROUPS[${group_id}][tags][${tag_id}][URL]"></td>
                                            </tr>
                                            <tr>
                                                <td width="20%"></td>
                                                <td width="80%">
                                                    <input type="button" class="remove_itb_seo_tag adm-btn-delete"
                                                        value="Удалить тэг">
                                                </td>
                                            </tr>
                                            <tr><td colspan="2" class="itb_seo_subtag_end"></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>`;
                $parent_row.before(template);
                tag_id++;
                $(this).parents('.itb_seo_group').data('tags', tag_id);
            });
            $('body').delegate('.remove_itb_seo_tag', 'click', function () {
                $(this).parents('.itb_seo_subtag').remove();
            });
            $('body').delegate('.remove_itb_seo_group', 'click', function () {
                $(this).parents('.itb_seo_group').remove();
            });
        })
    </script>
    <style>
        .itb_seo_group table {
            min-width: 100%;
            border-spacing: 0;
        }
        .itb_seo_group table td{
            padding: 2px;
        }
        .itb_seo_group_start, .itb_seo_group_end{
            padding: 0;
            height: 10px;
            background-color: #f5f9f9;
        }
    </style>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");