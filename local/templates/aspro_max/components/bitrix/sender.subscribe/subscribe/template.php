<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$buttonId = $this->randString();
?>
<div class="bx-subscribe subscribe-custom-form" id="sender-subscribe">
    <?php
    $frame = $this->createFrame("sender-subscribe", false)->begin();
    ?>
    <div class="subscribe-custom-form__inner">
        <div class="subscribe-custom-form__info">
            <div class="subscribe-custom-form__svg">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 13.3333L18.151 22.1006C19.2707 22.847 20.7293 22.847 21.849 22.1006L35 13.3333M8.33333 31.6666H31.6667C33.5076 31.6666 35 30.1742 35 28.3333V11.6666C35 9.82564 33.5076 8.33325 31.6667 8.33325H8.33333C6.49238 8.33325 5 9.82564 5 11.6666V28.3333C5 30.1742 6.49238 31.6666 8.33333 31.6666Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="subscribe-custom-form__info-right">
                <span><?= Loc::getMessage('MSG_FORM_TITLE') ?></span>
                <p><?= Loc::getMessage('MSG_FORM_DESCR') ?></p>
            </div>
        </div>
        <? if (isset($arResult['MESSAGE'])): CJSCore::Init(array("popup")); ?>
            <div id="sender-subscribe-response-cont" style="display: none;">
                <div class="bx_subscribe_response_container">
                    <table>
                        <tr>
                            <td style="padding-right: 40px; padding-bottom: 0px;"><img
                                        src="<?= ($this->GetFolder() . '/images/' . ($arResult['MESSAGE']['TYPE'] == 'ERROR' ? 'icon-alert.png' : 'icon-ok.png')) ?>"
                                        alt=""></td>
                            <td>
                                <div style="font-size: 22px;"><?= GetMessage('subscr_form_response_' . $arResult['MESSAGE']['TYPE']) ?></div>
                                <div style="font-size: 16px;"><?= htmlspecialcharsbx($arResult['MESSAGE']['TEXT']) ?></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <script>
                BX.ready(function () {
                    var oPopup = BX.PopupWindowManager.create('sender_subscribe_component', window.body, {
                        autoHide: true,
                        offsetTop: 1,
                        offsetLeft: 0,
                        lightShadow: true,
                        closeIcon: true,
                        closeByEsc: true,
                        overlay: {
                            backgroundColor: 'rgba(57,60,67,0.82)', opacity: '80'
                        }
                    });
                    oPopup.setContent(BX('sender-subscribe-response-cont'));
                    oPopup.show();
                });
            </script>
        <? endif; ?>

        <script>
            (function () {
                var btn = BX('bx_subscribe_btn_<?=$buttonId?>');
                var form = BX('bx_subscribe_subform_<?=$buttonId?>');

                if (!btn) {
                    return;
                }

                function mailSender() {
                    setTimeout(function () {
                        if (!btn) {
                            return;
                        }

                        var btn_span = btn.querySelector("span");
                        var btn_subscribe_width = btn_span.style.width;
                        BX.addClass(btn, "send");
                        btn_span.outterHTML = "<span><i class='fa fa-check'></i> <?=GetMessage("subscr_form_button_sent")?></span>";
                        if (btn_subscribe_width) {
                            btn.querySelector("span").style["min-width"] = btn_subscribe_width + "px";
                        }
                    }, 400);
                }

                BX.ready(function () {
                    BX.bind(btn, 'click', function () {
                        setTimeout(mailSender, 250);
                        return false;
                    });
                });

                BX.bind(form, 'submit', function () {
                    btn.disabled = true;
                    setTimeout(function () {
                        btn.disabled = false;
                    }, 2000);

                    return true;
                });
            })();
        </script>

        <form class="subscribe-custom-form__form" id="bx_subscribe_subform_<?= $buttonId ?>" role="form" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="sender_subscription" value="add">

            <div class="bx-input-group subscribe-custom-form__inputs">
                <input 
                    class="bx-form-control subscribe-custom-form__fields" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?= $arResult["EMAIL"] ?>"
                    title="<?= GetMessage("subscr_form_email_title") ?>"
                    placeholder="<?= htmlspecialcharsbx(GetMessage('subscr_form_email_title')) ?>"
                >
                <div class="bx_subscribe_submit_container">
                    <button class="sender-btn btn-subscribe subscribe-custom-form__submit" id="bx_subscribe_btn_<?=$buttonId?>">
                        <svg class="submit-mobile" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10L5 10M15 10L10 5M15 10L10 15" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="submit-desk"><?= Loc::getMessage('subscr_form_button') ?></span>
                    </button>
                </div>
            </div>
            <? if (($arParams['USER_CONSENT'] ?? '') == 'Y' ): ?>
                <div class="bx_subscribe_checkbox_container bx-sender-subscribe-agreement">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.userconsent.request",
                        "userconsent",
                        [
                            "ID" => $arParams['USER_CONSENT_ID'],
                            "IS_CHECKED" => "Y",
                            "AUTO_SAVE" => "Y",
                            "IS_LOADED" => "Y",
                            "ORIGIN_ID" => "sender/sub",
                            "ORIGINATOR_ID" => "",
                            "REPLACE" => [
                                "button_caption" => GetMessage("subscr_form_button"),
                                "fields" => [
                                    0 => GetMessage("subscr_form_email_title"),
                                ],
                            ],
                            "COMPONENT_TEMPLATE" => "userconsent"
                        ],
                        false
                    ); ?>
                </div>
            <? endif; ?>
        </form>
    </div>
</div>