<?

namespace Itb\Import\ProductImport;
ini_set('memory_limit', '1024M');

use Bitrix\Main\Loader;
use Bitrix\Catalog\Model\Product;

class Productimport
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
            echo"<a href='/bitrix/admin/hmarketing.php?lang=ru'> импорт завершён</a>";
            exit;
            throw new \Exception("Ошибка декодирования JSON: " . json_last_error_msg());
        }
        return $jsonData;
    }

    public function readFile($path)
    {
        $filename = $path;
        if (!file_exists($filename)) {
            throw new \Exception("Файл не найден: $filename");
        }

        $fileContent = file_get_contents($filename);

        if (empty($fileContent)) {
            throw new \Exception("Файл пустой: $filename");
        }

        foreach ($fileContent as $item) {
            $jsonData[] = json_decode($item, true);
        }
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Ошибка декодирования JSON: " . json_last_error_msg());
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

            if ($prod['ADDED_ID']) 
            {
                $log = [
                    'date' => date('Y-m-d'),
                    'id' => $prod['ADDED_ID']
                ];
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/addedItems.log', print_r($log, 1), FILE_APPEND);
            }

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
        } elseif ($pos2 !== false && $images = explode(",", $strImage)) {
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


        foreach (explode(";",$value) as $val) {
            $property_enums = \CIBlockPropertyEnum::GetList(array("DEF" => "DESC", "SORT" => "ASC"), array("IBLOCK_ID" => $this->options["ITB_IBLOCK_ID_IMPORT"], "VALUE" => trim($val), "PROPERTY_ID" => $propertyID));
            if ($enum_fields = $property_enums->GetNext()) {
                $result[] = $enum_fields["ID"];
            } else {
                $ibpenum = new \CIBlockPropertyEnum;
                if ($PropID = $ibpenum->Add(array('PROPERTY_ID' => $propertyID, 'VALUE' => $val)))
                    $result[] = $PropID;
            }
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
        $properties = \CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "CODE" => $property, "IBLOCK_ID" => $this->options["ITB_IBLOCK_ID_IMPORT"]));
        if ($prop_fields = $properties->GetNext()) {
            if (($prop_fields["PROPERTY_TYPE"] == "S" || $prop_fields["PROPERTY_TYPE"] == "N") && !empty($propertyValue)) {
                if ($prop_fields["MULTIPLE"] == "N") {
                    $prop[$prop_fields["ID"]] = $propertyValue;
                } else {
                    $prop[$prop_fields["ID"]] = explode(";", $propertyValue);
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
        $arElement["ID"] = $PRODUCT_ID;
        $price = $priceFields;
        $currency = 'RUB';
        $catalogGroupId = 1;

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
        if (!Loader::includeModule("catalog")) {
        }

        $result = Product::update($productId, [
            'QUANTITY' => $newQuantity,
        ]);

        if ($result->isSuccess()) {
            return "Количество товара успешно обновлено.";
        } else {
            return "Ошибка обновления товара: " . implode(", ", $result->getErrorMessages());
        }
    }

     private function arrayFieldsEl($products)
    {
        unset($products["PROPERTY_SECTION"]);
        $productName = $products["PROPERTY_NAME"];
        unset($products["PROPERTY_NAME"]);
        $productDescription_preview = $products["PROPERTY_DESCRIPTION_PREVIEW"];
        unset($products["PROPERTY_DESCRIPTION_PREVIEW"]);
        $productDescription_detaile = $products["PROPERTY_DESCRIPTION_DETAIL"];
        unset($products["PROPERTY_DESCRIPTION_DETAIL"]);
        $price = $products["PROPERTY_PRICE"];
        unset($products["PROPERTY_PRICE"]);
        unset($products["PROPERTY_ACTIVE"]);
        $img = $this->getImage($products["PROPERTY_PICTURE"]);
        unset($products["PROPERTY_PICTURE"]);

        $productKod = $products["PROPERTY_KOD"];
        unset($products["PROPERTY_KOD"]);
        $PROP = [];

        foreach ($products as $key => $property) {
            $PROP = array_replace($PROP, $this->getProperty($key, $property));
        }
        if (is_array($img)) {
            $PROP[437] = $img;
        }

        $arParams = array("replace_space" => "-", "replace_other" => "-");
        $trans = \Cutil::translit($productName, "ru", $arParams);

        $arLoadProductArray = array(
            "MODIFIED_BY"        => 1,
            "IBLOCK_ID"          => $this->options["ITB_IBLOCK_ID_IMPORT"],
            "NAME"               => $productName,
            "CODE"               => $trans,
            "DETAIL_TEXT"        => $productDescription_detaile,
            'DETAIL_TEXT_TYPE'   => 'html',
            "PREVIEW_TEXT"       => $productDescription_preview,
            'PREVIEW_TEXT_TYPE'  => 'html',
            "PREVIEW_PICTURE"    => $img[0] ?: "",
            "DETAIL_PICTURE"     => $img[1] ?: $img[0],
            "PROPERTY_VALUES"    => $PROP,
        );

        $el        = new \CIBlockElement;
        $arSelect  = array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_TEXT", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE");
        $PRODUCT_ID = null;
        $arFields   = null;

        if (!empty($productKod)) {
            $arFilter = array(
                "IBLOCK_ID"    => $arLoadProductArray["IBLOCK_ID"],
                "PROPERTY_KOD" => $productKod,
            );
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1), $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields   = $ob->GetFields();
                $PRODUCT_ID = $arFields["ID"];
            }
        }

        if (empty($PRODUCT_ID)) {
            $arFilterByName = array(
                "IBLOCK_ID" => $arLoadProductArray["IBLOCK_ID"],
                "%NAME"     => $productName,
            );
            $res = \CIBlockElement::GetList(array(), $arFilterByName, false, false, $arSelect);

            $bestMatchId     = null;
            $bestMatchFields = null;
            $bestSimilarity  = 0;
            $threshold       = 80;

            while ($ob = $res->GetNextElement()) {
                $candidate           = $ob->GetFields();
                $normalizedCandidate = mb_strtolower(preg_replace('/\s+/', ' ', trim($candidate["NAME"])));
                $normalizedSearch    = mb_strtolower(preg_replace('/\s+/', ' ', trim($productName)));

                similar_text($normalizedSearch, $normalizedCandidate, $percent);

                if ($percent > $bestSimilarity) {
                    $bestSimilarity  = $percent;
                    $bestMatchId     = $candidate["ID"];
                    $bestMatchFields = $candidate;
                }
            }

            if ($bestSimilarity >= $threshold && !empty($bestMatchId)) {
                $PRODUCT_ID = $bestMatchId;
                $arFields   = $bestMatchFields;
            }
        }

        $result = [];

        if (!empty($PRODUCT_ID)) {
            $arUpdateArray = [];

            $arUpdateArray["NAME"] = $arLoadProductArray["NAME"];
            $arUpdateArray["CODE"] = $arLoadProductArray["CODE"];

            if (!empty($productDescription_detaile)) {
                $arUpdateArray["DETAIL_TEXT"]      = $productDescription_detaile;
                $arUpdateArray["DETAIL_TEXT_TYPE"] = 'html';
            }
            if (!empty($productDescription_preview)) {
                $arUpdateArray["PREVIEW_TEXT"]      = $productDescription_preview;
                $arUpdateArray["PREVIEW_TEXT_TYPE"] = 'html';
            }

            if (!empty($img[0])) {
                $arUpdateArray["PREVIEW_PICTURE"] = $img[0];
            }
            if (!empty($img[1]) || !empty($img[0])) {
                $arUpdateArray["DETAIL_PICTURE"] = $img[1] ?: $img[0];
            }

            if (!empty($productKod)) {
                $propKodId = $this->getPropertyIdByCode('KOD', $arLoadProductArray["IBLOCK_ID"]);
                if ($propKodId) {
                    $PROP[$propKodId] = $productKod;
                }
            }

            $arUpdateArray["PROPERTY_VALUES"] = $PROP;

            if ($el::SetPropertyValuesEx($PRODUCT_ID, false, $arUpdateArray)) {
                $result["ADD"] += 1;
            } else {
                $result["ERROR"] += 1;
            }
            echo 'updated:' . $PRODUCT_ID;
        } else {
            if (!empty($productKod)) {
                $propKodId = $this->getPropertyIdByCode('KOD', $arLoadProductArray["IBLOCK_ID"]);
                if ($propKodId) {
                    $arLoadProductArray["PROPERTY_VALUES"][$propKodId] = $productKod;
                }
            }

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $result["ADD"] += 1;
                $result["ADDED_ID"] = $PRODUCT_ID;
            } else {
                $result["ERROR"] += 1;
            }
            echo 'added:' . $PRODUCT_ID;
        }

        if (!empty($PRODUCT_ID)) {
            if (\CCatalogProduct::Add(array("ID" => $PRODUCT_ID))) {
                $this->setPrice($PRODUCT_ID, $price);
            }
        }

        return $result;
    }

    private function getPropertyIdByCode(string $code, int $iblockId): ?int
    {
        $res = \CIBlockProperty::GetList(
            [],
            ["IBLOCK_ID" => $iblockId, "CODE" => $code]
        );
        if ($prop = $res->Fetch()) {
            return (int)$prop["ID"];
        }
        return null;
    }

}

?>