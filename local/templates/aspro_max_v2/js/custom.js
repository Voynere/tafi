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
});

