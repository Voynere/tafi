<?php

namespace Itb\Import\FormGenerator;

class OtionsGenerate
{
    public static $module_id;
    public function __construct($module_id)
    {
        self::$module_id = $module_id;

    }
    public function getOptionsPropertys($setingsModule){
        $getOptionsPropertyImport =[];
        foreach ($setingsModule as $key => $setings){
            if(empty($setings) || $setings === null || $setings === 0){
                continue ;
            }
            if(strpos($key,"itb_PROP_IBLOCK_")!==false){
              if(is_array(explode(",",$setings)) && count(explode(",",$setings))>1 ){
                  foreach (explode(",",$setings) as $key_count => $value){
                      $getOptionsPropertyImport[$key."_LIST_".$key_count+1] = $value - 1 ;
                  }
              }else{
                  $getOptionsPropertyImport[$key] = $setings-1;
              }
            }elseif (strpos($key,"itb_SECTION_IBLOCK_")!==false){
                $getOptionsPropertyImport[$key] = $setings-1;

            }elseif (strpos($key,"NAME")!==false || strpos($key,"PRICE")!==false || strpos($key,"DESCRIPTION")!==false || $key == "PATH"){
                $getOptionsPropertyImport[$key] = $setings-1;
            }

        }
        return $getOptionsPropertyImport;
    }

    public function writeToCSV($import, $name)
    {
        $fp = fopen($name, 'w');
        if (count($import) == 0)
            return;
        $keys = [];
        foreach ($import[0] as $key => $value) {
            $keys[] = $key;
        }
        fputcsv($fp, $keys, "|");
        foreach ($import as $fields) {
            fputcsv($fp, $fields, "|");
        }
        fclose($fp);
    }
    public function readFromCSV($name)
    {
        $result = [];
        if (($handle = fopen($name, "r")) !== FALSE) {
            $keys = fgetcsv($handle, 10000, "|");

            while (($data = fgetcsv($handle, 10000, "|")) !== FALSE) {
                $item = [];
                foreach ($keys as $index => $nameKey) {
                    $item[$nameKey] = $data[$index];
                }

                $result[] = $item;
            }
            fclose($handle);
        }
        return $result;
    }

    public function showProperties()
    {
        $properties = \Bitrix\Iblock\PropertyTable::getList([
            'select' => ['*'],
            'filter' => ['=IBLOCK_ID' => self::$IblockId, 'ACTIVE' => "Y"],
        ]);

        $propertyAll = [];

        while ($property = $properties->fetch()) {
            $propertyAll[] = $property;
        }
        return $propertyAll;
    }
    public function showParentSection()
    {
        $rsSection = \Bitrix\Iblock\SectionTable::getList(array(
            'filter' => array(
                'IBLOCK_ID' => self::$IblockId,
                'DEPTH_LEVEL' => 1,
            ),
            'select' =>  array('NAME','ID'),
        ));

        $arSections = [];
        while ($arSection=$rsSection->fetch())
        {
            $arSections[] = $arSection;
        }
        return $arSections;
    }
    public function InputGenerator($Option)
    {
        $arControllerOption = \CControllerClient::GetInstalledOptions(self::$module_id);
        if ($Option === null) {
            return;
        }

        if (!is_array($Option)):
            ?>
            <tr class="heading">
                <td colspan="2"><?= $Option ?></td>
            </tr>
        <?
        elseif (isset($Option["note"])):
            ?>
            <tr>
                <td colspan="2" align="center">
                    <? echo BeginNote('align="center"'); ?>
                    <?= $Option["note"] ?>
                    <? echo EndNote(); ?>
                </td>
            </tr>
        <?
        else:
            $isChoiceSites = array_key_exists(6, $Option) && $Option[6] == "Y" ? true : false;
            $listSite = array();
            $listSiteValue = array();
            if ($Option[0] != "") {
                if ($isChoiceSites) {
                    $queryObject = \Bitrix\Main\SiteTable::getList(array(
                        "select" => array("LID", "NAME"),
                        "filter" => array(),
                        "order" => array("SORT" => "ASC"),
                    ));
                    $listSite[""] = GetMessage("MAIN_ADMIN_SITE_DEFAULT_VALUE_SELECT");
                    $listSite["all"] = GetMessage("MAIN_ADMIN_SITE_ALL_SELECT");
                    while ($site = $queryObject->fetch()) {
                        $listSite[$site["LID"]] = $site["NAME"];
                        $val = \COption::GetOptionString(self::$module_id, $Option[0], $Option[2], $site["LID"], true);
                        if ($val)
                            $listSiteValue[$Option[0] . "_" . $site["LID"]] = $val;
                    }
                    $val = "";
                    if (empty($listSiteValue)) {
                        $value = \COption::GetOptionString(self::$module_id, $Option[0], $Option[2]);
                        if ($value)
                            $listSiteValue = array($Option[0] . "_all" => $value);
                        else
                            $listSiteValue[$Option[0]] = "";
                    }

                } else {
                    $val = \COption::GetOptionString(self::$module_id, $Option[0], $Option[2]);
                }
            } else {
                $val = $Option[2];
            }
            if ($isChoiceSites):?>
                <tr>
                    <td colspan="2" style="text-align: center!important;">
                        <label><?= $Option[1] ?></label>
                    </td>
                </tr>
            <?endif; ?>
            <? if ($isChoiceSites):
            foreach ($listSiteValue as $fieldName => $fieldValue):?>
                <tr>
                    <?
                    $siteValue = str_replace($Option[0] . "_", "", $fieldName);
                    $this->renderLable($Option, $listSite, $siteValue);
                    $this->renderInput($Option, $arControllerOption, $fieldName, $fieldValue);
                    ?>
                </tr>
            <?endforeach; ?>
        <? else:?>
            <tr>
                <?
                $this->renderLable($Option, $listSite);
                $this->renderInput($Option, $arControllerOption, $Option[0], $val);
                ?>
            </tr>
        <?endif; ?>
            <? if ($isChoiceSites): ?>
            <tr>
                <td width="50%">
                    <a href="javascript:void(0)" onclick="addSiteSelector(this)" class="bx-action-href">
                        <?= GetMessage("MAIN_ADMIN_ADD_SITE_SELECTOR") ?>
                    </a>
                </td>
                <td width="50%"></td>
            </tr>
        <? endif; ?>
        <?
        endif;
    }


    private function renderInput($Option, $arControllerOption, $fieldName, $val)
    {
        $type = $Option[3];
        $disabled = array_key_exists(4, $Option) && $Option[4] == 'Y' ? ' disabled' : '';
        ?>
        <td width="50%"><?
        if ($type[0] == "checkbox"):
            ?><input
            type="checkbox" <? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?>
            id="<? echo htmlspecialcharsbx($Option[0]) ?>" name="<?= htmlspecialcharsbx($fieldName) ?>"
            value="Y"<? if ($val == "Y") echo " checked"; ?><?= $disabled ?><? if ($type[2] <> '') echo " " . $type[2] ?>><?
        elseif ($type[0] == "text" || $type[0] == "password"):
            ?>
            <input type="<? echo $type[0] ?>"<? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?>
            size="<? echo $type[1] ?>" maxlength="255"
            value="<? echo htmlspecialcharsbx($val) ?>" name="<?= htmlspecialcharsbx($fieldName) ?>"<?= $disabled ?><?= ($type[0] == "password" || $type["noautocomplete"] ? ' autocomplete="new-password"' : '') ?>><?
        elseif ($type[0] == "file"):
            ?>
            <span> <?=!empty($val)?"загружен":"не загружен" ?></span>
            <input type="<? echo $type[0] ?>"
            <? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?>
            size="<? echo $type[1] ?>" accept=""
            value="<? echo htmlspecialcharsbx($val) ?>" name="<?= htmlspecialcharsbx($fieldName) ?>"<?= $disabled ?>><?
        elseif ($type[0] == "selectbox"):
            $arr = $type[1];
            if (!is_array($arr))
                $arr = array();
            ?><select
            name="<?= htmlspecialcharsbx($fieldName) ?>" <? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?> <?= $disabled ?>><?
            foreach ($arr as $key => $v):
                ?>
                <option value="<? echo $key ?>"<? if ($val == $key) echo " selected" ?>><? echo htmlspecialcharsbx($v) ?></option><?
            endforeach;
            ?></select><?
        elseif ($type[0] == "multiselectbox"):
            $arr = $type[1];
            if (!is_array($arr))
                $arr = array();
            $arr_val = explode(",", $val);
            ?><select
            size="5" <? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?>
            multiple name="<?= htmlspecialcharsbx($fieldName) ?>[]"<?= $disabled ?>><?
            foreach ($arr as $key => $v):
                ?>
                <option value="<? echo $key ?>"<? if (in_array($key, $arr_val)) echo " selected" ?>><? echo htmlspecialcharsbx($v) ?></option><?
            endforeach;
            ?></select><?
        elseif ($type[0] == "textarea"):
            ?>
            <textarea <? if (isset($arControllerOption[$Option[0]])) echo ' disabled title="' . GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT") . '"'; ?>
            rows="<? echo $type[1] ?>"
            cols="<? echo $type[2] ?>" name="<?= htmlspecialcharsbx($fieldName) ?>"<?= $disabled ?>><? echo htmlspecialcharsbx($val) ?></textarea><?
        elseif ($type[0] == "statictext"):
            echo htmlspecialcharsbx($val);
        elseif ($type[0] == "statichtml"):
            echo $val;
        endif; ?>
        </td><?
    }


    private function renderLable($Option, array $listSite, $siteValue = "")
    {
        $type = $Option[3];
        $sup_text = array_key_exists(5, $Option) ? $Option[5] : '';
        $isChoiceSites = array_key_exists(6, $Option) && $Option[6] == "Y" ? true : false;
        ?>
        <? if ($isChoiceSites): ?>
        <script type="text/javascript">
            function changeSite(el, fieldName) {
                var tr = jsUtils.FindParentObject(el, "tr");
                var sel = null, tagNames = ["select", "input", "textarea"];
                for (var i = 0; i < tagNames.length; i++) {
                    sel = jsUtils.FindChildObject(tr.cells[1], tagNames[i]);
                    if (sel) {
                        sel.name = fieldName + "_" + el.value;
                        break;
                    }

                }
            }

            function addSiteSelector(a) {
                var row = jsUtils.FindParentObject(a, "tr");
                var tbl = row.parentNode;
                var tableRow = tbl.rows[row.rowIndex - 1].cloneNode(true);
                tbl.insertBefore(tableRow, row);
                var sel = jsUtils.FindChildObject(tableRow.cells[0], "select");
                sel.name = "";
                sel.selectedIndex = 0;
                sel = jsUtils.FindChildObject(tableRow.cells[1], "select");
                sel.name = "";
                sel.selectedIndex = 0;
            }
        </script>
        <td width="50%">
            <select onchange="changeSite(this, '<?= htmlspecialcharsbx($Option[0]) ?>')">
                <? foreach ($listSite as $lid => $siteName): ?>
                    <option <? if ($siteValue == $lid) echo "selected"; ?> value="<?= htmlspecialcharsbx($lid) ?>">
                        <?= htmlspecialcharsbx($siteName) ?>
                    </option>
                <?endforeach; ?>
            </select>
        </td>
    <? else:?>
        <td<? if ($type[0] == "multiselectbox" || $type[0] == "textarea" || $type[0] == "statictext" ||
            $type[0] == "statichtml") echo ' class="adm-detail-valign-top"' ?> width="50%"><?
            if ($type[0] == "checkbox")
                echo "<label for='" . htmlspecialcharsbx($Option[0]) . "'>" . $Option[1] . "</label>";
            else
                echo $Option[1];
            if ($sup_text <> '') {
                ?><span class="required"><sup><?= $sup_text ?></sup></span><?
            }
            ?><a name="opt_<?= htmlspecialcharsbx($Option[0]) ?>"></a></td>
    <?endif;
    }


}