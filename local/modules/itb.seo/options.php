<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialchars($request['mid'] != '' ? $request['mid'] : $request['id']);
$POST_RIGHT = $APPLICATION->GetGroupRight($module_id);

Loader::includeModule($module_id);

if($POST_RIGHT >= "R") :

    IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/options.php");
    IncludeModuleLangFile(__FILE__);

    CModule::IncludeModule('iblock');
    CModule::IncludeModule('catalog');

    $aTabs = array(
        array("DIV" => "edit1", "TAB" => "Основные", "ICON" => "sender_settings", "TITLE" => "Настройки модуля"),
    );
    $tabControl = new CAdminTabControl("tabControl", $aTabs);

    if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && $POST_RIGHT=="W" && check_bitrix_sessid()) {

        if($CATALOG_FILE && !$FILTER_NAME) {
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . $CATALOG_FILE)) {
                $sFile = file_get_contents($_SERVER["DOCUMENT_ROOT"] . $CATALOG_FILE);
                preg_match_all('/"FILTER_NAME"[\s|]+=>[\s|]+"([a-zA-Z0-9]+)"/', $sFile, $arOut);

                if(isset($arOut[1]) && $arOut[1][0]) {
                    $FILTER_NAME = $arOut[1][0];
                } else {
                    $FILTER_NAME = $FILTER_NAME ? $FILTER_NAME : "arrFilter";
                }
            }
        }

        if($IBLOCK_ID && !$FILTER_CATEGORY) {
            $rsIBLOCK = CIBlock::GetByID($IBLOCK_ID);
            if($arIBlock = $rsIBLOCK->GetNext()) {
                $FILTER_CATEGORY = $arIBlock['SECTION_PAGE_URL'];
            }
        }

        if($FILTER_CATEGORY) {
            $FILTER_CATEGORY = preg_replace("/\#SITE_DIR\#/", "", $FILTER_CATEGORY);
        }

        COption::SetOptionString($module_id, "CATALOG_FILE", $CATALOG_FILE);
        COption::SetOptionString($module_id, "FILTER_NAME", $FILTER_NAME);
        COption::SetOptionString($module_id, "FILTER_CATEGORY", $FILTER_CATEGORY);
        COption::SetOptionString($module_id, "IBLOCK_ID", $IBLOCK_ID);
        COption::SetOptionString($module_id, "FILTER_HEAD", $FILTER_HEAD);
        COption::SetOptionString($module_id, "FILTER_TITLE", $FILTER_TITLE);
        COption::SetOptionString($module_id, "FILTER_DESCRIPTION", $FILTER_DESCRIPTION);


        if(strlen($_REQUEST["back_url_settings"]) > 0) {
            if((strlen($Apply) > 0) || (strlen($RestoreDefaults) > 0))
                LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
            else
                LocalRedirect($_REQUEST["back_url_settings"]);
        } else {
            LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&".$tabControl->ActiveTabParam());
        }
    }
    $CATALOG_FILE = COption::GetOptionString($module_id, "CATALOG_FILE");
    $FILTER_NAME = COption::GetOptionString($module_id, "FILTER_NAME");
    $FILTER_CATEGORY = COption::GetOptionString($module_id, "FILTER_CATEGORY");
    $IBLOCK_ID = COption::GetOptionString($module_id, "IBLOCK_ID");
    $FILTER_HEAD = COption::GetOptionString($module_id, "FILTER_HEAD");
    $FILTER_TITLE = COption::GetOptionString($module_id, "FILTER_TITLE");
    $FILTER_DESCRIPTION = COption::GetOptionString($module_id, "FILTER_DESCRIPTION");
    ?>
    <script type="text/javascript">
        var focus_textarea;

        function insertTextAtCursor(myValue) {
            var myField = focus_textarea;

            //IE support
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
            }
            //MOZILLA and others
            else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                myField.value = myField.value.substring(0, startPos)
                    + myValue
                    + myField.value.substring(endPos, myField.value.length);
            } else {
                myField.value += myValue;
            }

            myField.focus();
        }
    </script>
    <form method="post" name="bseo_form" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($module_id)?>&amp;lang=<?=LANGUAGE_ID?>">

        <?
        $tabControl->Begin();
        $tabControl->BeginNextTab();
        ?>

        <? ?>
        <tr>
            <td colspan="2">
                <h3>Общие настройки</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Код компонента тегов для вставки на страницу</label>
                <?
                $code = '<?$APPLICATION->IncludeComponent("itb:seo.tags", "", Array(), false);?>';
                ?>
                <textarea style="width: 100%; height: 40px; resize: none; background: none; border: 0; opacity: 1; box-shadow: none; color: #000;" disabled><?= $code?></textarea>
            </td>
        </tr>
        <tr>
            <td valign="top" width="40%">

            </td>
            <td valign="top" width="60%">

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3>Настройки генерации мета для фильтра</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td valign="top" width="40%">Инфоблок каталога</td>
            <td valign="top" width="60%">
                <select name="IBLOCK_ID">
                    <option value="">- Укажите инфоблок -</option>
                    <?
                    $rsIBlocks = CIBlock::GetList(array('ID' => 'ASC'));
                    while ($arIBlock = $rsIBlocks->Fetch()) {
                        ?>
                        <option value="<? echo htmlspecialcharsbx($arIBlock['ID']); ?>"<? echo ($arIBlock['ID'] == $IBLOCK_ID ? ' selected' : ''); ?>><? echo htmlspecialcharsex($arIBlock["NAME"]); ?> [<? echo htmlspecialcharsex($arIBlock['ID']); ?>]</option>
                        <?
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Глобальный массив с фильтром<br/> (arrFilter)</td>
            <td>
                <input type="text" size="60" name="FILTER_NAME" value="<?= $FILTER_NAME ?>">
            </td>
        </tr>
        <tr>
            <td> ЧПУ шаблон категории<br/> (/catalog/#SECTION_CODE#/)</td>
            <td>
                <input type="text" size="60" name="FILTER_CATEGORY" value="<?= $FILTER_CATEGORY ?>"><br/>
            </td>
        </tr>
        <tr>
            <td width="40%">
                Файл с каталогом
            </td>
            <td width="60%">


                <input type="text" placeholder="Укажите файл для поиска" name="CATALOG_FILE" value="<?= $CATALOG_FILE ?>">
                <input type="button" value="Выбрать файл" onclick="cmlBtnSelectClick();">
                <?
                CAdminFileDialog::ShowScript(
                    array(
                        "event" => "cmlBtnSelectClick",
                        "arResultDest" => array("FORM_NAME" => "bseo_form", "FORM_ELEMENT_NAME" => "CATALOG_FILE"),
                        "arPath" => array("PATH" => "/", "SITE" => SITE_ID),
                        "select" => 'F',// F - file only, D - folder only, DF - files & dirs
                        "operation" => 'O',// O - open, S - save
                        "showUploadTab" => false,
                        "showAddToMenuTab" => false,
                        "fileFilter" => 'php',
                        "allowAllFiles" => true,
                        "SaveConfig" => true
                    )
                );
                ?>
            </td>
        </tr>

        <tr>
            <td width="40%">Шаблон H1 для фильтра</td>
            <td width="60%">
                <textarea onfocus="focus_textarea = this;" rows="3" cols="62" name="FILTER_HEAD"><?= $FILTER_HEAD ?></textarea>
            </td>
        </tr>
        <tr>
            <td width="40%">Шаблон Title для фильтра</td>
            <td width="60%">
                <textarea onfocus="focus_textarea = this;" rows="3" cols="62" name="FILTER_TITLE"><?= $FILTER_TITLE ?></textarea>
            </td>
        </tr>

        <tr>
            <td width="40%">Шаблон Description для фильтра</td>
            <td width="60%">
                <textarea onfocus="focus_textarea = this;" rows="3" cols="62" name="FILTER_DESCRIPTION"><?= $FILTER_DESCRIPTION ?></textarea>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <?
                if($IBLOCK_ID) :
                    $rsIBlock = CIBlock::GetByID($IBLOCK_ID);
                    if($arIBlock = $rsIBlock->GetNext()) {

                        $rsProps = CIBlock::GetProperties($IBLOCK_ID);
                        $arPropsMain = Array();
                        while ($arProp = $rsProps->GetNext()) {
                            $arPropsMain[] = $arProp;
                        }

                        $arPropsOffer = Array();
                        if(class_exists('CCatalogSKU')) {
                            $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
                            if ($arInfo) {
                                $IBLOCK_SKU_ID = $arInfo['IBLOCK_ID'];

                                $rsProps = CIBlock::GetProperties($IBLOCK_SKU_ID);
                                while ($arProp = $rsProps->GetNext()) {
                                    $arPropsOffer[] = $arProp;
                                }
                            }
                        }

                        if($arPropsMain || $arPropsOffer) {
                            ?>
                            <hr>
                            <input style="margin-bottom: 5px;" onclick="insertTextAtCursor('{CATEGORY}'); return false;" type="button" class="insert-to-text" value="Название категории"/>
                            <? if($arPropsMain) : ?>
                                <h3>Свойства инфоблока</h3>
                                <?
                                foreach ($arPropsMain as $arProp) {
                                    if ($arProp['PROPERTY_TYPE'] == "S" || $arProp['PROPERTY_TYPE'] == "L" || $arProp['PROPERTY_TYPE'] == "E") {
                                        ?>
                                        <input style="margin-bottom: 5px;" onclick="insertTextAtCursor('{<?= $arProp["ID"] . "." . $arProp["CODE"] ?>}'); return false;" type="button" class="insert-to-text" value="<?= $arProp["NAME"] ?> {<?= $arProp["ID"] . "." . $arProp["CODE"] ?>}"/>
                                        <?
                                    }
                                }
                                ?>
                                <hr>
                            <? endif; ?>
                            <? if($arPropsOffer) : ?>
                                <h3>Свойства товарных предложений</h3>
                                <?
                                foreach ($arPropsOffer as $arProp) {
                                    if ($arProp['PROPERTY_TYPE'] == "S" || $arProp['PROPERTY_TYPE'] == "L" || $arProp['PROPERTY_TYPE'] == "E") {
                                        ?>
                                        <input style="margin-bottom: 5px;" onclick="insertTextAtCursor('{<?= $arProp["ID"] . "." . $arProp["CODE"] ?>}'); return false;" type="button" class="insert-to-text" value="<?= $arProp["NAME"] ?> {<?= $arProp["ID"] . "." . $arProp["CODE"] ?>}"/>
                                        <?
                                    }
                                }
                            endif;
                            ?>
                            <p>
                                Примеры вариантов свойств: <br/>
                                <b>{префикс|PROPERTY|постфикс!-параметр#сообщение когда параметр пуст}</b> <br/>
                                <b>{префикс|PROPERTY|постфикс!-параметр}</b> <br/>
                                <b>{префикс|PROPERTY|постфикс}</b> <br/>
                                <b>{префикс|PROPERTY!-параметр}</b> <br/>
                                <b>{PROPERTY!-параметр}</b> <br/>
                                <b>{PROPERTY|постфикс!-параметр}</b> <br/>
                                <b>{PROPERTY}</b> <br/>
                            </p>
                            <p>
                                Параметры свойств (можно указывать несколько): <br/>
                                <b>-C</b> Первая буква верхнего регистра <br/>
                                <b>-L</b> К нижнему регистру <br/>
                                <b>-PG</b> Родительный падеж <br/>
                                <b>-PD</b> Дательный падеж <br/>
                                <b>-PAC</b> Винительный падеж <br/>
                                <b>-PAB</b> Творительный падеж <br/>
                                <b>-PP</b> Предложеный падеж <br/>
                                <b>-N</b> Вместо значения подставляется названия свойства <br/>
                            </p>
                            <p>
                                Примеры: <br/>

                                <b>{2.MATERIAL!-C-PG}</b> - Первая буква заглавная слова в родительном падеже: <b>Трикотажа, шелка</b> <br/>
                                <b>{2.MATERIAL!-L-PP}</b> - Все буквы маленькие слова в предложном падеже: <b>трикотаже, шелке</b> <br/>
                                <b>{качественные материалые: |2.MATERIAL!-L}</b> - Все буквы маленькие слова c префиксом "качественные материалые: ": <b>качественные материалые: трикотаж, шелк</b> <br/>
                                <b>{2.MATERIAL|, такие материалы только у нас!-L}</b> - Все буквы маленькие слова c постфиксом "качественные материалые: ": <b>трикотаж, шелк, такие материалы только у нас</b> <br/>
                            </p>

                            <?
                        }
                    }
                endif;
                ?>
            </td>
        </tr>

        <?$tabControl->Buttons();?>
        <input <?if ($POST_RIGHT<"W") echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
        <input <?if ($POST_RIGHT<"W") echo "disabled" ?> type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
        <?if(strlen($_REQUEST["back_url_settings"])>0):?>
            <input <?if ($POST_RIGHT<"W") echo "disabled" ?> type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
            <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
        <?endif?>
        <?=bitrix_sessid_post();?>
        <?$tabControl->End();?>

    </form>
<?

endif;