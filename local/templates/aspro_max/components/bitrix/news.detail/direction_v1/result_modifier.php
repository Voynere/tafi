<?
use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

if(!empty($arResult['PROPERTIES']['PROP_DOCTORS']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_DOCTORS']['LINK_IBLOCK_ID'];
    $doctorIds = [];

    foreach ($arResult['PROPERTIES']['PROP_DOCTORS']['VALUE'] as $doctorId) {
        $doctorIds[] = $doctorId;
    }

    $res = CIBlockElement::GetList(
        ['SORT' => 'ASC'], 
        ['ID' => $doctorIds, 'IBLOCK_ID' => $iblockId], 
        false, 
        [], 
        ['ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_PROP_POSITION', 'PROPERTY_PROP_EXPERIENCE', 'PROPERTY_PROP_ADDRESS', 'PROPERTY_PROP_APPOINTMENT_LINK']
    );

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arResult['PROPERTIES']['PROP_DOCTORS']['LIST'][$arFields['ID']] = $arFields;
        $arResult['PROPERTIES']['PROP_DOCTORS']['LIST'][$arFields['ID']]['PREVIEW_PICTURE_SRC'] = CFile::GetPath($arResult['PROPERTIES']['PROP_DOCTORS']['LIST'][$arFields['ID']]['PREVIEW_PICTURE']);
    }
}

if(!empty($arResult['PROPERTIES']['PROP_PRICES_LIST']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_PRICES_LIST']['LINK_IBLOCK_ID'];
    $priceIds = [];

    foreach ($arResult['PROPERTIES']['PROP_PRICES_LIST']['VALUE'] as $priceId) {
        $priceIds[] = $priceId;
    }

    $dbItems = \Bitrix\Iblock\ElementTable::getList(array(
        'order' => ['SORT' => 'ASC'],
        'select' => ['ID', 'NAME', '*', 'PRICE_' => 'PRICE'],
        'filter' => ['ID' => $priceIds, 'IBLOCK_ID' => $iblockId],
        'runtime' => [
            new \Bitrix\Main\Entity\ReferenceField(
                'PRICE',
                '\Bitrix\Catalog\PriceTable',
                ['=this.ID' => 'ref.PRODUCT_ID'],
                ['join_type' => 'LEFT']
            )
        ]
    ))->fetchAll();

    foreach ($dbItems as $priceKey => $price) {
        $arResult['PROPERTIES']['PROP_PRICES_LIST']['LIST'][$priceKey] = $price;
        $number = floatval($price['PRICE_PRICE']);
        if ($number == intval($number)) {
            $arResult['PROPERTIES']['PROP_PRICES_LIST']['LIST'][$priceKey]['PRICE_PRICE'] = number_format($number, 0, '', ' ');
        } else {
            $arResult['PROPERTIES']['PROP_PRICES_LIST']['LIST'][$priceKey]['PRICE_PRICE'] = number_format($number, 2, ',', ' ');
        }
    }
}

if(!empty($arResult['PROPERTIES']['PROP_FAQ_LIST']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_FAQ_LIST']['LINK_IBLOCK_ID'];
    $faqIds = [];

    foreach ($arResult['PROPERTIES']['PROP_FAQ_LIST']['VALUE'] as $faqId) {
        $faqIds[] = $faqId;
    }

    $dbItems = \Bitrix\Iblock\Elements\ElementFaqTable::getList(array(
        'order' => ['SORT' => 'ASC'],
        'select' => ['ID', 'NAME', 'PREVIEW_TEXT'],
        'filter' => ['ID' => $faqIds, 'IBLOCK_ID' => $iblockId],
    ))->fetchAll();

    foreach ($dbItems as $faqKey => $faq) {
        $arResult['PROPERTIES']['PROP_FAQ_LIST']['LIST'][$faqKey] = $faq;
    }
}

if(!empty($arResult['PROPERTIES']['PROP_ARTICLES_LIST']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LINK_IBLOCK_ID'];
    $articlesIds = [];

    foreach ($arResult['PROPERTIES']['PROP_ARTICLES_LIST']['VALUE'] as $articleId) {
        $articlesIds[] = $articleId;
    }

    $dbItems = \Bitrix\Iblock\Elements\ElementArticlesTable::getList(array(
        'order' => ['SORT' => 'ASC'],
        'select' => ['ID', 'NAME', 'PREVIEW_PICTURE', 'ACTIVE_FROM', 'CODE'],
        'filter' => ['ID' => $articlesIds, 'IBLOCK_ID' => $iblockId],
    ))->fetchAll();

    foreach ($dbItems as $articleKey => $article) {
        $arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LIST'][$articleKey] = $article;
        $arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LIST'][$articleKey]['LINK'] = $arResult['PROPERTIES']['PROP_ARTICLES_LINK']['VALUE'] . $article['CODE'] . '/';
        $arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LIST'][$articleKey]['PREVIEW_PICTURE_SRC'] = CFile::GetPath($arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LIST'][$articleKey]['PREVIEW_PICTURE']);

        $timestamp = MakeTimeStamp($article['ACTIVE_FROM'], "DD.MM.YYYY HH:MI:SS");

        $arResult['PROPERTIES']['PROP_ARTICLES_LIST']['LIST'][$articleKey]['DATE'] = FormatDate("j F Y", $timestamp);
    }
}

if(!empty($arResult['PROPERTIES']['PROP_LIST']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_LIST']['LINK_IBLOCK_ID'];
    $linksIds = [];

    foreach ($arResult['PROPERTIES']['PROP_LIST']['VALUE'] as $linksId) {
        $linksIds[] = $linksId;
    }

    $dbItems = CIBlockElement::GetList(
        ['SORT' => 'ASC'],
        ['ID' => $linksIds, 'IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'],
        false,
        false,
        ['ID', 'NAME', 'DETAIL_PAGE_URL']
    );

    $result = [];
    while ($item = $dbItems->GetNext()) {
        $result[] = $item;
    }

    foreach ($result as $linkKey => $link) {
        $arResult['PROPERTIES']['PROP_LIST']['LIST'][$linkKey] = $link;
    }
}

if(!empty($arResult['PROPERTIES']['PROP_ACCORD_LIST']['VALUE']) && Loader::includeModule('iblock'))
{
    $iblockId = $arResult['PROPERTIES']['PROP_ACCORD_LIST']['LINK_IBLOCK_ID'];
    $accIds = [];

    foreach ($arResult['PROPERTIES']['PROP_ACCORD_LIST']['VALUE'] as $accId) {
        $accIds[] = $accId;
    }

    $dbItems = \Bitrix\Iblock\Elements\ElementXraytypesTable::getList(array(
        'order' => ['SORT' => 'ASC'],
        'select' => ['ID', 'NAME', 'PREVIEW_TEXT'],
        'filter' => ['ID' => $accIds, 'IBLOCK_ID' => $iblockId],
    ))->fetchAll();

    foreach ($dbItems as $accKey => $acc) {
        $arResult['PROPERTIES']['PROP_ACCORD_LIST']['LIST'][$accKey] = $acc;
    }
}

//dump($_SERVER)

?>