<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
?>
<?if($arResult['ITEMS']):?>
    <?
    if(!function_exists('formatData'))
    {
        function formatData($date)
        {
            if (empty($date)) return null;
            $months = [
                '01' => 'января',
                '02' => 'февраля',
                '03' => 'марта',
                '04' => 'апреля',
                '05' => 'мая',
                '06' => 'июня',
                '07' => 'июля',
                '08' => 'августа',
                '09' => 'сентября',
                '10' => 'октября',
                '11' => 'ноября',
                '12' => 'декабря',
            ];
            $dateArr = explode('.', explode(' ', $date)[0]);
            return $dateArr[0] . ' ' . $months[$dateArr[1]] . ' ' . $dateArr[2];
        }
    }

    if(!function_exists('makeeRating'))
    {
        function makeRating($rate)
        {
            if (empty($rate)) return null;

            $stars = [];

            for ($i = 1; $i <= 5; $i++)
            {
                if ($i <= $rate) {
                    array_push($stars, 'full');
                }
                else
                {
                    array_push($stars, 'empty');
                }
            }

            return $stars;
        }
    }

    $symbolQuantity = 150;
    ?>
    <div class="doctor-reviews__reviews">
        <div class="doctor-reviews__reviews-top">
            <h2 class="doctor-reviews__reviews-title"><?= Loc::getMessage('MSG_REVIEWS_TITLE')?></h2>
            <div class="doctor-reviews__right">
                <span class="btn btn-default btn-lg animate-load has-ripple" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.03117 10.7812L3.90625 13.9062V10.7812H2.34375C1.48082 10.7812 0.78125 10.0817 0.78125 9.21875V2.96875C0.78125 2.10582 1.48082 1.40625 2.34375 1.40625H11.7188C12.5817 1.40625 13.2812 2.10582 13.2812 2.96875V9.21875C13.2812 10.0817 12.5817 10.7812 11.7188 10.7812H7.03117Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.4375 13.9062C8.4375 14.7692 9.13707 15.4688 10 15.4688H13.1251L16.25 18.5938V15.4688H17.6562C18.5192 15.4688 19.2188 14.7692 19.2188 13.9062V7.65625C19.2188 6.79332 18.5192 6.09375 17.6562 6.09375H16.0938" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="3.90625" cy="6.09375" r="0.78125" fill="white"/>
                        <circle cx="7.03125" cy="6.09375" r="0.78125" fill="white"/>
                        <circle cx="10.1562" cy="6.09375" r="0.78125" fill="white"/>
                    </svg>
                    <?= Loc::getMessage('MSG_REVIEWS_LEAVE_REVIEW') ?>
                </span>
                <a 
                    class="doctor-detail__reviews-link" 
                    target="_blank" 
                    href="/company/reviews/"
                >
                    <?= Loc::getMessage('MSG_REVIEWS_ALL_REVIEWS') ?>
                    <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
                </a>
            </div>
        </div>
        <div class="doctor-swiper__container">
            <div class="swiper doctor-swiper">
                <div class="swiper-wrapper">
                    <? foreach ($arResult["ITEMS"] as $index => $item): ?>
                        <?
                        $review = [
                            "NAME" => $item["NAME"],
                            "REVIEW" => $item["PREVIEW_TEXT"],
                            "DATE" => formatData($item["DATE_ACTIVE_FROM"]),
                            "RATING" => makeRating($item["PROPERTIES"]["RATING"]["VALUE"]),
                        ];
                        if (empty($review["REVIEW"])) continue;
                        ?>
                        <div class="swiper-slide slide">
                            <? if (!empty($review["DATE"]) || !empty($review["RATING"])): ?>
                                <div class="slider__top">
                                    <div class="slide__top-left">
                                        <? if($review["NAME"]): ?>
                                            <div class="slide__name"><?=$review["NAME"]?></div>
                                        <? endif; ?>
                                        <div class="slider__top-date"><?=$review["DATE"] . ' г.'?></div>
                                    </div>
                                    <div class="slider__top-rating">
                                        <? foreach ($review["RATING"] as $star):?>
                                            <svg class="slider__top-rating-<?=$star?>" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1035_105)">
                                                    <path d="M8.31978 1.46472C8.58857 0.885922 9.41143 0.885923 9.68023 1.46472L11.3741 5.11204C11.4833 5.34735 11.7065 5.50947 11.964 5.54069L15.9563 6.02454C16.5898 6.10132 16.8441 6.8839 16.3767 7.3184L13.4313 10.0564C13.2413 10.2331 13.156 10.4954 13.2059 10.75L13.9794 14.6963C14.1022 15.3226 13.4365 15.8063 12.8788 15.496L9.36463 13.5409C9.13791 13.4147 8.86209 13.4147 8.63537 13.5409L5.12119 15.496C4.56352 15.8063 3.89781 15.3226 4.02056 14.6963L4.79406 10.75C4.84396 10.4954 4.75873 10.2331 4.5687 10.0564L1.62332 7.3184C1.15591 6.8839 1.41019 6.10132 2.04373 6.02454L6.03595 5.54069C6.29352 5.50947 6.51666 5.34735 6.62594 5.11204L8.31978 1.46472Z" fill=""/>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1035_105">
                                                        <rect width="18" height="18" fill="white"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            <? endif; ?>
                            <p class="slide__review" id="reviewText_<?= $index ?>">
                                <?= strlen($review["REVIEW"]) > $symbolQuantity ? mb_substr($review["REVIEW"], 0, $symbolQuantity) . '...' : $review["REVIEW"]; ?>
                            </p>

                            <?php if (strlen($review["REVIEW"]) > $symbolQuantity): ?>
                                <button class="slide__review-shor-more" id="showMore_<?= $index ?>" onclick="showMore(<?= $index ?>)"><?= Loc::getMessage('MSG_REVIEW_SHOW_FULLTEXT') ?></button>
                                <p class="slide__review" id="fullText_<?= $index ?>" style="display:none;"><?= $review["REVIEW"]; ?></p>
                            <?php endif; ?>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <div class="doctor-next">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                    <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                    <path d="M21 30L27 24L21 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="doctor-prev">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                    <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                    <path d="M27 30L21 24L27 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="doctor-reviews__right mobile">
                <span class="btn btn-default btn-lg animate-load has-ripple" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.03117 10.7812L3.90625 13.9062V10.7812H2.34375C1.48082 10.7812 0.78125 10.0817 0.78125 9.21875V2.96875C0.78125 2.10582 1.48082 1.40625 2.34375 1.40625H11.7188C12.5817 1.40625 13.2812 2.10582 13.2812 2.96875V9.21875C13.2812 10.0817 12.5817 10.7812 11.7188 10.7812H7.03117Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.4375 13.9062C8.4375 14.7692 9.13707 15.4688 10 15.4688H13.1251L16.25 18.5938V15.4688H17.6562C18.5192 15.4688 19.2188 14.7692 19.2188 13.9062V7.65625C19.2188 6.79332 18.5192 6.09375 17.6562 6.09375H16.0938" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="3.90625" cy="6.09375" r="0.78125" fill="white"/>
                        <circle cx="7.03125" cy="6.09375" r="0.78125" fill="white"/>
                        <circle cx="10.1562" cy="6.09375" r="0.78125" fill="white"/>
                    </svg>
                    <?= Loc::getMessage('MSG_REVIEWS_LEAVE_REVIEW') ?>
                </span>
            </div>
        </div>
    </div>
    <script>
        let countItems = '<?=count($arResult["ITEMS"])?>';

        if (countItems >= 3) countItems = 3;

        var swiper = new Swiper(".doctor-swiper", {
            navigation: {
                nextEl: ".doctor-next",
                prevEl: ".doctor-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1.1,
                    spaceBetween: 8,
                    slidesOffsetBefore: 20
                },
                576: {
                    slidesPerView: countItems - 1,
                    spaceBetween: 30
                },
                1200: {
                    slidesPerView: countItems,
                    spaceBetween: 24,
                }
            }
        });

        function showMore(index) {
            document.getElementById('reviewText_' + index).style.display = 'none';
            document.getElementById('showMore_' + index).style.display = 'none';
            document.getElementById('fullText_' + index).style.display = 'block';
        }
    </script>
<?endif;?>