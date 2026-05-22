<?php
namespace Itb\Licencecheck;

use Bitrix\Main\Config\Option;

class Options
{
    /**
     * @return string
     */
    public static function getModuleId()
    {
        return 'itb.licencecheck';
    }

    /**
     * @return bool
     */
    public static function isEnabled()
    {
        return Option::get('main', 'update_devsrv', 'Y') === 'N';
    }
}