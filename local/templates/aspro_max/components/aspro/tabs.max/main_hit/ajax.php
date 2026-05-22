<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

$class_block="s_".$this->randString();

$arTab=array();
$arParams["DISPLAY_BOTTOM_PAGER"] = "N";
$arParams['SET_TITLE'] = 'N';
$arTmp = reset($arResult["TABS"]);
$arParams["FILTER_HIT_PROP"] = $arTmp["CODE"];
$arParamsTmp = urlencode(serialize($arParams));

if($arResult["SHOW_SLIDER_PROP"]):?>
	<div class="content_wrapper_block <?=$templateName;?>">
		<div class="maxwidth-theme">
			<div class="tab_slider_wrapp specials <?=$class_block;?> best_block clearfix" itemscope itemtype="http://schema.org/WebPage">
				<span class='request-data' data-value='<?=$arParamsTmp?>'></span>
				<div class="top_block">
					<?if($arParams['TITLE_BLOCK']):?>
						<h3><?=$arParams['TITLE_BLOCK'];?></h3>
					<?endif;?>
					<div class="right_block_wrapper">
						<div class="tabs_wrapper <?=$arParams['TITLE_BLOCK_ALL'] && $arParams['ALL_URL'] ? 'with_link' : ''?>">
							
						</div>
						<?if($arParams['TITLE_BLOCK_ALL'] && $arParams['ALL_URL']):?>
							<a href="<?=$arParams['ALL_URL'];?>" class="font_upper muted"><?=$arParams['TITLE_BLOCK_ALL'];?></a>
						<?endif;?>
					</div>
				</div>
				<ul class="tabs_content">
					<?$j=1;?>
					<?foreach($arResult["TABS"] as $code => $arTab):?>
						<li class="tab <?=$code?>_wrapp <?=($j == 1 ? "cur opacity1" : "");?>" data-code="<?=$code?>" data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>">
							<div class="tabs_slider <?=$code?>_slides wr">
								<?if(strtolower($_REQUEST['ajax']) == 'y')
									$APPLICATION->RestartBuffer();?>
								<?if($j++ == 1)
								{
									if($arTab["FILTER"])
										$GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];

									include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));
								}?>
								<?if(strtolower($_REQUEST['ajax']) == 'y')
									CMax::checkRestartBuffer(true, 'catalog_tab');?>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	<script>try{window.tabsInitOnReady();}catch{}</script>
	<script>
		if(window.innerWidth < 576){
			setTimeout(() => {
	$('.catalog_block.slick-slider').removeClass('mobile-overflow')
	
}, 500);
		}

	
	$('.catalog_block.swipeignore').slick({
		lazyLoad: 'ondemand',
		slidesToShow: 5,
		slidesToScroll: 3,
		prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
		nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
		responsive: [

    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1.5,
        slidesToScroll: 1,
		arrows:false,
		infinite: false,
		variableWidth: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
	</script>
<?endif;?>