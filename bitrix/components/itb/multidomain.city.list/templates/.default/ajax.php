<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('itb.multidomains');
use Itb\MultiDomains\Site;
use \Bitrix\Main\Config\Option;

$url = trim(strip_tags(urldecode($_REQUEST['url'])));
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

$currentPath = $normalizePath($url);

$prev_letter = "";
$first = reset($cities);

$name = trim($first['NAME']);		
$letter = strtoupper(mb_substr($name,0,1));
$prev_letter = $letter;

//var_dump($url);
?>


<noindex>

	<?/*
	<div class="header">

		<? if(Option::get('itb.multidomains', "search") == 'N'){?>
		<div class="form-group search-city">
			<input type="text" placeholder="Введите ваш регион" class="search-city-input form-control">
			<div class="clearbtn"></div>
		</div>
		<?}?>
		
	</div>
	
	<div class="content-cities">
	
		<div class="search-result">
		</div>
		
		<div class="row row-inline cities-items">
		
			<?if(count($cities) > 5):?>
			<div class="col-xs-6 col-sm-6 col-md-4  col-inline">
				<div class="letter-title-wrap">
					<span class="letter-title"><?=$letter?></span>
				</div>
				<div class="cities-list">
				<?

				foreach ($cities as $key => $city){
					$name = trim($city['NAME']);		
					$letter = strtoupper(mb_substr($name,0,1));
					if( $letter != $prev_letter ){
						?>			
							</div></div><div class="col-xs-6 col-sm-6 col-md-4  col-inline">
							<div class="letter-title-wrap"><span class="letter-title"><?=$letter?></span></div>
							<div class="cities-list">
						<?
					}								
					?>
					
					<div class="city-item"><a data-id="<?=$city['ID']?>" href="<?=$city['URL']?>"><?=$city['NAME']?> </a> </div>	
					
					
					<?
					$prev_letter = $letter;		
				}
				?>
				</div>				
				
			</div>
			<?else:?>
			<div class="col-sm-12 col-inline">
				<div class="cities-list">
					<?
					foreach ($cities as $key => $city){						
					?>								
						
						<div class="city-item"><a data-id="<?=$city['ID']?>" href="<?=$city['URL']?>"><?=$city['NAME']?> </a> </div>	
						<?							
					}
					?>
				</div>
			</div>
			<?endif?>
			
			
		</div>
	
	
	</div>
	*/?>
	
	<div class="cities-list-selector">
		<?
		foreach ($cities as $key => $city){						
		?>								
			
			<?
			$isSelected = ($cityActive['ID'] == $city['ID']);
			$isSelf = ($normalizePath($city['URL'] ?? '') === $currentPath);
			?>
			<div class="city-item<?if($isSelected){?> selected<?}?>">
				<?if(!$isSelected && !$isSelf):?>
					<a data-id="<?=$city['ID']?>" href="<?=$city['URL']?>"><?=$city['NAME']?> </a>
				<?else:?>
					<span data-id="<?=$city['ID']?>" class="name"><?=$city['NAME']?></span>
				<?endif;?>
			</div>
			<?							
		}
		?>
	</div>	

	
	
</noindex>


