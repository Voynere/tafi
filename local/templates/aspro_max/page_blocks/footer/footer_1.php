<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
global $arTheme;
$bPrintButton = isset($arTheme['PRINT_BUTTON']) ? ($arTheme['PRINT_BUTTON']['VALUE'] == 'Y' ? true : false) : false;
?>

<div class="main-footer white-section">

	<div class="maxwidth-theme">

		<div class="main-footer__row">
		
			<div class="main-footer__col main-footer__col--left">

				<div class="main-footer__logo">
					<?=CMax::ShowLogo();?>
				</div>


				<div class="main-footer__copyright">

					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/copy/copyright.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "Copyright",
							"TEMPLATE" => "include_area.php",
						)
					); ?>

				</div>

				
				<div class="main-footer__offer-public">	
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/public_offer.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "offer",
							"TEMPLATE" => "include_area.php",
						)
					); ?>
				</div>

				<div class="main-footer__copyright2">
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/copy/copyright2.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "Copyright2",
							"TEMPLATE" => "include_area.php",
						)
					); ?>
				</div>

			</div>

			<div class="main-footer__col main-footer__col--center">

				<div class="main-footer__section">

					<div class="main-footer__section-title">Услуги</div>	

					<div class="main-footer__section-body">
						<? $APPLICATION->IncludeComponent(
			"bitrix:menu", 
			"bottom", 
								array(
									"ROOT_MENU_TYPE" => "bottom_info",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "36000",
									"MENU_CACHE_USE_GROUPS" => "N",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MAX_LEVEL" => "2",
									"CHILD_MENU_TYPE" => "left",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "Y",
									"COMPONENT_TEMPLATE" => "bottom",
									"COMPOSITE_FRAME_MODE" => "A",
									"COMPOSITE_FRAME_TYPE" => "AUTO"
								),
								false
							); ?>
					</div>

				</div>	

				<div class="main-footer__section">

					<div class="main-footer__section-title">Компания</div>	

					<div class="main-footer__section-body">

						<? $APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"bottom", 
							array(
								"ROOT_MENU_TYPE" => "bottom_company",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "2",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "Y",
								"COMPONENT_TEMPLATE" => "bottom",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO"
							),
							false
						); ?>

					</div>

				</div>	

			
			</div>

			<div class="main-footer__col main-footer__col--right">

				<div class="main-footer__section main-footer__section--contacts">

					<div class="main-footer__section-title">Контакты</div>	

					<div class="main-footer__section-body">

						<div class="main-footer__contacts">

							<div class="main-footer__social">
								<? $APPLICATION->IncludeComponent("aspro:social.info.max", "footer", Array(
									"CACHE_TYPE" => "A",	// Тип кеширования
										"CACHE_TIME" => "3600000",	// Время кеширования (сек.)
										"CACHE_GROUPS" => "N",	// Учитывать права доступа
										"COMPONENT_TEMPLATE" => ".default"
									),
									false
								); ?>
							</div>

							<div class="main-footer__phone">
								 <?$APPLICATION->IncludeFile(
							"/include/phone_footer.php",
							Array(),
							Array("MODE" => "html", "NAME" => "Телефон"));?>
							
							</div>

							<div class="main-footer__email">
								 <?$APPLICATION->IncludeFile(
								"/include/email_footer.php",
								Array(),
								Array("MODE" => "html", "NAME" => "Email"));?>
								
							</div>

							<div class="main-footer__btn-feedback-wrap">
								<span class="main-footer__btn-feedback" data-event="jqm" data-param-form_id="SIMPLE_FORM_13" data-name="SIMPLE_FORM_13">Написать директору</span>	
							</div>

						</div>
					</div>

				</div>
				
				<div class="main-footer__section">

					<div class="main-footer__section-title">Юридическая информация</div>	

					<div class="main-footer__section-body">
						<? $APPLICATION->IncludeComponent("bitrix:menu", "bottom-legal", Array(
							"ROOT_MENU_TYPE" => "legal_information",	// Тип меню для первого уровня
								"MENU_CACHE_TYPE" => "A",	// Тип кеширования
								"MENU_CACHE_TIME" => "36000",	// Время кеширования (сек.)
								"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
								"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
								"MAX_LEVEL" => "2",	// Уровень вложенности меню
								"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
								"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
								"DELAY" => "N",	// Откладывать выполнение шаблона меню
								"ALLOW_MULTI_SELECT" => "Y",	// Разрешить несколько активных пунктов одновременно
								"COMPONENT_TEMPLATE" => "bottom",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO"
							),
							false
						); ?>
					</div>

				</div>	



				
			</div>
		</div>

		<div class="main-footer__copyright-block-m">

				
				<div class="main-footer__offer-public">	
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/public_offer.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "offer",
							"TEMPLATE" => "include_area.php",
						)
					); ?>
				</div>

				<div class="main-footer__copyright2">
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/copy/copyright2.php",
						array(),
						array(
							"MODE" => "php",
							"NAME" => "Copyright2",
							"TEMPLATE" => "include_area.php",
						)
					); ?>
				</div>
		</div>

	</div>

</div>	