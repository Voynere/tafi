document.addEventListener('DOMContentLoaded', function() {
    const swiperBannerMain = document.querySelectorAll('.js-doctors-carouser');

    if (swiperBannerMain.length > 0) {
        swiperBannerMain.forEach(function(carousel, index) {
            const container = carousel;        
            const pagination = container.querySelector('.js-pagination');

            const swiper = new Swiper(carousel, {
                slidesPerView: 'auto',
                loop: false,
                spaceBetween: 8,

                 breakpoints: {
                        768: {
                           spaceBetween: 20
                        },            
                    },


                pagination: {
                    el: pagination,
                },
            });
        });
    }
});