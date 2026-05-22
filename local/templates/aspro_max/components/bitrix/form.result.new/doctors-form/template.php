<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); 
use Bitrix\Main\Localization\Loc;

$errors = $arResult['FORM_ERRORS'] ?? '';
?>

<div class="doctors-form">
	<?= $arResult["FORM_NOTE"] ?? '' ?>
	<?php if ($arResult["isFormNote"] != "Y"): ?>
		<?=$arResult["FORM_HEADER"]?>
		<div class="doctors-form__inner">
			<div class="doctors-form__info">
				<div class="doctors-form__svg">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 13.3333L18.151 22.1006C19.2707 22.847 20.7293 22.847 21.849 22.1006L35 13.3333M8.33333 31.6666H31.6667C33.5076 31.6666 35 30.1742 35 28.3333V11.6666C35 9.82564 33.5076 8.33325 31.6667 8.33325H8.33333C6.49238 8.33325 5 9.82564 5 11.6666V28.3333C5 30.1742 6.49238 31.6666 8.33333 31.6666Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
				<div class="doctors-form__info-right">
					<?php if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y"): ?>
						<?php if ($arResult["isFormTitle"]):?>
							<span><?=$arResult["FORM_TITLE"]?></span>
						<?php endif;?> 
						<?php if ($arResult["isFormDescription"]): ?>
							<p><?=$arResult["FORM_DESCRIPTION"]?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<?dd($arResult["FORM_ERRORS"]);?>
			<div class="doctors-form__fields">
				<div class="doctors-form__inputs">
					<div class="doctors-form__questions">
						<?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
							<?php if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'): ?>
								<?= $arQuestion["HTML_CODE"]; ?>
							<?php else: ?>
								<?=$arQuestion["HTML_CODE"]?>
								<?if (isset($arResult["FORM_ERRORS"][$FIELD_SID])):?>
									<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"><?=$arResult["FORM_ERRORS"][$FIELD_SID]?></span>
								<?endif;?>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<input 
						class="doctors-form__submit"
						type="submit" 
						name="web_form_submit" 
						value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" 
					>
				</div>
				<div class="doctors-form__captcha">
					<?php if($arResult["isUseCaptcha"] == "Y"): ?>
						<div class="captcha">
							<div class="captcha-block">
								<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" alt="captchaword"/>
							</div>
							<input class="captcha-input" placeholder="<?= Loc::getMessage('MSG_CAPTCHA_PLACEHOLDER') ?>" type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
						</div>
					<?php endif; ?>
				</div>
				<div class="doctors-form__license">
					<input 
						class="custom-checkbox"
						type="checkbox" 
						id="licenses_popup" 
						name="licenses_popup" 
						checked="Y" 
						value="Y" 
						aria-required="true"
					>
					<label class="license_text" for="licenses_popup"><?= Loc::getMessage('MSG_LICENSE_TEXT') ?></label>
				</div>
			</div>
		</div>
		<?=$arResult["FORM_FOOTER"]?>
	<?php endif; ?>
</div>