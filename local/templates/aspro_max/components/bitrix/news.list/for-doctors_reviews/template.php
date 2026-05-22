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

	 $jsParams = [
		'ITEMS' => $arResult["ITEMS"],
		'PARAMETERS' => \Bitrix\Main\Component\ParameterSigner::signParameters($component->__name, $arParamsCleared),
		"COMPONENT_NAME" => $component->__name,
		"TEMPLATE_NAME" => $templateName,
		'SWIPER_CONTAINER' => 'for-doctors-reviews-swiper__container'
	];
    ?>

	<div class="<?= $jsParams['SWIPER_CONTAINER'] ?>">
        <div class="swiper for-doctors-reviews-swiper">
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
                        <? if (!empty($review["NAME"]) || !empty($review["RATING"])): ?>
                            <div class="slide__top">
										<? if($review["NAME"]): ?>
                     			     <div class="slide__name"><?=$review["NAME"]?></div>
                     			 <? endif; ?>
                                <div class="slider__top-rating">
                                    <? foreach ($review["RATING"] as $star):?>
													<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
														<g clip-path="url(#clip0_2396_76)">
															<path d="M9.761 1.95296C10.1194 1.18123 11.2165 1.18123 11.5749 1.95296L13.2668 5.59594C13.4125 5.9097 13.71 6.12586 14.0534 6.16748L18.0409 6.65075C18.8856 6.75313 19.2246 7.79657 18.6014 8.37591L15.6595 11.1107C15.4062 11.3462 15.2925 11.696 15.3591 12.0354L16.1316 15.9771C16.2953 16.8121 15.4077 17.457 14.6641 17.0433L11.1541 15.0905C10.8518 14.9223 10.4841 14.9223 10.1818 15.0905L6.67179 17.0433C5.92823 17.457 5.04062 16.8121 5.20429 15.9771L5.97687 12.0354C6.0434 11.696 5.92976 11.3462 5.67639 11.1107L2.73451 8.37591C2.1113 7.79657 2.45034 6.75313 3.29505 6.65075L7.28253 6.16748C7.62595 6.12586 7.92347 5.9097 8.06918 5.59594L9.761 1.95296Z" fill="#FFC700"/>
														</g>
														<defs>
															<clipPath id="clip0_2396_76">
																<rect width="20" height="20" fill="white" transform="translate(0.667969)"/>
															</clipPath>
														</defs>
													</svg>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if($review["DATE"]): ?>
                           <div class="slider__top-date"><?=$review["DATE"]?></div>
                        <? endif; ?>
                        <p class="slide__review" id="reviewText_<?= $index ?>">
                            <?= $review["REVIEW"]; ?>
                        </p>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="for-doctors-reviews-next">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M21 30L27 24L21 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="for-doctors-reviews-prev">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="white"/>
                <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#EBEDF1"/>
                <path d="M27 30L21 24L27 18" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
<?endif;?>
<script>
	BX.JCDoctorReviews.init({
		result: <?= CUtil::PhpToJSObject($jsParams, false, true) ?>
	});
</script>
