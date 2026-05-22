<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Вы можете сдать анализы по полису добровольного медицинского страхования (ДМС) в сети медицинских лабораторий «ТАФИ». Записаться на исследование, узнать стоимость и ознакомиться с информацией можно на сайте «ТАФИ-Диагностика»");
$APPLICATION->SetPageProperty("title", "Обзоры");
$APPLICATION->SetTitle("Приемы врачей, диагностика и сдача анализов по ДМС");
$setDesc = 'Услуги врачей, прохождение диагностики, сдачу анализов можно выполнить по полису добровольного медицинского страхования (ДМС). Чтобы воспользоваться полисом ДМС:';
?><style>
        .topic__heading{
            margin-top: 19px;
        }
        .grey_block .page-top>div:last-of-type{
            margin-bottom: 0;
        }
        .header__description{
            margin-top: 16px;
            max-width: 585px;
            color: rgb(119, 119, 119);
            font-family: Montserrat;
            font-size: 14px;
            font-weight: 400;
            line-height: 150%;
            text-align: left;
        }
        @media (max-width: 380px) {
            .topic__heading h1{
                display: block !important;
                width: 325px;
            }
        }
        #pagetitle{
            color: rgb(51, 51, 51);
            font-family: Montserrat;
            font-size: 32px;
            font-weight: 700;
            line-height: 130%;
            text-align: left;
        }
    </style>
    </div>
    </div>
    </div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"tizer_dmc",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CENTERED" => "Y",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "aspro_max_content",
		"INCLUDE_FILE" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"MOBILE_TEMPLATE" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "736",
		"PARENT_SECTION_CODE" => "736",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SIZE_IN_ROW" => "3",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TYPE_IMG" => "top"
	)
);?>
<div class="middle">
	<div class="container">
		<div class="maxwidth-theme">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"dmc_companys", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CENTERED" => "Y",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "dmc_companys",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"HIDE_SECTION_NAME" => "N",
		"IBLOCK_ID" => "75",
		"IBLOCK_TYPE" => "aspro_max_content",
		"IMAGE_POSITION" => "left",
		"INCLUDE_FILE" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"MOBILE_TEMPLATE" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"SALE_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"SIZE_IN_ROW" => "4",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"S_ASK_QUESTION" => "",
		"S_ORDER_SERVICE" => "",
		"TYPE_IMG" => "top",
		"T_DOCS" => "",
		"T_GALLERY" => "",
		"T_GOODS" => "",
		"T_PROJECTS" => "",
		"T_REVIEWS" => "",
		"T_SERVICES" => "",
		"T_STAFF" => "",
		"USE_SHARE" => "N"
	),
	false
);?>
		</div>
	</div>
</div>
<div class="info-companys__wrapper_desktop">
	<div class="container">
		<div class="rows_info-companys">
			<div class="info-companys__header">
				<div class="info-companys__header_title">
					<h3>Информация для представителей страховых компаний</h3>
				</div>
				<div class="info-companys__header_description">
					<p>
						 Если вы не нашли вашу компанию в списке наших партнеров выше и хотите заключить договор, отправьте ваши предложения на почту <a href="mailto:dms@tafimed.ru">dms@tafimed.ru</a>
					</p>
				</div>
			</div>
			<div class="right-block_nfo-companys">
				<img src="<?=SITE_TEMPLATE_PATH. '/images/info-companys-bgs.png'?>" alt="">
			</div>
		</div>
	</div>
</div>
<div class="info-companys__wrapper">
	<div class="container">
		<div>
			<div class="info-companys__header">
				<div class="info-companys__header_title">
					<h3>Информация для представителей страховых компаний</h3>
				</div>
				<div class="info-companys__header_description">
					<p>
						 Если вы не нашли вашу компанию в списке наших партнеров выше и хотите заключить договор, отправьте ваши предложения на почту <a href="mailto:dms@tafimed.ru">dms@tafimed.ru</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
    <script>
        const headerBlock = document.querySelector('.topic__heading');
        const descDiv = document.createElement('div');
        descDiv.className = 'header__description';
        descDiv.textContent = '<?=$setDesc?>';
        headerBlock.appendChild(descDiv);
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>