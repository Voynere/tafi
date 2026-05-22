<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="bottom-menu bottom-menu--legal">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li class="bottom-menu__item bottom-menu__item--active"><a href="<?=$arItem["LINK"]?>" class="bottom-menu__item-link bottom-menu__item-link--active"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li class="bottom-menu__item"><a class="bottom-menu__item-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif?>