<?

use Bitrix\Main\Localization\Loc;

use Bitrix\Main\ModuleManager;

use Bitrix\Main\Config\Option;

use Bitrix\Main\Application;

use \Bitrix\Main\Entity\Base;

use \Bitrix\Main\Loader;

use \Bitrix\Main\EventManager;

Loc::loadMessages(__FILE__);

class itb_import extends CModule
{
    public $MODULE_ID;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;
    public $SHOW_SUPER_ADMIN_GROUP_RIGHTS;
    public $MODULE_GROUP_RIGHTS;

    function __construct()
    {
        $arModuleVersion = array();
        include_once(__DIR__ . '/version.php');

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_ID = "itb.import";
        $this->MODULE_NAME = "выгрузка из exel ";
        $this->MODULE_DESCRIPTION = "выгрузка из exel";
        $this->PARTNER_NAME = "itbImport";
        $this->PARTNER_URI = "11111";
        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = 'Y';
        $this->MODULE_GROUP_RIGHTS = 'Y';
    }

    function DoInstall()
    {
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        global $APPLICATION;
        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(
                Loc::getMessage('INSTALL_TITLE_STEP_1'),
                __DIR__ . '/instalInfo-step1.php'
            );
        }
        if ($request["step"] == 2) {
            $this->InstallFiles();
            ModuleManager::RegisterModule("itb.import");
            $APPLICATION->IncludeAdminFile(
                Loc::getMessage('INSTALL_TITLE_STEP_2'),
                __DIR__ . '/instalInfo-step2.php'
            );
        }

        return true;
    }

    function DoUninstall()
    {
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        global $APPLICATION;
        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(
                Loc::getMessage('DEINSTALL_TITLE_1'),
                __DIR__ . '/deInstalInfo-step1.php'
            );
        }
        if ($request["step"] == 2) {
            $this->UnInstallFiles();

            Option::delete($this->MODULE_ID);
            ModuleManager::UnRegisterModule("itb.import");
            $APPLICATION->IncludeAdminFile(
                Loc::getMessage('DEINSTALL_TITLE_2'),
                __DIR__ . '/deInstalInfo-step2.php'
            );
        }

        return true;
    }


    function InstallFiles()
    {
        CopyDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin",
            true, true);
    }

    function UnInstallFiles()
    {
        DeleteDirFiles(
            __DIR__ . "/admin",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin"
        );
    }

}
