<?php

namespace Itb;

use Bitrix\Currency\CurrencyManager;
use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Sale;
use CBitrixComponent;
use Bitrix\Catalog\Product\Basket;

Loader::includeModule('sale');
Loader::includeModule('iblock');

class BasketUpdate extends CBitrixComponent implements Controllerable
{
    private $basket;
    private $currency;
    protected $data = [];
    protected $errors = [];
    protected $message = '';

    /**
     * @param $error
     */
    protected function addError($error)
    {
        if ($error instanceof \Error) {
            $this->errors[] = [
                'code' => $error->getCode(),
                'message' => $error->getMessage(),
            ];
        } else {
            $this->errors[] = [
                'code' => '',
                'message' => $error
            ];
        }
    }


    protected function addErrors(array $errors)
    {
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }

    protected function setData($data)
    {
        $this->data = array_replace_recursive($this->data, $data);
    }

    protected function setMessage($message)
    {
        $this->message = $message;
    }

    protected function showResult()
    {
        return [
            'success' => empty($this->errors),
            'errors'  => $this->errors,
            'data'    => $this->data,
            'message' => $this->message
        ];

    }


    public function configureActions()
    {
        return [
            'basketUpdate' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'refreshBasketAjax' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'clearBasketAll' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'addDelay' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'deleteDelay' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'getDelayedItems' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'getBasketItems' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
            'deleteBasketItem' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ]
            ],
        ];
    }


    /**
     * @param $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams)
    {

        return $arParams;
    }


    public function executeComponent()
    {
        $this->initBasket();
        $this->IncludeComponentTemplate();
    }


    protected function initBasket(){

        $this->basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), SITE_ID);
        $this->currency = CurrencyManager::getBaseCurrency();
        $this->arResult['BASKET'] = $this->basket;

    }


    public function refreshBasketAjaxAction(){

        $this->initBasket();

        return [
            'items'  => $this->arResult['ITEMS'],
            'price'  => $this->arResult['BASKET']->getPrice()
        ];
    }

    public function clearBasketAllAction(){

        $this->initBasket();

        $basketItems = $this->basket->getBasketItems();
        foreach ($basketItems as $basketItem) {
            $basketItem->delete();
        }

        $this->basket->save();

        return [
            'success'  => true
        ];
    }

    protected function getBasket(){

        if(!$this->basket){
            $siteID = Context::getCurrent()->getSite();
            $this->basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $siteID);
        }

        return $this->basket;

    }

    protected function getItemByParams($paramsRequest){

        $result = [];
        $item = false;

        $arItemParams = array();

        if(isset($paramsRequest["PROPS"]) && !empty($paramsRequest["PROPS"])){
            $arItemParamsBefore = unserialize(base64_decode(strtr($paramsRequest["PROPS"], "-_,", "+/=")));
            foreach($arItemParamsBefore as $arProp){
                $arItemParams[] = $arProp;
            }
        }


        if(isset($paramsRequest["SELECT_PROPS"]) && !empty($paramsRequest["SELECT_PROPS"])){
            $select_props = explode("||", $paramsRequest["SELECT_PROPS"]);
            foreach($select_props as $arSelProp) {
                $arItemParams[] = unserialize(base64_decode(strtr($arSelProp, "-_,", "+/=")));
            }
        }

        if($paramsRequest['BASKET_ITEM_ID']) {

            $item = $this->basket->getItemById($paramsRequest['BASKET_ITEM_ID']);

        }else{

            $iterator = \CIBlockElement::GetList(
                array(),
                array('ID' => $paramsRequest['ID']),
                false,
                false,
                array(
                    "ID",
                    "IBLOCK_ID",
                    "XML_ID",
                    "NAME",
                    "DETAIL_PAGE_URL",
                )
            );

            if (!($elementFields = $iterator->GetNext()))
            {
                $this->addError(new Main\Error('Товар не найден'));
                return false;
            }

            $iBlockXmlID = (string)\CIBlock::GetArrayByID($elementFields['IBLOCK_ID'], 'XML_ID');

            $arItemParams[] = array(
                'NAME' => 'Catalog XML_ID',
                'CODE' => 'CATALOG.XML_ID',
                'VALUE' => $iBlockXmlID
            );

            $arItemParams[] = array(
                'NAME' => 'Product XML_ID',
                'CODE' => 'PRODUCT.XML_ID',
                'VALUE' => $elementFields['~XML_ID']
            );

            $items = $this->basket->getExistsItems('catalog', $paramsRequest['ID'] ,$arItemParams);


            if ($items) {

                $item = current($items);

            }
            else {

                $item =  $this->basket->createItem('catalog', $paramsRequest['ID']);

                $item->setFields(array(
                    'NAME' => $elementFields['NAME'],
                    'CURRENCY' => CurrencyManager::getBaseCurrency(),
                    'LID' => Context::getCurrent()->getSite(),
                    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
                ));

                $collection = $item->getPropertyCollection();

                if($arItemParams){
                    $collection->redefine($arItemParams);
                }

            }

        }


        return $item;

    }


    public function getDelayedItemsAction(){
        $basket = $this->getBasket();
        $items = [];
        foreach ($basket as $item) {
            if($item->isDelay()){
                $items[] = $item->getProductId();
            }
        }

        $this->setData(

            [
                'count' => count($items),
                'items' => $items
            ]

        );

        return $this->showResult();

    }

    public function getBasketItemsAction(){
        $basket = $this->getBasket();
        $items = [];
        foreach ($basket as $item) {
            if(!$item->isDelay()){
                $items[] = $item->getProductId();
            }
        }

        $this->setData(

            [
                'count' => count($items),
                'items' => $items
            ]

        );

        return $this->showResult();

    }


    public function basketUpdateAction()
    {

        $this->getBasket();
        $this->currency = CurrencyManager::getBaseCurrency();
        $paramsRequest = $this->request->getPostList()->toArray();

        $quantity = floatval($paramsRequest["quantity"]);
        $item = $this->getItemByParams($paramsRequest);

        $basketAdd = false;

        if(isset($paramsRequest["ADD_QUANTITY"]) && $paramsRequest["ADD_QUANTITY"] == 1){
            $basketAdd = true;
        }

        if($basketAdd && $quantity == 0){
            $quantity = 1;
        }

        if(!$item->isDelay()){
            $quantity = $quantity > 1 ? $quantity : $item->getQuantity() + $quantity;
        }

        $quantity = $quantity > 0 ? $quantity : 1;
        $item->setField('QUANTITY', $quantity);


        $this->setData(['quantity' => $quantity]);
        $item->setField('DELAY', 'N');

        return $this->basketSave();
    }

    public function addDelayAction(){

        $this->getBasket();
        $this->currency = CurrencyManager::getBaseCurrency();
        $paramsRequest = $this->request->getPostList()->toArray();

        $item = $this->getItemByParams($paramsRequest);
        $item->setField('QUANTITY', 1);
        $item->setField('DELAY', 'Y');
        $this->setMessage('Товар добавлен в избранное');

        return $this->delaySave();
    }

    public function deleteDelayAction(){

        $this->getBasket();
        $this->currency = CurrencyManager::getBaseCurrency();
        $paramsRequest = $this->request->getPostList()->toArray();

        $item = $this->getItemByParams($paramsRequest);

        if($item){
            $item->delete();
            $this->setMessage('Товар удален из отложенных');
        }

        return $this->delaySave();
    }

    public function deleteBasketItemAction(){

        $this->getBasket();

        $paramsRequest = $this->request->getPostList()->toArray();

        $item = $this->basket->getItemById($paramsRequest['BASKET_ITEM_ID']);

        if($item){
            $item->delete();
            $this->setMessage('Товар удален из корзины');
        }else{
            $this->addError('Не удалось удалить товар');
        }

        return $this->basketSave();
    }

    protected function basketSave()
    {
        $result = $this->basket->save();

        if ($result->isSuccess()) {
            $this->setData(['count' => $this->basket->count()]);
            $this->setMessage('Товар добавлен');
        } else {
            $this->addError('Возникла ошибка при добавлении товара');
            //var_dump($result->getErrorMessages());
            //$this->addError($result->getErrorMessages());
        }
        return $this->showResult();
    }

    protected function delaySave()
    {
        $result = $this->basket->save();

        if ($result->isSuccess()) {
            $this->setData(['count' => $this->basket->count()]);
        } else {
            $this->addError('Возникла ошибка при изменение избранного');
        }
        return $this->showResult();
    }

}