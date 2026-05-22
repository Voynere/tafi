<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$url = urlencode($_SERVER['REQUEST_URI']); 
use \Bitrix\Main\Config\Option;

if ($APPLICATION->GetCurPage() != '/order/' || $APPLICATION->GetCurPage() != '/basket/') {
  setcookie("activeCity", $arResult['ACTIVE_CITY']['NAME'], time() + 3600);
}
?>
<? if(Option::get('itb.multidomains', "hide_selector") != 'Y'){?>

	<div class="cities-row">
		
		<div data-href="<?=$templateFolder?>/ajax.php?url=<?=$url?>" class="location-top ajax-popup-city">
			
			<span class="city-active">		
				<?=$arResult['ACTIVE_CITY']['NAME']?>
				<svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.75 0.75L3.75 3.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
			</span>
		
		
		</div>

		<?$frame = $this->createFrame()->begin('');?>
		<? if($arResult['SHOW_FORM']):?>
			<div class="question-city">

				<div class="question-city__content">
					<span class="question-city__label">Ваш город</span>				
					<span class="question-city__title"><?=$arResult['ACTIVE_CITY']['NAME']?></span>?
				</div>				
				
				<div class="question-city__buttons">
				   <button type="button" class="question-city__button question-city__button--confirm js-city-confirm"><span>Да, все верно</span></button>
				   <button type="button" class="question-city__button question-city__button--no js-city-change"><span>Сменить город</span></button>				   
				</div>
			</div>
		<?endif?>
		<?
		$frame->end();
		?>
		
		<div class="city-selector">
		
		</div>
		
		
	
		<div id="openCityPopup" class="city-popup">
  
		  <div class="city-popup-window">
			 
			 
			 <div class="city-popup-wrapper">
				  <div class="city-popup-header">
				  <div class="city-popup-title">Выберите ваш город</div>

				  <span title="Закрыть" class="city-popup-close">
					<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.75 10.75L10.75 0.75M0.75 0.75L10.75 10.75" stroke="#5A616C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				  </span>

				  </div>
				  <div class="city-popup-body">  
				 
				  </div>
			  </div>
			  
			  
		  </div>
		  
		  
		</div>
		

		
	</div>

<script>



$(function() {
	
   $(document).on('click', '.js-city-change', function(){
	   
	   $(this).closest('.cities-row').find('.ajax-popup-city').click();	   
	   $(this).closest('.question-city').hide();
	   
   });
   
   $(document).on('click', '.js-city-confirm', function(){
	   $(this).closest('.question-city').hide();	   
   });  
   
   
	$(document).on('click', '.cities-row .ajax-popup-city', function(e) {
		e.preventDefault();
		
		let that = $(this),  url = that.attr('data-href'), row = that.closest('.cities-row'), content = row.find('.city-selector');
		
		if(!that.hasClass('loaded')){
			
			$.ajax({
			  url: url,
			  type: "GET"		  
			}).done(function( html ) {
				
				
			  $("#openCityPopup .city-popup-body").html(html);			  
			  $('.city-popup').addClass('active');

			});
			
		}else{
			content.toggleClass('active');
			row.toggleClass('cities-row-active');
		}
		
        
    }); 
	
	
	$(document).on('click', '.city-popup .city-popup-close', function(e){
		e.preventDefault();
		$(this).closest('.city-popup').removeClass('active');
	})
	
});



</script>

<?}?>