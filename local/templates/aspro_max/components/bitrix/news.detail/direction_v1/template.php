<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

// ДОБАВЛЯЕМ ФУНКЦИЮ СКЛОНЕНИЯ ПРЯМО ЗДЕСЬ
function getYearDeclension($number) {
    $number = (int)$number;
    $years = array('год', 'года', 'лет');
    if ($number % 10 == 1 && $number % 100 != 11) {
        return $number . ' ' . $years[0];
    } elseif ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20)) {
        return $number . ' ' . $years[1];
    } else {
        return $number . ' ' . $years[2];
    }
}

$props = $arResult["PROPERTIES"];
$advWidth = ($props["PROP_ADV_BLOCK_ROW"]['VALUE_XML_ID'] === 'TWO')
    ? 'two-in-row'
    : 'four-in-row';
$roadWidth = ($props["PROP_CARDS_ROW"]['VALUE_XML_ID'] === 'TWO')
    ? 'two-in-row'
    : (($props["PROP_CARDS_ROW"]['VALUE_XML_ID'] === 'ONE')
        ? 'one-in-row'
        : 'four-in-row');
$road2Width = ($props["PROP_CARDS2_ROW"]['VALUE_XML_ID'] === 'TWO')
    ? 'two-in-row'
    : (($props["PROP_CARDS2_ROW"]['VALUE_XML_ID'] === 'ONE')
        ? 'one-in-row'
        : 'four-in-row');
$noPhoto = SITE_TEMPLATE_PATH . '/images/page-service/doc-no-photo.png';

$getBannerAnchorAttr = static function ($anchor) {
    if (empty($anchor)) {
        return '';
    }
    $anchor = preg_replace('/[^a-z0-9_-]/i', '', (string)$anchor);
    return $anchor ? ' id="' . htmlspecialcharsbx($anchor) . '"' : '';
};

$isAdmin = $USER -> isAdmin();

// Функция для расчета стажа
function calculateExperience($value) {
    if (empty($value)) return '';
    
    $startYear = (int)$value;
    $currentYear = (int)date('Y');
    
    if ($startYear > 1900 && $startYear <= $currentYear) {
        $experience = $currentYear - $startYear;
        return 'Стаж ' . getYearDeclension($experience);
    } else {
        return 'Стаж ' . htmlspecialchars($value);
    }
}
?>

<div class="service-page">

    <? if($props['PROP_MAIN_BLOCK_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-block first js-service-block" data-position="<?=$props['PROP_MAIN_BLOCK_POSITION']['VALUE'] ?>">
            <div class="service-block__info">
                <span class="service-block__name">
                    <?= $arResult['NAME'] ?>
                </span>
                <?=$arResult['PREVIEW_TEXT'] ?>
            </div>
            <div class="service-block__image">
                <img src="<?=$arResult['PREVIEW_PICTURE']['SRC'] ?>" alt="<?=$arResult['PREVIEW_PICTURE']['ALT'] ?>">
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_ADV_BLOCK_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-reasons js-service-block" data-position="<?=$props['PROP_ADV_BLOCK_POSITION']['VALUE'] ?>">
            <h2><?=$props['PROP_ADV_BLOCK_TITLE']['VALUE'] ?></h2>
            <div class="service-reasons__block">
                <div class="service-reasons__item <?=$advWidth ?>">
                    <div class="service-reasons__item-icon">
                        <img src="<?=CFile::GetPath($props['PROP_ADV_BLOCK_ITEM1_ICON']['VALUE']) ?>" alt="">
                    </div>
                    <div class="service-reasons__item-info">
                        <span><?=$props['PROP_ADV_BLOCK_ITEM1_TITLE']['VALUE'] ?></span>
                        <p><?=$props['PROP_ADV_BLOCK_ITEM1_DESCR']['VALUE'] ?></p>
                    </div>
                </div>
                <div class="service-reasons__item <?=$advWidth ?>">
                    <div class="service-reasons__item-icon">
                        <img src="<?=CFile::GetPath($props['PROP_ADV_BLOCK_ITEM2_ICON']['VALUE']) ?>" alt="">
                    </div>
                    <div class="service-reasons__item-info">
                        <span><?=$props['PROP_ADV_BLOCK_ITEM2_TITLE']['VALUE'] ?></span>
                        <p><?=$props['PROP_ADV_BLOCK_ITEM2_DESCR']['VALUE'] ?></p>
                    </div>
                </div>
                <div class="service-reasons__item <?=$advWidth ?>">
                    <div class="service-reasons__item-icon">
                        <img src="<?=CFile::GetPath($props['PROP_ADV_BLOCK_ITEM3_ICON']['VALUE']) ?>" alt="">
                    </div>
                    <div class="service-reasons__item-info">
                        <span><?=$props['PROP_ADV_BLOCK_ITEM3_TITLE']['VALUE'] ?></span>
                        <p><?=$props['PROP_ADV_BLOCK_ITEM3_DESCR']['VALUE'] ?></p>
                    </div>
                </div>
                <div class="service-reasons__item <?=$advWidth ?>">
                    <div class="service-reasons__item-icon">
                        <img src="<?=CFile::GetPath($props['PROP_ADV_BLOCK_ITEM4_ICON']['VALUE']) ?>" alt="">
                    </div>
                    <div class="service-reasons__item-info">
                        <span><?=$props['PROP_ADV_BLOCK_ITEM4_TITLE']['VALUE'] ?></span>
                        <p><?=$props['PROP_ADV_BLOCK_ITEM4_DESCR']['VALUE'] ?></p>
                    </div>
                </div>
                <? if(!empty($props['PROP_ADV_BLOCK_ITEM5_TITLE']['VALUE'])): ?>
                <div class="service-reasons__item <?=$advWidth ?>">
                    <div class="service-reasons__item-icon">
                        <? if(!empty($props['PROP_ADV_BLOCK_ITEM5_ICON']['VALUE'])): ?>
                            <img src="<?=CFile::GetPath($props['PROP_ADV_BLOCK_ITEM5_ICON']['VALUE']) ?>" alt="">
                        <? endif; ?>
                    </div>
                    <div class="service-reasons__item-info">
                        <span><?=$props['PROP_ADV_BLOCK_ITEM5_TITLE']['VALUE'] ?></span>
                        <p><?=$props['PROP_ADV_BLOCK_ITEM5_DESCR']['VALUE'] ?></p>
                    </div>
                </div>
                <? endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_CARDS_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-road js-service-block" data-position="<?=$props['PROP_CARDS_POSITION']['VALUE'] ?>">
            <? if(!empty($props['PROP_CARDS_TITLE']['VALUE'])): ?>
                <h2><?=$props['PROP_CARDS_TITLE']['VALUE'] ?></h2>
            <? endif; ?>
            <div class="service-road__block">
                <? if(!empty($props['PROP_CARDS1']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$roadWidth ?>">
                        <? if($props['PROP_CARDS_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">1</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS1']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS2']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$roadWidth ?>">
                        <? if($props['PROP_CARDS_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">2</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS2']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS3']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$roadWidth ?>">
                        <? if($props['PROP_CARDS_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">3</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS3']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS4']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$roadWidth ?>">
                        <? if($props['PROP_CARDS_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">4</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS4']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS_IMAGE']['VALUE'])): ?>
                    <div class="service-road__block-item-image <?=$roadWidth ?>">
                        <img src="<?=CFile::GetPath($props['PROP_CARDS_IMAGE']['VALUE']) ?>" alt="">
                    </div>
                <? endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_INFO_BLOCK_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-block js-service-block" data-position="<?=$props['PROP_INFO_BLOCK_POSITION']['VALUE'] ?>">
            <div class="service-block__image">
                <img src="<?=$arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT'] ?>">
            </div>
            <div class="service-block__info">
                <?=$arResult['DETAIL_TEXT'] ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_DOCTORS_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-doctors js-service-block" data-position="<?=$props['PROP_DOCTORS_POSITION']['VALUE'] ?>">
            <div class="service-doctors__container">
                <div class="service-title__block">
                    <h2><?=$props['PROP_DOCTORS_TITLE']['VALUE'] ?></h2>
                    <a href="/doctors/">
                        Все специалисты
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16L14 12L10 8" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="service-doctors__block js-doctors-block">
                    <div class="swiper-wrapper">
                        <? foreach ($props['PROP_DOCTORS']['LIST'] as $doctor): ?>
                            <div class="swiper-slide service-doctors__item">
                                <div class="service-doctors__item-photo">
                                    <img src="<?=$doctor['PREVIEW_PICTURE_SRC'] ? : $noPhoto ?>" alt="">
                                </div>
                                <div class="service-doctors__item-info">
                                    <span class="service-doctors__item-info-name"><?=$doctor['NAME'] ?></span>
                                     <?php if (is_array($doctor['PROP_POSITION_VALUE']) && !empty(is_array($doctor['PROP_POSITION_VALUE']))): ?>
                                        <?php foreach($doctor['PROP_POSITION_VALUE'] as $docPosition): ?>
                                            <span class="service-doctors__item-info-spec"><?= $docPosition ?></span>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                    
                                    <?php 
                                    // РАСЧЕТ СТАЖА для врача на странице направления
                                    $experienceDisplay = '';
                                    if (!empty($doctor['PROPERTY_PROP_EXPERIENCE_VALUE'])) {
                                        $experienceDisplay = calculateExperience($doctor['PROPERTY_PROP_EXPERIENCE_VALUE']);
                                    }
                                    ?>
                                    <?php if ($experienceDisplay): ?>
                                        <span class="service-doctors__item-info-spec"><?= $experienceDisplay ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if (is_array($doctor['PROPERTY_PROP_ADDRESS_VALUE']) && !empty(is_array($doctor['PROPERTY_PROP_ADDRESS_VALUE']))): ?>
                                        <?php foreach($doctor['PROPERTY_PROP_ADDRESS_VALUE'] as $docAddress): ?>
                                            <span class="service-doctors__item-info-spec"><?= $docAddress ?></span>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                    <?php if($doctor['PROPERTY_PROP_APPOINTMENT_LINK_VALUE']): ?>
                                        <a class="doctors-list-items_action service-button" target="_blank" href="<?= $doctor['PROPERTY_PROP_APPOINTMENT_LINK_VALUE'] ?>">
                                            <?= Loc::getMessage('MSG_APPOINTMENT_LINK') ?>
                                        </a>
                                    <?php else: ?>
                                        <button 
                                            type="button" 
                                            class="doctors-list-items_action service-button"
                                            data-event="jqm"
                                            data-param-form_id="MAKE_AN_APPOINTMENT"
                                            data-name="MAKE_AN_APPOINTMENT"
                                            data-param-DOCTORS_NAME="<?= str_replace(' ', '@', $doctor['NAME']) ?>"
                                        >
                                            <?= Loc::getMessage('MSG_APPOINTMENT_LINK') ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <? if(!empty($props['PROP_DOCTORS']['LIST']) && count($props['PROP_DOCTORS']['LIST']) > 4): ?>
                    <div class="swiper-button-prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18L9 12L15 6" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="swiper-button-next">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <? endif ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_BANNER1_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-banner js-service-block"<?=$getBannerAnchorAttr($arParams['BANNER1_ANCHOR'] ?? '') ?> data-position="<?=$props['PROP_BANNER1_POSITION']['VALUE'] ?>">
            <div class="service-banner__block" style="background-color: <?=$props['PROP_BANNER1_COLOR']['VALUE_XML_ID'] ?>">
                <div class="service-banner__block-info">
                    <span><?=$props['PROP_BANNER1_TITLE']['VALUE'] ?></span>
                    <p><?=$props['PROP_BANNER1_TEXT']['VALUE'] ?></p>
                    <a href="<?=$props['PROP_BANNER1_LINK']['VALUE'] ?>"><?=$props['PROP_BANNER1_BTN_TEXT']['VALUE'] ?></a>
                </div>
                <div class="service-banner__block-image">
                    <img src="<?=CFile::GetPath($props['PROP_BANNER1_IMAGE']['VALUE']) ?>" alt="">
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_BANNER2_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-banner js-service-block"<?=$getBannerAnchorAttr($arParams['BANNER2_ANCHOR'] ?? '') ?> data-position="<?=$props['PROP_BANNER2_POSITION']['VALUE'] ?>">
            <div class="service-banner__block" style="background-color: <?=$props['PROP_BANNER2_COLOR']['VALUE_XML_ID'] ?>">
                <div class="service-banner__block-info">
                    <span><?=$props['PROP_BANNER2_TITLE']['VALUE'] ?></span>
                    <p><?=$props['PROP_BANNER2_TEXT']['VALUE'] ?></p>
                    <a href="<?=$props['PROP_BANNER2_LINK']['VALUE'] ?>"><?=$props['PROP_BANNER2_BTN_TEXT']['VALUE'] ?></a>
                </div>
                <div class="service-banner__block-image">
                    <img src="<?=CFile::GetPath($props['PROP_BANNER2_IMAGE']['VALUE']) ?>" alt="">
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_BANNER3_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-banner js-service-block"<?=$getBannerAnchorAttr($arParams['BANNER3_ANCHOR'] ?? '') ?> data-position="<?=$props['PROP_BANNER3_POSITION']['VALUE'] ?>">
            <div class="service-banner__block" style="background-color: <?=$props['PROP_BANNER3_COLOR']['VALUE_XML_ID'] ?>">
                <div class="service-banner__block-info">
                    <span><?=$props['PROP_BANNER3_TITLE']['VALUE'] ?></span>
                    <p><?=$props['PROP_BANNER3_TEXT']['VALUE'] ?></p>
                    <a href="<?=$props['PROP_BANNER3_LINK']['VALUE'] ?>"><?=$props['PROP_BANNER3_BTN_TEXT']['VALUE'] ?></a>
                </div>
                <div class="service-banner__block-image">
                    <img src="<?=CFile::GetPath($props['PROP_BANNER3_IMAGE']['VALUE']) ?>" alt="">
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_PRICES_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-prices js-service-block" data-position="<?=$props['PROP_PRICES_POSITION']['VALUE'] ?>">
            <div class="service-prices__block">
                <div class="service-prices__block-head">
                    <h2><?=$props['PROP_PRICES_TITLE']['VALUE'] ?></h2>
                    <a class="service-button" href="<?=$props['PROP_PRICES_LINK']['VALUE'] ?>">Посмотреть весь прайс</a>
                </div>
                <div class="service-prices__block-body">
                    <? foreach ($props['PROP_PRICES_LIST']['LIST'] as $price): ?>
                        <div class="service-prices__block-body-item">
                            <span><?=$price['NAME'] ?></span>
                            <span><?=$price['PRICE_PRICE'] ?> ₽</span>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_FAQ_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-faq js-service-block" data-position="<?=$props['PROP_FAQ_POSITION']['VALUE'] ?>">
            <div class="service-faq__info">
                <h2><?=$props['PROP_FAQ_TITLE']['VALUE'] ?></h2>
                <p>Если у вас остались вопросы, мы всегда готовы помочь! Ознакомьтесь с ответами на самые популярные запросы или свяжитесь с нами — наши специалисты проконсультируют вас и дадут всю необходимую информацию.</p>
                <!-- <button class="service-button">Задать вопрос</button> -->
            </div>
            <div class="service-faq__items">
                <? foreach ($props['PROP_FAQ_LIST']['LIST'] as $faq): ?>
                    <div class="service-faq__item js-accord-item">
                        <div class="service-faq__item-head js-accord-item-head">
                            <span><?=$faq['NAME'] ?></span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="service-faq__item-body js-accord-item-body">
                            <?=$faq['PREVIEW_TEXT'] ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_ARTICLES_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-articles js-service-block" data-position="<?=$props['PROP_ARTICLES_POSITION']['VALUE'] ?>">
            <div class="service-title__block">
                <h2><?=$props['PROP_ARTICLES_TITLE']['VALUE'] ?></h2>
                <a href="<?=$props['PROP_ARTICLES_LINK']['VALUE'] ?>">
                    Все статьи
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 16L14 12L10 8" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="service-articles__block">
                <? foreach ($props['PROP_ARTICLES_LIST']['LIST'] as $article): ?>
                    <a href="<?=$article['LINK'] ?>" class="service-articles__item">
                        <div class="service-articles__item-image">
                            <img src="<?=$article['PREVIEW_PICTURE_SRC'] ?>" alt="">
                        </div>
                        <div class="service-articles__item-info">
                            <span><?=$article['DATE'] ?></span>
                            <span><?=$article['NAME'] ?></span>
                        </div>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_INFO_BLOCK2_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-additional js-service-block" data-position="<?=$props['PROP_INFO_BLOCK2_POSITION']['VALUE'] ?>">
            <? if(!empty($props['PROP_INFO_BLOCK2_TITLE']['VALUE'])): ?>
                <h2><?=$props['PROP_INFO_BLOCK2_TITLE']['VALUE'] ?></h2>
            <?php endif; ?>
            <? if(!empty($props['PROP_INFO_BLOCK2_TOPTEXT']['VALUE'])): ?>
                <p><?=$props['PROP_INFO_BLOCK2_TOPTEXT']['VALUE'] ?></p>
            <?php endif; ?>
            <div class="service-additional__block">
                <div class="service-additional__block-image">
                    <img src="<?=CFile::GetPath($props['PROP_INFO_BLOCK2_IMAGE']['VALUE']) ?>" alt="">
                </div>
                <div class="service-additional__block-info">
                    <?=$props['PROP_INFO_BLOCK2_TEXT']['~VALUE']['TEXT'] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_LIST_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-list js-service-block" data-position="<?=$props['PROP_LIST_POSITION']['VALUE'] ?>">
            <div class="service-list__container">
                <h2><?=$props['PROP_LIST_TITLE']['VALUE'] ?></h2>
                <div class="service-list__block">
                    <? foreach ($props['PROP_LIST']['LIST'] as $link): ?>
<!--                        <a href="--><?php //=$link['DETAIL_PAGE_URL'] ?><!--">--><?php //=$link['NAME'] ?><!--</a>-->
                        <a><?=$link['NAME'] ?></a>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_CARDS2_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-road js-service-block" data-position="<?=$props['PROP_CARDS2_POSITION']['VALUE'] ?>">
            <? if(!empty($props['PROP_CARDS2_TITLE']['VALUE'])): ?>
                <h2><?=$props['PROP_CARDS2_TITLE']['VALUE'] ?></h2>
            <? endif; ?>
            <div class="service-road__block">
                <? if(!empty($props['PROP_CARDS2_1']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$road2Width ?>">
                        <? if($props['PROP_CARDS2_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">1</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS2_1']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS2_2']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$road2Width ?>">
                        <? if($props['PROP_CARDS2_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">2</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS2_2']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS2_3']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$road2Width ?>">
                        <? if($props['PROP_CARDS2_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">3</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS2_3']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS2_4']['~VALUE']['TEXT'])): ?>
                    <div class="service-road__block-item <?=$road2Width ?>">
                        <? if($props['PROP_CARDS2_NUM']['VALUE_XML_ID'] === 'Y'): ?>
                            <div class="service-road__block-item-num">4</div>
                        <?php endif; ?>
                        <div class="service-road__block-item-content">
                            <?=$props['PROP_CARDS2_4']['~VALUE']['TEXT'] ?>
                        </div>
                    </div>
                <? endif; ?>
                <? if(!empty($props['PROP_CARDS2_IMAGE']['VALUE'])): ?>
                    <div class="service-road__block-item-image <?=$roadWidth ?>">
                        <img src="<?=CFile::GetPath($props['PROP_CARDS2_IMAGE']['VALUE']) ?>" alt="">
                    </div>
                <? endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_CARDS3_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-cards js-service-block" data-position="<?=$props['PROP_CARDS3_POSITION']['VALUE'] ?>">
            <div class="service-cards__container">
                <? if(!empty($props['PROP_CARDS3_TITLE']['VALUE'])): ?>
                    <h2><?=$props['PROP_CARDS3_TITLE']['VALUE'] ?></h2>
                <? endif; ?>
                <div class="service-cards__block">
                    <? if(!empty($props['PROP_CARDS3_1']['~VALUE']['TEXT'])): ?>
                        <div class="service-cards__block-item">
                            <div class="service-cards__block-item-content">
                                <?=$props['PROP_CARDS3_1']['~VALUE']['TEXT'] ?>
                            </div>
                            <div class="service-cards__block-item-image">
                                <img src="<?=CFile::GetPath($props['PROP_CARDS3_IMAGE1']['VALUE']) ?>" alt="">
                            </div>
                        </div>
                    <? endif; ?>
                    <? if(!empty($props['PROP_CARDS3_2']['~VALUE']['TEXT'])): ?>
                        <div class="service-cards__block-item">
                            <div class="service-cards__block-item-content">
                                <?=$props['PROP_CARDS3_2']['~VALUE']['TEXT'] ?>
                            </div>
                            <div class="service-cards__block-item-image">
                                <img src="<?=CFile::GetPath($props['PROP_CARDS3_IMAGE2']['VALUE']) ?>" alt="">
                            </div>
                        </div>
                    <? endif; ?>
                    <? if(!empty($props['PROP_CARDS3_3']['~VALUE']['TEXT'])): ?>
                        <div class="service-cards__block-item">
                            <div class="service-cards__block-item-content">
                                <?=$props['PROP_CARDS3_3']['~VALUE']['TEXT'] ?>
                            </div>
                            <div class="service-cards__block-item-image">
                                <img src="<?=CFile::GetPath($props['PROP_CARDS3_IMAGE3']['VALUE']) ?>" alt="">
                            </div>
                        </div>
                    <? endif; ?>
                    <? if(!empty($props['PROP_CARDS3_4']['~VALUE']['TEXT'])): ?>
                        <div class="service-cards__block-item">
                            <div class="service-cards__block-item-content">
                                <?=$props['PROP_CARDS3_4']['~VALUE']['TEXT'] ?>
                            </div>
                            <div class="service-cards__block-item-image">
                                <img src="<?=CFile::GetPath($props['PROP_CARDS3_IMAGE4']['VALUE']) ?>" alt="">
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <? if($props['PROP_ACCORD_ACTIVE']['VALUE_XML_ID'] === 'Y'): ?>
        <div class="service-types js-service-block" data-position="<?=$props['PROP_ACCORD_POSITION']['VALUE'] ?>">
            <h2><?=$props['PROP_ACCORD_TITLE']['VALUE'] ?></h2>
            <div class="service-types__items">
                <div class="service-types__item-column">
                    <? foreach ($props['PROP_ACCORD_LIST']['LIST'] as $accKey => $acc): ?>
                        <? if($accKey % 2 == 0): ?>
                            <div class="service-faq__item js-accord-item">
                                <div class="service-faq__item-head js-accord-item-head">
                                    <span><?=$acc['NAME'] ?></span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9L12 15L18 9" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="service-faq__item-body js-accord-item-body">
                                    <?=$acc['PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                        <? endif ?>
                    <? endforeach; ?>
                </div>
                <div class="service-types__item-column">
                    <? foreach ($props['PROP_ACCORD_LIST']['LIST'] as $accKey => $acc): ?>
                        <? if($accKey % 2 != 0): ?>
                            <div class="service-faq__item js-accord-item">
                                <div class="service-faq__item-head js-accord-item-head">
                                    <span><?=$acc['NAME'] ?></span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9L12 15L18 9" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="service-faq__item-body js-accord-item-body">
                                    <?=$acc['PREVIEW_TEXT'] ?>
                                </div>
                            </div>
                        <? endif ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php
//dd($arResult);
//dump($arResult['PROPERTIES']);
//dump($arResult["PROPERTIES"]['PROP_CARDS1']);