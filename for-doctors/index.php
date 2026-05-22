<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Информация для врачей");
?>
<div class="for-doctors">
	<div class="for-doctors__information">
		<div class="for-doctors__text-block">
			<h1 class="for-doctors__title"><? $APPLICATION->ShowTitle() ?></h1>
			<div class="for-doctors__description">
				<? $APPLICATION->IncludeFile(
					SITE_DIR . '/for-doctors/include/information.php',
					[], // Передаваемый параметры
					['MODE' => 'php'] // text, html, php
				); ?>
			</div>
		</div>
		<div class="for-doctors__picture">
			<img src="include/information.jpg" alt="Информация для врачей">
		</div>
	</div>
	<div class="for-doctors__news">
		<div class="title-block">
			<h2 class="title-block__title">Новости и новинки</h2>
			<a href="/company/news/" class="title-block__link-to-all">
				Все новости
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10 16L14 12L10 8" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
		</div>
		<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front_news_2", 
	array(
		"IBLOCK_TYPE" => "aspro_max_content",
		"IBLOCK_ID" => "20",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DATE_ACTIVE_FROM",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "PERIOD",
			1 => "REDIRECT",
			2 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "news-for-doctors",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "ajax",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "front_news_2",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"TITLE_BLOCK" => "Новости",
		"TITLE_BLOCK_ALL" => "Все новости",
		"ALL_URL" => "company/news/",
		"SIZE_IN_ROW" => "4",
		"TYPE_IMG" => "md",
		"SHOW_SUBSCRIBE" => "Y",
		"BG_POSITION" => "top left",
		"TITLE_SUBSCRIBE" => "Подписаться",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"IS_AJAX" => CMax::checkAjaxRequest(),
		"MOBILE_TEMPLATE" => $GLOBALS["arTheme"]["MOBILE_NEWS"]["VALUE"],
		"CHECK_REQUEST_BLOCK" => CMax::checkRequestBlock("news"),
		"MESSAGE_404" => "",
		"INCLUDE_FILE" => "",
		"SHOW_SECTION_NAME" => "N",
		"HALF_BLOCK" => "N",
		"ALL_BLOCK_BG" => "N",
		"BORDERED" => "N",
		"FON_BLOCK_2_COLS" => "N",
		"USE_BG_IMAGE_ALTERNATE" => "N",
		"TITLE_SHOW_FON" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
	</div>
	<div class="for-doctors__advantages">
		<div class="title-block">
			<h2 class="title-block__title">Преимущества работы с «ТАФИ»</h2>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"front_tizers_2",
			array(
				"IBLOCK_TYPE" => "aspro_max_content",
				"IBLOCK_ID" => "10",
				"NEWS_COUNT" => "6",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(
					0 => "PREVIEW_TEXT",
					1 => "PREVIEW_PICTURE",
					2 => "DETAIL_PICTURE",
					3 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "ICON",
					2 => "URL",
					3 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "250",
				"ACTIVE_DATE_FORMAT" => "d F Y",
				"SET_TITLE" => "N",
				"SHOW_DETAIL_LINK" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "information-for-doctors",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "ajax",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
				"PAGER_SHOW_ALL" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"COMPONENT_TEMPLATE" => "front_tizers_2",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"STRICT_SECTION_CHECK" => "N",
				"TYPE_IMG" => "top",
				"CENTERED" => "Y",
				"SIZE_IN_ROW" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => "",
				"MOBILE_TEMPLATE" => "N",
				"INCLUDE_FILE" => "",
				"TITLE_BLOCK" => "Новости",
				"TITLE_BLOCK_ALL" => "Все новости",
				"ALL_URL" => "sale/",
				"VIEW_TYPE" => "grey_pict",
				"BG_POSITION" => "top left",
				"NO_MARGIN" => "N",
				"FILLED" => "N"
			),
			false
		); ?>
	</div>
	<div class="for-doctors__reviews">
		<div class="title-block">
			<h2 class="title-block__title">Отзывы врачей</h2>
			<div class="title-block__left">
				<span class="title-block__form-call-button animate-load" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.03117 10.7812L3.90625 13.9062V10.7812H2.34375C1.48082 10.7812 0.78125 10.0817 0.78125 9.21875V2.96875C0.78125 2.10582 1.48082 1.40625 2.34375 1.40625H11.7188C12.5817 1.40625 13.2812 2.10582 13.2812 2.96875V9.21875C13.2812 10.0817 12.5817 10.7812 11.7188 10.7812H7.03117Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M8.4375 13.9062C8.4375 14.7692 9.13707 15.4688 10 15.4688H13.1251L16.25 18.5938V15.4688H17.6562C18.5192 15.4688 19.2188 14.7692 19.2188 13.9062V7.65625C19.2188 6.79332 18.5192 6.09375 17.6562 6.09375H16.0938" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
						<circle cx="3.90625" cy="6.09375" r="0.78125" fill="white" />
						<circle cx="7.03125" cy="6.09375" r="0.78125" fill="white" />
						<circle cx="10.1562" cy="6.09375" r="0.78125" fill="white" />
					</svg>
					Оставить отзыв
				</span>
				<a class="title-block__link-to-all" target="_blank" href="/company/reviews/">
					Все отзывы
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10 16L14 12L10 8" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</a>
			</div>
		</div>
		<? $forDoctor = ["PROPERTY_SHOW_IN_FOR_DOCTOR_VALUE" => "Y"];
		$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"for-doctors_reviews",
			array(
				'IBLOCK_TYPE' => 'aspro_max_content',
				'IBLOCK_ID' => 19,
				'NEWS_COUNT' => 20,
				'SORT_BY1' => 'ACTIVE_FROM',
				'FILTER_NAME' => 'forDoctor',
				'SORT_ORDER1' => 'DESC',
				'SORT_BY2' => 'ID',
				'SORT_ORDER2' => 'DESC',
				'FIELD_CODE' => array(
					'NAME',
					'PREVIEW_TEXT',
					'PREVIEW_PICTURE',
					'DETAIL_TEXT',
					'DETAIL_PICTURE',
					'DATE_ACTIVE_FROM',
				),
				'PROPERTY_CODE' => array(
					'POST',
					'VIDEO',
					'STAFF',
					'RATING',
					'COMPANY_RESPONSE',
					'NAME',
					'MESSAGE',
					'FILE',
				),
				'AJAX_MODE' => 'N',
				'AJAX_OPTION_JUMP' => 'N',
				'AJAX_OPTION_STYLE' => 'Y',
				'AJAX_OPTION_HISTORY' => 'N',
				'CACHE_TYPE' => 'A',
				'CACHE_TIME' => 100000,
				'CACHE_FILTER' => 'N',
				'CACHE_GROUPS' => 'N',
				'PREVIEW_TRUNCATE_LEN' => '',
				'ACTIVE_DATE_FORMAT' => 'd.m.Y',
				'DISPLAY_PANEL' => '',
				'SET_TITLE' => 'N',
				'SHOW_DETAIL_LINK' => 'N',
				'SET_STATUS_404' => 'Y',
				'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
				'ADD_SECTIONS_CHAIN' => 'N',
				'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
				'CHECK_DATES' => 'Y',
				'PARENT_SECTION' => '',
				'PARENT_SECTION_CODE' => '',
				'DISPLAY_TOP_PAGER' => 'N',
				'DISPLAY_BOTTOM_PAGER' => 'Y',
				'PAGER_SHOW_ALWAYS' => 'N',
				'PAGER_DESC_NUMBERING' => 'N',
				'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
				'PAGER_SHOW_ALL' => 'N',
				'DISPLAY_DATE' => '',
				'DISPLAY_NAME' => 'N',
				'DISPLAY_PICTURE' => '',
				'DISPLAY_PREVIEW_TEXT' => '',
				'USE_PERMISSIONS' => 'N',
				'GROUP_PERMISSIONS' => '',
				'SHOW_SECTION_PREVIEW_DESCRIPTION' => 'Y',
				'AJAX_OPTION_ADDITIONAL' => '',
				'SET_BROWSER_TITLE' => 'N',
				'SET_LAST_MODIFIED' => 'N',
				'INCLUDE_SUBSECTIONS' => 'Y',
				'STRICT_SECTION_CHECK' => 'N',
				'TITLE_BLOCK' => '',
				'TITLE_BLOCK_ALL' => '',
				'SHOW_ADD_REVIEW' => '',
				'TITLE_ADD_REVIEW' => '',
				'ALL_URL' => '',
				'PAGER_BASE_LINK_ENABLE' => 'N',
				'SHOW_404' => 'Y',
				'NOT_SLIDER' => 'N',
				'SIZE_IN_ROW' => '3'
			),
			$component
		); ?>
	</div>
	<div class="for-doctors__form">
		<? $APPLICATION->IncludeComponent(
			"bitrix:form.result.new",
			"we-invite-you-work",
			array(
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"CHAIN_ITEM_LINK" => "",
				"CHAIN_ITEM_TEXT" => "",
				"DESCRIPTION" => "",
				"EDIT_URL" => "result_edit.php",
				"SUCCESSFUL_RESULT_SEPARATE_WINDOW" => "N",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"LIST_URL" => "result_list.php",
				"NAME_FORM_CALL_BUTTON" => "",
				"OPEN_FORM_IN_MODAL_WINDOW" => "N",
				"SEF_MODE" => "N",
				"SUCCESS_URL" => "",
				"TITLE" => "",
				"USER_CONSENT" => "Y",
				"USER_CONSENT_ID" => "2",
				"USER_CONSENT_IS_CHECKED" => "N",
				"USER_CONSENT_IS_LOADED" => "N",
				"USE_EXTENDED_ERRORS" => "N",
				"WEB_FORM_ID" => "15",
				"COMPONENT_TEMPLATE" => "we-invite-you-work",
				"TITLE_SUCCESSFUL_RESULT" => "Спасибо!",
				"DESCRIPTION_SUCCESSFUL_RESULT" => "В ближайшее время с вами свяжется администратор для уточнения деталей",
				"TITLE_FAILURE_RESULT" => "Ошибка",
				"DESCRIPTION_FAILURE_RESULT" => "Попробуйте ещё раз",
				"VARIABLE_ALIASES" => array(
					"WEB_FORM_ID" => "WEB_FORM_ID",
					"RESULT_ID" => "RESULT_ID",
				)
			),
			false
		); ?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
