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
    max-width: 1500px;
    margin: 0 auto;
}
.doctor-visit-page .service-banner {
    padding: 60px 20px;
}
.doctor-visit-page .service-banner__block {
    min-height: 480px;
}
.doctor-visit-page .service-banner__block-info {
    max-width: 640px;
    padding: 48px 0 48px 48px;
}
.doctor-visit-page .service-banner__block-info span {
    font-size: 32px;
    line-height: 1.25;
}
.doctor-visit-page .service-banner__block-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
    color: #fff;
    font: 18px/1.55 'Roboto', 'Montserrat', sans-serif;
}
.doctor-visit-page .service-banner__block-content p {
    margin: 0;
    font: inherit;
    color: inherit;
}
.doctor-visit-page .service-banner__block-content ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
.doctor-visit-page .service-banner__block-content li {
    position: relative;
    padding: 4px 0 4px 22px;
    font: inherit;
    color: inherit;
}
.doctor-visit-page .service-banner__block-content li::before {
    content: '—';
    position: absolute;
    left: 0;
    font-weight: 700;
}
.doctor-visit-page .service-banner__block-content strong {
    font-weight: 600;
}
.doctor-visit-page .service-banner__block-info a {
    margin-top: 8px;
}
@media (max-width: 991px) {
    .doctor-visit-page .service-banner__block {
        min-height: auto;
        flex-direction: column;
    }
    .doctor-visit-page .service-banner__block-info {
        max-width: 100%;
        padding: 32px 24px 24px;
    }
    .doctor-visit-page .service-banner__block-info span {
        font-size: 24px;
        line-height: 1.3;
    }
    .doctor-visit-page .service-banner__block-content {
        font-size: 16px;
    }
    .doctor-visit-page .service-banner__block-image {
        position: relative;
        max-width: 100%;
        aspect-ratio: 16 / 10;
    }
}
</style>

<div class="doctor-visit-page">
    <div class="service-banner">
        <div class="service-banner__block" style="background-color: #3B61B9">
            <div class="service-banner__block-info">
                <span>Данная услуга проводится на приёме врача</span>
                <div class="service-banner__block-content">
                    <p>Некоторые процедуры проводятся только во время очного приёма специалиста. Это позволяет врачу не просто выполнить манипуляцию, а разобраться в причине жалоб и подобрать наиболее эффективное лечение именно для Вас.</p>
                    <p><strong>На приёме врач:</strong></p>
                    <ul>
                        <li>внимательно выслушает жалобы;</li>
                        <li>проведёт осмотр и оценит текущее состояние;</li>
                        <li>при необходимости выполнит процедуру сразу во время посещения.</li>
                    </ul>
                    <p>Такой подход помогает избежать лишних назначений и получить помощь, которая действительно даст результат.</p>
                    <p>После нажатия кнопки «Записаться» откроется онлайн-запись к специалистам медицинского центра. Выберите, пожалуйста, интересующего врача по профилю и удобное время приёма — врач проведёт консультацию и при необходимости выполнит процедуру во время визита.</p>
                </div>
                <a href="/booking/">Записаться</a>
            </div>
            <div class="service-banner__block-image">
                <img src="/local/templates/aspro_max/images/page-service/doctor-visit-banner.jpg" alt="Приём врача в медицинском центре Доктор ТАФИ">
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
