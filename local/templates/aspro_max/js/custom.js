/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/

document.addEventListener('DOMContentLoaded', function() {
	var messageElement = document.querySelector('.cookie-notification');
    if (!$.cookie('agreement')) {
        showMessage();
    } else {
        initCounter();
    }
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document,'script','//mc.yandex.ru/metrika/tag.js', 'ym')
    function addClass (o, c) {
        var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
        if (!o || re.test(o.className)) {
            return;
        }
        o.className = (o.className + " " + c).replace(/\s+/g, " ").replace(/(^ | $)/g, "");
    }
    function removeClass (o, c) {
        var re = new RegExp('(^|\\s)' + c + '(\\s|$)', 'g');
        if (!o) {
            return;
        }
        o.className = o.className.replace(re, '$1').replace(/\s+/g, ' ').replace(/(^ | $)/g, '');
    }
    function hideMessage () {
        addClass(messageElement, 'cookie-notification_hidden_yes');
    }
    function showMessage () {
        removeClass(messageElement, 'cookie-notification_hidden_yes');
    }
    function saveAnswer () {
        hideMessage();

        $.cookie('agreement', '1');
    }
    function initCounter () {
        ym(86792413, 'init', {});
        saveAnswer();
    }
	document.querySelector('#yes') &&
    document.querySelector('#yes').addEventListener('click', function () {
        initCounter();
    });

	const accordItems = document.querySelectorAll('.js-accord-item');

	accordItems &&
	accordItems.forEach(item => {
		item.addEventListener('click', () => accordItem(item, accordItems))
	})

	initServiceBlocksSort();

	const doctorsSlider = new Swiper('.js-doctors-block', {
		speed: 600,
		slidesPerView: 'auto',
		spaceBetween: 20,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		breakpoints: {
			640: {},
		}
	});
})



if(document.getElementById('revealButton') != null) {
	document.getElementById('revealButton').addEventListener('click', function() {
		let soonT = document.querySelector('.soon__text');
		let backT = document.querySelector('.back__text');
		let arrowT = document.querySelector('.text-arrow');
		soonT.classList.toggle('active');
		arrowT.classList.toggle('active')
		backT.classList.toggle('active');
		elementsToHide.forEach(function(element) {
			element.classList.toggle('active');
		});
	});
}
$(function() {

	$('.section_info li:contains("Check-up комплексные программы")').css('display', 'none !important');

	$('.popup.form_14 .btn-default').click(function(){
		$('.popup.form_14').hide();
	})
   $(document).on('click', '.catalog_block .catalog_item  .item_info', function(){
	   
	  let linkItem = $(this).find('.item-title a');
	  
	  if(linkItem.length > 0 && linkItem.attr('href')){
		  location.href = linkItem.attr('href');
	  }
   })
   

   let banners = $('.top_big_banners .flexslider .slides > li');
  
   if(banners.length > 0){
	  
		$(window).on('resize', function(){
	   
			banners.each(function(){
				let item = $(this), width = item.width();
				
				if(width > 1920){
					width = 1920;
				}
				
				item.height(width * 0.344);
				
			});
	   
		});
   }
   

   let flexslider = $('.top_big_banners.only_banner.more_height .top_slider_wrapp .flexslider');
   
   
   if(flexslider.length > 0){
	   
	   $(window).on('load', function(){
		   flexslider.addClass('loaded');
	   });
	   
	   
		if(banners.length > 0){ 
		   banners.each(function(){
					let item = $(this), width = item.width();
					
					if(width > 1920){
						width = 1920;
					}
					
					item.height(width * 0.344);
					
				});
		}  
   }
   
   if(window.innerWidth < 767){
	$('.city-popup').hide().css({'position':'relative'})
   }
   /* let px_ratio = window.devicePixelRatio || window.screen.availWidth / document.documentElement.clientWidth;
 
	window.onresize = () => isZooming();
	function isZooming(){
		var newPx_ratio = window.devicePixelRatio || window.screen.availWidth / document.documentElement.clientWidth;
		if(newPx_ratio != px_ratio){
			px_ratio = newPx_ratio;
			console.log("zooming");
			return true;
		}else{
			console.log("just resizing");
			return false;
		}
	} */
	setTimeout(() => {
		if(window.location.pathname == '/services/uzi/'){
			$('.button_opener.colored').click()
		   }
	}, 100);
	
   BX.addCustomEvent('onAjaxSuccess', function(){
		let site_dir;
		
		if($('body').data('site') !== undefined){
			site_dir = $('body').data('site');
		}	
		
			if(site_dir && site_dir != '/'){
			
				$("a[href^='/']").each(function(){
					
					let href = $(this).attr('href');
					
					if(href.indexOf(site_dir) == -1){
						$(this).attr('href', site_dir + href.slice(1));
					}
					
				});
			}
			
	})	
   
	$(".link_btn").click(function() {
		window.open(
			'https://api.whatsapp.com/send/?phone=79941106261&text&app_absent=0',
			'_blank' // <- This is what makes it open in a new window.
		  );
		
	  });
	  $('.ordered-block li:contains("Генетическая диагностика - полный перечень исследований")').hide();


	  new isvek.Bvi({
		target: '.bvi-open',
		fontSize: 24,
		theme: 'black',
		speech:true,
		panelHide:true
	});

	let  swiperCarouselsProducts = document.querySelectorAll('.js-product-carousel');


    if(swiperCarouselsProducts.length > 0){

        swiperCarouselsProducts.forEach(function(carousel, index){

            let container = carousel.closest('.js-product-carousel-container');
            let prev = container.querySelector('.js-product-carousel-prev');
            let next = container.querySelector('.js-product-carousel-next');
            let pagination = container.querySelector('.js-pagination');

            let swiper= new Swiper(carousel, {

                slidesPerView: "auto",
                loop: false,
                spaceBetween: 8,
                watchSlidesProgress: true,
                slideVisibleClass: 'product-carousel__item--visible',

                breakpoints: {
                    768: {
                        slidesPerView:2
                    },
                    991: {
                        slidesPerView: 2
                    },
                    1199: {
                        slidesPerView: 3,
						spaceBetween: 20,
                    },
                    1599: {
                        slidesPerView: 4,
						spaceBetween: 20,
                    },
                },

                
                pagination: {
                    el: pagination,
                    clickable: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: next,
                    prevEl: prev
                },


            });

        });

    }

	const copyrightCompany = document.querySelectorAll('.itb-copyright .itb-copyright__content');

	if(copyrightCompany.length > 0){

		copyrightCompany.forEach(item => {
			item.addEventListener('click', function(e){
				e.preventDefault();
				this.closest('.itb-copyright').querySelector('.itb-copyright__popup').classList.toggle('itb-copyright__popup--active');
			});

		});
	}
	


	$(".main-header__search .search-input").on("focus keyup mouseenter", function() {
        const item = $(this);
        const popup = item.closest('.main-header__search').find('.search-top-popup');
		const query = $.trim(item.val());

		if(!query){	
        	popup.addClass('search-top-popup--active');
		}

    } );

	$('.search-wrapper').on('mouseleave', function(){
        const popup = $(this).closest('.main-header__search').find('.search-top-popup');
        popup.removeClass('search-top-popup--active');
    });

	$(document).on('change keyup input', '.main-header__search .search-input', function() {
		const $this = $(this);	
		const query = $.trim($this.val());
		const popup = $this.closest('.main-header__search').find('.search-top-popup');

		if(query){			
			popup.removeClass('search-top-popup--active');
		}else{
			popup.addClass('search-top-popup--active');	
		}

	});

	$('.mobilemenu-v1__close, .close-mobile-menu').on('click', function(e){
        e.preventDefault();
        $('#mobilemenu-overlay').click();
    });

	 window.addEventListener('scroll', function(e) {

        const header = document.querySelector('.main-header .main-header__wrapper');

        if(!header)
            return;

        if(this.scrollY > 60){
            header.classList.add('main-header__wrapper--fixed');
        }else{
            header.classList.remove('main-header__wrapper--fixed');
        }

    }, false);

	document.addEventListener('click', function(e) {

		
        let button = e.target.classList.contains('js-basket-add') ? e.target : false;

        if(!button){
            button = e.target.closest('.js-basket-add');
        }

        if (button) {

            e.preventDefault();

            let params = [];

            params['ID'] = button.getAttribute('data-id');

            addProductToBasket(params).then( (result) => {

                if(result.success){

                    button.classList.add('in-basket');
                    button.textContent = 'В корзине';

                    reloadBasketCounters(result['data']['count']);
					
                    BX.onCustomEvent('OnBasketChange');
					
					if($("#ajax_basket").length)
						reloadTopBasket('add', $('#ajax_basket'), 200, 5000, 'Y');

					if($("#basket_line .basket_fly").length){
						if(th.closest('.services_in_basket').length && !window.matchMedia('(max-width: 767px)').matches){
							basketFly('open', 'SHOW');//need for buy services in basket_fly
						} 
						else if(th.closest('.fast_view_frame').length || window.matchMedia('(max-width: 767px)').matches  || $("#basket_line .basket_fly.loaded").length)
							basketFly('open', 'N');
						else{
							basketFly('open');											
						}
							
					}

                    if($(".top_basket").length){
                        basketTop('open', $(".top_basket").find('.basket_hover_block'));
                    }


                }


            }).catch( ()=> {
                console.log('error');
            });

        }
    });


});
let listL = document.querySelector('.controls-view__link--list ');
let listB = document.querySelector('.controls-view__link--block ');

if (listL || listB) {
	window.addEventListener('resize', function() {
		if (window.innerWidth <= 757) {
			listB.click();
		}
		if (window.innerWidth >= 757) {
			listL.click();
		}
	});
}

function accordItem(item, items) {
	const itemHead = item.querySelector('.js-accord-item-head');
	const itemBody = item.querySelector('.js-accord-item-body');

	items &&
	items.forEach(accordItem => {
		const accordItemHead = accordItem.querySelector('.js-accord-item-head');
		const accordItemBody = accordItem.querySelector('.js-accord-item-body');
		if(accordItem.classList.contains('opened') && itemHead !== accordItemHead) {
			accordItem.classList.remove('opened')
			accordItemBody.style.height = '0';
		}
	})

	if(item.classList.contains('opened')) {
		item.classList.remove('opened')
		itemBody.style.height = '0';
	} else {
		item.classList.add('opened')
		itemBody.style.height = itemBody.scrollHeight + 'px';
	}
}

function initServiceBlocksSort() {
	const serviceBlocks = document.querySelectorAll('.js-service-block');
	if (serviceBlocks.length) {
		sortServiceBlocks(serviceBlocks);
	}
}

if (window.BX) {
	BX.ready(initServiceBlocksSort);
}

function sortServiceBlocks(blocks) {
	const blocksArray = Array.from(blocks);
	const container = blocksArray[0]?.parentNode;

	blocksArray.sort((a, b) => {
		const posA = parseInt(a.dataset.position) || 0;
		const posB = parseInt(b.dataset.position) || 0;
		return posA - posB;
	});

	blocksArray.forEach(block => container.appendChild(block));
}

async function addProductToBasket(paramsIn) {
    const url = '/bitrix/services/main/ajax.php?mode=class&c=itb:basket.update&action=basketUpdate';

    let params = new FormData();

    params.append("sessid", BX.bitrix_sessid());
    params.append("ID", paramsIn['ID']);

    const response = await fetch(url, {
        method: 'POST',
        body: params
    });
    const answer = await response.json();

    BX.onCustomEvent('OnBasketChange');

    return answer['data'];
}
(function(window, document) {
    'use strict';

    const DEBUG = true; // 🔧 Выключите в продакшене
    const log = (...args) => DEBUG && console.log('[UTM-Phone]', ...args);
    const warn = (...args) => DEBUG && console.warn('[UTM-Phone]', ...args);
    const error = (...args) => DEBUG && console.error('[UTM-Phone]', ...args);

    const CONFIG = {
        utmToPhone: {
            'test': '+7 (423) 239-32-72',
        },
        defaultPhone: '+7 (423) 242-56-60',
        selectors: ['.phone-number', 'a[href^="tel:"]', '[data-phone]'],
        // Селекторы контейнеров, внутри которых НЕ нужно подменять телефоны (карточки магазинов/филиалов)
        excludeContainers: ['.shop-detail1', '.store-item', '.stores-list1', '.shops-list1', '.contacts-stores', '.contacts_map', '.item-body'],
        storageKey: 'utm_phone_session'
    };

    log('🚀 Скрипт запущен', {
        url: window.location.href,
        selectors: CONFIG.selectors
    });

    function getUTM(name) {
        const value = new URLSearchParams(window.location.search).get(name)?.toLowerCase() || '';
        log(`🔍 UTM-параметр "${name}":`, value || '(не найден)');
        return value;
    }

    function resolvePhone() {
        log('📞 resolvePhone() — определение номера');
        
        const stored = sessionStorage.getItem(CONFIG.storageKey);
        if (stored) {
            log('✅ Номер взят из sessionStorage:', stored);
            return stored;
        }
        log('ℹ️ В sessionStorage ничего нет');

        const source = getUTM('utm_source');
        const medium = getUTM('utm_medium');
        const combined = source && medium ? `${source}_${medium}` : source;
        
        log('🔑 Ключи для поиска:', { source, medium, combined });

        const phone = CONFIG.utmToPhone[combined] 
                   || CONFIG.utmToPhone[source] 
                   || CONFIG.defaultPhone;
        
        log('🎯 Найденный номер:', phone, {
            matchedKey: CONFIG.utmToPhone[combined] ? combined : 
                       CONFIG.utmToPhone[source] ? source : 'default'
        });

        sessionStorage.setItem(CONFIG.storageKey, phone);
        log('💾 Номер сохранён в sessionStorage');
        
        return phone;
    }

    function toTelHref(phone) {
        const digits = phone.replace(/[^\d]/g, '');
        const href = digits ? `tel:+${digits}` : '';
        log('🔗 toTelHref():', { original: phone, digits, result: href });
        return href;
    }

    function replacePhone(phone) {
        log('🔄 replacePhone() — начало подмены', { phone });
        const telHref = toTelHref(phone);
        let totalReplaced = 0;

        // Проверка: элемент находится внутри исключённого контейнера?
        function isInsideExcludedContainer(el) {
            if (!CONFIG.excludeContainers || !CONFIG.excludeContainers.length) return false;
            for (const containerSelector of CONFIG.excludeContainers) {
                if (el.closest(containerSelector)) {
                    log(`   ⛔ Элемент внутри исключённого контейнера "${containerSelector}", пропускаем`);
                    return true;
                }
            }
            return false;
        }

        CONFIG.selectors.forEach(selector => {
            log(`🔎 Поиск по селектору: "${selector}"`);
            const elements = document.querySelectorAll(selector);
            log(`   Найдено элементов: ${elements.length}`);
            
            if (elements.length === 0) {
                warn(`⚠️ По селектору "${selector}" ничего не найдено. Проверьте, есть ли такие элементы в DOM.`);
            }

            elements.forEach((el, idx) => {
                try {
                    log(`   [${idx}] Элемент:`, el);

                    // Пропускаем элементы внутри карточек магазинов/филиалов
                    if (isInsideExcludedContainer(el)) {
                        return;
                    }
                    
                    // Сохраняем оригинал для отладки
                    if (!el.dataset.phoneOriginal) {
                        el.dataset.phoneOriginal = el.textContent;
                    }

                    // Меняем текст
                    const oldText = el.textContent;
                    el.textContent = phone;
                    log(`   ✏️ Текст: "${oldText}" → "${el.textContent}"`);
                    
                    // Меняем href для tel:
                    if (el.tagName === 'A' && el.getAttribute('href')?.toLowerCase().startsWith('tel:')) {
                        const oldHref = el.href;
                        el.href = telHref;
                        log(`   🔗 href: "${oldHref}" → "${el.href}"`);
                    }
                    
                    // Меняем data-атрибут
                    if (el.hasAttribute('data-phone')) {
                        el.setAttribute('data-phone', phone);
                        log(`   📦 data-phone обновлён`);
                    }
                    
                    totalReplaced++;
                } catch (e) {
                    error(`❌ Ошибка при обработке элемента [${idx}]:`, e, el);
                }
            });
        });

        log(`✅ Подмена завершена. Всего изменено элементов: ${totalReplaced}`);
        
        if (totalReplaced === 0) {
            warn('⚠️ Ни один элемент не был изменён! Возможные причины:');
            warn('   • Элементы ещё не отрисованы в DOM (попробуйте вызвать скрипт позже)');
            warn('   • Селекторы не совпадают с реальной разметкой');
            warn('   • Элементы находятся внутри shadow-DOM или iframe');
            warn('   • Скрипт загружается после того, как номер уже был отрисован динамически');
        }
    }

    function init() {
        log('⚙️ init() — инициализация');
        
        if (document.body === null) {
            warn('⚠️ document.body ещё не готов, откладываем инициализацию');
            setTimeout(init, 50);
            return;
        }

        try {
            const targetPhone = resolvePhone();
            replacePhone(targetPhone);
            
            // 🔍 Финальная проверка: выводим текущее состояние целевых элементов
            log('🔍 Финальная проверка DOM:');
            CONFIG.selectors.forEach(selector => {
                document.querySelectorAll(selector).forEach((el, i) => {
                    log(`   ${selector}[${i}]:`, {
                        text: el.textContent,
                        href: el.href,
                        dataPhone: el.getAttribute('data-phone')
                    });
                });
            });
        } catch (e) {
            error('💥 Критическая ошибка в init():', e);
        }
    }

    if (document.readyState === 'loading') {
        log('📄 Документ ещё загружается, ждём DOMContentLoaded');
        document.addEventListener('DOMContentLoaded', init);
    } else {
        log('📄 Документ уже готов, запускаем сразу');
        init();
    }

})(window, document);