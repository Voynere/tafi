<?php
namespace Itb\Licencecheck;

use Bitrix\Main\Config\Option;

class LicenceCheckAgent
{
    protected static function sendLicenseDate()
    {
        if(!Options::isEnabled()) {
            return true;
        }
        $module = Options::getModuleId();

        $licenceData = LicenceCheckHelper::getBitrixLicenceData();
        if (!$licenceData || empty($licenceData['expires_at'])) {
            return false;
        }

        $timestamp = intval($licenceData['expires_at']);
        $clientName = isset($licenceData['client_name']) ? $licenceData['client_name'] : '';

        $stored = intval(Option::get($module, 'notified_timestamp', '0'));
        if ($stored === intval($timestamp)) {
            return true;
        }

        $result = BitrixLicenceNotifier::sendLicenseDate($timestamp, $clientName);
        if ($result !== false) {
            Option::set($module, 'notified_timestamp', $timestamp);
        }
        return $result !== false;
    }

    public static function exec()
    {
        $result = static::sendLicenseDate();
        if ($result === false) {
            \AddMessage2Log(date('Y-m-d H:i:s') . ' - LicenceCheckAgent: failed to send license date', Options::getModuleId());
        }
        return '\\'.__METHOD__.'();';
    }
}