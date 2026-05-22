<?php

namespace Itb\Licencecheck;

class LicenceCheckHelper
{
    /**
     * Получить данные лицензии Битрикса для уведомления
     * @return array|null
     */
    public static function getBitrixLicenceData()
    {
        static $cachedData = null;
        if ($cachedData !== null) {
            return $cachedData;
        }

        $documentRoot = getDocumentRoot();
        $file = $documentRoot . '/bitrix/modules/main/classes/general/update_client_partner.php';
        if (!file_exists($file)) {
            return null;
        }
        require_once $file;

        $errorMessage = '';
        $arUpdateList = \CUpdateClientPartner::GetUpdatesList(
            $errorMessage,
            LANGUAGE_ID ?: 'ru',
            'Y',
            []
        );

        if (!$arUpdateList || empty($arUpdateList['CLIENT'][0]['@'])) {
            return null;
        }

        $clientData = $arUpdateList['CLIENT'][0]['@'];

        $date = null;
        if (isset($clientData['DATE_TO_SOURCE']) && $clientData['DATE_TO_SOURCE'] !== '') {
            $date = $clientData['DATE_TO_SOURCE'];
        } elseif (isset($clientData['DATE_TO']) && $clientData['DATE_TO'] !== '') {
            $date = $clientData['DATE_TO'];
        }

        if (!$date) {
            return null;
        }

        $timestamp = \MakeTimeStamp($date);
        if (!$timestamp) {
            $timestamp = strtotime($date);
        }
        $timestamp = $timestamp ? intval($timestamp) : null;
        if (!$timestamp) {
            return null;
        }

        $clientName = static::extractClientName($clientData, $arUpdateList);

        $cachedData = [
            'expires_at' => $timestamp,
            'client_name' => $clientName,
        ];

        return $cachedData;
    }

    /**
     * Получить timestamp даты окончания лицензии Битрикса
     * @return int|null
     */
    public static function getBitrixLicenceExpireTimestamp()
    {
        $data = static::getBitrixLicenceData();
        if (!$data || empty($data['expires_at'])) {
            return null;
        }

        return intval($data['expires_at']);
    }

    /**
     * @param array $clientData
     * @param array $arUpdateList
     * @return string
     */
    protected static function extractClientName($clientData, $arUpdateList)
    {
        $candidateKeys = ['CLIENT_NAME', 'NAME', 'COMPANY_NAME', 'CLIENT', 'TITLE'];
        foreach ($candidateKeys as $key) {
            if (isset($clientData[$key]) && trim($clientData[$key]) !== '') {
                return trim($clientData[$key]);
            }
        }

        if (!empty($arUpdateList['CLIENT'][0]['#']) && is_array($arUpdateList['CLIENT'][0]['#'])) {
            $clientNode = $arUpdateList['CLIENT'][0]['#'];
            foreach ($candidateKeys as $key) {
                if (empty($clientNode[$key][0])) {
                    continue;
                }

                $nodeValue = '';
                if (isset($clientNode[$key][0]['#'])) {
                    $nodeValue = $clientNode[$key][0]['#'];
                } elseif (is_string($clientNode[$key][0])) {
                    $nodeValue = $clientNode[$key][0];
                }

                if (trim($nodeValue) !== '') {
                    return trim($nodeValue);
                }
            }
        }

        return '';
    }
}
