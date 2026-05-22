<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->addExternalJS($templateFolder . "/vendor/node/node_modules/imask/dist/imask.js");

CJSCore::Init(['popup']);

use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$callingForm = $request->getPost('calling_form');
$jsObjectName = 'ob' . uniqid();
$formCallButton = 'order-open-form__' . uniqid();
$jsParams = []; ?>
<? if ($arParams["CALLING_VIA_AJAX"] == "Y"): ?>
	<a href="javascript:void(0)" class="<?= $formCallButton ?>"><?= $arParams['NAME_FORM_CALL_BUTTON'] ?></a>
<? else: ?>
	<? $formId = 'we-invite-you-work-' . uniqid(); ?>
	<div class="we-invite-you-work" id="<?= $formId ?>">
		<div class="we-invite-you-work__shell">
			<div class="we-invite-you-work__right-container">
				<div class="we-invite-you-work__icon">
					<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect width="60" height="60" rx="6" fill="#6B86C4" />
						<path d="M15 23.3333L28.151 32.1006C29.2707 32.847 30.7293 32.847 31.849 32.1006L45 23.3333M18.3333 41.6666H41.6667C43.5076 41.6666 45 40.1742 45 38.3333V21.6666C45 19.8256 43.5076 18.3333 41.6667 18.3333H18.3333C16.4924 18.3333 15 19.8256 15 21.6666V38.3333C15 40.1742 16.4924 41.6666 18.3333 41.6666Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</div>
				<div class="we-invite-you-work__content-block">
					<? if (!empty($arParams['TITLE']) || !empty($arResult["arForm"]["NAME"])):  ?>
						<div class="we-invite-you-work__title">
							<?= (!empty($arParams['TITLE']) ? $arParams['TITLE'] : $arResult["arForm"]["NAME"]) ?>
						</div>
					<? endif; ?>
					<? if (!empty($arParams['DESCRIPTION']) || !empty($arResult["FORM_DESCRIPTION"])):  ?>
						<div class="we-invite-you-work__description">
							<?= (!empty($arParams['DESCRIPTION']) ? $arParams['DESCRIPTION'] : $arResult["FORM_DESCRIPTION"]) ?>
						</div>
					<? endif; ?>
				</div>
			</div>
			<div class="we-invite-you-work__left-container">
				<?= $arResult["FORM_HEADER"] ?>
				<div class="we-invite-you-work__block-field">
					<? foreach ($arResult["QUESTIONS"] as $keyQuestion => $valueQuestion) : ?>
						<? $type = $valueQuestion["STRUCTURE"][0]["FIELD_TYPE"];
						$name = "form_" . $type . "_" . $valueQuestion["STRUCTURE"][0]["ID"]; ?>
						<div class="we-invite-you-work__field-<?= $type ?> we-invite-you-work__field">
							<? if (isset($arResult["FORM_ERRORS"][$keyQuestion])): ?>
								<span class="form-error"><?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$keyQuestion]) ?></span>
							<? endif; ?>

							<? $jsParams['INPUTS'][$keyQuestion]['DATA_NAME'] = $name;
							$jsParams['INPUTS'][$keyQuestion]['CAPTION'] = $valueQuestion["CAPTION"];
							$jsParams['INPUTS'][$keyQuestion]['ID'] = $valueQuestion["STRUCTURE"][0]["ID"];
							$jsParams['INPUTS'][$keyQuestion]['REQUIRED'] = $valueQuestion["REQUIRED"];
							$jsParams['INPUTS'][$keyQuestion]['TYPE'] = $type; ?>

							<? switch ($type) {
								case 'text': ?>
									<input type="<?= $type ?>" name="<?= $name ?>" placeholder="<?= $valueQuestion["CAPTION"] ?><? if ($valueQuestion["REQUIRED"] == 'Y') : ?> *<? endif; ?>" <?= $valueQuestion["STRUCTURE"][0]["FIELD_PARAM"] ?> value="">
								<? break;

								case 'radio':
									$jsParams['INPUTS'][$keyQuestion]['ID'] = [];
									$jsParams['INPUTS'][$keyQuestion]['DATA_NAME'] = []; ?>
									<div class="we-invite-you-work__item-shell">
										<? foreach ($valueQuestion["STRUCTURE"] as $keyRadio => $valueRadio) {
											$name = "form_" . $type . "_" . $keyQuestion;
											$jsParams['INPUTS'][$keyQuestion]['ID'][] = $valueRadio["ID"];
											$jsParams['INPUTS'][$keyQuestion]['DATA_NAME'] = $name;
										?>
											<div class="we-invite-you-work__item-radio-button">
												<input type="radio" id="<?= $valueRadio['ID'] ?>" name="<?= $name ?>" value="<?= $valueRadio['ID'] ?>" <?= ($keyRadio == 0 ? ' checked' : '') ?>>
												<label for="<?= $valueRadio['ID'] ?>" class="we-invite-you-work__item-radio-label">
													<span></span>
													<div class="we-invite-you-work__item-radio-text"><?= $valueRadio["MESSAGE"] ?></div>
												</label>
											</div>
										<? } ?>
									</div>
								<? break;

								case 'hidden': ?>
									<?= $valueQuestion["HTML_CODE"] ?>
								<? break;

								case 'textarea': ?>
									<div class="we-invite-you-work__field-textarea-shell">
										<textarea name="<?= $name ?>" placeholder="<?= $valueQuestion["CAPTION"] ?><? if ($valueQuestion["REQUIRED"] == 'Y') : ?> *<? endif; ?>" <?= $valueQuestion["STRUCTURE"][0]["FIELD_PARAM"] ?> maxlength="100"></textarea>
										<div class="we-invite-you-work__custom-resizer">
											<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
												<line x1="9" y1="0.707107" x2="0.707107" y2="9" stroke="#D2D6DC" stroke-linecap="round" />
												<line x1="9" y1="3.70711" x2="3.70711" y2="9" stroke="#D2D6DC" stroke-linecap="round" />
												<line x1="9" y1="6.70711" x2="6.70711" y2="9" stroke="#D2D6DC" stroke-linecap="round" />
											</svg>
										</div>
									</div>
									<div class="we-invite-you-work__character-counter-container">
										<span id="we-invite-you-work__character-counter">0</span> / 100
									</div>
								<? break;

								default: ?>
									<?= $valueQuestion["HTML_CODE"] ?>
							<? break;
							} ?>
						</div>
					<? endforeach; ?>

					<? if ($arResult["isUseCaptcha"] == "Y"): ?>
						<div class="we-invite-you-work__field-captcha">
							<p class="we-invite-you-work__text-name">Введите код проверки</p>
							<input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>">
							<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext">
							<img class="we-invite-you-work__captcha-code" src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
								width="180" height="40" />
						</div>
					<? endif; ?>

					<? if (Loader::includeModule('aspro.max') || Loader::includeModule('aspro.next')): ?>
						<input type="hidden" name="licenses_popup" value="Y">
						<input type="hidden" name="licenses_inline" value="Y">

						<? $jsParams['INPUTS']['licenses_popup']['TYPE'] = 'hidden';
						$jsParams['INPUTS']['licenses_popup']['DATA_NAME'] = 'licenses_popup';
						$jsParams['INPUTS']['licenses_inline']['TYPE'] = 'hidden';
						$jsParams['INPUTS']['licenses_inline']['DATA_NAME'] = 'licenses_inline'; ?>
					<? endif; ?>

				</div>

				<div class="we-invite-you-work__button-container">
					<div class="we-invite-you-work__field-submit we-invite-you-work__action-block">
						<input <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" class="form-submit" name="web_form_submit" value="<?= htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>" />
					</div>
					<? if ($arParams['USER_CONSENT'] == 'Y'): ?>
						<div class="we-invite-you-work__agreement">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.userconsent.request",
								"",
								array(
									"ID" => $arParams["USER_CONSENT_ID"],
									"IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
									"AUTO_SAVE" => "Y",
									"IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
									'SUBMIT_EVENT_NAME' => $arParams["COMPONENT_TEMPLATE"]
								)
							); ?>
						</div>
					<? endif; ?>
				</div>
				<?= $arResult["FORM_FOOTER"] ?>
			</div>
		</div>
	</div>
<? endif; ?>
<? $arParamsCleared = array_filter($arParams, function ($key) {
	return strpos($key, '~') === false;
}, ARRAY_FILTER_USE_KEY);

$jsParams += [
	'FORM_NAME' => $arResult["arForm"]["SID"],
	'PATH_TO_AJAX_COMPONENT' => $templateFolder . '/ajax-component.php',
	'PATH_TO_AJAX_RESULT' => $templateFolder . '/ajax-result.php',
	'USE_CAPTCHA' => $arResult["isUseCaptcha"],
	'OPEN_FORM_IN_MODAL_WINDOW' => $arParams["OPEN_FORM_IN_MODAL_WINDOW"],
	'SUCCESSFUL_RESULT_SEPARATE_WINDOW' => $arParams["SUCCESSFUL_RESULT_SEPARATE_WINDOW"],
	'FORM_ID' => $formId,
	'CLASS_FORM_CALL_BUTTON' => $formCallButton,
	'PARAMETERS' => \Bitrix\Main\Component\ParameterSigner::signParameters($component->__name, $arParamsCleared),
	"COMPONENT_NAME" => $component->__name,
	"TEMPLATE_NAME" => $templateName,
	"CALLING_FORM" => $callingForm,
	"SUBMIT_EVENT_NAME" => $arParams["COMPONENT_TEMPLATE"],
	"USER_CONSENT" => $arParams["USER_CONSENT"],
	"USER_CONSENT_IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"]
];

if (!empty($arParams["TITLE_SUCCESSFUL_RESULT"])) $jsParams['TITLE_SUCCESSFUL_RESULT'] = $arParams["TITLE_SUCCESSFUL_RESULT"];
if (!empty($arParams["DESCRIPTION_SUCCESSFUL_RESULT"])) $jsParams['DESCRIPTION_SUCCESSFUL_RESULT'] = $arParams["DESCRIPTION_SUCCESSFUL_RESULT"];
if (!empty($arParams["TITLE_FAILURE_RESULT"])) $jsParams['TITLE_FAILURE_RESULT'] = $arParams["TITLE_FAILURE_RESULT"];
if (!empty($arParams["DESCRIPTION_FAILURE_RESULT"])) $jsParams['DESCRIPTION_FAILURE_RESULT'] = $arParams["DESCRIPTION_FAILURE_RESULT"];

$messages = Loc::loadLanguageFile(__FILE__);
?>
<script>
	BX.message(<?= CUtil::PhpToJSObject($messages) ?>);
	BX.JCWebForm.init({
		result: <?= CUtil::PhpToJSObject($jsParams, false, true) ?>
	});
</script>
