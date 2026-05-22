<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>

	<div class="front-reviews">

		<div class="front-reviews__header">

			<div class="front-reviews__header-title">
				<?=$arParams['TITLE_BLOCK'];?>
			</div>

			<span class="front-reviews__show-form front-reviews__show-form--desktop" data-no-mobile="Y" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review" title="<?=$arParams['TITLE_ADD_REVIEW'] ;?>">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_4159_165)">
					<path d="M7.03117 10.7812L3.90625 13.9062V10.7812H2.34375C1.48082 10.7812 0.78125 10.0817 0.78125 9.21875V2.96875C0.78125 2.10582 1.48082 1.40625 2.34375 1.40625H11.7188C12.5817 1.40625 13.2812 2.10582 13.2812 2.96875V9.21875C13.2812 10.0817 12.5817 10.7812 11.7188 10.7812H7.03117Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.4375 13.9062C8.4375 14.7692 9.13707 15.4688 10 15.4688H13.1251L16.25 18.5938V15.4688H17.6562C18.5192 15.4688 19.2188 14.7692 19.2188 13.9062V7.65625C19.2188 6.79332 18.5192 6.09375 17.6562 6.09375H16.0938" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<circle cx="3.90625" cy="6.09375" r="0.78125" fill="white"/>
					<circle cx="7.03125" cy="6.09375" r="0.78125" fill="white"/>
					<circle cx="10.1562" cy="6.09375" r="0.78125" fill="white"/>
					</g>
					<defs>
					<clipPath id="clip0_4159_165">
					<rect width="20" height="20" fill="white"/>
					</clipPath>
					</defs>
				</svg>

				Оставить отзыв

			</span>

			<a href="<?=SITE_DIR.$arParams['ALL_URL'];?>" class="front-reviews__all-btn">
				<?=$arParams['TITLE_BLOCK_ALL'] ;?>
				<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 9L5 5L1 1" stroke="#767B81" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
		</div>
		
		<div class="front-reviews__body js-carousel-container">

			<div class="carouser-nav">

				<div class="carouser-nav__button carouser-nav__button--prev js-carouser-nav-prev">
					<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7 13L1 7L7 1" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

				<div class="carouser-nav__button carouser-nav__button--next js-carouser-nav-next">
					<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 13L7 7L1 1" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>

			</div>

			<div class="front-reviews__carousel">
				
				<div class="reviews-carousel swiper js-reviews-carousel">

					<div class="reviews-list-items reviews-carousel-wrapper swiper-wrapper">
						<?foreach($arResult['ITEMS'] as $i => $arItem){?>
							<?
							$this->AddEditAction(
									$arItem['ID'],
									$arItem['EDIT_LINK'],
									CIBlock::GetArrayByID(
											$arItem["IBLOCK_ID"],
											"ELEMENT_EDIT"
									)
							);
							$this->AddDeleteAction(
									$arItem['ID'],
									$arItem['DELETE_LINK'],
									CIBlock::GetArrayByID(
											$arItem["IBLOCK_ID"],
											"ELEMENT_DELETE"),
									array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
							);

							?>
							<div class="reviews-list-items__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

								<div class="reviews-list-items__item-top">

									<div class="reviews-list-items__item-meta">
										<span class="reviews-list-items__person"><?=$arItem['NAME']?></span>
										<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && $arItem['DISPLAY_ACTIVE_FROM']):?>
											<span class="reviews-list-items__date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
										<?endif;?>
									</div>
									

									<?if(in_array('RATING', $arParams['PROPERTY_CODE'])):?>
										<?$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);?>
										<div class="reviews-list-items__rating">
											<div class="ratings-review">										
												<?for($i=1;$i<=5;$i++):?>
													<div class="ratings-review__item <?=(round($ratingValue) >= $i ? "ratings-review__item--filed" : "");?>">
														<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M7.75954 0.952963C8.11793 0.181231 9.21507 0.181231 9.57347 0.952963L11.2653 4.59594C11.411 4.9097 11.7085 5.12586 12.0519 5.16748L16.0394 5.65075C16.8841 5.75313 17.2232 6.79657 16.6 7.37591L13.6581 10.1107C13.4047 10.3462 13.2911 10.696 13.3576 11.0354L14.1302 14.9771C14.2938 15.8121 13.4062 16.457 12.6627 16.0433L9.15268 14.0905C8.85038 13.9223 8.48263 13.9223 8.18033 14.0905L4.67033 16.0433C3.92676 16.457 3.03916 15.8121 3.20282 14.9771L3.9754 11.0354C4.04194 10.696 3.9283 10.3462 3.67493 10.1107L0.733049 7.37591C0.109839 6.79657 0.448874 5.75313 1.29359 5.65075L5.28107 5.16748C5.62449 5.12586 5.92201 4.9097 6.06772 4.59594L7.75954 0.952963Z" fill="#D9D9D9"/>
														</svg>											
													</div>
												<?endfor;?>										
											</div>
										</div>
									<?endif;?>

								</div>
								

								<div class="reviews-list-items__preview-text"><?=$arItem['FIELDS']['PREVIEW_TEXT'];?></div>

								<?if(($arParams['PREVIEW_TRUNCATE_LEN'] > 0) && (strlen($arItem['~PREVIEW_TEXT']) > $arParams['PREVIEW_TRUNCATE_LEN'])):?>
									<div class="reviews-list-items__more">
										<span class="reviews-list-items__more-btn" data-event="jqm" data-param-id="<?=$arItem['ID'];?>" data-param-type="review" data-name="review">Показать весь отзыв</span>
									</div>
								<?endif;?>
								
							</div>

						<?}?>
					</div>
					
				</div>
			</div>

			<span class="front-reviews__show-form front-reviews__show-form--mobile" data-no-mobile="Y" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review" title="<?=$arParams['TITLE_ADD_REVIEW'] ;?>">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_4159_165)">
					<path d="M7.03117 10.7812L3.90625 13.9062V10.7812H2.34375C1.48082 10.7812 0.78125 10.0817 0.78125 9.21875V2.96875C0.78125 2.10582 1.48082 1.40625 2.34375 1.40625H11.7188C12.5817 1.40625 13.2812 2.10582 13.2812 2.96875V9.21875C13.2812 10.0817 12.5817 10.7812 11.7188 10.7812H7.03117Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.4375 13.9062C8.4375 14.7692 9.13707 15.4688 10 15.4688H13.1251L16.25 18.5938V15.4688H17.6562C18.5192 15.4688 19.2188 14.7692 19.2188 13.9062V7.65625C19.2188 6.79332 18.5192 6.09375 17.6562 6.09375H16.0938" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<circle cx="3.90625" cy="6.09375" r="0.78125" fill="white"/>
					<circle cx="7.03125" cy="6.09375" r="0.78125" fill="white"/>
					<circle cx="10.1562" cy="6.09375" r="0.78125" fill="white"/>
					</g>
					<defs>
					<clipPath id="clip0_4159_165">
					<rect width="20" height="20" fill="white"/>
					</clipPath>
					</defs>
				</svg>

				Оставить отзыв

			</span>
		</div>
	</div>

	 <script>
       
        const swiperReviews = document.querySelectorAll('.js-reviews-carousel');

        if (swiperReviews.length > 0) {
            swiperReviews.forEach(function(carousel, index) {  
				
				const constainer = carousel.closest('.js-carousel-container');
				const prev = constainer.querySelector('.js-carouser-nav-prev');
            	const next = constainer.querySelector('.js-carouser-nav-next');


                const swiper = new Swiper(carousel, {
                    slidesPerView: 'auto',
                    loop: false,
                    spaceBetween: 8,

					// Navigation arrows
					navigation: {
						nextEl: next,
						prevEl: prev
					},

					 breakpoints: {

						768: {
							slidesPerView: 2
						},

						991: {
							slidesPerView: 2,
							spaceBetween: 20,
						},

						1280: {
							slidesPerView: 3,
							spaceBetween: 20,
						}
					},

                });
            });
        }
       
    </script>
<?endif;?>