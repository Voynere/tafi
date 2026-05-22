<?

namespace Itb\Import\ProductImport;
use \Itb\Import\ProductImport\Productimport as Productimport;
class ProductLinkProps
{
    public $ID_PRODUCT_ONE;
    public $ID_PRODUCT_TWO;
    public $PRODUCT_PROPERTIES;
    public $IBLOCK_ID;
    public $FILES_LINK;


    function __construct($ID1,$ID2,$PROP,$IBLOCK_ID,$FILES_LINK)
    {
        $this->ID_PRODUCT_ONE = $ID1;
        $this->ID_PRODUCT_TWO = $ID2;
        $this->PRODUCT_PROPERTIES = $this->getPropertyCode($PROP);
        $this->IBLOCK_ID = $IBLOCK_ID;
        $this->FILES_LINK = $FILES_LINK;
    }
    private function getPropertyCode($IDProperty){
        $CODE = $IDProperty;
        $res = \CIBlockProperty::GetByID(
            $IDProperty,
            $this->IBLOCK_ID,
        );
        if($ar_res = $res->GetNext())
            $CODE =  $ar_res['CODE'];

        return $CODE;
    }

    public function FIleReadMe(){
        $FILE_R = new Productimport();
        $array_file_link = $FILE_R->readAndRemoveFirstLine($this->FILES_LINK)["PRODUCTS"];
        return $array_file_link;
    }
    public function SearchElProp($El_ID,$elArray)
    {
        $elArray = array_diff($elArray, [$El_ID]);
        \CIBlockElement::SetPropertyValuesEx($El_ID, false, array($this->PRODUCT_PROPERTIES => $elArray));
    }

    public function IblckParasIDArray(&$array){


        $result = array();
        foreach($array as $key => &$EL){
             foreach ($EL as &$idProp){

                 $arSelect = Array("ID","PROPERTY_ID");
                 $arFilter = Array("IBLOCK_ID"=>$this->IBLOCK_ID, "=PROPERTY_ID"=>$idProp);
                 $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
                 if($ob = $res->GetNextElement())
                 {
                     $arFields = $ob->GetFields();
                     $array[$key][$idProp] =  $arFields["ID"];
                 }else{
                     unset($array[$key][$idProp]);
                 }
             }
        }
    }
    public function SetPropElLink()
    {
        $array_el = $this->FIleReadMe();
       $this->IblckParasIDArray($array_el);
        foreach ($array_el as $key => $el_Product){
            foreach ($el_Product as $el){
                $this->SearchElProp($el,$el_Product);
            }
        }
        $refresh = false;
        if(is_array($array_el) && count($array_el)){
            $refresh = true;
        }

        return  $refresh;

    }

}