<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="item-views-wrapper <?=$templateName;?>">
	
	<?if($arResult['SECTIONS']):?>
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<div class="contacts-stores shops-list1">
						<?foreach($arResult['SECTIONS'] as $si => $arSection):?>
							<?$bHasSection = (isset($arSection['SECTION']) && $arSection['SECTION'])?>
							<?if($bHasSection):?>
								<?// edit/add/delete buttons for edit mode
								$arSectionButtons = CIBlock::GetPanelButtons($arSection['SECTION']['IBLOCK_ID'], 0, $arSection['SECTION']['ID'], array('SESSID' => false, 'CATALOG' => true));
								$this->AddEditAction($arSection['SECTION']['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['SECTION']['IBLOCK_ID'], 'SECTION_EDIT'));
								$this->AddDeleteAction($arSection['SECTION']['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['SECTION']['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
								<div class="section_name" id="<?=$this->GetEditAreaId($arSection['SECTION']['ID'])?>">
									<h4><?=$arSection['SECTION']['NAME'];?></h4>
								</div>
							<?endif;?>
							<?foreach($arSection['ITEMS'] as $i => $arItem):?>
								<?
								// edit/add/delete buttons for edit mode
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								// use detail link?
								$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
								// preview picture
								$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
								$imageSrc = ($bImage ? $arItem['PREVIEW_PICTURE']['SRC'] : false);
								$imageDetailSrc = ($bImage ? $arItem['DETAIL_PICTURE']['SRC'] : false);
								$address = ($arItem['PROPERTIES']['ADDRESS']['VALUE'] ? ", ".$arItem['PROPERTIES']['ADDRESS']['VALUE'] : "");
								?>


								<div class="item bordered box-shadow<?=(!$bImage ? ' wti' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<div class="row">
										<div class="col-md-6 col-sm-8 col-xs-12 left-block-contacts">
											<?if($imageSrc):?>
												<div class="image pull-left">
													<a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
														<img src="<?=\Aspro\Functions\CAsproMax::showBlankImg($imageSrc);?>" data-src="<?=$imageSrc;?>" alt="<?=$arItem['NAME'];?>" title="<?=$arItem['NAME'];?>" class="img-responsive lazy"/>
													</a>
												</div>
											<?endif;?>
											<div class="top-wrap 2222">
												<div class="title font_mxs darken">
													<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="darken">
														<?=$arItem['NAME'];?><?=$address;?>
													</a>
												</div>
												<?if($arItem['PROPERTIES']['SCHEDULE']['VALUE']):?>
													<div class="schedule"><?=CMax::showIconSvg("clock colored", SITE_TEMPLATE_PATH."/images/svg/WorkingHours.svg");?><span class="text font_xs muted777"><?=$arItem['PROPERTIES']['SCHEDULE']['~VALUE']['TEXT'];?></span></div>
												<?endif;?>
												<?if($arItem['DISPLAY_PROPERTIES']):?>
													<div>
														<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
															<?if($arProperty["DISPLAY_VALUE"]):?>
																<div class="muted custom_prop <?=strtolower($pid);?>">
																	<div class="icons-text schedule grey s25">
																		<i class="fa"></i>
																		<span class="text_custom">
																			<span class="name"><?=$arProperty["NAME"]?>:&nbsp;</span>
																			<span class="value">
																				<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
																					<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
																				<?else:?>
																					<?=$arProperty["DISPLAY_VALUE"];?>
																				<?endif?>
																			</span>
																		</span>
																	</div>
																</div>
															<?endif?>
														<?endforeach;?>
													</div>
												<?endif;?>
											</div>
										</div>
										<div class="col-md-6 col-sm-4 col-xs-12 right-block-contacts">
											<div class="item-body">
												<div class="row">
													<?if($arItem['PROPERTIES']['PHONE']['VALUE']):?>
														<div class="phones col-md-4 col-sm-12 col-xs-12">
															<?foreach($arItem['PROPERTIES']['PHONE']['VALUE'] as $phone):?>
																<div class="phone font_sm darken">
																	<a href="tel:<?=substr($phone, 0, 18);?>" class="black"><?=$phone;?></a>
																</div>
															<?endforeach;?>
														</div>
													<?endif?>
													<?if($arItem['PROPERTIES']['EMAIL']['VALUE']):?>
														<div class="emails col-md-4 col-sm-12 col-xs-12">
															<div class="email font_sm">
																<a class="dark-color" href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?>"><?=$arItem['PROPERTIES']['EMAIL']['VALUE'];?></a>
															</div>
														</div>
													<?endif?>
													
													<?if($arItem['PROPERTIES']['PAY_TYPE']['VALUE'])
													{?>
														<div class="pay_block col-md-4 col-sm-12 col-xs-12 ">
														<?	foreach($arItem['PROPERTIES']['PAY_TYPE']['FORMAT'] as $arPays):?>
																<span class="icon-text grey s20" title="<?=$arPays['UF_NAME'];?>">
																	<?if($arPays['UF_ICON_CLASS']):?><i class="fa <?=$arPays['UF_ICON_CLASS'];?>"></i>
																	<?elseif($arPays['UF_FILE']):?>
																		<i><img src="<?=CFile::GetPath($arPays['UF_FILE']);?>" height="20" alt="<?=$arPays['UF_NAME'];?>"/></i>
																	<?endif;?> 
																	<?if(!$arPays['UF_FILE'] && !$arPays['UF_ICON_CLASS']):?>
																		<?=$arPays['UF_NAME'];?>
																	<?endif;?>
																</span>
															<?endforeach;?>
														</div>
													<?}?>
													
												</div>
                                                <div class="map_block_btn">
                                                    <? if ($arItem['PROPERTIES']['MARSHRUT_LINK']['VALUE'] !== ""): ?>
                                                        <div class="show_on_map">
                                                            <a class="marshrut_btn" target="_blank" href="<?=$arItem['PROPERTIES']['MARSHRUT_LINK']['VALUE']?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                                                                    <path d="M6.385 15.793L6.193 15.663C5.23208 14.9907 4.33917 14.226 3.527 13.38C2.1 11.885 0.5 9.644 0.5 6.999C0.5 3.745 3.141 0.5 7 0.5C10.859 0.5 13.5 3.745 13.5 7C13.5 9.645 11.9 11.886 10.473 13.379C9.66083 14.225 8.76792 14.9897 7.807 15.662C7.72567 15.7187 7.66167 15.762 7.615 15.792C7.412 15.927 7.205 16.055 7 16.185C6.795 16.055 6.588 15.927 6.385 15.793ZM7 9C7.53043 9 8.03914 8.78929 8.41421 8.41421C8.78929 8.03914 9 7.53043 9 7C9 6.46957 8.78929 5.96086 8.41421 5.58579C8.03914 5.21071 7.53043 5 7 5C6.46957 5 5.96086 5.21071 5.58579 5.58579C5.21071 5.96086 5 6.46957 5 7C5 7.53043 5.21071 8.03914 5.58579 8.41421C5.96086 8.78929 6.46957 9 7 9Z" fill="white"/>
                                                                </svg>
                                                                ПРОЛОЖИТЬ МАРШРУТ
                                                            </a>
                                                        </div>
                                                    <? endif; ?>
                                                </div>
											</div>
										</div>

									</div>
								</div>
							<?endforeach;?>
						<?endforeach;?>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
</div>