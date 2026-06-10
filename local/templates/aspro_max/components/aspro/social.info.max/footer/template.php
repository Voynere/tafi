<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="social-icons-footer">
	<!-- noindex -->
	<ul class="social-icons-footer__list">
		
		<?if(!empty($arResult['SOCIAL_VK'])):?>
			<li class="social-icons-footer__item social-icons-footer__item--vk">
				<a href="<?=$arResult['SOCIAL_VK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VK')?>">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M21.6373 31.6667C9.1097 31.6667 1.96423 23.5335 1.6665 10H7.94172C8.14784 19.9333 12.774 24.1408 16.4384 25.0083V10H22.3474V18.5669C25.9659 18.1982 29.7673 14.2943 31.0498 10H36.9588C35.974 15.292 31.8516 19.1958 28.9201 20.8008C31.8516 22.1021 36.5468 25.5072 38.3332 31.6667H31.8287C30.4317 27.5459 26.9507 24.3577 22.3474 23.9239V31.6667H21.6373Z" fill="#0077FF"/>
					</svg>
				</a>
			</li>
		<?endif;?>

		<?if(!empty($arResult['SOCIAL_TELEGRAM'])):?>
			<li class="social-icons-footer__item social-icons-footer__item--telegram">
				<a href="<?=$arResult['SOCIAL_TELEGRAM']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TELEGRAM')?>">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5.62499 17.1974C14.5728 13.199 20.5394 10.5629 23.5249 9.28934C32.0488 5.65296 33.82 5.02128 34.9745 5.0002C35.2284 4.99584 35.7961 5.06038 36.1638 5.36644C36.4744 5.62487 36.5598 5.97397 36.6007 6.21899C36.6416 6.46401 36.6925 7.02217 36.652 7.4583C36.1901 12.4362 34.1914 24.5164 33.1746 30.0917C32.7443 32.4509 31.8971 33.2419 31.0769 33.3193C29.2945 33.4875 27.941 32.1111 26.2146 30.9504C23.5132 29.1341 21.987 28.0035 19.3648 26.2312C16.3344 24.1829 18.2989 23.0572 20.0259 21.2174C20.4779 20.7359 28.3314 13.4093 28.4834 12.7446C28.5024 12.6615 28.52 12.3516 28.3405 12.188C28.1611 12.0244 27.8962 12.0804 27.705 12.1249C27.4341 12.1879 23.1185 15.1136 14.7583 20.9018C13.5333 21.7645 12.4238 22.1849 11.4297 22.1628C10.3337 22.1386 8.22562 21.5273 6.65846 21.0048C4.73626 20.3639 3.20854 20.0251 3.34157 18.9367C3.41086 18.3698 4.172 17.7901 5.62499 17.1974Z" fill="#28A8EA"/>
					</svg>
				</a>
			</li>
		<?endif;?>		

		<?if(!empty($arResult['SOCIAL_WHATS']) || !empty($arResult["SOCIAL_WHATS_CUSTOM"]) ):?>
			<?
			if( strlen(trim($arResult["SOCIAL_WHATS_CUSTOM"])) ){
				$whatsHref = $arResult["SOCIAL_WHATS_CUSTOM"];
			} else {
				if(defined('LANG_CHARSET') && strtolower(LANG_CHARSET) == 'windows-1251'){
					$text = iconv("windows-1251","utf-8", $arResult['SOCIAL_WHATS_TEXT']);
				} else {
					$text = $arResult['SOCIAL_WHATS_TEXT'];
				}
				$bWhatsText = !empty($arResult['SOCIAL_WHATS_TEXT']);
				$whatsText = $bWhatsText ? '?text='.rawurlencode($text) : '';
				$whatsHref = 'https://wa.me/'.$arResult['SOCIAL_WHATS'].$whatsText;
			}			
			?>
			<li class="social-icons-footer__item social-icons-footer__item--whats">
				<a href="<?=$whatsHref?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_WHATS')?>">
					<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M32.0936 7.95512C29.1599 4.95962 25.1045 3.3335 20.9628 3.3335C12.1617 3.3335 5.08629 10.4371 5.17257 19.0812C5.17257 21.82 5.94914 24.4731 7.24341 26.8695L5 35.0002L13.3697 32.8605C15.6994 34.1443 18.2879 34.7434 20.8765 34.7434C29.5913 34.7434 36.6667 27.6398 36.6667 18.9957C36.6667 14.802 35.0272 10.865 32.0936 7.95512ZM20.9628 32.0903C18.6331 32.0903 16.3034 31.4912 14.3188 30.293L13.8011 30.0362L8.79655 31.32L10.0908 26.4416L9.74569 25.9281C5.94914 19.8515 7.76113 11.8065 13.9737 8.0407C20.1862 4.27494 28.2107 6.07223 32.0073 12.2344C35.8038 18.3966 33.9918 26.356 27.7793 30.1218C25.7947 31.4056 23.3787 32.0903 20.9628 32.0903ZM28.5559 22.5903L27.6067 22.1623C27.6067 22.1623 26.2262 21.5632 25.3633 21.1353C25.277 21.1353 25.1907 21.0497 25.1044 21.0497C24.8456 21.0497 24.673 21.1353 24.5005 21.2209C24.5005 21.2209 24.4142 21.3065 23.2062 22.6758C23.1199 22.847 22.9473 22.9326 22.7747 22.9326H22.6885C22.6022 22.9326 22.4296 22.847 22.3433 22.7614L21.9119 22.5903C20.9628 22.1623 20.0999 21.6488 19.4096 20.9641C19.2371 20.793 18.9782 20.6218 18.8056 20.4506C18.2016 19.8515 17.5976 19.1668 17.1662 18.3966L17.0799 18.2254C16.9936 18.1398 16.9936 18.0542 16.9074 17.883C16.9074 17.7119 16.9074 17.5407 16.9936 17.4551C16.9936 17.4551 17.3388 17.0272 17.5976 16.7704C17.7702 16.5993 17.8565 16.3425 18.0291 16.1713C18.2016 15.9146 18.2879 15.5722 18.2016 15.3155C18.1153 14.8875 17.0799 12.5767 16.8211 12.0632C16.6485 11.8065 16.4759 11.7209 16.2171 11.6353H15.9582C15.7856 11.6353 15.5268 11.6353 15.2679 11.6353C15.0954 11.6353 14.9228 11.7209 14.7502 11.7209L14.6639 11.8065C14.4914 11.8921 14.3188 12.0632 14.1462 12.1488C13.9737 12.32 13.8874 12.4912 13.7148 12.6623C13.1108 13.4326 12.7657 14.374 12.7657 15.3155C12.7657 16.0002 12.9382 16.6848 13.1971 17.2839L13.2834 17.5407C14.0599 19.1668 15.0954 20.6218 16.4759 21.9056L16.8211 22.2479C17.0799 22.5047 17.3388 22.6758 17.5114 22.9326C19.3233 24.4731 21.3942 25.5857 23.7239 26.1848C23.9827 26.2704 24.3279 26.2704 24.5867 26.356C24.8456 26.356 25.1907 26.356 25.4496 26.356C25.881 26.356 26.3987 26.1848 26.7439 26.0137C27.0027 25.8425 27.1753 25.8425 27.3479 25.6713L27.5204 25.5002C27.693 25.329 27.8656 25.2434 28.0381 25.0722C28.2107 24.9011 28.3833 24.7299 28.4696 24.5587C28.6421 24.2164 28.7284 23.7885 28.8147 23.3605C28.8147 23.1894 28.8147 22.9326 28.8147 22.7614C28.8147 22.7614 28.7284 22.6758 28.5559 22.5903Z" fill="#0DC143"/>
					</svg>
				</a>
			</li>
		<?endif;?>

		<li class="social-icons-footer__item social-icons-footer__item--max">
			<a href="https://max.ru/u/f9LHodD0cOLaGoeOnfRz3hNOnmlxOABlmeZ9tOcGy1wXt7sz85lrhfANCMo" target="_blank" rel="nofollow noopener" title="<?=GetMessage('TEMPL_SOCIAL_MAX')?>">
				<svg width="40" height="40" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill="#7C4DFF" fill-rule="evenodd" clip-rule="evenodd" d="M21.47 41.88c-4.11 0-6.02-.6-9.34-3-2.1 2.7-8.75 4.81-9.04 1.2 0-2.71-.6-5-1.28-7.5C1 29.5.08 26.07.08 21.1.08 9.23 9.82.3 21.36.3c11.55 0 20.6 9.37 20.6 20.91a20.6 20.6 0 0 1-20.49 20.67m.17-31.32c-5.62-.29-10 3.6-10.97 9.7-.8 5.05.62 11.2 1.83 11.52.58.14 2.04-1.04 2.95-1.95a10.4 10.4 0 0 0 5.08 1.81 10.7 10.7 0 0 0 11.19-9.97 10.7 10.7 0 0 0-10.08-11.1Z"/>
				</svg>
			</a>
		</li>

		<?/*
		<?if(!empty($arResult['SOCIAL_FACEBOOK'])):?>
			<li class="facebook">
				<a href="<?=$arResult['SOCIAL_FACEBOOK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>">
					<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TWITTER'])):?>
			<li class="twitter">
				<a href="<?=$arResult['SOCIAL_TWITTER']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>">
					<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_INSTAGRAM'])):?>
			<li class="instagram">
				<a href="<?=$arResult['SOCIAL_INSTAGRAM']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>">
					<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>
				</a>
			</li>
		<?endif;?>
		
		<?if(!empty($arResult['SOCIAL_YOUTUBE'])):?>
			<li class="ytb">
				<a href="<?=$arResult['SOCIAL_YOUTUBE']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>">
					<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_ODNOKLASSNIKI'])):?>
			<li class="odn">
				<a href="<?=$arResult['SOCIAL_ODNOKLASSNIKI']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>">
					<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_GOOGLEPLUS'])):?>
			<li class="gplus">
				<a href="<?=$arResult['SOCIAL_GOOGLEPLUS']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>">
					<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_MAIL'])):?>
			<li class="mail">
				<a href="<?=$arResult['SOCIAL_MAIL']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_MAILRU')?>">
					<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_VIBER']) || !empty($arResult["SOCIAL_VIBER_CUSTOM_DESKTOP"]) || !empty($arResult["SOCIAL_VIBER_CUSTOM_MOBILE"]) ):?>
			<?			
			$hrefDesktop = strlen(trim($arResult["SOCIAL_VIBER_CUSTOM_DESKTOP"])) ? $arResult["SOCIAL_VIBER_CUSTOM_DESKTOP"] : 'viber://chat?number=+'.$arResult['SOCIAL_VIBER'];
			$hrefMobile = strlen(trim($arResult["SOCIAL_VIBER_CUSTOM_MOBILE"])) ? $arResult["SOCIAL_VIBER_CUSTOM_MOBILE"] : 'viber://add?number='.$arResult['SOCIAL_VIBER'];
			?>	
			<li class="viber viber_mobile">
				<a href="<?=$hrefMobile?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VIBER')?>">
					<?=GetMessage('TEMPL_SOCIAL_VIBER')?>
				</a>
			</li>
			<li class="viber viber_desktop">
				<a href="<?=$hrefDesktop?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VIBER')?>">
					<?=GetMessage('TEMPL_SOCIAL_VIBER')?>
				</a>
			</li>
		<?endif;?>
		
		<?if(!empty($arResult['SOCIAL_ZEN'])):?>
			<li class="zen">
				<a href="<?=$arResult['SOCIAL_ZEN']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_ZEN')?>">
					<?=GetMessage('TEMPL_SOCIAL_ZEN')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TIKTOK'])):?>
			<li class="tiktok">
				<a href="<?=$arResult['SOCIAL_TIKTOK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TIKTOK')?>">
					<?=GetMessage('TEMPL_SOCIAL_TIKTOK')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_PINTEREST'])):?>
			<li class="pinterest">
				<a href="<?=$arResult['SOCIAL_PINTEREST']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_PINTEREST')?>">
					<?=GetMessage('TEMPL_SOCIAL_PINTEREST')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_SNAPCHAT'])):?>
			<li class="snapchat">
				<a href="<?=$arResult['SOCIAL_SNAPCHAT']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_SNAPCHAT')?>">
					<?=GetMessage('TEMPL_SOCIAL_SNAPCHAT')?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_LINKEDIN'])):?>
			<li class="linkedin">
				<a href="<?=$arResult['SOCIAL_LINKEDIN']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_LINKEDIN')?>">
					<?=GetMessage('TEMPL_SOCIAL_LINKEDIN')?>
				</a>
			</li>
		<?endif;?>

		<?*/?>	
	</ul>
	<!-- /noindex -->
</div>