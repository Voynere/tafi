<div class="mobilemenu-v1 scroller">
	<div class="wrap">


		<div class="mobilemenu-v1__top">

			<div class="mobilemenu-v1__close">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 11L11 1M1 1L11 11" stroke="#5A616C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="mobilemenu-v1__logo">
                <?=CMax::ShowLogo();?>
            </div>
            
        </div>

		<?$APPLICATION->IncludeComponent(
			"itb:multidomain.city.list",
			"mobile",
			Array(
				"COMPONENT_TEMPLATE" => "mobile"									
			)
		);?>
		<?if(CMax::nlo('menu-mobile', 'class="loadings" style="height:47px;"')):?>
		<!-- noindex -->
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top_mobile",
			Array(
				"COMPONENT_TEMPLATE" => "top_mobile",
				"MENU_CACHE_TIME" => "3600000",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(
				),
				"DELAY" => "N",
				"MAX_LEVEL" => \Bitrix\Main\Config\Option::get("aspro.max", "MAX_DEPTH_MENU", 2),
				"ALLOW_MULTI_SELECT" => "Y",
				"ROOT_MENU_TYPE" => "top_content_multilevel",
				"CHILD_MENU_TYPE" => "left",
				"CACHE_SELECTED_ITEMS" => "N",
				"ALLOW_MULTI_SELECT" => "Y",
				"USE_EXT" => "Y"
			)
		);?>
		<!-- /noindex -->
		<?endif;?>
		<?CMax::nlo('menu-mobile');?>
		<?
		// show regions
		//CMax::ShowMobileRegions();

		// show cabinet item
		//CMax::ShowMobileMenuCabinet();
		?>

		<div class="mobile-contact-phone">
			<div class="mobile-contact-phone__value">
				  <?$APPLICATION->IncludeFile(
                        "/include/phone_header.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "Телефон"));?>
			</div>
			<div class="mobile-contact-phone__caption">
				Контактный центр
			</div>
		</div>

		<a href="https://tafimed.ru/booking/"><button class="header-callback-btn-m" type="button">Онлайн-запись к врачу</button></a>
		<!--data-event="jqm" data-param-form_id="SIGN_UP_ONLINE" data-name="SIGN_UP_ONLINE"-->
	</div>
</div>