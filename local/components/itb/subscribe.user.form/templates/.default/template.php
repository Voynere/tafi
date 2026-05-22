<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="subscribe-main">

    <div class="subscribe-main__content">

        <div class="subscribe-main__icon">

            <svg width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 6.3335L14.151 15.1008C15.2707 15.8473 16.7293 15.8473 17.849 15.1008L31 6.3335M4.33333 24.6668H27.6667C29.5076 24.6668 31 23.1744 31 21.3335V4.66683C31 2.82588 29.5076 1.3335 27.6667 1.3335H4.33333C2.49238 1.3335 1 2.82588 1 4.66683V21.3335C1 23.1744 2.49238 24.6668 4.33333 24.6668Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </div>

        <div class="subscribe-main__text">
            <div class="subscribe-main__title">Подпишитесь на нашу рассылку</div>
            <div class="subscribe-main__descr">Оставайтесь в курсе событий</div>
        </div>

    </div>

    <form class="subscribe-main__form js-subscibe-user-form">

        <div class="subscribe-main__form-content">

            <div class="subscribe-main__form-row">

                <div style="position: absolute; left: -100%; opacity: 0;">
                    <input type="email" name="email_confirm"
                           tabindex="-1" autocomplete="off"
                           placeholder="Не заполняйте это поле">
                </div>

                <div class="subscribe-main__field">
                    <input type="email" class="subscribe-main__field-input" name="EMAIL" placeholder="Введите свою почту" required>
                </div>

                <div class="subscribe-main__button">
                    <button class="subscribe-main__button-btn" type="submit">

                        <div class="subscribe-main__button-btn-text">
                            Подписаться
                        </div>
                        
                        <svg class="subscribe-main__button-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.75 5.75L0.75 5.75M10.75 5.75L5.75 0.75M10.75 5.75L5.75 10.75" stroke="#333333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                    </button>
                </div>	

            </div>

            <div class="subscribe-main__agreement">
                Подписываясь, вы соглашаетесь на <a href="/include/licenses_detail.php">обработку персональных данных</a> и принимаете <a href="/include/licenses_detail.php">оферту</a>
            </div>
            
        </div>

        <div class="subscribe-main__form-success">

            <div class="subscribe-main__form-success-title">Спасибо за подписку!</div>
            <div class="subscribe-main__form-success-desc">
                Вам выслано письмо. Для подтверждения перейдите по ссылке из письма.
            </div>

        </div>

        

    </form>
    
</div>		