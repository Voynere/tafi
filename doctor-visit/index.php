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
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px;
}
.doctor-visit-page * { box-sizing: border-box; }

/* Блок 1: заголовок + вводный текст + фото */
.dv-intro {
    display: flex;
    align-items: flex-start;
    gap: 48px;
    padding: 40px 0 32px;
}
.dv-intro__text { flex: 1; min-width: 0; }
.dv-intro__text h1 {
    font: 700 32px/1.25 'Montserrat', 'Roboto', sans-serif;
    color: #222;
    margin: 0 0 20px;
}
.dv-intro__text p {
    font: 400 17px/1.7 'Roboto', 'Montserrat', sans-serif;
    color: #555;
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

/* Блок 2: список */
.dv-list {
    background: linear-gradient(135deg, #E8EEF9 0%, #D6E4F7 100%);
    border-radius: 16px;
    padding: 36px 40px;
    margin: 24px 0;
}
.dv-list h2 {
    font: 700 22px/1.3 'Montserrat', 'Roboto', sans-serif;
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
    font: 400 17px/1.6 'Roboto', 'Montserrat', sans-serif;
    color: #333;
}
.dv-list li::before {
    content: '—';
    position: absolute;
    left: 0;
    color: #3B61B9;
    font-weight: 700;
}

/* Блок 3: итог + запись */
.dv-outro {
    background: #fff;
    border: 1px solid #E8ECF2;
    border-radius: 16px;
    padding: 36px 40px;
    margin-top: 24px;
}
.dv-outro p {
    font: 400 17px/1.7 'Roboto', 'Montserrat', sans-serif;
    color: #555;
    margin: 0 0 16px;
}
.dv-outro p:last-of-type {
    margin-bottom: 28px;
}
.dv-btn {
    display: inline-block;
    background: #3B61B9;
    color: #fff !important;
    padding: 14px 36px;
    border-radius: 10px;
    font: 600 16px/1.4 'Montserrat', sans-serif;
    text-decoration: none !important;
    transition: background 0.2s;
}
.dv-btn:hover { background: #2E4F9E; }

@media (max-width: 991px) {
    .dv-intro {
        gap: 32px;
    }
    .dv-intro__image {
        flex: 0 0 340px;
        max-width: 340px;
    }
    .dv-intro__text h1 {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .doctor-visit-page {
        padding-bottom: 40px;
    }
    .dv-intro {
        flex-direction: column-reverse;
        gap: 24px;
        padding: 24px 0 16px;
    }
    .dv-intro__image {
        flex: none;
        max-width: 100%;
        width: 100%;
    }
    .dv-intro__text h1 {
        font-size: 24px;
    }
    .dv-intro__text p,
    .dv-list li,
    .dv-outro p {
        font-size: 16px;
    }
    .dv-list,
    .dv-outro {
        padding: 24px 20px;
    }
    .dv-list h2 {
        font-size: 20px;
    }
    .dv-btn {
        display: block;
        text-align: center;
        width: 100%;
    }
}
</style>

<div class="doctor-visit-page">

    <section class="dv-intro">
        <div class="dv-intro__text">
            <h1>Данная услуга проводится на приёме врача</h1>
            <p>Некоторые процедуры проводятся только во время очного приёма специалиста. Это позволяет врачу не просто выполнить манипуляцию, а разобраться в причине жалоб и подобрать наиболее эффективное лечение именно для Вас.</p>
        </div>
        <div class="dv-intro__image">
            <img src="/local/templates/aspro_max/images/page-service/doctor-visit-banner.jpg" alt="Приём врача в медицинском центре Доктор ТАФИ">
        </div>
    </section>

    <section class="dv-list">
        <h2>На приёме врач:</h2>
        <ul>
            <li>внимательно выслушает жалобы;</li>
            <li>проведёт осмотр и оценит текущее состояние;</li>
            <li>при необходимости выполнит процедуру сразу во время посещения.</li>
        </ul>
    </section>

    <section class="dv-outro">
        <p>Такой подход помогает избежать лишних назначений и получить помощь, которая действительно даст результат.</p>
        <p>После нажатия кнопки «Записаться» откроется онлайн-запись к специалистам медицинского центра. Выберите, пожалуйста, интересующего врача по профилю и удобное время приёма — врач проведёт консультацию и при необходимости выполнит процедуру во время визита.</p>
        <a href="/booking/" class="dv-btn">Записаться</a>
    </section>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
