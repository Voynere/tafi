<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
    define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}?>
<div class="main-services">
    <div class="main-services__container">
        <h3>Наши услуги</h3>
        <div class="main-services__items">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/mainpage/components/our_services/service01.php"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/mainpage/components/our_services/service02.php"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => "/include/mainpage/components/our_services/service03.php"
                )
            );?>
        </div>
    </div>
</div>