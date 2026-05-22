BX.namespace('BX.JCDoctorReviews');

(function () {
	'use strict';

	BX.JCDoctorReviews = {
		init: function (parameters) {
			this.result = parameters.result;
			this.swiper = {};

			this.arrayItems = document.querySelectorAll('.' + this.result.SWIPER_CONTAINER + ' .swiper-slide');
			if (this.result.ITEMS != null) {
				this.initSwiper(this.arrayItems);
				this.processReviews(this.arrayItems);
			}
		},

		processReviews: function (items) {
			items.forEach((item, index, array) => {
				this.fixedHeight(item, index)
			});
		},

		fixedHeight: function (item, index) {
			let reviewItem = item.querySelector('.slide__review'), buttonShowMore;

			if (reviewItem.scrollHeight > 168) {
				reviewItem.style.height = '168px'
				buttonShowMore = document.createElement('div');
				buttonShowMore.innerHTML = `<button class="slide__review-shor-more" id="showMore_${index}" onclick="BX.JCDoctorReviews.showMore(${index})">Показать весь отзыв</button>`;
				item.appendChild(buttonShowMore);
			}
		},

		initSwiper: function (items) {
			let countItems = items.length;
			if (countItems >= 3) countItems = 3;

			this.swiper = new Swiper(".for-doctors-reviews-swiper", {
				navigation: {
					nextEl: ".for-doctors-reviews-next",
					prevEl: ".for-doctors-reviews-prev",
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
						spaceBetween: 20,
					}
				}
			});
		},

		showMore: function (index) {
			document.getElementById('reviewText_' + index).style.height = 'auto';
			document.getElementById('showMore_' + index).remove();
		}
	}
})();
