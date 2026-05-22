<?php

namespace Itb\Import\ProductImport;

use phpDocumentor\Reflection\Types\This;
use Shuchkin\SimpleXLSX;

ini_set('memory_limit', '1024M');

class GneratorImportFile
{
    public $options;
    public $FILE_ADD_PATCH;
    public $FILE_README_PATCH;

    function __construct($filePathA = null,$filePathR = null)
    {
        $this->FILE_ADD_PATCH = $filePathA;
        $this->FILE_README_PATCH = $filePathR;

    }

    public function PripaerseProps($options,$str = "")
    {
        if(empty($str))
            return [];

        $optionsAll = [];
        foreach ($options as $key => $value) {
            if (strpos($key, $str) !== false) {
                $optionsAll[$key] = $value - 1;
            }
        }
        return $optionsAll;
    }

    private function ParseFileExel($prop,$str ="")
    {
        $products = [];
        $count = 0;

        if ($xlsx = SimpleXLSX::parse($this->FILE_README_PATCH)) {

            foreach ($xlsx->rows() as $key => $row) {

                if($count != 0){
                    $products[] = $this->ParseProduct($row, $prop,$str);
                }
                if ((is_array($products) && count($products) > 14) || count($xlsx->rows()) <= 14) {
                    file_put_contents( $this->FILE_ADD_PATCH, print_r(json_encode($products), 1)."\n", FILE_APPEND);
                    unset($products);
                }
                $count++;
            }
            file_put_contents( $this->FILE_ADD_PATCH, print_r(json_encode([]), 1)."\n", FILE_APPEND);

        }
        return  $count ;
    }

    private function ParseProduct($rowExel, $props,$str = "")
    {
        $product = [];
        foreach ($props as $key => $prop) {
            $product[str_replace($str, "PROPERTY_", $key)] = $rowExel[$prop];
        }
        return $product;
    }
    private function ParseFileExelLink($ParamsPars){
        $products = [];

        if ($xlsx = SimpleXLSX::parse($this->FILE_README_PATCH)) {

            foreach ($xlsx->rows() as $key => $row) {

                $products[$row[0]][$row[0]] = $row[0];
                $products[$row[0]][$row[1]] = $row[1];
            }

        }
        $product = [];
        foreach ($products as $key => &$item){
            if ((is_array($product) && count($product) > 10) || count($products)  <= 10 ) {
                file_put_contents( $this->FILE_ADD_PATCH, print_r(json_encode($product), 1)."\n", FILE_APPEND);
                unset($product);
            }
            $product[$key] = $item ;
            unset($item);
        }
        return $products;
    }

    public function fileGenerator($options,$str="",$addin5 = true)
    {

        $ParamsPars = $this->PripaerseProps($options,$str);
        unlink($this->FILE_ADD_PATCH);

        if ($addin5)
            $productsCount = $this->ParseFileExel($ParamsPars,$str);
        else
            $productsCount = $this->ParseFileExelLink($ParamsPars);

        return $productsCount;
    }

}
