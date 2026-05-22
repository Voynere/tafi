$(document).ready(function(){
	$('.content-sections1 .body-info .button_opener').on('click', function(e){
	
		var _this = $(this),
			slideBlock = _this.closest('.body-info').find('.text.childs'),
			bOpen = slideBlock.is(':visible'),
			btnOpen = _this.find('.opener'),
			dur = bOpen ? 200 : 400,
			func = (bOpen ? 'slideUp' : 'slideDown'),
			openText = (typeof(btnOpen.data('open_text')) !== 'undefined' ? btnOpen.data('open_text') : ''),
			closeText = (typeof(btnOpen.data('close_text')) !== 'undefined' ? btnOpen.data('close_text') : '');

		if(slideBlock.length)
		{
			//if(!$(e.target).closest('a').length && !$(e.target).hasClass('dark_link'))
			//{
				slideBlock.velocity(func, {duration: dur, easing: 'easeOutQuart'});
				slideBlock.toggleClass('opened');
			//}
			
			if(slideBlock.hasClass('opened')){
				if(openText.length){
					btnOpen.text(openText);
				}
			}
			else if(!slideBlock.hasClass('opened')){
				if(closeText.length){
					btnOpen.text(closeText);
				}
			}
		}
	})
});

document.addEventListener('DOMContentLoaded', function () {
	const openers = document.querySelectorAll('.nsections__button');

	openers.forEach(function (opener) {
		opener.addEventListener('click', function () {
			const parentBlock = opener.closest('.nsections__item');
			const allItems = parentBlock.querySelectorAll('.nsections__li');
			const hiddenItems = parentBlock.querySelectorAll('.nsections__li.hidden');

			if (opener.classList.contains('open')) {
				for (let i = 0; i < allItems.length; i++) {
					if (i >= 4)
					{
						allItems[i].classList.add('hidden')
					}
				}
				opener.classList.remove('open');
			} else {
				hiddenItems.forEach(function (item) {
					item.classList.remove('hidden');
				});
				opener.classList.add('open');
			}

			const openerText = opener.querySelector('.nsections__button-span');
			if (openerText.textContent === openerText.dataset.open_text) {
				openerText.textContent = openerText.dataset.close_text;
			} else {
				openerText.textContent = openerText.dataset.open_text;
			}
		});
	});

	let hiddenBreadCrumbs = document.querySelector('#hiddenBreadcrumbs');

	if (hiddenBreadCrumbs) {
		let bannerBreadcrumbs = document.querySelector('.banner__breadcrumbs');
		bannerBreadcrumbs.innerHTML = hiddenBreadCrumbs.innerHTML;
	}

});






