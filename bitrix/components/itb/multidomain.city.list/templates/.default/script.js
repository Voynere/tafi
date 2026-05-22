	$(document).on('click', '.city-selector-btn', function(e) {
        e.preventDefault();
		
	
		
		var url = $(this).attr('data-href'), elem = $(this), selector = elem.find('.cities-list-selector');
		
		if(selector.length == 0){
			
			
			
			var request = $.ajax({
			  url: url,
			  method: "POST",
			 // data: {},
			  dataType: "html"
			});
			 
			request.done(function( msg ) {
			  elem.append( msg ).addClass('active');
			});
		}else{
			
			if($(e.target).hasClass('city-selector-btn')){
				elem.toggleClass('active');
			}
			
		}	
		
		
    });
	
	$(document).on('click', '.city-selector-btn .cities-list-selector a', function(e) {
		
		location.href = $(this).attr('href');
	});
	
	$(document).on('mouseleave', '.city-selector-btn .cities-list-selector', function(){
		$(this).closest('.city-selector-btn').removeClass('active');
	});
	
	
    $(document).on('change keyup', '.city-popup .search-city-input', function() {
        var count = 0;
        var need = $(this).val().toLowerCase();
        var result = '';
        var content = $(this).closest('.city-popup').find('.cities-items');
        var cityList = $('.cities-items').find('a');
        if (need) {
            cityList.each(function() {
                var elem = $(this);
                var str = elem.text().toLowerCase();
                if ((str).indexOf(need) >= 0) {
                    result += '<div class="city-item"><a href="' + elem.attr('href') + '">' + elem.text() + '</a></div>';
                    count++;
                }
            });
        }
        if (result) {
            result = result;
        } else if (need) {
            result = '<div class="no-result">По запросу ничего не найдено</div>'
        }
        if (result) {
            content.hide();
        } else {
            content.show();
        }
        $('.city-popup .search-result').html(result);
    });
    
   
    $(document).on('click', '.city-popup .clearbtn', function(){     
      $(this).closest('.search-city').find('.search-city-input').val('').change();
    });