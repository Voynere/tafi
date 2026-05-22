<?php

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

class itb_licencecheck extends CModule
{
    public function __construct()
    {
        include_once(__DIR__ . '/version.php');
        $this->MODULE_ID = 'itb.licencecheck';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'ITB Licence Check';
        $this->MODULE_DESCRIPTION = 'ITB Licence Check module';
        $this->PARTNER_NAME = 'ITB';
        $this->PARTNER_URI = '#';
    }

    public function DoInstall()
    {
        if ($this->checkRequirements()) {
            ModuleManager::registerModule($this->MODULE_ID);
            $this->installAgents();
            Loader::includeModule($this->MODULE_ID);
        } else {
            CAdminMessage::showMessage(
                'The module requires PHP 5.6.0 or higher and Bitrix version 14.00.00 or higher.'
            );
            return;
        }
    }

    public function DoUninstall()
    {
        Loader::includeModule($this->MODULE_ID);
        \CAgent::RemoveModuleAgents($this->MODULE_ID);
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installAgents()
    {
        \CAgent::AddAgent(
            '\\Itb\\Licencecheck\\LicenceCheckAgent::exec();',
            $this->MODULE_ID,
            'N',
            86400,
        );
    }

    /**
     * @return bool
     */
    public function checkRequirements()
    {
        if (version_compare(PHP_VERSION, '5.6.0', '<')) {
            return false;
        }
        return version_compare(ModuleManager::getVersion('main'), '14.00.00') >= 0;
    }
}
