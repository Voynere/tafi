<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? if (!empty($arResult["ITEMS"])): ?>
	<div class="front-news-2__container">
		<? foreach ($arResult["ITEMS"] as $arItem): ?>
			<? if (empty($arItem["PREVIEW_PICTURE"]["SRC"]) || empty($arItem["NAME"])) continue;
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
			<div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="front-news-2__item">
				<a href="<?= $arItem["LIST_PAGE_URL"] . $arItem["CODE"] . '/'; ?>" class="front-news-2__img">
					<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>">
				</a>
				<div class="front-news-2__bottom">
					<div class="front-news-2__date"><?= $arItem["DISPLAY_ACTIVE_FROM"]; ?></div>
					<a href="<?= $arItem["LIST_PAGE_URL"] . $arItem["CODE"] . '/'; ?>" class="front-news-2__title">
						<?= $arItem["NAME"]; ?>
					</a>
				</div>
			</div>
		<? endforeach; ?>
	</div>
<? endif; ?>
