<?php

namespace Itb\Import\OtionsGeneratorParams;

use http\Encoding\Stream\Deflate;
use Shuchkin\SimpleXLSX;

ini_set('memory_limit', '1024M');

class OtionsGenerate
{
    public $IblockId;
    public $module_id;
    public $aTabs;
    public $ITB_FILE_EXEL;
    public $ITB_FILE_EXEL_LINK_PRODUCT;
    public $ITB_FILE_EXEL_LINK_OFFERS;

    public function __construct($IblockIds = "", $OptionsPatch = [])
    {
        \CModule::IncludeModule("iblock");
        $this->IblockId = $IblockIds;
        $this->ITB_FILE_EXEL = $_SERVER["DOCUMENT_ROOT"] . $OptionsPatch["ITB_FILE_EXEL"];
        $this->ITB_FILE_EXEL_LINK_PRODUCT = $_SERVER["DOCUMENT_ROOT"] . $OptionsPatch["ITB_FILE_EXEL_LINK_PRODUCT"];
        $this->ITB_FILE_EXEL_LINK_OFFERS = $_SERVER["DOCUMENT_ROOT"] . $OptionsPatch["ITB_FILE_EXEL_LINK_OFFERS"];
        $this->aTabs = [];


        $this->arrayDefault();


        return $this->aTabs;
    }

    private function ExeleParams($patch)
    {
        $arrayPropsInExel = ["выбрать"];
        if (empty($patch)) {
            return $arrayPropsInExel;
        }

        if ($xlsx = SimpleXLSX::parse($patch)) {
            $arraysExel = $xlsx->rows(0, 1)[0] ?? []; // Use null coalescing operator to ensure it's an array
            if (is_array($arraysExel) && !empty($arraysExel)) {
                asort($arraysExel);
                $arrayEx = [];
                foreach ($arraysExel as $key => $el) {
                    if ($el) {
                        $arrayEx[$key + 1] = $el;
                    }
                }
                $arrayPropsInExel = array_replace($arrayPropsInExel, $arrayEx);
            }
        } else {
            pre(SimpleXLSX::parseError());
        }
        return $arrayPropsInExel;
    }

    public function OptionsIblockGenerator()
    {
        if ($this->IblockId == null || empty($this->ITB_FILE_EXEL))
            return;

        $arrayParamsEXEL = $this->ExeleParams($this->ITB_FILE_EXEL);
        $options = [];

        $optionsDefuult[] = [
            "ITB_PARAMS_NAME",
            "название",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_DESCRIPTION_DETAIL",
            "описание детальное",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_DESCRIPTION_PREVIEW",
            "описание анонс",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_ACTIVE",
            "активность",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_PICTURE",
            "картина",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_PRICE",
            "цена",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_COUNT",
            "количество товара",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_PARAMS_SECTION",
            "раздел",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];

        $options = array_merge($options, $optionsDefuult);
        $properties = \CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => $this->IblockId));
        while ($prop_fields = $properties->GetNext()) {

            $code = "ITB_PARAMS_" . $prop_fields["CODE"];
            $name = "[" . $prop_fields['ID'] . "] " . $prop_fields["NAME"];
            $type = ["selectbox", $arrayParamsEXEL];
            $options[] = $this->inputOption($code, $name, $type,  array_search($prop_fields["NAME"], $arrayParamsEXEL));
        }
        $this->aTabs[] = [
            "DIV" => "edit2",
            "TAB" => "Сопоставление",
            "TITLE" => "Сопоставление",
            "OPTIONS" => $options
        ];
    }

    public function inputOption($code, $name, $type,$Deflate = '')
    {
        return [
            "$code",
            "$name",
            $Deflate,
            $type,
        ];
    }

    public function OptionsGeneratorLinkProduct()
    {
        if ($this->IblockId == null || empty($this->ITB_FILE_EXEL_LINK_PRODUCT))
            return;
        $arrayParamsEXEL = $this->ExeleParams($this->ITB_FILE_EXEL_LINK_PRODUCT);
        $options = [];
        $optionsDefuult[] = [
            "ITB_LINK_PRODUCT_ID",
            "основной товар ID",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_LINK_PRODUCT_ID2",
            "связи ID",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $properties = \CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => $this->IblockId));
        $nameProperty = ["выбрать"];
        while ($prop_fields = $properties->GetNext()) {
            $nameProperty[$prop_fields['ID']] = "[" . $prop_fields['ID'] . "] " . $prop_fields["NAME"];
        }
        $optionsDefuult[] = [
            "ITB_LINK_PRODUCT_PROPERTIES",
            "свойство куда осушествляется привязка элементов",
            "",
            ["selectbox", $nameProperty],
        ];

        $options = array_merge($options, $optionsDefuult);
    }

    public function OptionsGeneratorLinkOffers()
    {
        if ($this->IblockId == null || empty($this->ITB_FILE_EXEL_LINK_OFFERS))
            return;

        $arrayParamsEXEL = $this->ExeleParams($this->ITB_FILE_EXEL_LINK_OFFERS);
        $options = [];
        $optionsDefuult[] = [
            "ITB_LINK_OFFERS_ID",
            "основной товар ID",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_LINK_OFFERS_ID2",
            "торговое предложение ID",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_LINK_OFFERS_PRICE",
            "цена",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $optionsDefuult[] = [
            "ITB_LINK_OFFERS_COUNT",
            "количество",
            "",
            ["selectbox", $arrayParamsEXEL],
        ];
        $options = array_merge($options, $optionsDefuult);
        $properties = \CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => 34));
        while ($prop_fields = $properties->GetNext()) {

            $code = "ITB_LINK_OFFERS_" . $prop_fields["CODE"];
            $name = "[" . $prop_fields['ID'] . "] " . $prop_fields["NAME"];
            $type = ["selectbox", $arrayParamsEXEL];
            $options[] = $this->inputOption($code, $name, $type,  array_search($prop_fields["NAME"], $arrayParamsEXEL));
        }
    }

    public function arrayDefault()
    {
        $this->aTabs[] =
            array(
                "DIV" => "edit1",
                "TAB" => "Настройки выгрузки",
                "TITLE" => "Настройки выгрузки",
                "OPTIONS" => array(
                    array(
                        "ITB_ACTIVE_MODULES",
                        "Активировать модуль",
                        "",
                        array("checkbox"),
                    ),
                    array(
                        "ITB_IBLOCK_ID_IMPORT",
                        "IBLOCK ID товаров",
                        "",
                        array("text"),
                    ),
                    array(
                        "ITB_IBLOCK_ID_OFFERS",
                        "IBLOCK ID торговых предложений",
                        "",
                        array("text"),
                    ),
                    array(
                        "ITB_FILE_EXEL",
                        "EXEL фаил",
                        "",
                        array("file"),
                    ),
                )
            );
        $this->OptionsIblockGenerator();
        $this->OptionsGeneratorLinkProduct();
        $this->OptionsGeneratorLinkOffers();
        $this->aTabs[] = array(
            "DIV" => "edit4",
            "TAB" => "Доступ",
            "TITLE" => "Настройки прав доступа"
            );
    }


}