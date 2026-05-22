<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['SECTIONS']):?>
<?
    $url = explode('?', $_SERVER['REQUEST_URI'])[0];
?>
    <? if($arResult["SECTION_SHOW"]["UF_NEW_TEMPLATE"] == 1 && $url != '/services/'): ?>
        <style>
            .top-block-wrapper .page-top.maxwidth-theme {
                display: none;
            }
            .wraps .wrapper_inner {
                max-width: unset;
                padding: 0;
            }
        </style>
        <div class="nsections-banner banner">
            <div class="banner__inner nsections__container">
                <div class="banner__breadcrumbs"></div>
                <? if(!empty($arResult["SECTION_SHOW"]["UF_BANNER_TITLE"])): ?>
                    <span class="banner__title"><?=$arResult["SECTION_SHOW"]["UF_BANNER_TITLE"]?></span>
                <? endif; ?>
                <? if(!empty($arResult["SECTION_SHOW"]["UF_BANNER_ADVANTAGES"])): ?>
                    <ul class="banner__descr">
                        <? foreach ($arResult["SECTION_SHOW"]["UF_BANNER_ADVANTAGES"] as $item): ?>
                            <li class="banner__descr-li"><?=$item?></li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
                <? if($arResult["SECTION_SHOW"]["UF_BANNER_BUTTON"] == 1 && !empty($arResult["SECTION_SHOW"]["UF_BANNER_BUTTON_LINK"])): ?>
                    <a target="_blank" class="bunner__button btn btn-default" href="<?=$arResult["SECTION_SHOW"]["UF_BANNER_BUTTON_LINK"]?>">
                        <?=GetMessage("BANNER_BUTTON")?>
                    </a>
                <? endif; ?>
            </div>
            <? if(!empty($arResult["SECTION_SHOW"]["UF_BANNER_PHOTO"])): ?>
                <img class="banner__img" src="<?=$arResult["SECTION_SHOW"]["UF_BANNER_PHOTO"]?>" alt="banner">
            <? endif;?>
            <? if(!empty($arResult["SECTION_SHOW"]["UF_BANNER_PHOTO_MOB"])): ?>
                <img class="banner__img-mob" src="<?=$arResult["SECTION_SHOW"]["UF_BANNER_PHOTO_MOB"]?>" alt="banner">
            <? endif;?>
        </div>
        <div class="nsections nsections__container">
            <?foreach($arResult['SECTIONS'] as $arItem):?>
                <?
                $arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
                $this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
                $this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']))
                {
                    $bImage = strlen($arItem['~PICTURE']);
                    $arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 429, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
                    $imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_content.svg');
                }
                ?>
                <div class="nsections__item" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
                    <div class="nsections__inner">
                        <div class="nsections__top-block">
                            <? if($bShowSectionImage): ?>
                                <a class="nsections__image-link" href="<?=$arItem['SECTION_PAGE_URL']?>">
                                    <img
                                        class="nsections__image-img img-responsive lazy"
                                        src="<?=\Aspro\Functions\CAsproMax::showBlankImg($imageSectionSrc);?>"
                                        data-src="<?=$imageSectionSrc?>"
                                        alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>"
                                        title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>"
                                    >
                                </a>
                            <? endif; ?>
                            <? if(in_array('NAME', $arParams['FIELD_CODE'])): ?>
                                <a class="nsections__title" href="<?=$arItem['SECTION_PAGE_URL']?>">
                                    <?=$arItem['NAME']?>
                                </a>
                            <? endif; ?>
                            <? if($arItem['CHILD']): ?>
                                <ul class="nsections__list">
                                    <?$counter = 0;?>
                                    <? foreach($arItem['CHILD'] as $arSubItem): ?>
                                        <?
                                        $showItem = '';
                                        if ($counter >= 4)
                                        {
                                            $showItem = 'hidden';
                                        };
                                        $counter++;
                                        if(is_array($arSubItem['DETAIL_PAGE_URL']))
                                        {
                                            if(isset($arSubItem['CANONICAL_PAGE_URL']) && !empty($arSubItem['CANONICAL_PAGE_URL']))
                                            {
                                                $arSubItem['DETAIL_PAGE_URL'] = $arSubItem['CANONICAL_PAGE_URL'];
                                            }
                                            else
                                            {
                                                $arSubItem['DETAIL_PAGE_URL'] = $arSubItem['DETAIL_PAGE_URL'][key($arSubItem['DETAIL_PAGE_URL'])];
                                            }
                                        }
                                        ?>
                                        <li class="nsections__li <?=$showItem?>">
                                            <a
                                                    class="nsections__link"
                                                    href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"
                                            >
                                                <?=$arSubItem['NAME']?>
                                            </a>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                            <? endif; ?>
                        </div>
                        <? if($arItem['CHILD']): ?>
                            <div class="nsections__button">
                                <span
                                    class="nsections__button-span"
                                    data-open_text="<?=GetMessage('CLOSE_TEXT');?>"
                                    data-close_text="<?=GetMessage('OPEN_TEXT');?>"
                                >
                                    <?=GetMessage('OPEN_TEXT');?>
                                </span>
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            <?endforeach;?>
        </div>
    <? else: ?>
	    <div class="item-views content-sections1 ">
		<div class="items row margin0 list_block">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
                if ($arItem["ID"] == 746) continue;
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 429, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_content.svg');
				}
				?>
				<div class="col-md-12 col-sm-12">
					<div class="item_wrap colored_theme_hover_bg-block box-shadow rounded3 bordered-block " >
						<div class="item noborder <?=($bShowSectionImage ? '' : ' wti')?>  <?=$arParams['IMAGE_CATALOG_POSITION'];?> clearfix" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
							<?// icon or preview picture?>
							<?if($bShowSectionImage):?>
								<div class="image shine nopadding">
									<a href="<?=$arItem['SECTION_PAGE_URL']?>">
										<img src="<?=\Aspro\Functions\CAsproMax::showBlankImg($imageSectionSrc);?>" data-src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive lazy" />
									</a>
								</div>
							<?endif;?>

							<div class="body-info">
								<?// section name?>
								<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
									<div class="title font_mlg">
										<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
											<?=$arItem['NAME']?>
										</a>
									</div>
								<?endif;?>

								<?// section preview text?>
								<?if(strlen($arItem['UF_TOP_SEO']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
									<div class="previewtext  font_sm muted777 line-h-165">
										<?=$arItem['UF_TOP_SEO']?>
									</div>
								<?elseif(strlen($arItem['DESCRIPTION']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
									<div class="previewtext  font_sm muted777 line-h-165">
										<?if($arParams['PREVIEW_TRUNCATE_LEN']):?>
											<?=CMax::truncateLengthText($arItem['DESCRIPTION'], $arParams['PREVIEW_TRUNCATE_LEN'])?>
										<?else:?>
											<?=$arItem['DESCRIPTION'];?>
										<?endif;?>
									</div>
								<?endif;?>
								<?// section child?>
								<?if($arItem['CHILD']):?>
									<div class="text childs">
										<ul>
											<?foreach($arItem['CHILD'] as $arSubItem):?>
												<?
												if(is_array($arSubItem['DETAIL_PAGE_URL'])){
													if(isset($arSubItem['CANONICAL_PAGE_URL']) && !empty($arSubItem['CANONICAL_PAGE_URL'])){
														$arSubItem['DETAIL_PAGE_URL'] = $arSubItem['CANONICAL_PAGE_URL'];
													}
													else{
														$arSubItem['DETAIL_PAGE_URL'] = $arSubItem['DETAIL_PAGE_URL'][key($arSubItem['DETAIL_PAGE_URL'])];
													}
												}
												?>
												<li class="font_sm"><a class="colored" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
											<?endforeach;?>
										</ul>
									</div>
								<?endif;?>
								<?if($arItem['CHILD']):?>
									<div class="button_opener colored"><i class="fa fa-angle-down" aria-hidden="true"></i><?//=CMax::showIconSvg("arrow", SITE_TEMPLATE_PATH.'/images/svg/arrow_down_accordion.svg', '', '', true, false);?><span class="opener font_upper" data-open_text="<?=GetMessage('CLOSE_TEXT');?>" data-close_text="<?=GetMessage('OPEN_TEXT');?>"><?=GetMessage('OPEN_TEXT');?></span></div>
								<?endif;?>


								<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="arrow_link colored_theme_hover_bg-el bordered-block rounded3 muted" title="<?=GetMessage('TO_ALL')?>"><?=CMax::showIconSvg("right-arrow", SITE_TEMPLATE_PATH.'/images/svg/arrow_right_list.svg', '', '');?></a>

							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
    <? endif; ?>
<?endif;?>