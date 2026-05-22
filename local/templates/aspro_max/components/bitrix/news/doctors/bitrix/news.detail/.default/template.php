<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

// РАСЧЕТ СТАЖА из поля PROP_EXPERIENCE (год начала)
$experienceValue = '';

// Сначала проверяем, есть ли уже готовое значение из result_modifier.php
if (!empty($arResult['DISPLAY_EXPERIENCE'])) {
    $experienceValue = $arResult['DISPLAY_EXPERIENCE'];
}
// Если нет, считаем самостоятельно
elseif (!empty($arResult['PROPERTIES']['PROP_EXPERIENCE']['VALUE'])) {
    $startYear = (int)$arResult['PROPERTIES']['PROP_EXPERIENCE']['VALUE'];
    $currentYear = (int)date('Y');
    
    // Проверяем, что ввели корректный год (не раньше 1900 и не больше текущего)
    if ($startYear > 1900 && $startYear <= $currentYear) {
        $experience = $currentYear - $startYear;
        // Вызываем функцию из result_modifier.php
        $experienceValue = getYearDeclensionModifier($experience);
    } else {
        // Если год некорректный, выводим как есть
        $experienceValue = htmlspecialchars($arResult['PROPERTIES']['PROP_EXPERIENCE']['VALUE']);
    }
}

$imgSrc = $arResult['DETAIL_PICTURE']['SRC'] ?? $arResult['PREVIEW_PICTURE']['SRC'];
if (empty($imgSrc))
{
    $imgSrc = SITE_TEMPLATE_PATH . '/images/doctors/doctors-empty.png';
}
$doctor = [
    'NAME' => $arResult['NAME'],
    'IMAGE' => $imgSrc,
    'TEXT' => $arResult['DETAIL_TEXT'] ?? '',
    'PROPS' => [
        'POSITION' => $arResult['PROPERTIES']['PROP_POSITION']['VALUE'] ?? '',
        'CATEGORY' => $arResult['PROPERTIES']['PROP_CATEGORY']['VALUE'] ?? '',
        'EXP' => $experienceValue, // Используем рассчитанное значение
        'ADDRESS' => $arResult['PROPERTIES']['PROP_ADDRESS']['VALUE'],
        'INITIAL_APPOINTMENT' => $arResult['PROPERTIES']['PROP_INITIAL_APPOINTMENT']['VALUE'] ?? '',
        'SECOND_APPOINTMENT' => $arResult['PROPERTIES']['PROP_SECOND_APPOINTMENT']['VALUE'] ?? '',
        'ABILITY_HOME' => $arResult['PROPERTIES']['PROP_ABILITY_HOME']['VALUE'],
        'ABILITY_CHILD' => $arResult['PROPERTIES']['PROP_ABILITY_CHILD']['VALUE'],
        'ABILITY_INSURANCE' => $arResult['PROPERTIES']['PROP_ABILITY_INSURANCE']['VALUE'],
        'SKILLS' => $arResult['PROPERTIES']['PROP_SKILLS']['~VALUE']['TEXT'] ?? '',
        'EDUCATION' => $arResult['PROPERTIES']['PROP_EDUCATION']['~VALUE']['TEXT'] ?? '',
        'TRAINING' => $arResult['PROPERTIES']['PROP_TRAINING']['~VALUE']['TEXT'] ?? '',
        'APPOINTMENT_LINK' => $arResult['PROPERTIES']['PROP_APPOINTMENT_LINK']['VALUE'] ?? '',
        'SERVICES' => $arResult['DOCTORS_DIRECTIONS'] ?? '',
		'DOCTOR_ABOUT' => $arResult['PROPERTIES']['PROP_DOCTOR_ABOUT']['VALUE']['TEXT'] ?? '',
		'APPOINTMENT_IMPORTANT' => $arResult['PROPERTIES']['PROP_APPOINTMENT_IMPORTANT']['VALUE']['TEXT'] ?? '',
		'OFTEN_REQ' => $arResult['PROPERTIES']['PROP_OFTEN_REQ']['VALUE']['TEXT'] ?? '',
    ],
];
?>

<div class="doctor-detail additional-container">
	<div class="doctor-detail__top-block">
		<img class="doctor-detail__image" src="<?= $doctor['IMAGE'] ?>" alt="<?= $doctor['NAME'] ?>">
		<div class="doctor-detail__main-info">
			<h1 class="doctor-detail__title"><?= $doctor['NAME'] ?></h1>
			<div class="doctor-detail__props">
				<?php if (!empty($doctor['PROPS']['POSITION'])): ?>
					<?php $positionRes = ''; ?>
					<?php foreach($doctor['PROPS']['POSITION'] as $position): ?>
						<?php $positionRes .= $position . ', '?>
					<?php endforeach;?>
					<span class="doctor-detail__position"><?= substr($positionRes, 0, -2) ?></span>
				<?php endif; ?>
				<?php if (!empty($doctor['PROPS']['EXP'])): ?>
					<span class="doctor-detail__exp"><?= Loc::getMessage('MSG_DOCTOR_EXP') . ' ' . $doctor['PROPS']['EXP'] ?></span>
				<?php endif; ?>
				<?php if (!empty($doctor['PROPS']['ADDRESS'])): ?>
					<div class="doctor-detail__address">
						<span><?= Loc::getMessage('MSG_DOCTOR_ADDRESS') ?></span>
						<?php $addressRes = ''; ?>
						<?php foreach($doctor['PROPS']['ADDRESS'] as $address): ?>
							<?php $addressRes .= $address . ', '?>
						<?php endforeach;?>
						<span class="doctor-detail__address-span"><?= substr($addressRes, 0, -2) ?></span>
					</div>
				<?php endif; ?>
			</div>
			<?php if (empty($doctor['PROPS']['SERVICES'])): ?>
				<?php if (!empty($doctor['PROPS']['INITIAL_APPOINTMENT']) || !empty($doctor['PROPS']['SECOND_APPOINTMENT'])): ?>
					<div class="doctor-detail__appointments">
						<?php if (!empty($doctor['PROPS']['INITIAL_APPOINTMENT'])): ?>
							<div class="doctor-detail__appointment doctor-detail__initial-appointment">
								<span><?= Loc::getMessage('MSG_INITIAL_APPOINTMENT') ?></span>
								<span><?= $doctor['PROPS']['INITIAL_APPOINTMENT'] ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($doctor['PROPS']['SECOND_APPOINTMENT'])): ?>
							<div class="doctor-detail__appointment doctor-detail__second-appointment">
								<span><?= Loc::getMessage('MSG_SECOND_APPOINTMENT') ?></span>
								<span><?= $doctor['PROPS']['SECOND_APPOINTMENT'] ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<div class="doctor-detail__appointments some-services">
					<?php foreach($doctor['PROPS']['SERVICES'] as $service): ?>
						<?php if ($service['PRICE'] || $service['SECOND']): ?>
							<div class="doctor-detail__appointment-block">
								<span><?= $service["NAME"] ?></span>
								<div class="doctor-detail__appointment-prices">
									<?php if ($service['PRICE']): ?>
										<div class="doctor-detail__appointment">
											<span><?= Loc::getMessage('MSG_INITIAL_APPOINTMENT') ?></span>
											<span><?= $service['PRICE'] ?></span>
										</div>
									<?php endif; ?>
									<?php if ($service['SECOND']): ?>
										<div class="doctor-detail__appointment">
											<span><?= Loc::getMessage('MSG_SECOND_APPOINTMENT') ?></span>
											<span><?= $service['SECOND'] ?></span>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>

			<?php endif; ?>
			<?php if (
				$doctor['PROPS']['ABILITY_HOME'] === 'Y' 
				|| $doctor['PROPS']['ABILITY_CHILD'] === 'Y' 
				|| $doctor['PROPS']['ABILITY_INSURANCE'] === 'Y'
			): ?>
				<div class="doctor-detail__abilities">
					<?php if ($doctor['PROPS']['ABILITY_HOME'] === 'Y'): ?>
						<div class="doctor-detail__ability">
							<?php include_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/ability_home.svg') ?>
							<span><?= Loc::getMessage('MSG_ABILITY_HOME') ?></span>
						</div>
					<?php endif; ?>
					<?php if ($doctor['PROPS']['ABILITY_CHILD'] === 'Y'): ?>
						<div class="doctor-detail__ability">
							<?php include_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/ability_kids.svg') ?>
							<span><?= Loc::getMessage('MSG_ABILITY_CHILD') ?></span>
						</div>
					<?php endif; ?>
					<?php if ($doctor['PROPS']['ABILITY_INSURANCE'] === 'Y'): ?>
						<div class="doctor-detail__ability">
							<?php include_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/ability_ensuranse.svg') ?>
							<span><?= Loc::getMessage('MSG_ABILITY_INSURANCE') ?></span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php 
			// ID врача, которому нужно скрыть кнопку
			$hiddenDoctorIds = [3803]; // можно добавить ещё ID через запятую
			
			// Проверяем, не входит ли текущий врач в список скрытых
			$hideButton = in_array($arResult['ID'], $hiddenDoctorIds);
			
			if (!$hideButton): ?>
				<?php if($doctor['PROPS']['APPOINTMENT_LINK']): ?>
					<a class="doctor-detail__appointment-btn" target="_blank" href="<?= $doctor['PROPS']['APPOINTMENT_LINK'] ?>">
						<?= Loc::getMessage('MSG_APPOINTMENT_BTN') ?>
					</a>
				<?php else: ?>
					<span 
						class="doctor-detail__appointment-btn" 
						data-event="jqm" 
						data-param-form_id="<?= $arParams['FORM_CODE'] ?>" 
						data-name="<?= $arParams['FORM_CODE'] ?>"
						data-param-DOCTORS_NAME="<?= str_replace(' ', '@', $doctor['NAME']) ?>"
					>
						<?= Loc::getMessage('MSG_APPOINTMENT_BTN') ?>
					</span>
				<?php endif; ?>
			<?php endif; ?>
			
		</div>
	</div>
	<?php if (
		!empty($doctor['PROPS']['SKILLS'])
		|| !empty($doctor['PROPS']['EDUCATION'])
		|| !empty($doctor['PROPS']['TRAINING'])
		|| !empty($doctor['PROPS']['OFTEN_REQ'])
		|| !empty($doctor['PROPS']['APPOINTMENT_IMPORTANT'])
	): ?>
		<div class="doctor-detail__bottom-block">
			<?php if (!empty($doctor['PROPS']['OFTEN_REQ'])): ?>
				<div class="doctor-detail__tab">
					<span class="doctor-detail__tab-title" id="oftenReqImp">
						<?= Loc::getMessage('MSG_OFTEN_REQ') ?>
						<?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
					</span>
					<p class="doctor-detail__tab-content" id="oftenReqImp_content"><?= $doctor['PROPS']['OFTEN_REQ'] ?></p>
				</div>
			<?php endif; ?>
			<?php if (!empty($doctor['PROPS']['APPOINTMENT_IMPORTANT'])): ?>
				<div class="doctor-detail__tab">
					<span class="doctor-detail__tab-title" id="appointmentImp">
						<?= Loc::getMessage('MSG_APPOINTMENT_IMPORTANT') ?>
						<?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
					</span>
					<p class="doctor-detail__tab-content" id="appointmentImp_content"><?= $doctor['PROPS']['APPOINTMENT_IMPORTANT'] ?></p>
				</div>
			<?php endif; ?>
			<?php if (!empty($doctor['PROPS']['SKILLS'])): ?>
				<div class="doctor-detail__tab">
					<span class="doctor-detail__tab-title" id="skills">
						<?= Loc::getMessage('MSG_SKILLS') ?>
						<?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
					</span>
					<p class="doctor-detail__tab-content" id="skills_content"><?= $doctor['PROPS']['SKILLS'] ?></p>
				</div>
			<?php endif; ?>
			<?php if (!empty($doctor['PROPS']['EDUCATION'])): ?>
				<div class="doctor-detail__tab">
					<span class="doctor-detail__tab-title" id="education">
						<?= Loc::getMessage('MSG_EDUCATION') ?>
						<?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
					</span>
					<p class="doctor-detail__tab-content" id="education_content"><?= $doctor['PROPS']['EDUCATION'] ?></p>
				</div>
			<?php endif; ?>
			<?php if (!empty($doctor['PROPS']['TRAINING'])): ?>
				<div class="doctor-detail__tab">
					<span class="doctor-detail__tab-title" id="training">
						<?= Loc::getMessage('MSG_TRAINING') ?>
						<?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/arrow.svg') ?>
					</span>
					<p class="doctor-detail__tab-content" id="training_content"><?= $doctor['PROPS']['TRAINING'] ?></p>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ($doctor['PROPS']['DOCTOR_ABOUT']): ?>
		<div class="doctor-detail__about-block">
			<span><?= Loc::getMessage('MSG_DOC_ABOUT') ?></span>
			<p><?= $doctor['PROPS']['DOCTOR_ABOUT'] ?></p>
		</div>
	<?php endif; ?>
</div>