<?php

namespace Itb\Licencecheck;

use Bitrix\Main\Config\Option;

class BitrixLicenceNotifier
{
    protected const API_URL = 'https://itb-company.com/api/bitrix/licenses/expired-notify';
    protected const HEADERS = [
        'Content-Type: application/json',
        'Accept: application/json',
    ];

    /**
     * Отправляет данные о завершении лицензии на внешний API через cURL.
     *
     * @param int $expiresAt Timestamp окончания лицензии
     * @param string $clientName Название клиента из XML обновлений
     * @return array|false Возвращает декодированный JSON-ответ или false при ошибке
     */
    public static function sendLicenseDate($expiresAt, $clientName = '')
    {
        if (!$expiresAt) {
            $msg = date('Y-m-d H:i:s') . ' - BitrixLicenceNotifier: license timestamp is null or invalid';
            \AddMessage2Log($msg, Options::getModuleId());
            return false;
        }

        $domain = static::resolveDomain();
        $payload = json_encode([
            'expires_at' => intval($expiresAt),
            'domain' => $domain,
            'client_name' => $clientName,
        ], JSON_UNESCAPED_UNICODE);

        if ($payload === false) {
            $msg = date('Y-m-d H:i:s') . ' - BitrixLicenceNotifier: failed to encode payload';
            \AddMessage2Log($msg, Options::getModuleId());
            return false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, static::API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, static::HEADERS);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (PHP_VERSION_ID >= 80000) {
            unset($ch);
        } else {
            curl_close($ch);
        }

        if ($errno || $httpCode < 200 || $httpCode >= 300) {
            $msg = sprintf('%s - BitrixLicenceNotifier: curl error=%s http=%s response=%s', date('Y-m-d H:i:s'), $error, $httpCode, $response);
            \AddMessage2Log($msg, Options::getModuleId());
            return false;
        }

        $decoded = json_decode($response, true);
        return $decoded !== null ? $decoded : ['raw' => $response];
    }

    /**
     * Текущий домен: из SERVER_NAME/HTTP_HOST, для cron fallback на main.server_name.
     *
     * @return string
     */
    protected static function resolveDomain()
    {
        $domain = '';

        if (!empty($_SERVER['HTTP_HOST'])) {
            $domain = $_SERVER['HTTP_HOST'];
        } elseif (!empty($_SERVER['SERVER_NAME'])) {
            $domain = $_SERVER['SERVER_NAME'];
        }

        if (empty($domain)) {
            $domain = Option::get('main', 'server_name', '');
        }

        $domain = preg_replace('#^https?://#i', '', trim($domain));
        $domain = preg_replace('#/.*$#', '', $domain);

        return trim($domain);
    }
}
