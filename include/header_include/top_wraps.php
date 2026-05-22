<?global $APPLICATION, $arRegion, $arSite, $arTheme, $bIndexBot, $is404, $isForm, $isIndex;?>

<?php
$isNewPage = $APPLICATION->GetCurPage() == "/info/podarochnye-sertifikaty.php";
?>
<? if(!$isNewPage): ?>
    <?if(!$is404 && !$isForm && !$isIndex):?>
        <?$APPLICATION->ShowViewContent('section_bnr_content');?>
            <!--title_content-->
            <?CMax::ShowPageType('page_title');?>
            <!--end-title_content-->
        <?$APPLICATION->ShowViewContent('top_section_filter_content');?>
    <?endif;?>
<?endif;?>
<?include_once('top_wraps_custom.php');?>
