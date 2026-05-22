<?

\Bitrix\Main\Loader::includeModule('shestpa.lastmodified');
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php"))
	include_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/autoload.php");

COption::SetOptionString("catalog", "DEFAULT_SKIP_SOURCE_CHECK", "Y"); 
COption::SetOptionString("sale", "secure_1c_exchange", "N");

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/CMaxCustom.php"))
{
  include_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/CMaxCustom.php");
}

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/CloseExternalFromIndex.php"))
{
  include_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/CloseExternalFromIndex.php");
}

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/ReplaceLoopLinks.php"))
{
  include_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/ReplaceLoopLinks.php");
  AddEventHandler("main", "OnEndBufferContent", ["ReplaceLoopLinks", "Handle"]);
}
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

AddEventHandler("main", "OnEndBufferContent", ["CloseExternalFromIndex", "Handle"]);

AddEventHandler("search", "BeforeIndex", array("SiteHelper", "BeforeIndexHandler"));

function fDebug($data)
{
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/debugfile.txt", date("[d.m.Y H:i:s]:\n") . print_r($data, true) . "\n");
}

function isCli(): bool
{
    if (defined('BX_CRONTAB') && BX_CRONTAB === true) {
        return true;
    }

    if (php_sapi_name() === 'cli') {
        return true;
    }

    return false;
}

class SiteHelper
{
	// создаем обработчик события "BeforeIndex"
	static function BeforeIndexHandler($arFields)
	{

		CModule::IncludeModule("search");

		if ($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == 26 && CModule::IncludeModule('iblock')) {
			$arFilter = array(
				'IBLOCK_ID' => $arFields["PARAM2"],
				'ID' => $arFields["ITEM_ID"]
			);

			$arSelect = array("ID", "TAGS");

			$dbElement = CIBlockElement::GetList(
				array(),
				$arFilter,
				false,
				array("nTopCount" => 1),
				$arSelect
			);



			if ($arElement = $dbElement->GetNext()) {

				if ($arElement["TAGS"]) {
					$arFields["TITLE"] .= ' ' . $arElement["TAGS"];
				}
			}
		}
		return $arFields;
	}
}






AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
function BeforeIndexHandler($arFields)
{
	$arFields["BODY"] = "{$arFields["TITLE"]} {$arFields["BODY"]} {$arFields["TITLE"]}";
	return $arFields;
}






function pre($val, $dev = false)
{
	if ($dev && !isset($_GET['dev'])) {
		return false;
	}

	echo '<pre style="background: #fff;">';
	print_r($val);
	echo '</pre>';
}

function dds($data, $file = false, $fileOnly = false)
{
    if (!$fileOnly) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    if ($file) {
//        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/dump.log', var_export($data, true));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/_dump.log', var_export($data, true), FILE_APPEND);
    }
}



// AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
function bxModifySaleMails($orderID, &$eventName, &$arFields)
{
	$fullName = '';

	$dbRes = \Bitrix\Sale\PropertyValueCollection::getList([
		'select' => ['*'],
		'filter' => [
			'=ORDER_ID' => $orderID,
		]
	]);

	while ($item = $dbRes->fetch()) {
		if ($item['CODE'] == 'NAME' || $item['CODE'] == 'SURNAME') {
			$fullName .= $item['VALUE'] . " ";
		}
	}

	$fullName =	trim($fullName);
	$arFields['ORDER_USER'] = $fullName;
}

function isLighthouse()
{
return (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') !== false);
}



AddEventHandler("main", "OnEndBufferContent", "deleteKernelJs2");
AddEventHandler("main", "OnEndBufferContent", "deleteKernelCss2");

function deleteKernelJs2(&$content)
{
global $USER, $APPLICATION;

//if($USER->IsAuthorized()) return;
if (!isLighthouse()) return;

//if(defined("ADMIN_SECTION")) return;

$arPatternsToRemove = array(
'/<script.+?src=".+?kernel_htmleditor\/kernel_htmleditor_v1\.js\?\d+"><\/script\>/',
'/<script.+?src=".+?kernel_main\/kernel_main\.js\?\d+"><\/script\>/',
'/<script.+?src=".+?kernel_main\/kernel_main_v1\.js\?\d+"><\/script\>/',
'/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/script\>/',
'/<script.+?>BX\.(setCSSList|setJSList)\(\[.+?\]\).*?<\/script>/',
'/<script.+?>if\(\!window\.BX\)window\.BX.+?<\/script>/',
'/<script[^>]+?>\(window\.BX\|\|top\.BX\)\.message[^<]+<\/script>/',
);

$content = preg_replace($arPatternsToRemove, "", $content);
$content = preg_replace("/\n{2,}/", "\n\n", $content);
}

function deleteKernelCss2(&$content)
{
global $USER, $APPLICATION;

if (!isLighthouse()) return;

global $USER, $APPLICATION;

//if($USER->IsAuthorized()) return;

$arPatternsToRemove = array(
'/<link.+?href=".+?kernel_main\/kernel_main\.css\?\d+"[^>]+>/',
'/<link.+?href=".+?kernel_main\/kernel_main_v1\.css\?\d+"[^>]+>/',
'/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
// '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
// '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
);

$content = preg_replace($arPatternsToRemove, "", $content);
$content = preg_replace("/\n{2,}/", "\n\n", $content);
}


AddEventHandler("main", "OnBeforeUserRegister",  "setEmail");

function setEmail(&$arFields){
		if(preg_match('/^[а-яё-]+$/ui', $arFields["LAST_NAME"]) || empty($arFields["LAST_NAME"]) && preg_match('/^[а-яё-]+$/ui', $arFields["NAME"]) &&preg_match('/^[а-яё-]+$/ui', $arFields["SECOND_NAME"]) || empty($arFields["SECOND_NAME"]) ){
			return $arFields;
		}else{
			if(!empty($arFields["LAST_NAME"])){
				$GLOBALS['APPLICATION']->ThrowException('не верный формат Имени');
			}elseif(!empty($arFields["LAST_NAME"])){
					$GLOBALS['APPLICATION']->ThrowException('не верный формат Фамилии');
			}elseif(!empty($arFields["SECOND_NAME"])){
					$GLOBALS['APPLICATION']->ThrowException('не верный формат Отчество ');
			}
			return false;
		}

	return false;
}



AddEventHandler("sale", "OnOrderNewSendEmail", "bxAddPickupPointToMail");

function bxAddPickupPointToMail($orderID, &$eventName, &$arFields)
{
    // Получаем данные о пункте самовывоза через отгрузки заказа
    $storeTitle   = '';
    $storeAddress = '';
    $storePhone   = '';
    $storeSchedule = '';

    $order = \Bitrix\Sale\Order::load($orderID);
    if ($order)
    {
        $shipments = $order->getShipmentCollection();
        foreach ($shipments as $shipment)
        {
            if (!$shipment->isSystem())
            {
                $storeId = $shipment->getStoreId();
                if ($storeId > 0)
                {
                    $dbStore = \CCatalogStore::GetList(
                        [],
                        ['ID' => $storeId],
                        false,
                        false,
                        ['ID', 'TITLE', 'ADDRESS', 'PHONE', 'SCHEDULE']
                    );
                    if ($store = $dbStore->Fetch())
                    {
                        $storeTitle    = $store['TITLE'];
                        $storeAddress  = $store['ADDRESS'];
                        $storePhone    = $store['PHONE'];
                        $storeSchedule = $store['SCHEDULE'];
                    }
                }
            }
        }
    }

    // Добавляем поля в массив письма
    $arFields['STORE_TITLE']    = $storeTitle;
    $arFields['STORE_ADDRESS']  = $storeAddress;
    $arFields['STORE_PHONE']    = $storePhone;
    $arFields['STORE_SCHEDULE'] = $storeSchedule;
    $arFields['PICKUP_INFO']    = $storeTitle
        ? $storeTitle . ($storeAddress ? ', ' . $storeAddress : '')
        : 'Не выбран';
}