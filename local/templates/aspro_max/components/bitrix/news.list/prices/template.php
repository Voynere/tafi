<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>

<? if (!$arResult['TREE']) return; ?>

<div class="price-list-wrapper">

    <div class="price-list__search">
        <input type="text" id="priceListSearch" placeholder="Поиск по анализам и услугам" autocomplete="off">

        <svg class="price-btn__seract-service" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M21.0004 21L16.6504 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#9EA4AD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <div class="price-list" id="priceList">
        <?
        // Запускаем отрисовку дерева
        renderPriceListTree($arResult['TREE'], 1, $this);
        ?>
    </div>

    <div class="price-list__no-results" id="priceListNoResults" style="display:none;">
        Ничего не найдено
    </div>

</div>

<?php
/**
 * Рекурсивная функция для вывода разделов любой глубины вложенности
 */
function renderPriceListTree($sections, $level, $template) {
    foreach ($sections as $arSection) {

        // --- Логика для 1 (корневого) уровня ---
        if ($level === 1) {
            ?>
            <div class="price-list__section">
                <div class="price-list__section-title">
                    <span><?= $arSection['NAME'] ?></span>
                    <svg class="price-list__chevron" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7L6 2L11 7" stroke="#A0A0A0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <div class="price-list__section-content">
                    <? if (!empty($arSection['ITEMS'])): ?>
                        <div class="price-list__items">
                            <? foreach ($arSection['ITEMS'] as $arItem): ?>
                                <? renderPriceRow($arItem, $template); ?>
                            <? endforeach; ?>
                        </div>
                    <? endif; ?>

                    <? if (!empty($arSection['SECTIONS'])): ?>
                        <? renderPriceListTree($arSection['SECTIONS'], 2, $template); ?>
                    <? endif; ?>
                </div>
            </div>
            <?php
        }
        // --- Логика для 2, 3 и всех последующих уровней ---
        else {
            $blockClass = ($level === 2) ? 'price-list__subsection' : 'price-list__sub-subsection';
            $titleClass = ($level === 2) ? 'price-list__subsection-title' : 'price-list__sub-subsection-title';
            $marginStyle = ($level >= 3) ? 'style="margin-left: 15px; font-weight: 500; margin-bottom: 10px;"' : '';
            ?>
            <div class="<?= $blockClass ?>">
                <? if (!empty($arSection['NAME'])): ?>
                    <div class="<?= $titleClass ?>" <?= $marginStyle ?>><?= $arSection['NAME'] ?></div>
                <? endif; ?>

                <? if (!empty($arSection['ITEMS'])): ?>
                    <div class="price-list__items">
                        <? foreach ($arSection['ITEMS'] as $arItem): ?>
                            <? renderPriceRow($arItem, $template); ?>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>

                <? if (!empty($arSection['SECTIONS'])): ?>
                    <? renderPriceListTree($arSection['SECTIONS'], $level + 1, $template); ?>
                <? endif; ?>
            </div>
            <?php
        }
    }
}

/**
 * Вспомогательная функция для вывода самой услуги
 */
function renderPriceRow($arItem, $template) {
    ?>
    <div class="price-list__row" id="<?= $template->GetEditAreaId($arItem['ID']) ?>">
        <span class="price-list__name"><?= $arItem['NAME'] ?></span>
        <? if (!empty($arItem['PROPERTIES']['PRICE']['VALUE'])): ?>
            <span class="price-list__price">
                <?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?>
            </span>
        <? elseif (!empty($arItem['PROPERTIES']['MINIMUM_PRICE']['VALUE'])): ?>
            <span class="price-list__price">
                <?= 'От ' . $arItem['PROPERTIES']['MINIMUM_PRICE']['VALUE'] . ' ₽' ?>
            </span>
        <? endif; ?>
    </div>
    <?php
}
?>
