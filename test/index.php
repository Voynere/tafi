<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\EventManager,
	Dompdf\Dompdf,
	Dompdf\Options;
	
	use Bitrix\Main\Diag\Debug;

$APPLICATION->SetTitle("Test");
$directory = '/upload/tmp/';
$fileName = 'order_.pdf';
$pathToFile = $directory . $fileName;

$entityDirectory = new \Bitrix\Main\IO\Directory(\Bitrix\Main\Application::getDocumentRoot() . $directory);

$options = new Options();
$options->set('tempDir', $directory);
$options->set('chroot', \Bitrix\Main\Application::getDocumentRoot());
$dompdf = new Dompdf($options);
$arFields['ORDER_USER'] = 'Ждёмся';
$html = "<html lang='ru'>

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<style>
		body {
			font-family: 'DejaVu Sans', sans-serif;
			font-size: 14px;
			color: #000;
		}
	</style>
</head>

<body>
	<table cellpadding='0' cellspacing='0' style='background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;' border='1' bordercolor='#d1d1d1'>
		<tbody>
			<tr>
				<td height='83' bgcolor='#eaf3f5' style='border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;'>
					<table cellpadding='0' cellspacing='0' width='100%'>
						<tbody>
							<tr>
								<td bgcolor='#ffffff' height='75' style='font-weight: bold; text-align: center; font-size: 26px; color: #0b3961;'>
									Сеть медицинских лабораторий «ТАФИ – Диагностика»
								</td>
							</tr>
							<tr>
								<td bgcolor='#bad3df' height='11'>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td bgcolor='#f7f7f7' valign='top' style='border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;'>
					<p style='margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;'>
						Уважаемый(ая) {$arFields['ORDER_USER']}
						</p>
					<p style='margin-top: 0; margin-bottom: 20px; line-height: 20px;'>
						<br>
						Для Вас сформирован предварительный расчет стоимости исследований номер" . $arFields['ORDER_ID'] . ". Окончательное оформление производится при посещении сети медицинских лабораторий «ТАФИ-Диагностика».<br>"

						. $arFields['OL_BASKET_TABLE'] . "<br"
						. $arFields['OL_USER_DESCRIPTION'] .
					"</p>
					<br>
					<b>Стоимость заказа:</b>" . $arFields['PRICE'] . ".<br>
					</p>
					<h5>Ждем Вас в наших филиалах по адресам: </h5>
					<ul>
						• Владивосток, ул. Садовая, 25б,<br>
						• Владивосток, ул. Трамвайная, 14а,<br>
						• Владивосток, Океанский пр-т, 48а,<br>
						• Владивосток, ул. Новоивановская, 2б,<br>
						• Владивосток, пр. 100 лет Владивостоку, 60,<br>
						• Владивосток, ул. Сахалинская, 40а,<br>
						• Владивосток, ул. Казанская, 7,<br>
						• Владивосток, ул. Русская, 55а,<br>
						• Владивосток, ул. Нейбута, 8 г,<br>
						• Владивосток, ул. Калинина, 45,<br>
						• Владивосток, ул. Сочинская, 9 ,<br>
						• Владивосток, ул. Калинина, 283а,<br>
						• Трудовое, ул. Лермонтова, 68,<br>
						• Артём, ул. Кооперативная, 4,<br>
						• Уссурийск, ул. Пионерская,19,<br>
						• Находка, ул. Школьная, 2,<br>
						• Арсеньев, пр. Горького, 28,<br>
						• Славянка, ул. Героев Хасана, 9а,<br>
						• Большой Камень, ул. Маслакова, 10.<br>
					</ul>
					<p>
						Оплата производится наличными деньгами или банковской картой на месте. Не забудьте ознакомиться с <a href='http://tafimed.ru/help/'>правилами подготовки</a> к сдаче анализов на нашем сайте.
					</p>
					<p>
						Если у Вас есть вопросы, мы с радостью на них ответим по номеру справочной службы: <br>
					</p>
					<h3><b><a href='tel:+74232425660'>+7 (423) 242-56-60</a></b></h3>
					<p>
					</p>
					<p>
						С уважением,<br>
						Сеть медицинских лабораторий «ТАФИ-Диагностика»<br>
						E-mail: <a href='mailto:order@tafimed.ru'> order@tafimed.ru </a>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>";


$dompdf->loadHtml($html);
$dompdf->setPaper('A3', 'portrait');
$dompdf->render();
$output = $dompdf->output();

if (!$entityDirectory->isExists()) $entityDirectory->createDirectory(\Bitrix\Main\Application::getDocumentRoot() . $directory);

file_put_contents(\Bitrix\Main\Application::getDocumentRoot() . $pathToFile, $output);
?><?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"landings_block",
	Array(
		"ADD_DETAIL_TO_SLIDER" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_FILTER_CATALOG" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALT_TITLE_GET" => "NORMAL",
		"BG_POSITION" => "top left",
		"BLOCK_BLOG_NAME" => "",
		"BLOCK_BRANDS_NAME" => "",
		"BLOCK_LANDINGS_NAME" => "",
		"BLOCK_NEWS_NAME" => "",
		"BLOCK_PARTNERS_NAME" => "",
		"BLOCK_PROJECTS_NAME" => "",
		"BLOCK_REVIEWS_NAME" => "",
		"BLOCK_SERVICES_NAME" => "",
		"BLOCK_STAFF_NAME" => "",
		"BLOCK_TIZERS_NAME" => "",
		"BLOCK_VACANCY_NAME" => "",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"CONVERT_CURRENCY" => "N",
		"COUNT_IN_LINE" => "3",
		"DEFAULT_LIST_TEMPLATE" => "block",
		"DEPTH_LEVEL_BRAND" => "2",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_BLOCKS_ALL_ORDER" => "tizers,preview_text,char,docs,services,news,vacancy,blog,projects,brands,staff,gallery,partners,form_order,landings,reviews,goods_sections,goods,goods_catalog,desc,comments",
		"DETAIL_BLOG_USE" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FB_USE" => "N",
		"DETAIL_FIELD_CODE" => array("",""),
		"DETAIL_LINKED_GOODS_SLIDER" => "Y",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array("",""),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_VK_USE" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_WISH_BUTTONS" => "Y",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"GALLERY_PRODUCTS_PROPERTY" => "PHOTOS",
		"GALLERY_TYPE" => "small",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_CATALOG_ID" => "1",
		"IBLOCK_CATALOG_TYPE" => "-",
		"IBLOCK_ID" => "",
		"IBLOCK_LINK_BLOG_ID" => "",
		"IBLOCK_LINK_BRANDS_ID" => "",
		"IBLOCK_LINK_LANDINGS_ID" => "",
		"IBLOCK_LINK_NEWS_ID" => "",
		"IBLOCK_LINK_PARTNERS_ID" => "",
		"IBLOCK_LINK_PROJECTS_ID" => "",
		"IBLOCK_LINK_REVIEWS_ID" => "",
		"IBLOCK_LINK_SERVICES_ID" => "",
		"IBLOCK_LINK_STAFF_ID" => "",
		"IBLOCK_LINK_TIZERS_ID" => "",
		"IBLOCK_LINK_VACANCY_ID" => "",
		"IBLOCK_TYPE" => "aspro_max_catalog",
		"IMAGE_POSITION" => "left",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LINKED_ELEMENST_PAGE_COUNT" => "20",
		"LINKED_PRODUCTS_PROPERTY" => "BRAND",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array("",""),
		"LIST_PROPERTY_CATALOG_CODE" => array("",""),
		"LIST_PROPERTY_CODE" => array("",""),
		"LIST_VIEW" => "slider",
		"MAX_GALLERY_GOODS_ITEMS" => "5",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"ONLY_ELEMENT_DISPLAY_VARIANT" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PRICE_CODE" => array("",""),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_1",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ARTICLE_SKU" => "N",
		"SHOW_COUNT_ELEMENTS" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
		"SHOW_DISCOUNT_TIME" => "Y",
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
		"SHOW_GALLERY" => "Y",
		"SHOW_GALLERY_GOODS" => "Y",
		"SHOW_ICONS_SECTION" => "N",
		"SHOW_LINKED_PRODUCTS" => "N",
		"SHOW_MEASURE" => "N",
		"SHOW_MEASURE_WITH_RATIO" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_ONE_CLICK_BUY" => "Y",
		"SHOW_RATING" => "Y",
		"SHOW_UNABLE_SKU_PROPS" => "Y",
		"SIDE_LEFT_BLOCK" => "FROM_MODULE",
		"SIDE_LEFT_BLOCK_DETAIL" => "FROM_MODULE",
		"SIZE_IN_ROW" => "4",
		"SORT_BUTTONS" => array("POPULARITY","NAME","PRICE"),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STAFF_TYPE_DETAIL" => "list",
		"STORES" => array("",""),
		"STRICT_SECTION_CHECK" => "N",
		"TYPE_LEFT_BLOCK" => "FROM_MODULE",
		"TYPE_LEFT_BLOCK_DETAIL" => "FROM_MODULE",
		"T_GALLERY" => "",
		"T_GOODS" => "",
		"T_GOODS_SECTION" => "",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"USE_SUBSCRIBE_IN_TOP" => "N",
		"VARIABLE_ALIASES" => Array("ELEMENT_ID"=>"ELEMENT_ID","SECTION_ID"=>"SECTION_ID")
	)
);?><? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>