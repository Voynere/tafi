<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
    <?
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
    ?>

	<div class="kids-swiper__container">
        <div class="swiper kids-swiper">
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
                            <div class="slide__top">
                                <div class="slider__top-date"><?=$review["DATE"]?></div>
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
                        <? if($review["NAME"]): ?>
                            <div class="slide__name"><?=$review["NAME"]?></div>
                        <? endif; ?>
                        <p class="slide__review" id="reviewText_<?= $index ?>">
                            <?= strlen($review["REVIEW"]) > 250 ? mb_substr($review["REVIEW"], 0, 250) . '...' : $review["REVIEW"]; ?>
                        </p>

                        <?php if (strlen($review["REVIEW"]) > 250): ?>
                            <button class="slide__review-shor-more" id="showMore_<?= $index ?>" onclick="showMore(<?= $index ?>)">Читать полностью</button>
                            <p class="slide__review" id="fullText_<?= $index ?>" style="display:none;"><?= $review["REVIEW"]; ?></p>
                        <?php endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="kids-next">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M21 30L27 24L21 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="kids-prev">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M27 30L21 24L27 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    <script>
        let countItems = '<?=count($arResult["ITEMS"])?>';

        if (countItems >= 3) countItems = 3;

        var swiper = new Swiper(".kids-swiper", {
            navigation: {
                nextEl: ".kids-next",
                prevEl: ".kids-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
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