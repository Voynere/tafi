<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs_off = CMax::GetDirMenuParametrs(__DIR__))
{
	$iblock_id = CMaxCache::$arIBlocks[SITE_ID]['aspro_max_content']['aspro_max_services'][0];
	$arExtParams = array(
		'IBLOCK_ID' => $iblock_id,
		'MENU_PARAMS' => $arMenuParametrs,
		'SECTION_FILTER' => array(),	// custom filter for sections (through array_merge)
		'SECTION_SELECT' => array(),	// custom select for sections (through array_merge)
		'ELEMENT_FILTER' => array(),	// custom filter for elements (through array_merge)
		'ELEMENT_SELECT' => array(),	// custom select for elements (through array_merge)
		'MENU_TYPE' => 'services',
	);
	CMax::getMenuChildsExt($arExtParams, $aMenuLinksExt);
}

//$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

// Добавляем в меню элементы Инфоблока без разделоыв

if(CModule::IncludeModule("iblock")) {
$IBLOCK_ID = 3;        //здесь необходимо указать ID Вашего инфоблока
$arOrder = Array("SORT"=>"ASC");   
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
	$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", 'SECTION_ID'=> false ); // только для разделов в корне
$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement())
    {
    $arFields = $ob->GetFields();            
    $aMenuLinksExt[] = Array(
                $arFields['NAME'],
                $arFields['DETAIL_PAGE_URL'],
                Array(),
                Array(),
                ""
                );
    
    }       
    
}   

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>