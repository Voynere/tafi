
$(document).on('click', '.city-selector-btn .cities-list-selector a', function(e) {
	
	location.href = $(this).attr('href');
});

$(document).on('mouseleave', '.city-selector-btn .cities-list-selector', function(){
	$(this).closest('.city-selector-btn').removeClass('active');
});
	