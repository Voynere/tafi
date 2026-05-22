<?php

namespace Itb\Doctors;

class Alphabet
{
    /**
     * Contains russian letters
     * @var array
     */
    private $letters;
    /**
     * Contains IBlockId
     * @var mixed
     */
    private $iblockId;
     /**
     * Array with information about structure
     * @var array
     */
    private $doctorsInfo;

    public function __construct($iblockId)
    {
        if (empty($iblockId)) return;

        $this->iblockId = $iblockId;
        $this->getLetters();
        $this->getDoctorsInfo();
    }

    /**
     * Getting an array with RU letters
     * @return void
     */
    public function getLetters()
    {
        $abc = [];
        foreach (range(chr(0xC0), chr(0xDF)) as $b)
        {
            $abc[] = iconv('CP1251', 'UTF-8', $b);
        }
        $this->letters = array_fill_keys($abc, []);
    }

    /**
     * Getting information about doctor`s category and position
     * @return void
     */
    public function getDoctorsInfo()
    {
        $doctorsInfo = [];
        $cache = \Bitrix\Main\Data\Cache::createInstance();
        $cacheKey = md5(serialize(array('=NAME.LANGUAGE_ID' => LANGUAGE_ID, 'TYPE_CODE' => 'ALPHABET')));

        if ($cache->initCache(3600, $cacheKey, '/doctors_alphabet/')) 
        {
            $doctorsInfo = $cache->getVars();
        } 
        elseif ($cache->startDataCache()) 
        {
            $arSelect = [
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PROPERTY_PROP_POSITION',
                'PROPERTY_PROP_CATEGORY'
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

            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();

                if (!empty($arFields['PROPERTY_PROP_CATEGORY_VALUE']))
                {
                    foreach ($arFields['PROPERTY_PROP_CATEGORY_VALUE'] as $k => $item)
                    {
                        $doctorsInfo['CATEGORIES'][$k][] = $item;
                    }
                    if (!empty($arProps['PROP_POSITION']['VALUE']))
                    {
                        for($i = 0; $i <= count($arProps['PROP_POSITION']['VALUE']); $i++)
                        {
                            if ($arProps['PROP_POSITION']['VALUE_ENUM_ID'][$i] && $arProps['PROP_POSITION']['VALUE'][$i])
                            {
                                foreach ($arFields['PROPERTY_PROP_CATEGORY_VALUE'] as $key => $item)
                                {
                                    $doctorsInfo['POSITIONS'][$key][$arProps['PROP_POSITION']['VALUE_ENUM_ID'][$i]] = $arProps['PROP_POSITION']['VALUE'][$i];
                                }
                            }
                        }
                    }
                }
            }
            $cache->endDataCache($doctorsInfo);
        }

        $result = [];

        foreach ($doctorsInfo['CATEGORIES'] as $key => $item)
        {
            $result[$key]['NAME'] = $item[0];
            $result[$key]['QUANTITY'] = count($item);
        }

        foreach ($doctorsInfo['POSITIONS'] as $key => $item)
        {
            $result[$key]['POSITIONS'] = $item;
        }

        foreach($result as $key => &$resultItem)
        {
            $resultItem['POSITIONS'] = array_unique($resultItem['POSITIONS']);
        }

        $this->doctorsInfo = $result;
        unset($doctorsInfo, $result);
    }

    /**
     * Get a resulted array
     * @return array
     */
    public function GetResultArray()
    {
        foreach ($this->doctorsInfo as $key => $item)
        {
            $letters = $this->letters;
            foreach ($item['POSITIONS'] as $positionKey => $position)
            {
                $letters[strtoupper(mb_substr($position, 0, 1))][$positionKey] = $position;
            }

            $filtered = array_filter($letters, function($value) {
                return !empty($value);
            });

            $this->doctorsInfo[$key]['ALPHABET']['CODE'] = 'PROPERTY_PROP_POSITION';
            $this->doctorsInfo[$key]['ALPHABET']['WORD'] = $filtered;

        }
        return $this->doctorsInfo;
    }
}

?>