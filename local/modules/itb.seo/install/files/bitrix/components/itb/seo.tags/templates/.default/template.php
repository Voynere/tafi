<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php if($arResult['GROUPS']) : ?>

<div class="seoeverywhere-tags">
    <?php foreach ($arResult['GROUPS'] as $title => $group) : ?>
    <div class="seoeverywhere-tags__group">
        <div class="seoeverywhere-tags__group-title">
            <?php echo $group['TITLE'] ?>
        </div>
        <div class="seoeverywhere-tags__list">
            <?php foreach ($group['ITEMS'] as $item) : ?>
                <div class="seoeverywhere-tags__item">
                    <a href="<?php echo $item["URL"]; ?>">
                        <?php echo $item["TITLE"]; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>
