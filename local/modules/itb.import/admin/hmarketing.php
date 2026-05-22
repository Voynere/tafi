<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

use \Bitrix\Main\Loader;
use Bitrix\Main\HttpApplication;
use Itb\Import\ProductImport as ProductImport;

global $APPLICATION;

IncludeModuleLangFile(__FILE__);

$module_id = "itb.import";
$APPLICATION->GetGroupRight($module_id);
Loader::includeModule($module_id);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';

$request = HttpApplication::getInstance()->getContext()->getRequest();
$options = \Bitrix\Main\Config\Option::getForModule($module_id);
$options = array_change_key_case($options, CASE_UPPER);
CJSCore::Init(array("jquery"));
$text = "";

if ($_REQUEST["generator"] == "Y") 
{
    $file_SAVE = new ProductImport\GneratorImportFile($_SERVER['DOCUMENT_ROOT'] . '/itb.import/elems.log', $_SERVER["DOCUMENT_ROOT"] . $options["ITB_FILE_EXEL"]);
    $text = $file_SAVE->fileGenerator($options, "ITB_PARAMS_") - 1;
} 
elseif ($_REQUEST["generatorProduct"] == "Y") 
{
    $product = new ProductImport\Productimport($_SERVER["DOCUMENT_ROOT"] . "/itb.import/elems.log", $options);
    $productArray = $product->productsSwitcher();
}
?>

<div class="mecc"></div>
<a class="adm-btn-save" href="?generator=Y">с генирировать фаил выгрузки товаров</a><br><br>
<a class="adm-btn-save" href="?generatorProduct=Y">создание товаров</a><br><br>

<?php
if ($_REQUEST["generator"] == "Y") 
{
    echo $text . " сгенирированно элементов";
    setcookie("COUNT_IMPORT_PRODUCT", $text);
}

if (empty($_COOKIE["COUNT_IMPORT_PRODUCT"]))
{
    $_COOKIE["COUNT_IMPORT_PRODUCT"] = 1;
}

if ( 
    ($_REQUEST["generatorProduct"] == "Y"  || $_REQUEST["generator"] == "Y") 
    && $_COOKIE["COUNT_IMPORT_PRODUCT"] != $productArray["COUNT"]["SUM"] 
    && round((($_COOKIE["COUNT_IMPORT_PRODUCT"] - $productArray["COUNT"]["SUM"]) / $_COOKIE["COUNT_IMPORT_PRODUCT"]) * 100, 2) != 100
) 
{
  if($_COOKIE["COUNT_IMPORT_PRODUCT"] > 50)
    {
    ?>
    <div id="skills">
        <p>процесс загрузки</p>
        <?= round((($_COOKIE["COUNT_IMPORT_PRODUCT"] - $productArray["COUNT"]["SUM"]) / $_COOKIE["COUNT_IMPORT_PRODUCT"]) * 100, 2) ?>
        % из 100%
        <div class="value">
            <div class="value-box"
                 style="width: <?= round((($_COOKIE["COUNT_IMPORT_PRODUCT"] - $productArray["COUNT"]["SUM"]) / $_COOKIE["COUNT_IMPORT_PRODUCT"]) * 100, 2) ?>%;"
            >
            </div>
        </div>
    </div>
    <?php
  }
  else
  {
      echo "займет пару минут, не закрывайте вкладку ";
  }

    header("Refresh: 0");
} 
elseif (round((($_COOKIE["COUNT_IMPORT_PRODUCT"] - $productArray["COUNT"]["SUM"]) / $_COOKIE["COUNT_IMPORT_PRODUCT"]) * 100, 2) === 100) 
{
    echo "импорт завершён";
}
?>
<style>
    .value,
    progress {
        width: 100%;
        height: 10px;
        background: #ddd;
        margin-bottom: 20px;
    }

    .value-box {
        height: 10px;
        background: #36c36e;
    }
</style>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';
?>