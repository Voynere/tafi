<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;

\Bitrix\Main\Loader::IncludeModule("iblock");

$arMenuItemsIDs = array();
$arAllItems = array();
$arImgDesc = array();
foreach($arResult as $key=>$arItem)
{
	if($arItem["DEPTH_LEVEL"] > $arParams["MAX_LEVEL"])
	{
		unset($arResult[$key]);
		continue;
	}

	$arItem["PARAMS"]["item_id"] = crc32($arItem["LINK"].$key);


	if ($arItem["DEPTH_LEVEL"] == "1")
	{
		$arMenuItemsIDs[$arItem["PARAMS"]["item_id"]] = array();
		if ($arItem["IS_PARENT"])
		{
			$curItemLevel_1 = $arItem["PARAMS"]["item_id"];
		}
		$arAllItems[$arItem["PARAMS"]["item_id"]] = $arItem;
	}
	elseif($arItem["DEPTH_LEVEL"] == "2")
	{
		$arMenuItemsIDs[$curItemLevel_1][$arItem["PARAMS"]["item_id"]] = array();
		if ($arItem["IS_PARENT"])
		{
			$curItemLevel_2 = $arItem["PARAMS"]["item_id"];
		}
		$arAllItems[$arItem["PARAMS"]["item_id"]] = $arItem;
	}
	elseif($arItem["DEPTH_LEVEL"] == "3")
	{
		$arMenuItemsIDs[$curItemLevel_1][$curItemLevel_2][] = $arItem["PARAMS"]["item_id"];
		$arAllItems[$arItem["PARAMS"]["item_id"]] = $arItem;
	}
}


$arMenuStructure = array();
foreach ($arMenuItemsIDs as $itemIdLevel_1=>$arLevels2)
{
	$countItemsInRow = 200;
	$arMenuStructure[$itemIdLevel_1] = array();
	$countLevels2 = count($arLevels2);

	if ($countLevels2 > 0)
	{
		for ($i=1; $i<=3; $i++)
		{
			$sumElementsInRow = 0;
			foreach($arLevels2 as $itemIdLevel_2=>$arLevels3)
			{
				$sumElementsInRow+= count($arLevels3) + 1;
				$arMenuStructure[$itemIdLevel_1][$i][$itemIdLevel_2] = $arLevels3;
				if ($sumElementsInRow > $countItemsInRow)
					$countItemsInRow = $sumElementsInRow;

				unset($arLevels2[$itemIdLevel_2]);
				$tmpCount = 0;
				foreach($arLevels2 as $tmpItemIdLevel_2=>$arTmpLevels3)
				{
					$tmpCount+= 1 + count($arTmpLevels3);
				}

				if ($tmpCount <= $countItemsInRow*(3-$i) && $countItemsInRow<=$sumElementsInRow)
					break;
			}
		}
	}
}

$arResult = array();
$arResult["ALL_ITEMS"] = $arAllItems;
$arResult["MENU_STRUCTURE"] = $arMenuStructure;


$elementsQuery = \Bitrix\Iblock\Elements\ElementBannerMegaMenuTable::query() 
        ->setSelect(
			[
				'ID', 
				'IBLOCK_ID',
				'NAME', 
				'PREVIEW_PICTURE', 
				'PREVIEW_TEXT', 
				'LINK'
			]) 
        ->setFilter(['=ACTIVE' => 'Y'])
        ->setOrder(['ID' => 'DESC'])
        ->setLimit(1)
		->cacheJoins(true)
        ->setCacheTtl(86400);
    
$elementsResult = $elementsQuery->exec();

while ($element = $elementsResult->fetchObject()) {

	$arResult['BANNERS'][] = [
		'ID' => $element->getId(),
		'NAME' => $element->getName(),
		'PREVIEW_PICTURE' => CFile::ResizeImageGet($element->getPreviewPicture(), array('width'=>310, 'height'=>426), BX_RESIZE_IMAGE_PROPORTIONAL),
		'PREVIEW_TEXT' => $element->getPreviewText(),
		'LINK' => $element->getLink()?->getValue(),
	];

}