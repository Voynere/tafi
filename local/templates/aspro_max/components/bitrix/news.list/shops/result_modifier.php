<?php

if($arResult['ITEMS']){
    foreach($arResult['ITEMS'] as $key_item => $arItem)
    {
        CMax::getFieldImageData($arItem, array('PREVIEW_PICTURE'));
        if($arItem['PREVIEW_PICTURE'])
            $bHasImg = true;
        if($arItem['PROPERTIES'])
        {
            foreach($arItem['PROPERTIES'] as $key_prop => $arProperty)
            {
                if($arProperty["USER_TYPE"]=="directory" && isset($arProperty["USER_TYPE_SETTINGS"]["TABLE_NAME"])) // get values from highload
                {
                    $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=TABLE_NAME'=>$arProperty["USER_TYPE_SETTINGS"]["TABLE_NAME"])));
                    if ($arData = $rsData->fetch()){
                        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
                        $entityDataClass = $entity->getDataClass();
                        $arFilter = array(
                            'filter' => array(
                                '=UF_XML_ID' => $arProperty["VALUE"]
                            )
                        );
                        $rsValues = $entityDataClass::getList($arFilter);
                        while($arValue = $rsValues->fetch())
                        {
                            $arResult['ITEMS'][$key_item]['PROPERTIES'][$key_prop]['FORMAT'][] = $arValue;
                        }
                    }
                }
            }
        }
    }

}


?>


<?$this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, array('ID', 'IBLOCK_SECTION_ID', 'ITEMS'));?>