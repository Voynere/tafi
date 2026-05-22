<?global $USER;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-block".$arParams["WEB_FORM_ID"]);?>
<?if($USER->IsAuthorized()):?>
	<?
	$dbRes = CUser::GetList(($by = "id"), ($order = "asc"), array("ID" => $USER->GetID()), array("FIELDS" => array("ID", "PERSONAL_PHONE")));
	$arUser = $dbRes->Fetch();
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		try{
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=CLIENT_NAME], .form.<?=$arResult["arForm"]["SID"]?> input[data-sid=FIO], .form.<?=$arResult["arForm"]["SID"]?> input[data-sid=NAME]').val('<?=$USER->GetFullName()?>');
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=PHONE]').val('<?=$arUser['PERSONAL_PHONE']?>');
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=EMAIL]').val('<?=$USER->GetEmail()?>');
		}
		catch(e){
		}
	});
	</script>
<?endif;?>
	<?php if($arResult['INPUT_POST_HANDLER']): ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.form.<?= $arResult["arForm"]["SID"] ?> input[data-sid="<?= $arResult['INPUT_POST_HANDLER']['ID'] ?>"]').attr('value', '<?= $arResult['INPUT_POST_HANDLER']['NAME'] ?>');
			});
		</script>
	<?php else: ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
			});
		</script>
	<?php endif; ?>


<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-block".$arParams["WEB_FORM_ID"], "");?>