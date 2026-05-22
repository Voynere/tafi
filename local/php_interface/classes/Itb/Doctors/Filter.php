<?php

namespace Itb\Doctors;

class Filter {

    public $iblockId;

    public $filterInfo;

    public function __construct($iblockId)
    {
        if (!$iblockId) return;
        $this->iblockId = $iblockId;

        $this->getData();
    }

    public function getData()
    {
        $filterInfo = [];
        $cache = \Bitrix\Main\Data\Cache::createInstance();
        $cacheKey = md5(serialize(array('=NAME.LANGUAGE_ID' => LANGUAGE_ID, 'TYPE_CODE' => 'FILTER')));

        if ($cache->initCache(3600, $cacheKey, '/doctors_filter/')) 
        {
            $filterInfo = $cache->getVars();
        } 
        elseif ($cache->startDataCache()) 
        {
            $arSelect = [
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PROPERTY_PROP_POSITION',
                'PROPERTY_PROP_CATEGORY',
                'PROPERTY_PROP_ADDRESS'
            ];
            $arFilter = [
                'IBLOCK_ID' => $this->iblockId,
                'ACTIVE' => 'Y',
            ];
            $res = \CIBlockElement::GetList(
                ['PROPERTY_PROP_CATEGORY' => 'ASC'],
                $arFilter,
                false,
                false,
                $arSelect
            );

            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();

                if (!empty($arFields['PROPERTY_PROP_CATEGORY_VALUE']))
                {
                    foreach ($arFields['PROPERTY_PROP_CATEGORY_VALUE'] as $key => $item)
                    {
                        $filterInfo['CATEGORIES'][$key] = $item;
                    }
                }

                if (!empty($arProps['PROP_POSITION']['VALUE']))
                {
                    for($i = 0; $i <= count($arProps['PROP_POSITION']['VALUE']); $i++)
                    {
                        if ($arProps['PROP_POSITION']['VALUE_ENUM_ID'][$i] && $arProps['PROP_POSITION']['VALUE'][$i])
                        {
                            foreach ($arFields['PROPERTY_PROP_CATEGORY_VALUE'] as $key => $value)
                            {
                                $filterInfo['POSITIONS'][$key][$arProps['PROP_POSITION']['VALUE_ENUM_ID'][$i]] = $arProps['PROP_POSITION']['VALUE'][$i];
                            }
                        }
                    }
                }

                if (!empty($arProps['PROP_ADDRESS']['VALUE']))
                {
                    for($i = 0; $i <= count($arProps['PROP_ADDRESS']['VALUE']); $i++)
                    {
                        if ($arProps['PROP_ADDRESS']['VALUE_ENUM_ID'][$i] && $arProps['PROP_ADDRESS']['VALUE'][$i]) {
                            foreach ($arFields['PROPERTY_PROP_CATEGORY_VALUE'] as $key => $value)
                            {
                                $filterInfo['ADDRESSES'][$key][$arProps['PROP_ADDRESS']['VALUE_ENUM_ID'][$i]] = $arProps['PROP_ADDRESS']['VALUE'][$i];
                            }
                        }
                    }
                }
            }

            $cache->endDataCache($filterInfo);
        }
        
        $this->getResult($filterInfo);
    }

    public function getResult($filterInfo)
    {
        $result = [];

        foreach ($filterInfo['CATEGORIES'] as $key => $item)
        {
            $result[$key]['NAME'] = $item;
        }

        foreach ($filterInfo['POSITIONS'] as $key => $item)
        {
            $result[$key]['POSITIONS'] = $item;
        }

         foreach ($filterInfo['ADDRESSES'] as $key => $item)
        {
            $result[$key]['ADDRESSES'] = $item;
        }

        foreach($result as $key => &$resultItem)
        {
            $resultItem['POSITIONS'] = array_unique($resultItem['POSITIONS']);
            $resultItem['ADDRESSES'] = array_unique($resultItem['ADDRESSES']);
        }

        $this->filterInfo = $result;
        unset($filterInfo, $result);
    }

}

?>