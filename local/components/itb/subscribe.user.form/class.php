<?php

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use CBitrixComponent;



class ItbSubscribeUserForm extends CBitrixComponent implements Controllerable
{
   public function onPrepareComponentParams($params)
    {
        return $params;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    public function configureActions()
    {
        return [
            'updateSubscribe' => [
                'prefilters' => [],
            ],
        ];
    }


    public function updateSubscribeAction(){

        $paramsRequest = $this->request->getPostList()->toArray();

        if (!empty($paramsRequest['BOT_EMAIL'])) {
            die();
        }

        try {

            Loader::includeModule('subscribe');    

            $dbRes = CRubric::GetList(array('ID' => 'ASC'), array('LID' => SITE_ID, 'ACTIVE' => 'Y'));
            while($arRes = $dbRes->Fetch()){
                $arRubricsID[] = $arRes['ID'];
            }

            $arSubscription = CSubscription::GetList(array('ID' => 'ASC'), array('ACTIVE' => 'Y', 'EMAIL' => $paramsRequest['EMAIL']))->Fetch();

            $subscr = new CSubscription;
	
            if($arSubscription){
                $subscr->Update($arSubscription['ID'], array('EMAIL' => $paramsRequest['EMAIL'], 'RUB_ID' => $arRubricsID), SITE_ID);
            }
            else{
                $subscr->Add(array('EMAIL' => $paramsRequest['EMAIL'], 'RUB_ID' => $arRubricsID), SITE_ID);
            }    

            //throw new \Exception('Данную подписку нельзя продлить');

            return [
                'success' => true,
            ];
        }  catch (\Throwable $e) {

            return [
                'success' => false,
                'errors' => [$e->getMessage()]
            ];

        }

    }


    
}