<?php
declare(strict_types=1);
namespace Itb\Seo\Service;

use Itb\Seo\MorphyFacade;
use Itb\Seo\Options;
use Itb\Seo\Table\MetaTable;

class MetaService
{
    public function getMeta(string $request_uri, string $subdomain = 'www')
    {
        $query = MetaTable::query()
            ->setSelect(['*'])
            ->where('URL', $request_uri)
            ->setOrder(['SUBDOMAIN' => 'DESC'])
            ->setLimit(1);

        // Условия для поддомена
        if ($subdomain == false || mb_strtolower($subdomain) == "www") {
            $query->whereIn('SUBDOMAIN', ['', null, 'www']);
        } else {
            $query->whereIn('SUBDOMAIN', ['', null, $subdomain]);
        }

        return $query->fetch();
    }

    public function setMeta(array $meta = [])
    {
        global $APPLICATION;

        if (!empty($meta["TITLE"])) {
            $APPLICATION->SetPageProperty('title', $meta['TITLE']);
        }
        if (!empty($meta["KEYWORDS"])) {
            $APPLICATION->SetPageProperty('keywords', $meta['KEYWORDS']);
        }
        if (!empty($meta["DESCRIPTION"])) {
            $APPLICATION->SetPageProperty('description', $meta['DESCRIPTION']);
        }
        if (!empty($meta["TEXT"])) {
            $APPLICATION->SetPageProperty('text', $meta['TEXT']);
        }
        if (!empty($meta["H1"])) {
            $APPLICATION->SetTitle($meta['H1']);
        }
    }

    public function getFilter()
    {
        $FILTER_NAME = service(Options::class)->filterName;
        global $FILTER_NAME;

        return isset($FILTER_NAME) ? $FILTER_NAME : array();
    }

    public function parseParams(string $string)
    {
        $arReplace = array();
        preg_match_all('/{.+}/U', $string, $params);
        if ($params && $params[0]) {
            foreach ($params[0] as $param) {
                $tmp = $param;
                $tmp = str_replace("{", "", $tmp);
                $tmp = str_replace("}", "", $tmp);

                list($tmp, $sEmpty) = explode("#", $tmp);
                list($tmp, $sParam) = explode("!", $tmp);

                $tmp = explode("|", $tmp);

                $key = 0;
                foreach ($tmp as $k => $item) {
                    if (stripos($item, ".")) {
                        $key = $k;
                    }
                }

                if (stripos($tmp[$key], ".")) {
                    list($sParamID, $sCODE) = explode(".", $tmp[$key]);
                } else {
                    $sParamID = 0;
                    $sCODE = $tmp[$key];
                }

                $arReplace[$sCODE] = array(
                    "ID"        => $sParamID,
                    "CODE"      => $sCODE,
                    "PREFIX"    => ($key > 0 && isset($tmp[$key - 1])) ? $tmp[$key - 1] : "",
                    "POSTFIX"   => (($key == 0 || ($key == 1 && count($tmp) > 2)) && isset($tmp[$key + 1])) ? $tmp[$key + 1] : "",
                    "PARAMS"    => $sParam ? $sParam : "",
                    "EMPTY"     => $sEmpty ? $sEmpty : ""
                );
            }
        }
        return $arReplace;
    }

    public function getCategory()
    {
        $options = service(Options::class);
        $FILTER_CATEGORY    = $options->filterCategory;
        $IBLOCK_ID          = $options->iblockId;

        $pattern = preg_replace('/\#.+\#/U', '(.+)', $FILTER_CATEGORY);
        $pattern = "/" . addcslashes($pattern, '/') . "/";

        preg_match($pattern, $_SERVER["REQUEST_URI"], $arOut);
        if ($arOut && isset($arOut[1])) {
            $category_path = $arOut[1];
            list($category_code) = explode("/", $category_path);

            $rsSection = \CIBlockSection::GetList(array(), array("CODE" => $category_code, "IBLOCK_ID" => $IBLOCK_ID));
            if ($arSection = $rsSection->GetNext()) {
                return $arSection["NAME"];
            }
        }
        return false;
    }

    public function prepareParams(array &$arParams, array $arFilter)
    {
        if (isset($arFilter["PROPERTY"])) {
            $this->eachParams($arFilter["PROPERTY"], $arParams);
        } else {
            $this->eachParams($arFilter, $arParams);
            $this->eachParams($arFilter["OFFERS"], $arParams);
        }
    }

    public function eachParams(array $items, array &$arParams)
    {
        foreach ($items as $code => $values) {
            if ($code != "OFFERS") {
                foreach ($arParams as $p => $arParam) {
                    if ($code == "=PROPERTY_" . $arParam["ID"] || $p == $code) {
                        $rsProp = \CIBlockProperty::GetByID($arParam["ID"]);
                        if ($arProp = $rsProp->GetNext()) {

                            if ($arProp["PROPERTY_TYPE"] == "L") {
                                if (stripos($arParam["PARAMS"], "-N") !== false) {
                                    $arParams[$p]["VALUE"] = $arProp["NAME"];
                                } else {
                                    $arParams[$p]["VALUE"] = array();

                                    if (is_array($values)) {
                                        foreach ($values as $value) {
                                            $rsEnum = \CIBlockProperty::GetPropertyEnum($arParam["ID"], array(), array("ID" => $value));
                                            if ($arEnum = $rsEnum->GetNext())
                                                $arParams[$p]["VALUE"][] = $arEnum["VALUE"];
                                        }
                                    } else {
                                        $rsEnum = \CIBlockProperty::GetPropertyEnum($arParam["ID"], array(), array("ID" => $values));
                                        if ($arEnum = $rsEnum->GetNext())
                                            $arParams[$p]["VALUE"][] = $arEnum["VALUE"];
                                    }
                                }
                            }

                            if ($arProp["PROPERTY_TYPE"] == "E") {
                                $arParams[$p]["VALUE"] = array();
                                if (is_array($values)) {
                                    foreach ($values as $value) {
                                        $rsElement = \CIBlockElement::GetByID($value);
                                        if ($arElement = $rsElement->GetNext())
                                            $arParams[$p]["VALUE"][] = $arElement["NAME"];
                                    }
                                } else {
                                    $rsElement = \CIBlockElement::GetByID($values);
                                    if ($arElement = $rsElement->GetNext())
                                        $arParams[$p]["VALUE"][] = $arElement["NAME"];
                                }
                            }

                            if ($arProp["PROPERTY_TYPE"] == "S") {
                                $arParams[$p]["VALUE"] = $values;
                            }
                        }
                    }
                }
            }
        }
    }

    public function insertParams(array $arParams, string $string)
    {
        preg_match_all('/{.+}/U', $string, $params);
        if ($params && $params[0]) {
            $value = array_values($arParams);
            foreach ($params[0] as $key => $item) {
                if ($value[$key]) {
                    if (empty($value[$key]["VALUE"])) {
                        $text = "";
                        if (!trim($value[$key]["VALUE"])) {
                            $text = $value[$key]["EMPTY"];
                        }

                        $string = str_replace($item, $text, $string);
                    } else {
                        $objWord = MorphyFacade::getInstance();

                        $v = $value[$key]["VALUE"];

                        $cases = array("-PG", "-PD", "-PAC", "-PAB", "-PP");
                        $cases = $this->multineedle_stripos($value[$key]["PARAMS"], $cases);

                        foreach ($cases as $name => $case) {
                            if ($case !== false) {
                                $forms = $objWord->getFormsPhrase($v);

                                switch ($name) {
                                    case "-PG":
                                        $v = implode(", ", $forms["GENITIVE"]);
                                        break;
                                    case "-PD":
                                        $v = implode(", ", $forms["DATIVE"]);
                                        break;
                                    case "-PAC":
                                        $v = implode(", ", $forms["ACCUSATIVE"]);
                                        break;
                                    case "-PAB":
                                        $v = implode(", ", $forms["ABLATIVE"]);
                                        break;
                                    case "-PP":
                                        $v = implode(", ", $forms["PREPOSITIONAL"]);
                                        break;
                                }
                            }
                        }

                        if (is_array($v)) {
                            $v = implode(", ", $v);
                        }

                        if (stripos($value[$key]["PARAMS"], "-L") !== false) {
                            $v = mb_strtolower($v);
                        }

                        if (stripos($value[$key]["PARAMS"], "-C") !== false) {
                            $v = $this->mb_strtoupper_first($v);
                        }

                        $text = $value[$key]["PREFIX"] . $v . $value[$key]["POSTFIX"];

                        $string = str_replace($item, $text, $string);
                    }
                } else {
                    $string = str_replace($item, "", $string);
                }
            }
        }

        return $string;
    }

    public function mb_strtoupper_first(string $str, string $encoding = 'UTF8')
    {
        return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) . mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }

    public function multineedle_stripos(string $haystack, array $needles, int $offset = 0)
    {
        foreach ($needles as $needle) {
            $found[$needle] = stripos($haystack, $needle, $offset);
        }
        return $found;
    }
}
