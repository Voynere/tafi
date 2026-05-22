<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
$visibleItemsMenu = 6;

if (empty($arResult["ALL_ITEMS"]))
    return;

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

$currentPath = $normalizePath($_SERVER['REQUEST_URI'] ?? '/');
?>

<nav class="main-nav-menu">

    <ul class="main-nav-menu__items">
        <?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns){?>
            <?$class = $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["CLASS"]?>

            <?if(is_array($arColumns) && !empty($arColumns)){
                $class .= ' dropdown';
            }?>    

             <?
             $topLink = $arResult["ALL_ITEMS"][$itemID]["LINK"];
             $topIsSelf = ($normalizePath($topLink) === $currentPath) || !empty($arResult["ALL_ITEMS"][$itemID]["SELECTED"]);
             ?>
             <li class="main-nav-menu__top-item<?if(!$active){ $active = true;?> main-nav-menu__top-item--active<?}?><?=$class ? ' '.$class : ''?><?=($topIsSelf ? ' active' : '')?>">
                <?if(!$topIsSelf):?>
                    <a href="<?=$topLink?>" class="main-nav-menu__top-link"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></a>
                <?else:?>
                    <span class="main-nav-menu__top-link" aria-current="page"><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></span>
                <?endif;?>

                 <?if (is_array($arColumns) && !empty($arColumns)){?>
                                
                    <ul class="main-nav-menu__submenu">

                        <?foreach($arColumns as $key=>$arRow){?>

                            <?foreach($arRow as $itemIdLevel_2=>$arLevel_3){?>
                                 <?$class = $arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["CLASS"]?>    
                                <?
                                $lvl2Link = $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"];
                                $lvl2IsSelf = ($normalizePath($lvl2Link) === $currentPath) || !empty($arResult["ALL_ITEMS"][$itemIdLevel_2]["SELECTED"]);
                                ?>
                                <li class="main-nav-menu__submenu-item<?=$class ? ' '.$class : ''?><?=($lvl2IsSelf ? ' active' : '')?>">
                                    <?if(!$lvl2IsSelf):?>
                                        <a href="<?=$lvl2Link?>" class="main-nav-menu__submenu-item-link">
                                            <?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?>
                                        </a>
                                    <?else:?>
                                        <span class="main-nav-menu__submenu-item-link" aria-current="page">
                                            <?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?>
                                        </span>
                                    <?endif;?>
                                    <?$link = $lvl2Link?>
                                    <?if (is_array($arLevel_3) && !empty($arLevel_3)){?>
                                        <?
                                        $iCountChilds = count($arLevel_3);
                                        $counter = 0;
                                        ?>
                                        <ul class="main-nav-menu__submenu2">
                                            <?foreach($arLevel_3 as $itemIdLevel_3){?>
                                                <?$class = $arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["CLASS"]?> 
                                                <?
                                                $lvl3Link = $arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"];
                                                $lvl3IsSelf = ($normalizePath($lvl3Link) === $currentPath) || !empty($arResult["ALL_ITEMS"][$itemIdLevel_3]["SELECTED"]);
                                                ?>
                                                <li class="main-nav-menu__submenu2-item<?if(++$counter > $visibleItemsMenu){?> main-nav-menu__submenu2-item--collapsed<?}?><?=$class ? ' '.$class : ''?>">
                                                    <?if(!$lvl3IsSelf):?>
                                                        <a href="<?=$lvl3Link?>" class="main-nav-menu__submenu2-item-link">
                                                            <?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?>
                                                        </a>
                                                    <?else:?>
                                                        <span class="main-nav-menu__submenu2-item-link" aria-current="page">
                                                            <?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?>
                                                        </span>
                                                    <?endif;?>

                                                </li>

                                            <?}?>

                                            <?if($iCountChilds > $visibleItemsMenu):?>
                                                <?
                                                $moreIsSelf = ($normalizePath($link) === $currentPath);
                                                ?>
                                                <li class="main-nav-menu__submenu2-item">
                                                    <?if(!$moreIsSelf):?>
                                                        <a class="main-nav-menu__more-text" href="<?=$link?>">
                                                            <?=Loc::getMessage("TOP_MENU_MORE_ITEMS_SHOW")?>
                                                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    <?else:?>
                                                        <span class="main-nav-menu__more-text" aria-current="page">
                                                            <?=Loc::getMessage("TOP_MENU_MORE_ITEMS_SHOW")?>
                                                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </span>
                                                    <?endif;?>
                                                </li>
                                            <?endif;?>
                                        </ul>

                                    <?}?>

                                </li>

                            <?}?>

                        <?}?>

                         <?if($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["CLASS"] === 'direction' && $arResult['BANNERS']){
                            
                            $banner = $arResult['BANNERS'][0];
                            ?>
                            <li class="main-nav-menu__submenu-item">
                                <a class="menu-banner" href="<?=$banner['LINK']?>" style="background-image: url(<?=$banner['PREVIEW_PICTURE']['src']?>)">
                                    <span class="menu-banner__title"><?=$banner['NAME']?></span>
                                    <span class="menu-banner__desc"><?=$banner['PREVIEW_TEXT']?></span>
                                </a>    
                            </li>
                                
                        <?}?>


                    </ul>

                <?}?>    



            </li>

        <?}?>    
    </ul>

</nav>