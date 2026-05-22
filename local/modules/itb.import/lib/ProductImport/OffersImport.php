<?
namespace Itb\Import\ProductImport;
ini_set('memory_limit', '1024M');
use Bitrix\Main\Loader;
use Bitrix\Catalog\Model\Product;
class OffersImport
{
    public $FILE_PATH;
    public $options;

    function __construct($FILE_PATH = "", $options = "")
    {
        $this->FILE_PATH = $FILE_PATH;
        $this->options = $options;
    }

    public function readAndRemoveFirstLine($path)
    {
        $filename = $path;
        if (!file_exists($filename)) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершён</a>";
            exit;
            throw new \Exception("Файл не найден: $filename");
        }

        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (empty($lines)) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершён</a>";
            exit;
            throw new \Exception("Файл пустой: $filename");
        }

        $firstLine = array_shift($lines);
        file_put_contents($filename, implode(PHP_EOL, $lines));

        $jsonData["PRODUCTS"] = json_decode($firstLine, true);
        $jsonData["COUNT"] = ((count($lines) - 1) * 15);
        $lastLine = json_decode($lines[array_key_last($lines)]);
        if (is_array($lastLine) || $lastLine instanceof Countable) {
            $jsonData["COUNT"] += count($lastLine);
        } else {
            $jsonData["COUNT"] += 0;
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершон</a>";
            exit;
        }

        return $jsonData;
    }

    public function readFile($path)
    {
        $filename = $path;
        // Проверяем, существует ли файл
        if (!file_exists($filename)) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершон</a>";
            exit;
        }

        $fileContent = file_get_contents($filename);

        if (empty($fileContent)) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершон</a>";
            exit;
        }

        foreach ($fileContent as $item) {
            $jsonData[] = json_decode($item, true);
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершон</a>";
            exit;
        }

        return $jsonData;
    }

    public function productsSwitcher()
    {
        $result = [];
        $result = $this->readAndRemoveFirstLine($this->FILE_PATH);
        $products = $result["PRODUCTS"];
        $massage["COUNT"]["SUM"] = $result["COUNT"];

        $massage["COUNT"]["ADD"] = 0;
        $massage["COUNT"]["ERROR"] = 0;
        foreach ($products as $product) {
            $prod = $this->arrayFieldsEl($product);
            $massage["COUNT"]["ADD"] += $prod["ADD"];
            $massage["COUNT"]["ERROR"] += $prod["ERROR"];
        }
        return $massage;
    }

    private function createSection($section, $parentSection = false)
    {
        $ID_SECTION = false;

        $arFilter = array('IBLOCK_ID' => $this->options["ITB_IBLOCK_ID_IMPORT"], "IBLOCK_SECTION_ID" => $parentSection, "NAME" => trim($section));
        $db_list = \CIBlockSection::GetList([], $arFilter, true);
        if ($ar_result = $db_list->GetNext()) {
            $ID_SECTION = $ar_result['ID'];
        } else {
            $bs = new \CIBlockSection;
            $name = trim($section);
            $arParams = array("replace_space" => "-", "replace_other" => "-");
            $trans = \Cutil::translit($name, "ru", $arParams);
            $arFields = array(
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $this->options["ITB_IBLOCK_ID_IMPORT"],
                "IBLOCK_SECTION_ID" => $parentSection,
                "CODE" => $trans,
                "NAME" => $name,
            );
            $ID_SECTION = $bs->Add($arFields);


        }
        return $ID_SECTION;
    }

    private function sectionCheck($sections)
    {
        $section = false;
        if (empty($sections)) {
            return $section;
        }
        $sectionsId = [];
        if ($sections = explode("||", $sections)) {
            foreach ($sections as $section) {
                $section = explode("|", $section);
                if (is_array($section) && count($section) > 1) {
                    $parantId = false;
                    foreach ($section as $sectio) {
                        $parantId = $this->createSection($sectio, $parantId);
                    }
                    $sectionsId[] = $parantId;
                } elseif (is_array($section) && count($section) == 1) {
                    $sectionsId[] = $this->createSection($section[0], false);
                }
            }
        } elseif ($sections = explode("|", $sections)) {
            if (is_array($sections) && count($sections) > 1) {
                $parantId = false;
                foreach ($sections as $sectio) {
                    $parantId = $this->createSection($sectio, $parantId);
                }
                $sectionsId[] = $parantId;
            } elseif (is_array($section) && count($section) == 1) {
                $sectionsId[] = $this->createSection($section[0], false);
            }
        }
        return $sectionsId;
    }

    private function getImage($strImage)
    {
        $arrayImages = [];
        if (empty($strImage)) {
            return $arrayImages;
        }

        $pos = strpos($strImage, ";");
        $pos2 = strpos($strImage, ",");

        if ($pos !== false && $images = explode(";", $strImage)) {
            foreach ($images as $image) {
                $arrayImage = \CFile::MakeFileArray(trim($image));
                $fid = \CFile::SaveFile($arrayImage, "vote");
                $arrayImages[] = \CFile::MakeFileArray(\CFile::GetPath($fid));
            }
        }elseif ($pos2 !== false && $images = explode(",", $strImage)){
            foreach ($images as $image) {
                $arrayImage = \CFile::MakeFileArray(trim($image));
                $fid = \CFile::SaveFile($arrayImage, "vote");
                $arrayImages[] = \CFile::MakeFileArray(\CFile::GetPath($fid));
            }
        }

        return $arrayImages;
    }

    private function ListSheck($propertyID, $value)
    {
        if (empty($propertyID) || empty($value))
            return [];

        $result = [];
        $property_enums = \CIBlockPropertyEnum::GetList(array("DEF" => "DESC", "SORT" => "ASC"), array("IBLOCK_ID" => 34, "VALUE" => trim($value), "PROPERTY_ID" => $propertyID));
        if ($enum_fields = $property_enums->GetNext()) {
            $result = $enum_fields["ID"];
        } else {
            $ibpenum = new \CIBlockPropertyEnum;
            if ($PropID = $ibpenum->Add(array('PROPERTY_ID' => $propertyID, 'VALUE' => $value)))
                $result = $PropID;
        }
        return $result;
    }

    private function getProperty($property, $propertyValue)
    {
        $prop = [];
        if (empty($property)) {
            return "";
        }


        $property = explode("PROPERTY_", $property)[1];
        $properties = \CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "CODE" => $property, "IBLOCK_ID" => 34));
        if ($prop_fields = $properties->GetNext()) {
            if (($prop_fields["PROPERTY_TYPE"] == "S" || $prop_fields["PROPERTY_TYPE"] == "N") && !empty($propertyValue)) {
                if ($prop_fields["MULTIPLE"] == "N") {
                    $prop[$prop_fields["ID"]] = $propertyValue;
                } else {
                    $prop[$prop_fields["ID"]] = explode("|", $propertyValue);
                }
            } elseif ($prop_fields["PROPERTY_TYPE"] == "L") {
                if (!empty($propertyValue)) {
                    $prop[$prop_fields["ID"]] = $this->ListSheck($prop_fields["ID"], $propertyValue);
                } elseif (empty($propertyValue) && $prop_fields["DEFAULT_VALUE"]) {
                    $prop[$prop_fields["ID"]] = $prop_fields["DEFAULT_VALUE"];
                }
            }
        }
        return $prop;
    }

    private function setPrice($PRODUCT_ID, $priceFields)
    {
        $arElement["ID"] = $PRODUCT_ID; // PRODUCT_ID
        $price = $priceFields;
        $currency = 'RUB';
        $catalogGroupId = 1; // Тип цены
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $arFieldsPrice = [
            "PRODUCT_ID" => $arElement["ID"],
            "CATALOG_GROUP_ID" => $catalogGroupId,
            "PRICE" => $price,
            "CURRENCY" => !$currency ? "RUB" : $currency,
        ];

        $dbPrice = \Bitrix\Catalog\Model\Price::getList([
            "filter" => [
                "PRODUCT_ID" => $arElement["ID"],
                "CATALOG_GROUP_ID" => $catalogGroupId
            ]
        ]);


        if ($arPrice = $dbPrice->fetch()) {
            $result = \Bitrix\Catalog\Model\Price::update($arPrice["ID"], $arFieldsPrice);
            if ($result->isSuccess()) {
            } else {
            }
        } else {
            $result = \Bitrix\Catalog\Model\Price::add($arFieldsPrice);
            if ($result->isSuccess()) {
            } else {
            }
        }
    }
    private function updateProductQuantity($productId, $newQuantity)
    {
        // Проверяем, загружен ли модуль каталога
        if (!Loader::includeModule("catalog")) {
        }


        // Обновление товара
        $result = Product::update($productId, [
            'QUANTITY' => $newQuantity,
        ]);

        if ($result->isSuccess()) {
            return "Количество товара успешно обновлено.";
        } else {
            return "Ошибка обновления товара: " . implode(", ", $result->getErrorMessages());
        }
    }

    static function parentGetProducts($productId){
        $arSelect = Array("ID", "NAME" ,"CATALOG_PRICE_1");
        $arFilter = Array("IBLOCK_ID"=>32,"=PROPERTY_ID" =>$productId);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
        if($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
//            \CCatalogProduct::Add( array("ID" => $arFields["ID"] ,"TYPE"=>\Bitrix\Catalog\ProductTable::TYPE_SKU) );
            \Bitrix\Catalog\ProductTable::update($arFields["ID"], ['TYPE' => \Bitrix\Catalog\ProductTable::TYPE_SKU]);
            return $arFields;
        }
        return false;
    }
    private function arrayFieldsEl($products)
    {


        $parentProduct =   self::parentGetProducts($products["PROPERTY_ID"]);

        if ($parentProduct == false){
            return $result["ERROR"] += 1;
        }


        $products["PROPERTY_CML2_LINK"] = $parentProduct["ID"];

        $productName = $parentProduct["NAME"]."_".$products["PROPERTY_ID2"];
        unset($products["NAME"]);


        $price = (int)$products["PROPERTY_PRICE"] + (float)$parentProduct["CATALOG_PRICE_1"];
        unset($products["PROPERTY_PRICE"]);
        $active = (!empty($products["PROPERTY_COUNT"])) ? "Y" : "N";
        $countProduct = (!empty($products["PROPERTY_COUNT"])) ?$products["PROPERTY_COUNT"] : 0 ;
        unset($products["PROPERTY_COUNT"]);




        $PROP = [];
        foreach ($products as $key => $property) {
            $PROP = array_replace($PROP, $this->getProperty($key, $property));
        }
            $PROP[527] = $products["PROPERTY_CML2_LINK"];
        $arParams = array("replace_space" => "-", "replace_other" => "-");
        $trans = \Cutil::translit($productName, "ru", $arParams);

        $arLoadProductArray = array(
            "MODIFIED_BY" => 1,
            "IBLOCK_SECTION" => false,
            "IBLOCK_ID" => 34,
            "NAME" => $productName,
            "CODE" => $trans,
            "ACTIVE" => $active,
            "PROPERTY_VALUES" => $PROP,
        );



        $el = new \CIBlockElement;
        $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
        $arFilter = array("IBLOCK_ID" => $arLoadProductArray["IBLOCK_ID"], "NAME" => $arLoadProductArray["NAME"]);
        $res = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
        $result = [];

        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $PRODUCT_ID = $arFields["ID"];
            if ($el->Update($arFields["ID"], $arLoadProductArray)) {
                $result["ADD"] += 1;
            } else {
                $result["ERROR"] += 1;
            }
        } else {
            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $result["ADD"] += 1;
            } else {
                $result["ERROR"] += 1;
            }
        }
        pre($PRODUCT_ID);
        pre($products["PROPERTY_CML2_LINK"]);

        if (!empty($PRODUCT_ID)) {
            if(\CCatalogProduct::Add( array("ID" => $PRODUCT_ID ,"TYPE"=>\Bitrix\Catalog\ProductTable::TYPE_OFFER) )){
                $this->setPrice($PRODUCT_ID, $price);
                $this->updateProductQuantity($PRODUCT_ID,$countProduct);
            }

        }
        return $result;
    }

}

?>