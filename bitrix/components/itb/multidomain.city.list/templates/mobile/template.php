<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Itb\MultiDomains\Site;
use \Bitrix\Main\Config\Option;
$url = urlencode($_SERVER['REQUEST_URI']); 

$geoData = Site::Instance();
$cities = $geoData->getCitiesList($url);
$cityActive = $geoData->detectCity();

$normalizePath = static function ($urlOrPath) {
	$val = (string)$urlOrPath;
	if ($val === '') {
		return '/';
	}
	$parts = @parse_url($val);
	$path = (is_array($parts) && isset($parts['path']) && $parts['path'] !== '') ? $parts['path'] : $val;
	$path = preg_replace('~[?#].*$~', '', $path);
	$path = str_replace('\\', '/', $path);
	$path = preg_replace('~/{2,}~', '/', $path);
	$path = preg_replace('~/index\.php$~i', '/', $path);
	if ($path === '') {
		$path = '/';
	}
	if ($path !== '/' && !preg_match('~\.[a-z0-9]+$~i', $path) && substr($path, -1) !== '/') {
		$path .= '/';
	}
	return $path;
};

$currentPath = $normalizePath($_SERVER['REQUEST_URI'] ?? '/');

?>

<? if(Option::get('itb.multidomains', "hide_selector") != 'Y'){?>
<div class="mobile-selector">
	<?$this->SetViewTarget('mobile-city-selector');?>




	
	<li class="mobile-selector-item">
			<div class="mobile-selector-item__line"></div>
			<a class="dark-color parent" href="#" onclick="return false;">

			
				<span class="city-active">		
					<?=$arResult['ACTIVE_CITY']['NAME']?>
				</span>

				
				<span class="arrow">
					<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</span>

			</a>
			
			<ul class="dropdown js-select-stores city-selector">

				<li class="menu_back">
					<a href="#" onclick="return false;" class="dark-color" rel="nofollow">
						<?=CMax::showIconSvg('back_arrow', SITE_TEMPLATE_PATH.'/images/svg/return_mm.svg')?>
					</a>
					<div class="close-mobile-menu">
							<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 11L11 1M1 1L11 11" stroke="#5A616C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
				</li>

				<li class="menu_title"><a title="Выберите город">Выберите город</a></li>


				<?foreach ($cities as $key => $city){?>	
					<?
					$isSelected = ($cityActive['ID'] == $city['ID']);
					$isSelf = ($normalizePath($city['URL'] ?? '') === $currentPath);
					?>
					<li class="city-item<?if($cityActive['ID'] == $city['ID']){?> selected<?}?>">
						<?if(!$isSelected && !$isSelf):?>
							<a data-id="<?=$city['ID']?>" href="<?=$city['URL']?>"><?=$city['NAME']?> </a>
						<?else:?>
							<span data-id="<?=$city['ID']?>" class="name"><?=$city['NAME']?></span>
						<?endif;?>
					</li>
				<?}?>


			</ul>	
			
	</li>		
	<?$this->EndViewTarget();?>		

	<div class="city-popup">

		<div class="city-popup-window">
		
			<div class="city-popup-wrapper">
			
				<div class="city-popup-header">
				
					<span title="Закрыть" class="city-popup-close">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none">
						<path d="M1.4209 1L17 17.0025" stroke="#2A7FB9"/>
						<path d="M16.5791 1L1.00003 17.0025" stroke="#2A7FB9"/>
						</svg>
					</span>
					
				</div>
				
				<div class="city-popup-body">  
						<div class="cities-row">
			
							<?$frame = $this->createFrame()->begin('');?>
							
								<div class="question-city">
									<div class="question-city-label">Ваш город</div>
									
									<div class="question-city-title"><strong><?=$arResult['ACTIVE_CITY']['NAME']?></strong></div>
									
									<div class="question-city-btn2">
									<button type="button" class="btn-yes"><span>Да, все верно</span></button>
									<button type="button" class="btn-no"><span>Выбрать другой</span></button>				   
									</div>
								</div>
							
							<?
							$frame->end();
							?>
							
							<div class="city-selector" data-href="<?=$templateFolder?>/ajax.php?url=<?=$url?>">
							
							</div>
							
							
						</div>
				</div>
			</div>
		
		
		</div>
	</div>

</div>

<script>


	$(function() {
		
		
		<?if(!$_SESSION['IS_SHOWED_FORM_MOBILE']){?>
			
			//$('.city-popup').addClass('active');
		
			<?$_SESSION['IS_SHOWED_FORM_MOBILE'] = true;?>
		<?}?>

		
		
		
		$(document).on('click', '.city-popup .question-city-btn2 .btn-no', function(){
			
			//$(this).closest('.cities-row').find('.ajax-popup-city').click();	   
			//$(this).closest('.question-city').hide();
			
				let selector = $(this).closest('.city-popup').find('.city-selector'),	   
					url = selector.attr('data-href'), popup = selector.closest('.city-popup-window');
				
				if(!selector.hasClass('loaded')){
					
					$.ajax({
					url: url,
					type: "GET"		  
					}).done(function( html ) {
						
						selector.html(html);
						selector.addClass('loaded');
						popup.addClass('showed');
					
					});
					
				}/* else{
					popup.toggleClass('showed');
				} */
			
			
		});
	
		$(document).on('click', '.city-popup .question-city-btn2 .btn-yes', function(){
			$(this).closest('.city-popup').removeClass('active');	   
		});  
	
		
	});



</script>

<?}?>