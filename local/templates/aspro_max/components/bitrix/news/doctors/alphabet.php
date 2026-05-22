<?php

use Bitrix\Main\Localization\Loc;
use Itb\Doctors\Alphabet;

$alphabetObj = new Alphabet($arParams['IBLOCK_ID']);
$elements = $alphabetObj->GetResultArray();
?>

<?php if (is_array($elements) && count($elements) > 0): ?>
    <div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <div class="news-alphabet">
        <div class="news-alphabet__categories">
            <h1 class="news-alphabet__title"><?= Loc::getMessage('ALPHABET_TITLE')?></h1>
            <div class="news-alphabet__buttons">
                <?php $counter = 0; ?>
                <?php foreach ($elements as $key => $element): ?>
                    <?php if ($element['NAME']): ?>
                        <button 
                            class="news-alphabet__button category-filter-button <?= $counter === 0 ? 'active' : ''?>" 
                            data-filter-name="PROPERTY_PROP_CATEGORY" 
                            data-filter-value="<?=$key?>"
                        >
                            <?= $element['NAME'] ?>
                        </button>
                    <?php endif; ?>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="news-alphabet__alphabet">
            <?php foreach ($elements as $key => $element): ?>
                <?php if (empty($element['ALPHABET'])) continue; ?>
                <div class="news-alphabet__block" id="alphabet-block_<?= $key ?>">
                    <?php foreach ($element['ALPHABET']['WORD'] as $key => $names): ?>
                        <div class="news-alphabet__common">
                            <span><?= $key ?></span>
                            <div class="news-alphabet__specialities">
                                <?php foreach($names as $nameKey => $name): ?>
                                    <a 
                                        class="news-alphabet__speciality" 
                                        data-filter-name="<?=$element['ALPHABET']['CODE']?>" 
                                        data-filter-value="<?=$nameKey?>"
                                        value="<?= $name ?>"
                                        href="#"
                                    >
                                        <?= $name ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>