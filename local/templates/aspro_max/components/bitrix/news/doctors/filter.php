<?php
use Bitrix\Main\Localization\Loc;
use Itb\Doctors\Filter;

$filterObj = new Filter($arParams['IBLOCK_ID']);
$filterData = $filterObj->filterInfo;
$classChecker = 0;
$categoryId = '';
?>
<div class="doctors-filter">
    <div class="doctors-filter__top">
        <h2><?= Loc::getMessage('MSG_FILTER_TITLE') ?></h2>
        <div class="doctors-filter__buttons">
            <?php foreach($filterData as $key => $data): ?>
                <?php if (!empty($data['NAME'])): ?>
                    <button 
                        class="doctors-filter__button category-filter-button <?= !$classChecker ? 'active' : '' ?>" 
                        data-filter-name="PROPERTY_PROP_CATEGORY" 
                        data-filter-value="<?= $key ?>"
                    >
                        <?= $data['NAME'] ?>                        
                    </button>
                <?php endif ?>
                <?php 
                if (!$classChecker) $categoryId = $key;
                $classChecker = 1 
                ?>
            <?php endforeach ?>
        </div>
    </div>
    <form class="doctors-filter__form" id="doctorsNameFilter" action="/ajax/doctorsFilter.php">
        <div class="doctors-filter__name-block">
            <div class="doctors-filter__form-name">
                <input placeholder="<?= Loc::getMessage('MSG_NAME_INPUT_FORM') ?>" name="q" type="text">
                <button class="active">
                    <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/search.svg') ?>
                </button>
                <button id="nameInputCleaner">
                    <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/resetname.svg') ?>
                </button>
            </div>
             <div class="doctors-filter__filter-opener">
                <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/mob-filter.svg') ?>
             </div>
        </div>
        <?php foreach($filterData as $key => $data): ?>
            <div class="doctors-filter__block <?= $categoryId == $key ? 'active' : '' ?>" id="doctorsFilterBlock_<?= $key ?>">
                <?php if (count($data['POSITIONS']) > 0): ?>
                      <div data-select-type="POSITIONS" class="doctors-filter__select positions" name="POSITION">
                        <!-- <input data-object-collection="[]" hidden name="POSITIONS"> -->
                        <div class="doctors-filter__input">
                             <span data-type="POSITIONS">
                                <?= Loc::getMessage('MSG_FILTER_SPECIALITIES') ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M16 10L12 14L8 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="JSDropwownElements">
                            <span 
                                value=""
                                data-filter-name="PROPERTY_PROP_POSITION"
                                data-filter-value="all" 
                            >
                                <div class="listing-checkbox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M2.5 6.5L4.5 8.5L9.5 3.5" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <?= Loc::getMessage('MSG_FILTER_SPECIALITIES') ?>
                            </span>
                            <?php foreach($data['POSITIONS'] as $key => $position): ?>
                            <span 
                                data-filter-name="PROPERTY_PROP_POSITION"
                                data-filter-value="<?= $key ?>" 
                                value="<?= $key ?>"
                            >
                                <div class="listing-checkbox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M2.5 6.5L4.5 8.5L9.5 3.5" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <?= $position ?>
                            </span>
                            <?php endforeach ?>
                        </div>
                    </div>

                <?php endif; ?>
                <?php if (count($data['ADDRESSES']) > 0): ?>
                    <div data-select-type="ADDRESSES" class="doctors-filter__select addresses" name="ADDRESS">
                        <!-- <input data-object-collection="[]" hidden name="ADDRESSES"> -->
                        <div class="doctors-filter__input">
                             <span data-type="ADDRESSES">
                                <?= Loc::getMessage('MSG_FILTER_ADDRESSES') ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M16 10L12 14L8 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="JSDropwownElements">
                            <span 
                                value=""
                                data-filter-name="PROPERTY_PROP_ADDRESS"
                                data-filter-value="all" 
                            >
                                 <div class="listing-checkbox">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                        <path d="M2.5 6.5L4.5 8.5L9.5 3.5" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <?= Loc::getMessage('MSG_FILTER_ADDRESSES') ?>
                            </span>
                            <?php foreach($data['ADDRESSES'] as $key => $position): ?>
                                <span 
                                    data-filter-name="PROPERTY_PROP_ADDRESS"
                                    data-filter-value="<?= $key ?>" 
                                    value="<?= $key ?>"
                                >
                                    <div class="listing-checkbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <path d="M2.5 6.5L4.5 8.5L9.5 3.5" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <?=$position?>
                                </span>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </form>
</div>

<?$this->SetViewTarget('mobile-doctors-filter');?>
	<div class="doctors-filter-mobile">
        <div class="doctors-filter-mobile__top first-step">
            <button class="doctors-filter-mobile__back close-filter">
                <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/doctors-back-arrow.svg') ?>
            </button>
            <span class="doctors-filter-mobile__title"><?= Loc::getMessage('MSG_MOBILE_FILTER_TITLE') ?></span>
            <button class="doctors-filter-mobile__reset" id="resetMobileFilter"><?= Loc::getMessage('MSG_MOBILE_FILTER_RESET') ?></button>
        </div>
        <div class="doctors-filter-mobile__top second-step">
            <button class="doctors-filter-mobile__back to-first-step">
                <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/doctors-back-arrow.svg') ?>
            </button>
            <span class="doctors-filter-mobile__title"><?= Loc::getMessage('MSG_MOBILE_FILTER_SPECIALITIES') ?></span>
        </div>
        <div class="doctors-filter-mobile__bottom first-step">
            <?php foreach($filterData as $key => $item): ?>
                <?php if ($item['POSITIONS']): ?>
                    <div class="doctors-filter-mobile__bottom-specialities mobile-blocks" id="mobileFilterSpecialities__<?= $key ?>">
                        <span class="doctors-filter-mobile__bottom-title"><?= Loc::getMessage('MSG_MOBILE_FILTER_SPECIALITIES') ?></span>
                        <div class="doctors-filter-mobile__bottom-list">
                            <?php $counter = 0; ?>
                            <?php foreach($item['POSITIONS'] as $positionKey => $position): ?>
                                <span 
                                    data-filter-name="PROPERTY_PROP_POSITION"
                                    data-filter-value="<?= $positionKey ?>" 
                                    value="<?= $positionKey ?>"
                                    class="doctors-filter-mobile__item"
                                >
                                    <?= $position ?>
                                </span>
                                <?php if ($counter >= 10): ?>
                                    <a href="#" class="doctors-filter-mobile__show-more">
                                        <?= Loc::getMessage('MSG_GET_ALL_DIRECTIONS') ?>
                                    </a>
                                    <?php break ?>
                                <?php endif; ?>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($item['ADDRESSES']): ?>
                    <div class="doctors-filter-mobile__bottom-addresses mobile-blocks" id="mobileFilterAddresses__<?= $key ?>">
                        <span class="doctors-filter-mobile__bottom-title"><?= Loc::getMessage('MSG_MOBILE_FILTER_ADDRESSES') ?></span>
                        <div class="doctors-filter-mobile__bottom-list">
                            <?php foreach($item['ADDRESSES'] as $addressKey => $address): ?>
                                <span 
                                    data-filter-name="PROPERTY_PROP_ADDRESS"
                                    data-filter-value="<?= $addressKey ?>" 
                                    value="<?= $addressKey ?>"
                                    class="doctors-filter-mobile__item"
                                >
                                    <?=$address?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="doctors-filter-mobile__bottom second-step">
            <div class="doctors-filter-mobile__next-step-name-block">
                <form class="doctors-filter-mobile__form" action="">
                    <input placeholder="<?= Loc::getMessage('MSG_SEARCH_PLACEHOLDER') ?>" name="w" type="text">
                    <button>
                        <?php include ($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/images/doctors/search.svg') ?>
                    </button>
                </form>
            </div>
            <div class="doctors-filter-mobile__next-step-list">
                <?php foreach($filterData as $sectionKey => $section): ?>
                    <div class="doctors-filter-mobile__next-step-section" id="mobileFilterAddressesNextStep__<?= $sectionKey ?>">
                        <?php foreach($section['POSITIONS'] as $nextStepKey => $nextStepItems): ?>
                            <span 
                                data-filter-name="PROPERTY_PROP_POSITION"
                                data-filter-value="<?= $nextStepKey ?>" 
                                value="<?= $nextStepKey ?>"
                                class="doctors-filter-mobile__item next-step"
                            >
                                <?= $nextStepItems ?>
                            </span>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div id="noMobileFormResults" class="no-results" style="display:none;"><?= Loc::getMessage('MSG_NO_SEARCH_RESULT') ?></div>
        </div>
    </div>
<?$this->EndViewTarget();?> 
  