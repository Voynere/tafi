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
.qr-banner__icon {
    flex: 0 0 120px;
    text-align: center;
}
.qr-banner__icon svg {
    width: 80px;
    height: 80px;
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
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}
.qr-advantages__item-icon svg {
    width: 28px;
    height: 28px;
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
    .qr-banner__icon { flex: none; }
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
        <div class="qr-banner__icon">
            <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="80" height="80" rx="16" fill="#1565C0" fill-opacity="0.1"/>
                <path d="M40 20C29 20 20 29 20 40C20 51 29 60 40 60C51 60 60 51 60 40C60 29 51 20 40 20ZM44 44H36V36H44V44ZM44 32H36V28H44V32Z" fill="#1565C0"/>
            </svg>
        </div>
        <div class="qr-banner__text">
            <h3>Не уверены, к какому врачу обратиться?</h3>
            <p>Вы можете написать нашему врачу-консультанту, и она:</p>
            <ul>
                <li>подскажет, к кому лучше записаться</li>
                <li>поможет сориентироваться по результатам</li>
            </ul>
            <a href="https://max.ru/u/f9LHodD0cOKedrr4y8JR0SoBFWwBZebysI7X3TsUMIwlZgrRah8xsq_JVUQ" target="_blank" rel="noopener" class="qr-btn qr-btn--max">Написать врачу-консультанту</a>
        </div>
    </div>

    <!-- BLOCK 3: Advantages -->
    <div class="qr-advantages">
        <h2>Почему стоит обратиться именно к нам?</h2>
        <div class="qr-advantages__grid">
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--blue">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" fill="#1565C0"/>
                    </svg>
                </div>
                <h4>Все в одном месте</h4>
                <p>Квалифицированные врачи, рентген, маммограф, УЗИ, ЭКГ, холтер и консультации смежных специалистов позволяют быстро и точно выявить проблему.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--green">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="#2E7D32"/>
                    </svg>
                </div>
                <h4>Индивидуальный план лечения</h4>
                <p>Наши терапевты разрабатывают персональные схемы с учётом всех обследований и результатов смежных специалистов, решая проблему комплексно.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--purple">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.66 7.93L12 2.27L6.34 7.93C4.78 9.49 4 11.53 4 13.64C4 15.75 4.78 17.79 6.34 19.35C7.9 20.91 9.94 21.69 12.05 21.69C14.16 21.69 16.2 20.91 17.76 19.35C19.32 17.79 20.1 15.75 20.1 13.64C20.1 11.53 19.32 9.49 17.76 7.93H17.66ZM12 19C9.79 19 8 17.21 8 15C8 12.79 9.79 11 12 11C14.21 11 16 12.79 16 15C16 17.21 14.21 19 12 19Z" fill="#7B1FA2"/>
                    </svg>
                </div>
                <h4>Современные физиотерапевтические методики</h4>
                <p>Поддержка организма и восстановление функций без лишнего стресса, ускоряя процесс выздоровления.</p>
            </div>
            <div class="qr-advantages__item">
                <div class="qr-advantages__item-icon qr-advantages__item-icon--orange">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12.5 7H11V13L16.25 16.15L17 14.92L12.5 12.25V7Z" fill="#E65100"/>
                    </svg>
                </div>
                <h4>Полный контроль здоровья</h4>
                <p>От первичной диагностики до динамического наблюдения и профилактических мероприятий, чтобы вы могли жить без лишней тревоги за своё здоровье.</p>
            </div>
        </div>
    </div>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
