/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/


$(function() {
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
   
  
});

