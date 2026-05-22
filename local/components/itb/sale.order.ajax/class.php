<?php

use Bitrix\Main;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Controller\PhoneAuth;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;
use Bitrix\Sale;
use Bitrix\Sale\Delivery;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Location\GeoIp;
use Bitrix\Sale\Location\LocationTable;
use Bitrix\Sale\Order;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PaySystem;
use Bitrix\Sale\PersonType;
use Bitrix\Sale\Result;
use Bitrix\Sale\Services\Company;
use Bitrix\Sale\Shipment;
use Bitrix\Main\UserTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
  die();
}

CBitrixComponent::includeComponentClass('bitrix:sale.order.ajax');

class ItbSaleOrderAjax extends SaleOrderAjax
{
  /** id of order Name field */
  private const NAME = 22;
  /** id of order Last Name field */
  private const LAST_NAME = 21;
  /** id of order Second Name field */
  private const SECOND_NAME = 23;

  /**
   * Modified return to avoid PAYER result with one field, need three fields
   * @inheritdoc
   */
  public function generateUserData($userProps = []): array
  {
    $oldResult = parent::generateUserData($userProps);

    $allValues = $this->getPropertyValuesFromRequest();
    $FIO_fields = array_intersect_key($allValues, [
      self::NAME =>'', self::LAST_NAME=>'', self::SECOND_NAME=>''
    ]);

    $newName = $FIO_fields[self::NAME];
    $newLastName = $FIO_fields[self::LAST_NAME];
    $newSecondName = $FIO_fields[self::SECOND_NAME];

    $oldResult['NEW_NAME'] = $newName;
    $oldResult['NEW_LAST_NAME'] = $newLastName;
    $oldResult['NEW_SECOND_NAME'] = $newSecondName;

    return $oldResult;
  }
  /**
   * Modified return with SECOND_NAME field to create new USER
   * @inheritdoc
   */
  protected function registerAndLogIn($userProps)
  {
    $userId = false;
    $userData = $this->generateUserData($userProps);

    $fields = [
      'LOGIN' => $userData['NEW_LOGIN'],
      'NAME' => $userData['NEW_NAME'],
      'LAST_NAME' => $userData['NEW_LAST_NAME'],
      'SECOND_NAME' => $userData['NEW_SECOND_NAME'], // new key
      'PASSWORD' => $userData['NEW_PASSWORD'],
      'CONFIRM_PASSWORD' => $userData['NEW_PASSWORD_CONFIRM'],
      'EMAIL' => $userData['NEW_EMAIL'],
      'GROUP_ID' => $userData['GROUP_ID'],
      'ACTIVE' => 'Y',
      'LID' => $this->getSiteId(),
      'PERSONAL_PHONE' => isset($userProps['PHONE']) ? $this->getNormalizedPhone($userProps['PHONE']) : '',
      'PERSONAL_ZIP' => isset($userProps['ZIP']) ? $userProps['ZIP'] : '',
      'PERSONAL_STREET' => isset($userProps['ADDRESS']) ? $userProps['ADDRESS'] : '',
    ];

    if ($this->arResult['AUTH']['new_user_phone_auth'] === 'Y') {
      $fields['PHONE_NUMBER'] = isset($userProps['PHONE']) ? $userProps['PHONE'] : '';
    }

    if ($this->arParams['IS_LANDING_SHOP'] === 'Y') {
      $fields['GROUP_ID'] = \Bitrix\Crm\Order\BuyerGroup::getDefaultGroups();
      $fields['EXTERNAL_AUTH_ID'] = 'shop';

      // reset department for intranet
      $fields['UF_DEPARTMENT'] = [];

      // rewrite login with email
      if (!empty($userData['NEW_EMAIL'])) {
        $fields['LOGIN'] = $userData['NEW_EMAIL'];
      }
    }

    $user = new CUser;
    $addResult = $user->Add($fields);

    if (intval($addResult) <= 0) {
      $this->addError(Loc::getMessage('STOF_ERROR_REG') . (($user->LAST_ERROR <> '') ? ': ' . $user->LAST_ERROR : ''), self::AUTH_BLOCK);
    } else {
      global $USER;

      $userId = intval($addResult);
      $USER->Authorize($addResult);

      if ($USER->IsAuthorized()) {
        if ($this->arParams['SEND_NEW_USER_NOTIFY'] == 'Y') {
          if (
            isset($this->arParams['CONTEXT_SITE_ID']) &&
            $this->arParams['CONTEXT_SITE_ID'] > 0 &&
            Loader::includeModule('landing')
          ) {
            $componentName = 'bitrix:landing.pub';
            /** @var LandingPubComponent $className */
            $className = \CBitrixComponent::includeComponentClass($componentName);
            $className::replaceUrlInLetter(
              $this->arParams['CONTEXT_SITE_ID']
            );
          }
          CUser::SendUserInfo($USER->GetID(), $this->getSiteId(), Loc::getMessage('INFO_REQ'), true);
        }
      } else {
        $this->addError(Loc::getMessage('STOF_ERROR_REG_CONFIRM'), self::AUTH_BLOCK);
      }
    }

    return $userId;
  }
}
