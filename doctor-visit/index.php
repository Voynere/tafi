<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Запись на приём у врача");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Запись на приём у врача");
?>

<style>
.doctor-visit-page {
    --main-color: #3B61B9;
    --main-color-hover: #34549E;
    --font-color-black: #333333;
    --font-color2: #5A616C;

    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px;
    font-family: 'Montserrat', sans-serif;
}
.doctor-visit-page * { box-sizing: border-box; }

.dv-title {
    font: 700 32px/1.25 'Montserrat', sans-serif;
    color: var(--font-color-black);
    margin: 0;
    padding: 40px 0 24px;
}

/* Список «На приёме врач» */
.dv-list {
    background: linear-gradient(135deg, #E8EEF9 0%, #D6E4F7 100%);
    border-radius: 16px;
    padding: 36px 40px;
    margin: 0 0 24px;
}
.dv-list h2 {
    font: 700 22px/1.3 'Montserrat', sans-serif;
    color: #1565C0;
    margin: 0 0 20px;
}
.dv-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.dv-list li {
    position: relative;
    padding: 0 0 0 28px;
    font: 500 16px/24px 'Montserrat', sans-serif;
    color: var(--font-color-black);
}
.dv-list li::before {
    content: '—';
    position: absolute;
    left: 0;
    color: var(--main-color);
    font-weight: 700;
}

/* Кнопка записи */
.dv-cta {
    margin: 0 0 32px;
}
.dv-btn {
    display: inline-block;
    background: var(--main-color);
    color: #fff !important;
    padding: 12px 40px;
    border-radius: 8px;
    font: 500 16px/24px 'Montserrat', sans-serif;
    text-decoration: none !important;
    transition: background-color 0.2s;
}
.dv-btn:hover { background: var(--main-color-hover); }

/* Вводный текст + фото */
.dv-intro {
    display: flex;
    align-items: flex-start;
    gap: 48px;
    padding: 0 0 32px;
}
.dv-intro__text { flex: 1; min-width: 0; }
.dv-intro__text p {
    font: 500 16px/24px 'Montserrat', sans-serif;
    color: var(--font-color2);
    margin: 0;
}
.dv-intro__image {
    flex: 0 0 420px;
    max-width: 420px;
}
.dv-intro__image img {
    width: 100%;
    border-radius: 16px;
    display: block;
}

/* Текстовый блок (запись + итог) */
.dv-outro {
    background: #fff;
    border: 1px solid #E8ECF2;
    border-radius: 16px;
    padding: 36px 40px;
}
.dv-outro p {
    font: 500 16px/24px 'Montserrat', sans-serif;
    color: var(--font-color2);
    margin: 0 0 16px;
}
.dv-outro p:last-child {
    margin-bottom: 0;
}

@media (max-width: 991px) {
    .dv-intro { gap: 32px; }
    .dv-intro__image {
        flex: 0 0 340px;
        max-width: 340px;
    }
    .dv-title { font-size: 28px; }
}

@media (max-width: 768px) {
    .doctor-visit-page { padding-bottom: 40px; }
    .dv-title {
        font-size: 24px;
        padding: 24px 0 16px;
    }
    .dv-intro {
        flex-direction: column-reverse;
        gap: 24px;
        padding-bottom: 16px;
    }
    .dv-intro__image {
        flex: none;
        max-width: 100%;
        width: 100%;
    }
    .dv-list,
    .dv-outro {
        padding: 24px 20px;
    }
    .dv-list h2 { font-size: 20px; }
    .dv-btn {
        display: block;
        text-align: center;
        width: 100%;
    }
}
</style>

<div class="doctor-visit-page">

    <h1 class="dv-title">Данная услуга проводится на приёме врача</h1>

    <section class="dv-list">
        <h2>На приёме врач:</h2>
        <ul>
            <li>внимательно выслушает жалобы;</li>
            <li>проведёт осмотр и оценит текущее состояние;</li>
            <li>при необходимости выполнит процедуру сразу во время посещения.</li>
        </ul>
    </section>

    <div class="dv-cta">
        <a href="/booking/" class="dv-btn">Записаться</a>
    </div>

    <section class="dv-intro">
        <div class="dv-intro__text">
            <p>Некоторые процедуры проводятся только во время очного приёма специалиста. Это позволяет врачу не просто выполнить манипуляцию, а разобраться в причине жалоб и подобрать наиболее эффективное лечение именно для Вас.</p>
        </div>
        <div class="dv-intro__image">
            <img src="/local/templates/aspro_max/images/page-service/doctor-visit-banner.jpg" alt="Приём врача в медицинском центре Доктор ТАФИ">
        </div>
    </section>

    <section class="dv-outro">
        <p>После нажатия кнопки «Записаться» откроется онлайн-запись к специалистам медицинского центра. Выберите, пожалуйста, интересующего врача по профилю и удобное время приёма — врач проведёт консультацию и при необходимости выполнит процедуру во время визита.</p>
        <p>Такой подход помогает избежать лишних назначений и получить помощь, которая действительно даст результат.</p>
    </section>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
