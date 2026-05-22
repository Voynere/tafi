<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

$isDetailPage = $arParams['IS_DETAIL_PAGE'] === 'Y' ? true : false;

if (count($arResult["ITEMS"]) === 0 && !$isDetailPage)
{
	echo Loc::getMessage('MSG_NOTHNING_FOUND');
	return;
} elseif (count($arResult["ITEMS"]) === 0 && $isDetailPage) {
	return;
}

// ⚠️ ФУНКЦИЯ getYearDeclension() НЕ ОБЪЯВЛЯЕТСЯ ЗДЕСЬ
// Она уже есть в файле result_modifier.php

?>
<div class="<?= $isDetailPage ? 'doctors-detail-container' : 'doctors-listing-container'?>">
	<div class="doctors-listing <?= $isDetailPage ? 'swiper similar-doctor-swiper additional-container' : 'section'?>">
		<?php if ($isDetailPage): ?>
			<h2 class="similar-doctor-swiper__title"><?= Loc::getMessage('MSG_DETAIL_TITLE') ?></h2>
		<?php endif; ?>
		<?php if ($isDetailPage): ?>
			<div class="swiper-wrapper">
		<?php endif; ?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?php
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$imgSrc = $arItem['PREVIEW_PICTURE']['SRC'];
				$imageClass = '';
				if (empty($imgSrc))
				{
					$imageClass = 'empty';
					$imgSrc = SITE_TEMPLATE_PATH . '/images/doctors/doctors-empty.png';
				}
				
				// РАСЧЕТ СТАЖА для элемента списка
				// Используем готовое значение из result_modifier.php, если оно есть
				$experienceDisplay = '';
				if (!empty($arItem['DISPLAY_EXPERIENCE'])) {
					$experienceDisplay = $arItem['DISPLAY_EXPERIENCE'];
				} elseif (!empty($arItem['PROPERTIES']['PROP_EXPERIENCE']['VALUE'])) {
					$startYear = (int)$arItem['PROPERTIES']['PROP_EXPERIENCE']['VALUE'];
					$currentYear = (int)date('Y');
					
					if ($startYear > 1900 && $startYear <= $currentYear) {
						$experience = $currentYear - $startYear;
						// Вызываем функцию из result_modifier.php
						$experienceDisplay = 'Стаж ' . getYearDeclension($experience);
					} else {
						$experienceDisplay = 'Стаж ' . htmlspecialchars($arItem['PROPERTIES']['PROP_EXPERIENCE']['VALUE']);
					}
				}
				?>
				<div class="doctors-listing__item <?= $isDetailPage ? 'swiper-slide' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="doctors-listing__info-outer-wrapper">
						<a class="doctors-listing__img-link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							<img class="doctors-listing__img <?= $imageClass ?>" src="<?= $imgSrc ?>" alt="<?= $arItem['NAME'] ?>">
						</a>
						<div class="doctors-listing__info">
							<div class="doctors-listing__info-inner-wrapper">
								<a class="doctors-listing__name" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
								<div class="doctors-listing__props">
									<?php if (!empty($arItem['PROPERTIES']['PROP_POSITION']['VALUE'])): ?>
										<?php $positionRes = ''; ?>
										<?php foreach($arItem['PROPERTIES']['PROP_POSITION']['VALUE'] as $position): ?>
											<?php $positionRes .= $position . ', '?>
										<?php endforeach;?>
										<span><?= substr($positionRes, 0, -2) ?></span>
									<?php endif; ?>
									
									<?php if (!empty($experienceDisplay)): ?>
										<span><?= $experienceDisplay ?></span>
									<?php endif; ?>
									
									<?php 
									$addressRes = ''; 
									if (!empty($arItem['PROPERTIES']['PROP_ADDRESS']['VALUE'])) {
										foreach($arItem['PROPERTIES']['PROP_ADDRESS']['VALUE'] as $address): 
											$addressRes .= $address . ', ';
										endforeach;
										$addressRes = substr($addressRes, 0, -2);
									}
									?>
									<span><?= $addressRes ?></span>
								</div>
							</div>
							<?php 
							// ID врачей, которым нужно скрыть кнопку
							$hiddenDoctorIds = [3803]; // можно добавить ещё ID через запятую
							
							// Проверяем, не входит ли текущий врач в список скрытых
							$hideButton = in_array($arItem['ID'], $hiddenDoctorIds);
							
							if (!$hideButton): ?>
								<?php if($arItem['PROPERTIES']['PROP_APPOINTMENT_LINK']['VALUE']): ?>
									<a class="doctors-listing__link" target="_blank" href="<?= $arItem['PROPERTIES']['PROP_APPOINTMENT_LINK']['VALUE'] ?>"><?= Loc::getMessage('MSG_APPOINTMENT_LINK') ?></a>
								<?php else: ?>
									<span 
										class="doctors-listing__link" 
										data-event="jqm" 
										data-param-form_id="<?= $arParams['FORM_CODE'] ?>" 
										data-name="<?= $arParams['FORM_CODE'] ?>"
										data-param-DOCTORS_NAME="<?= str_replace(' ', '@', $arItem['NAME']) ?>"
									>
										<?= Loc::getMessage('MSG_APPOINTMENT_LINK') ?>
									</span>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		<?php if ($isDetailPage): ?>
			</div>
			<div class="similar-doctor-pagination"></div>
		<?php endif; ?>
	</div>
</div>
<?php if(!$isDetailPage && $arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<div class="doctors-listing__pagination">
		<?=$arResult["NAV_STRING"]?>
	</div>
<?php endif; ?>
<script>
	var swiper = new Swiper(".similar-doctor-swiper", {
		pagination: {
        	el: ".similar-doctor-pagination",
      	},
		breakpoints: {
			320: {
				slidesPerView: 1.99,
				spaceBetween: 8,
				slidesOffsetBefore: 20
			},
			576: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			992: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			1320: {
				slidesPerView: 4,
				spaceBetween: 24,
			}
		}
	});
</script>