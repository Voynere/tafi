<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__DIR__ . '/user_consent.php');
$config = \Bitrix\Main\Web\Json::encode($arResult['CONFIG']);
?>

<div class="custom-checkbox__container">
	<input 
		id="customCheckbox" 
		class="custom-checkbox" 
		type="checkbox" 
		value="Y" 
		<?=($arParams['IS_CHECKED'] ? 'checked' : '')?> 
		name="<?=htmlspecialcharsbx($arParams['INPUT_NAME'])?>"
	>
	<label for="customCheckbox" class="">
		<a target="_blank" href="<?= $arResult['CONFIG']['url'] ?>"><?=$arResult["CONFIG"]["text"]?></a>
	</label>
</div>