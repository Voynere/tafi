<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$strReturn = '';
if($arResult){
	\Bitrix\Main\Loader::includeModule("iblock");
	global $NextSectionID, $APPLICATION;
	$cnt = count($arResult);
	$lastindex = $cnt - 1;
	$visibleMobile = 0;
	if(\Bitrix\Main\Loader::includeModule('aspro.max'))
	{
		global $arTheme;
		// В некоторых проектах ключи темы могут отличаться — проверяем безопасно
		$bShowCatalogSubsections = (isset($arTheme["SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS"]["VALUE"]) && $arTheme["SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS"]["VALUE"] == "Y")
			|| (isset($arTheme["SHOW_breadcrumbs-2_CATALOG_SUBSECTIONS"]["VALUE"]) && $arTheme["SHOW_breadcrumbs-2_CATALOG_SUBSECTIONS"]["VALUE"] == "Y");
		$bMobileBreadcrumbs = (
			(isset($arTheme["MOBILE_CATALOG_BREADCRUMBS"]["VALUE"]) && $arTheme["MOBILE_CATALOG_BREADCRUMBS"]["VALUE"] == "Y")
			|| (isset($arTheme["MOBILE_CATALOG_breadcrumbs-2"]["VALUE"]) && $arTheme["MOBILE_CATALOG_breadcrumbs-2"]["VALUE"] == "Y")
		) && $NextSectionID;
	}

	$normalizePath = static function ($urlOrPath) {
		$val = (string)$urlOrPath;
		if ($val === '') {
			return '/';
		}
		$parts = @parse_url($val);
		$path = (is_array($parts) && isset($parts['path']) && $parts['path'] !== '') ? $parts['path'] : $val;
		$path = preg_replace('~[?#].*$~', '', $path);
		$path = str_replace('\\', '/', $path);
		$path = preg_replace('~/{2,}~', '/', $path);
		$path = preg_replace('~/index\.php$~i', '/', $path);
		if ($path === '') {
			$path = '/';
		}
		if ($path !== '/' && !preg_match('~\.[a-z0-9]+$~i', $path) && substr($path, -1) !== '/') {
			$path .= '/';
		}
		return $path;
	};

	$currentPath = $normalizePath($_SERVER['REQUEST_URI'] ?? GetPagePath());

	if ($bMobileBreadcrumbs) {
		$visibleMobile = $lastindex - 1;
	}
	for($index = 0; $index < $cnt; ++$index){
		$arSubSections = array();
		$bShowMobileArrow = false;
		$arItem = $arResult[$index];
		$title = htmlspecialcharsex($arItem["TITLE"]);
		$bLast = $index == $lastindex;
		if ($NextSectionID) {
			if ($bMobileBreadcrumbs && $visibleMobile == $index) {
				$bShowMobileArrow = true;
			}
			if ($bShowCatalogSubsections) {
				$arSubSections = CMax::getChainNeighbors($NextSectionID, $arItem['LINK']);
			}
		}
    if (explode('?', $_SERVER['REQUEST_URI'])[0] == '/landings/checkup/' && $arItem["LINK"] == '/landings/')
    {
      $arItem["LINK"] = '/catalog/';
      $title = 'Анализы';
    }

		if($arItem["LINK"] == '/catalog/check_up_kompleksnye_programmy/'){
			$arItem["LINK"] = '/landings/checkup/';
		}
		if($index){
			$strReturn .= '<span class="breadcrumbs-2__separator">/</span>';
		}
		$itemLink = (string)$arItem["LINK"];
		$itemPath = $normalizePath($itemLink);
		$isSelf = ($itemLink !== '' && $itemPath === $currentPath);

		if(($itemLink <> "" && !$isSelf && $itemLink != GetPagePath() && $itemLink."index.php" != GetPagePath()) || $arSubSections){
			$strReturn .= '<div class="breadcrumbs-2__item'.($bMobileBreadcrumbs ? ' breadcrumbs-2__item--mobile' : '').($bShowMobileArrow ? ' breadcrumbs-2__item--visible-mobile' : '').($arSubSections ? ' breadcrumbs-2__item--with-dropdown colored_theme_hover_bg-block' : '').($bLast ? ' cat_last' : '').'" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			if($arSubSections){
				if($index == ($cnt-1)):
					$strReturn .= '<link href="'.GetPagePath().'" itemprop="item" /><span>';
				else:
					$strReturn .= '<a class="breadcrumbs-2__link colored_theme_hover_bg-el-svg" href="'.$arItem["LINK"].'" itemprop="item">';
				endif;
				if ($bShowMobileArrow) {
					$strReturn .= CMax::showIconSvg('colored_theme_hover_bg-el-svg', SITE_TEMPLATE_PATH.'/images/svg/catalog/arrow_breadcrumbs-2.svg');
				}
				$strReturn .=($arSubSections ? '<span itemprop="name" class="breadcrumbs-2__item-name font_xs">'.$title.'</span><span class="breadcrumbs-2__arrow-down '.(!$bLast ? 'colored_theme_hover_bg-el-svg' : '').'">'.CMax::showIconSvg("arrow", SITE_TEMPLATE_PATH."/images/svg/trianglearrow_down.svg").'</span>' : '<span>'.$title.'</span>');
				$strReturn .= '<meta itemprop="position" content="'.($index + 1).'">';
				if($index == ($cnt-1)):
					$strReturn .= '</span>';
				else:
					$strReturn .= '</a>';
				endif;
				$strReturn .= '<div class="breadcrumbs-2__dropdown-wrapper"><div class="breadcrumbs-2__dropdown rounded3">';
					foreach($arSubSections as $arSubSection){
						if ($arSubSection["LINK"] !== $arItem["LINK"]) {
							$strReturn .= '<a class="breadcrumbs-2__dropdown-item dark_link font_xs" href="'.$arSubSection["LINK"].'">'.$arSubSection["NAME"].'</a>';
						}
					}
				$strReturn .= '</div></div>';
			}
			else{
				$strReturn .= '<a class="breadcrumbs-2__link" href="'.$arItem["LINK"].'" title="'.$title.'" itemprop="item">';
				if ($bShowMobileArrow) {
					$strReturn .= CMax::showIconSvg('colored_theme_hover_bg-el-svg', SITE_TEMPLATE_PATH.'/images/svg/catalog/arrow_breadcrumbs-2.svg');
				}
				$strReturn .= '<span itemprop="name" class="breadcrumbs-2__item-name font_xs">'.$title.'</span><meta itemprop="position" content="'.($index + 1).'"></a>';
			}
			$strReturn .= '</div>';
		}
		else{
			$strReturn .= '<span class="breadcrumbs-2__item'.($bMobileBreadcrumbs ? ' breadcrumbs-2__item--mobile' : '').'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><link href="'.GetPagePath().'" itemprop="item" /><span><span itemprop="name" class="breadcrumbs-2__item-name font_xs">'.$title.'</span><meta itemprop="position" content="'.($index + 1).'"></span></span>';
		}
	}

	return '<div class="breadcrumbs-2 swipeignore" itemscope="" itemtype="http://schema.org/BreadcrumbList">'.$strReturn.'</div>';
	//return $strReturn;
}
else{
	return $strReturn;
}
?>
