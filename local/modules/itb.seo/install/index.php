<?php

use Beeralex\Core\Service\FileService;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Itb\Seo\EventHandlers\Main;
use Itb\Seo\Table\LinkTable;
use Itb\Seo\Table\MetaTable;
use Itb\Seo\Table\TagGroupTable;
use Itb\Seo\Table\TagsTable;
use Itb\Seo\Table\TagTable;
use Itb\Seo\Table\TagToGroupTable;

Loc::loadMessages(__FILE__);

class itb_seo extends CModule
{
    public function __construct()
    {
        if (is_file(__DIR__ . '/version.php')) {
            include(__DIR__ . '/version.php');
            $this->MODULE_ID           = 'itb.seo';
            $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
            $this->MODULE_NAME         = Loc::getMessage('ITB_SEO_NAME');
            $this->MODULE_DESCRIPTION  = Loc::getMessage('ITB_SEO_DESCRIPTION');
            $this->PARTNER_NAME = 'Itb';
            $this->PARTNER_URI = 'https://itb-company.com/';
        } else {
            CAdminMessage::showMessage(
                Loc::getMessage('ITB_SEO_FILE_NOT_FOUND') . ' version.php'
            );
        }
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if ($this->checkRequirements()) {
            ModuleManager::registerModule($this->MODULE_ID);
            Loader::includeModule($this->MODULE_ID);
            $this->InstallFiles();
            $this->InstallDB();
            $this->InstallEvents();
        } else {
            CAdminMessage::showMessage(
                Loc::getMessage('ITB_SEO_INSTALL_ERROR')
            );
            return;
        }

        $APPLICATION->includeAdminFile(
            Loc::getMessage('ITB_SEO_INSTALL_TITLE') . ' «' . Loc::getMessage('ITB_SEO_NAME') . '»',
            __DIR__ . '/step.php'
        );
    }

    public function checkRequirements(): bool
    {
        return (version_compare(ModuleManager::getVersion('main'), '15.00.00') >= 0) && Loader::includeModule('beeralex.core');
    }

    public function InstallFiles()
    {
        $moduleDir = __DIR__;
        $sourceDir = $moduleDir . '/files';
        $targetDir = Application::getDocumentRoot();

        service(FileService::class)->copyRecursive($sourceDir, $targetDir);
    }

    public function InstallDB()
    {
        LinkTable::createTable();
        MetaTable::createTable();
        TagGroupTable::createTable();
        TagTable::createTable();
        TagsTable::createTable();
        TagToGroupTable::createTable();
    }

    public function InstallEvents()
    {
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnPageStart',
            $this->MODULE_ID,
            Main::class,
            'onPageStart'
        );
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnEndBufferContent',
            $this->MODULE_ID,
            Main::class,
            'onEndBufferContent'
        );
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnBeforeEndBufferContent',
            $this->MODULE_ID,
            Main::class,
            'onBeforeEndBufferContent'
        );
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        Loader::includeModule($this->MODULE_ID);

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->includeAdminFile(
            Loc::getMessage('ITB_SEO_UNINSTALL_TITLE') . ' «' . Loc::getMessage('ITB_SEO_NAME') . '»',
            __DIR__ . '/unstep.php'
        );
    }

    public function UnInstallDB()
    {
        LinkTable::dropTable();
        MetaTable::dropTable();
        TagGroupTable::dropTable();
        TagTable::dropTable();
        TagsTable::dropTable();
        TagToGroupTable::dropTable();
    }

    public function UnInstallFiles()
    {
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_link.php');
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_link_edit.php');
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_meta.php');
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_meta_edit.php');
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_tag.php');
        @unlink(Application::getDocumentRoot() . '/bitrix/admin/' . $this->MODULE_ID . '_tag_edit.php');

        DeleteDirFilesEx("/bitrix/components/" . $this->MODULE_ID);

        Option::delete($this->MODULE_ID);
    }

    public function UnInstallEvents()
    {
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnPageStart',
            $this->MODULE_ID,
            Main::class,
            'onPageStart'
        );
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnEndBufferContent',
            $this->MODULE_ID,
            Main::class,
            'onEndBufferContent'
        );
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnBeforeEndBufferContent',
            $this->MODULE_ID,
            Main::class,
            'onBeforeEndBufferContent'
        );
    }
}
