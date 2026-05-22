<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
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
<?if($arResult):?>
	<div class="menu top">
		<ul class="top">

			<?foreach($arResult as $arItem):?>
				<?$bShowChilds = $arParams['MAX_LEVEL'] > 1;?>
				<?$bParent = $arItem['CHILD'] && $bShowChilds;?>
				<?
				$itemLink = (string)$arItem["LINK"];
				$isSelf = !empty($arItem['SELECTED']) || ($normalizePath($itemLink) === $currentPath);
				?>
				<li<?=($arItem['SELECTED'] ? ' class="selected"' : '')?>>
					<?if(!$isSelf):?>
						<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$itemLink?>" title="<?=$arItem["TEXT"]?>">
							<span><?=$arItem['TEXT']?></span>
							<?if($bParent):?>
								<span class="arrow">
									<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							<?endif;?>
						</a>
					<?else:?>
						<span class="dark-color<?=($bParent ? ' parent' : '')?>" aria-current="page" title="<?=$arItem["TEXT"]?>">
							<span><?=$arItem['TEXT']?></span>
							<?if($bParent):?>
								<span class="arrow">
									<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							<?endif;?>
						</span>
					<?endif;?>
					<?if($bParent):?>
						<ul class="dropdown">
							<li class="menu_back">
								<a href="#" onclick="return false;" class="dark-color" rel="nofollow"><?=CMax::showIconSvg('back_arrow', SITE_TEMPLATE_PATH.'/images/svg/return_mm.svg')?></a>
								<div class="close-mobile-menu">
									 <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 11L11 1M1 1L11 11" stroke="#5A616C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
							</li>
							<li class="menu_title">
								<?if(!$isSelf):?>
									<a href="<?=$itemLink?>"><?=$arItem['TEXT']?></a>
								<?else:?>
									<span aria-current="page"><?=$arItem['TEXT']?></span>
								<?endif;?>
							</li>
							<?foreach($arItem['CHILD'] as $arSubItem):?>
								<?$bShowChilds = $arParams['MAX_LEVEL'] > 2;?>
								<?$bParent = $arSubItem['CHILD'] && $bShowChilds;?>
								<?
								$subLink = (string)$arSubItem["LINK"];
								$subIsSelf = !empty($arSubItem['SELECTED']) || ($normalizePath($subLink) === $currentPath);
								?>
								<li<?=($arSubItem['SELECTED'] ? ' class="selected"' : '')?>>
									<?if(!$subIsSelf):?>
										<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$subLink?>" title="<?=$arSubItem["TEXT"]?>">
											<span><?=$arSubItem['TEXT']?></span>
											<?if($bParent):?>
												<span class="arrow">
													<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</span>
											<?endif;?>
										</a>
									<?else:?>
										<span class="dark-color<?=($bParent ? ' parent' : '')?>" aria-current="page" title="<?=$arSubItem["TEXT"]?>">
											<span><?=$arSubItem['TEXT']?></span>
											<?if($bParent):?>
												<span class="arrow">
													<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</span>
											<?endif;?>
										</span>
									<?endif;?>
									<?if($bParent):?>
										<ul class="dropdown">
											<li class="menu_back">
												<a href="#" onclick="return false;" class="dark-color" rel="nofollow"><?=CMax::showIconSvg('back_arrow', SITE_TEMPLATE_PATH.'/images/svg/return_mm.svg')?></a>
												<div class="close-mobile-menu">
													<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M1 11L11 1M1 1L11 11" stroke="#5A616C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													</svg>
												</div>
											</li>
											<li class="menu_title">
												<?if(!$subIsSelf):?>
													<a href="<?=$subLink?>"><?=$arSubItem['TEXT']?></a>
												<?else:?>
													<span aria-current="page"><?=$arSubItem['TEXT']?></span>
												<?endif;?>
											</li>
											<?foreach($arSubItem["CHILD"] as $arSubSubItem):?>
												<?$bShowChilds = $arParams['MAX_LEVEL'] > 3;?>
												<?$bParent = $arSubSubItem['CHILD'] && $bShowChilds;?>
												<?
												$subSubLink = (string)$arSubSubItem["LINK"];
												$subSubIsSelf = !empty($arSubSubItem['SELECTED']) || ($normalizePath($subSubLink) === $currentPath);
												?>
												<li<?=($arSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
													<?if(!$subSubIsSelf):?>
														<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$subSubLink?>" title="<?=$arSubSubItem["TEXT"]?>">
															<span><?=$arSubSubItem['TEXT']?></span>
															<?if($bParent):?>
																<span class="arrow">
																	<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																	</svg>
																</span>
															<?endif;?>
														</a>
													<?else:?>
														<span class="dark-color<?=($bParent ? ' parent' : '')?>" aria-current="page" title="<?=$arSubSubItem["TEXT"]?>">
															<span><?=$arSubSubItem['TEXT']?></span>
															<?if($bParent):?>
																<span class="arrow">
																	<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M0.75 8.75L4.75 4.75L0.75 0.75" stroke="#9299A5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
																	</svg>
																</span>
															<?endif;?>
														</span>
													<?endif;?>
													<?if($bParent):?>
														<ul class="dropdown">
															<li class="menu_back">
																<a href="#" onclick="return false;" class="dark-color" rel="nofollow"><?=CMax::showIconSvg('back_arrow', SITE_TEMPLATE_PATH.'/images/svg/return_mm.svg')?></a>
																<div class="close-mobile-menu">
																	<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M1 11L11 1M1 1L11 11" stroke="#5A616C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
																	</svg>
																</div>
															</li>
															<li class="menu_title">
																<?if(!$subSubIsSelf):?>
																	<a href="<?=$subSubLink?>"><?=$arSubSubItem['TEXT']?></a>
																<?else:?>
																	<span aria-current="page"><?=$arSubSubItem['TEXT']?></span>
																<?endif;?>
															</li>
															<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																<?
																$subSubSubLink = (string)$arSubSubSubItem["LINK"];
																$subSubSubIsSelf = !empty($arSubSubSubItem['SELECTED']) || ($normalizePath($subSubSubLink) === $currentPath);
																?>
																<li<?=($arSubSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
																	<?if(!$subSubSubIsSelf):?>
																		<a class="dark-color" href="<?=$subSubSubLink?>" title="<?=$arSubSubSubItem["TEXT"]?>">
																			<span><?=$arSubSubSubItem['TEXT']?></span>
																		</a>
																	<?else:?>
																		<span class="dark-color" aria-current="page" title="<?=$arSubSubSubItem["TEXT"]?>">
																			<span><?=$arSubSubSubItem['TEXT']?></span>
																		</span>
																	<?endif;?>
																</li>
															<?endforeach;?>
														</ul>
													<?endif;?>
												</li>
											<?endforeach;?>
										</ul>
									<?endif;?>
								</li>
							<?endforeach;?>
						</ul>
					<?endif;?>
				</li>
			<?endforeach;?>

			<?$APPLICATION->ShowViewContent('mobile-city-selector');?>
		</ul>
	</div>
<?endif;?>

<script>
(function() {
    // Функция для переназначения пункта "Лечение"
    function fixTreatmentLink() {
        // Ищем все ссылки в мобильном меню
        var allLinks = document.querySelectorAll('.mobilemenu-v1 .menu.top a');
        
        for (var i = 0; i < allLinks.length; i++) {
            var link = allLinks[i];
            
            // Находим ссылку с текстом "Лечение"
            if (link.innerText.trim() === 'Лечение') {
                // Меняем ссылку
                link.href = '/services/';
                
                // Убираем класс parent (отключает раскрытие подменю)
                link.classList.remove('parent');
                
                // Убираем стрелку
                var arrow = link.querySelector('.arrow');
                if (arrow) {
                    arrow.remove();
                }
                
                // Убираем родительский класс expanded (если есть)
                var parentLi = link.closest('li');
                if (parentLi) {
                    parentLi.classList.remove('expanded');
                }
                
                // Перехватываем клик и предотвращаем стандартное поведение
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.location.href = '/services/';
                    return false;
                });
                
                break;
            }
        }
    }
    
    // Запускаем сразу, если DOM уже загружен
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fixTreatmentLink);
    } else {
        fixTreatmentLink();
    }
    
    // Дополнительно запускаем через небольшие задержки (на случай, если меню подгружается позже)
    setTimeout(fixTreatmentLink, 300);
    setTimeout(fixTreatmentLink, 1000);
})();
</script>