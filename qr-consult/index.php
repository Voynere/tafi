<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Запись к врачу");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Запись к врачу");
?>

<style>
.qr-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.qr-page * { box-sizing: border-box; }

/* === BLOCK 1: Intro === */
.qr-intro {
    display: flex;
    align-items: center;
    gap: 40px;
    padding: 50px 0;
}
.qr-intro__text { flex: 1; }
.qr-intro__text h2 {
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 20px;
    color: #222;
}
.qr-intro__text p {
    font-size: 16px;
    line-height: 1.7;
    color: #555;
    margin: 0 0 12px;
}
.qr-intro__text .highlight {
    background: #FFF8E1;
    border-left: 4px solid #FFB300;
    padding: 14px 18px;
    border-radius: 6px;
    margin: 20px 0;
    font-size: 15px;
    color: #555;
}
.qr-intro__image {
    flex: 0 0 400px;
    max-width: 400px;
}
.qr-intro__image img {
    width: 100%;
    border-radius: 12px;
}

/* === BLOCK 2: Banner === */
.qr-banner {
    background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
    border-radius: 16px;
    padding: 40px;
    margin: 30px 0;
    display: flex;
    align-items: center;
    gap: 30px;
    overflow: hidden;
    position: relative;
    max-height: 380px;
}
.qr-banner__text { flex: 1; }
.qr-banner__text h3 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 16px;
    color: #1565C0;
}
.qr-banner__text ul {
    list-style: none;
    padding: 0;
    margin: 0 0 20px;
}
.qr-banner__text li {
    font-size: 16px;
    color: #333;
    padding: 6px 0 6px 28px;
    position: relative;
}
.qr-banner__text li::before {
    content: '—';
    position: absolute;
    left: 0;
    color: #1565C0;
    font-weight: 700;
}
.qr-banner__image {
    flex: 0 0 380px;
    max-width: 380px;
    align-self: flex-end;
    margin-bottom: -40px;
    margin-right: -40px;
}
.qr-banner__image img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 12px 0 0 0;
}

/* === BLOCK 3: Advantages === */
.qr-advantages {
    padding: 50px 0;
}
.qr-advantages h2 {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    margin: 0 0 40px;
    color: #222;
}
.qr-advantages__grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}
.qr-advantages__item {
    background: #fff;
    border: 1px solid #E0E0E0;
    border-radius: 12px;
    padding: 28px;
    transition: box-shadow 0.2s;
}
.qr-advantages__item:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
.qr-advantages__item-icon {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}
.qr-advantages__item-icon img {
    width: 48px;
    height: 48px;
}
.qr-advantages__item-icon--blue { background: #E3F2FD; }
.qr-advantages__item-icon--green { background: #E8F5E9; }
.qr-advantages__item-icon--purple { background: #F3E5F5; }
.qr-advantages__item-icon--orange { background: #FFF3E0; }
.qr-advantages__item h4 {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 10px;
    color: #222;
}
.qr-advantages__item p {
    font-size: 15px;
    line-height: 1.6;
    color: #666;
    margin: 0;
}

/* === Buttons === */
.qr-btn {
    display: inline-block;
    background: #3B61B9;
    color: #fff !important;
    padding: 14px 32px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none !important;
    transition: background 0.2s;
    cursor: pointer;
    border: none;
}
.qr-btn:hover { background: #2E4F9E; }
.qr-btn--outline {
    background: transparent;
    color: #3B61B9 !important;
    border: 2px solid #3B61B9;
}
.qr-btn--outline:hover { background: #E3F2FD; }
.qr-btn--max {
    background: #FF6B00;
}
.qr-btn--max:hover { background: #E55F00; }

/* === Responsive === */
@media (max-width: 768px) {
    .qr-intro { flex-direction: column-reverse; gap: 24px; }
    .qr-intro__image { flex: none; max-width: 280px; }
    .qr-intro__text h2 { font-size: 24px; }
    .qr-banner { flex-direction: column; padding: 28px; }
    .qr-banner__image { flex: none; max-width: 200px; }
    .qr-advantages__grid { grid-template-columns: 1fr; }
}
</style>

<div class="qr-page">

    <!-- BLOCK 1: Intro -->
    <div class="qr-intro">
        <div class="qr-intro__text">
            <h2>Рекомендуем посетить врача</h2>
            <p>Если в ваших анализах есть показатели вне референсных значений, первое и самое правильное решение — обратиться к врачу.</p>
            <p>В бланке анализов указаны нормы (референсные значения), и отклонение от них — это сигнал, что организму стоит уделить внимание. Показатели могут быть вне нормы по разным причинам: стресс, питание, физическая нагрузка, гормональные колебания, начальные симптомы заболеваний.</p>
            <div class="highlight">
                <strong>Важно:</strong> не стоит самостоятельно расшифровывать анализы — без медицинской оценки это может привести к лишним переживаниям или неверным выводам. Лучшее решение — спокойно разобраться в результатах вместе со специалистом.
            </div>
            <a href="/booking/" class="qr-btn">Записаться к врачу</a>
        </div>
        <div class="qr-intro__image">
            <img src="/local/templates/aspro_max/images/page-service/qr-consult-doctor.png" alt="Врач-консультант ТАФИ">
        </div>
    </div>

    <!-- BLOCK 2: Banner -->
    <div class="qr-banner">
        <div class="qr-banner__text">
            <h3>Не уверены, к какому врачу обратиться?</h3>
            <p>Вы можете написать нашему врачу-консультанту, и она:</p>
            <ul>
                <li>подскажет, к кому лучше записаться</li>
                <li>поможет сориентироваться по результатам</li>
            </ul>
            <a href="https://max.ru/u/f9LHodD0cOKedrr4y8JR0SoBFWwBZebysI7X3TsUMIwlZgrRah8xsq_JVUQ" target="_blank" rel="noopener" class="qr-btn">Написать врачу-консультанту</a>
        </div>
        <div class="qr-banner__image">
            <img src="/local/templates/aspro_max/images/page-service/qr-consult-doctor-banner.png" alt="Врач-консультант ТАФИ">
        </div>
    </div>

    <!-- BLOCK 3: Advantages -->
    <div class="qr-advantages">
        <h2>Почему стоит обратиться именно к нам?</h2>
        <div class="qr-advantages__grid">
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--blue">
                    <img src="/local/templates/aspro_max/images/page-service/icons/hospital.svg" alt="Больница">
                </div>
                <h4>Все в одном месте</h4>
                <p>Квалифицированные врачи, рентген, маммограф, УЗИ, ЭКГ, холтер и консультации смежных специалистов позволяют быстро и точно выявить проблему.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--green">
                    <img src="/local/templates/aspro_max/images/page-service/icons/checklist.svg" alt="Бланк с галочкой">
                </div>
                <h4>Индивидуальный план лечения</h4>
                <p>Наши терапевты разрабатывают персональные схемы с учётом всех обследований и результатов смежных специалистов, решая проблему комплексно.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--purple">
                    <img src="/local/templates/aspro_max/images/page-service/icons/checkmark.svg" alt="Галочка">
                </div>
                <h4>Современные физиотерапевтические методики</h4>
                <p>Поддержка организма и восстановление функций без лишнего стресса, ускоряя процесс выздоровления.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--orange">
                    <img src="/local/templates/aspro_max/images/page-service/icons/shield.svg" alt="Щит">
                </div>
                <h4>Полный контроль здоровья</h4>
                <p>От первичной диагностики до динамического наблюдения и профилактических мероприятий, чтобы вы могли жить без лишней тревоги за своё здоровье.</p>
            </div>
        </div>
    </div>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
