<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if($_GET["debug"] == "y")
	error_reporting(E_ERROR | E_PARSE);
IncludeTemplateLangFile(__FILE__);
global $APPLICATION, $arRegion, $arSite, $arTheme, $bIndexBot, $bIframeMode;
$arSite = CSite::GetByID(SITE_ID)->Fetch();
$htmlClass = ($_REQUEST && isset($_REQUEST['print']) ? 'print' : false);
$bIncludedModule = (\Bitrix\Main\Loader::includeModule("aspro.max"));

if(\Bitrix\Main\Loader::includeModule('itb.multidomains')){
	$geoData = \Itb\MultiDomains\Site::Instance();
	$city = $geoData->detectCity();
	
	if($city && ($city['CODE'] != $geoData->getDefaultCityCode()) && \Bitrix\Main\Config\Option::get('itb.multidomains', "domain_noindex") == 'Y'){
		$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
	}
	
	$geoData->checkBasket();

    $checkPage = false;
    $pages = [
        "/services/protsedury/uslugi-protsedurnogo-kabineta/",
        "/services/dop_uslugi/vyezd-na-dom/",
        "/services/allergologicheskie-issledovaniya/allergologicheskie-issledovaniya/",
        "/services/kleshchevye-infektsii/kleshchevye-infektsii/"
    ];
    foreach ($pages as $page)
    {
        if ($APPLICATION->GetCurDir() === $page) $checkPage = true;
    }
}

$isDoctorsFolder = 'N';
$uri = new \Bitrix\Main\Web\Uri(\Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getRequestUri());
if (str_starts_with($uri->getPath(), '/doctors/')) {
	$isDoctorsFolder = 'Y';
}

$classAdditional = "";

if(CSite::InDir('/index.php')){
	$classAdditional .= " main-page-body";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" <?=($htmlClass ? 'class="'.$htmlClass.'"' : '')?> <?=($bIncludedModule ? CMax::getCurrentHtmlClass() : '')?>>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowMeta("viewport");?>
	<?$APPLICATION->ShowMeta("HandheldFriendly");?>
	<?$APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");?>
	<?$APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");?>
	<?$APPLICATION->ShowMeta("SKYPE_TOOLBAR");?>
	<?$APPLICATION->ShowHead();?>
	<?$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject( $MESS, false ).')</script>', true);?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/datepicker.js" );?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/datepicker.css", true);?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/page-service.css", true);?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<meta name="apple-mobile-web-app-title" content="tafimed.ru" />
	<link rel="manifest" href="/site.webmanifest" />
    <script src="<?=SITE_TEMPLATE_PATH?>/js/search_fix.js"></script>
	<?
	$currentUrl = $APPLICATION->GetCurPage();

	if (empty($APPLICATION->GetProperty("canonical"))) {
		$APPLICATION->SetPageProperty("canonical", $currentUrl);
	}
	?>
	<?if($bIncludedModule)
		CMax::Start(SITE_ID);?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/main.css', true);?>
	<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header_include/head.php'));?>

	<!-- cookie-notification START -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.2/js.cookie.js"></script>
	<!-- cookie-notification END -->
</head>
<?$bIndexBot = CMax::checkIndexBot();?>
<body class="<?=$isDoctorsFolder === 'Y' ? 'doctors' : ''?> <?=($bIndexBot ? "wbot" : "");?><?=$classAdditional;?> site_<?=SITE_ID?> <?=($bIncludedModule ? CMax::getCurrentBodyClass() : '')?>" id="main" data-site="<?=$city["SITE_DIR"]//SITE_DIR?>">


	<?if(!$bIncludedModule):?>
		<?$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_ASPRO_MAX_TITLE"));?>
		<center><?$APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php");?></center></body></html><?die();?>
	<?endif;?>
	
	<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header_include/body_top.php'));?>

	<?$arTheme = $APPLICATION->IncludeComponent("aspro:theme.max", ".default", array("COMPONENT_TEMPLATE" => ".default"), false, array("HIDE_ICONS" => "Y"));?>
	<?include_once('defines.php');?>
	<?CMax::SetJSOptions();?>

	<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header_include/under_wrapper1.php'));?>
	<div class="wrapper1 <?=($isIndex && $isShowIndexLeftBlock ? "with_left_block" : "");?> <?=CMax::getCurrentPageClass();?> <?$APPLICATION->AddBufferContent(array('CMax', 'getCurrentThemeClasses'))?>  ">
		<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header_include/top_wrapper1.php'));?>

		<div class="wraps hover_<?=$arTheme["HOVER_TYPE_IMG"]["VALUE"];?>" id="content">
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header_include/top_wraps.php'));?>

			<?if($isIndex):?>
				<?$APPLICATION->ShowViewContent('front_top_big_banner');?>
				<div class="wrapper_inner front <?=($isShowIndexLeftBlock ? "" : "wide_page");?> <?=$APPLICATION->ShowViewContent('wrapper_inner_class')?>">
			<?elseif(!$isWidePage):?>
                <? if ($checkPage) $isHideLeftBlock = true ?>
				<div class="wrapper_inner <?=($isHideLeftBlock ? "wide_page" : "");?> <?=$APPLICATION->ShowViewContent('wrapper_inner_class')?>">
			<?endif;?>
				
				<div class="container_inner clearfix <?=$APPLICATION->ShowViewContent('container_inner_class')?>">
				<?if(($isIndex && ($isShowIndexLeftBlock || $bActiveTheme)) || (!$isIndex && !$isHideLeftBlock)):?>
					<div class="right_block <?=(defined("ERROR_404") ? "error_page" : "");?> wide_<?=CMax::ShowPageProps("HIDE_LEFT_BLOCK");?> <?=$APPLICATION->ShowViewContent('right_block_class')?>">
				<?endif;?>
					<div class="middle <?=($is404 ? 'error-page' : '');?> <?=$APPLICATION->ShowViewContent('middle_class')?>">
						<?CMax::get_banners_position('CONTENT_TOP');?>
						<?if(!$isIndex):?>
							<div class="container">
								<?//h1?>
								<?if($APPLICATION->GetCurDir() === "/company/sistema-loyalnosti/" || $APPLICATION->GetCurDir() === "/analizy-dlya-detey/" || $APPLICATION->GetCurPage() === "/info/podarochnye-sertifikaty.php"):?>
                                    <div class="wide">
                                <? elseif ($isHideLeftBlock && !$isWidePage): ?>
                                    <div class="maxwidth-theme">
								<?endif;?>
						<?endif;?>
						<?CMax::checkRestartBuffer();?>