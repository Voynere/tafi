<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("devpage");
?>

<div class="main-services">
    <div class="main-services__container">
        <h3>Наши услуги</h3>
        <div class="main-services__items">
            <div class="main-services__item">
                <div class="main-services__item-info">
                    <span>УЗИ</span>
                    <p>Проводим ультразвуковые исследования  на современном оборудовании для взрослых  и детей с 3 лет.</p>
                    <a href="/services/uzi/">Подробнее</a>
                </div>
                <div class="main-services__item-image">
                    <img src="<?=SITE_TEMPLATE_PATH ?>/images/service01.png" alt="УЗИ">
                </div>
            </div>
            <div class="main-services__item">
                <div class="main-services__item-info">
                    <span>Выезд на дом</span>
                    <p>Сдайте анализы и обследования на дому —  в комфортной для вас обстановке, без очередей, лишних поездок и пробок.</p>
                    <a href="/services/dop_uslugi/vyezd-na-dom/">Подробнее</a>
                </div>
                <div class="main-services__item-image">
                    <img src="<?=SITE_TEMPLATE_PATH ?>/images/service02.png" alt="Выезд на дом">
                </div>
            </div>
            <div class="main-services__item">
                <div class="main-services__item-info">
                    <span>Процедуры</span>
                    <p>В сети медицинских лабораторий «ТАФИ-диагностика» предоставлятся дополнительные услуги процедурного кабинета, а именно — уколы и капельницы.</p>
                    <a href="#">Подробнее</a>
                </div>
                <div class="main-services__item-image">
                    <img src="<?=SITE_TEMPLATE_PATH ?>/images/service03.png" alt="Процедуры">
                </div>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>