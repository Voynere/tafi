<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
global $APPLICATION;
$APPLICATION->SetTitle($arResult['NAME'] . ",  " .$arResult['PROPERTIES']['ADDRESS']['VALUE'] );
$APPLICATION->AddChainItem($arResult['NAME'] . ",  " .$arResult['PROPERTIES']['ADDRESS']['VALUE']);

$str = explode("Пн - Пт:", $arResult['PROPERTIES']['SCHEDULE']['VALUE']['TEXT']);

$str_one = explode("(Прием анализов:", $str[1]);

$str_one[0] = html_entity_decode($str_one[0]);
$str_one[1] = html_entity_decode($str_one[1]);
$str_one[2] = html_entity_decode($str_one[2]);
$str_one[3] = html_entity_decode($str_one[3]);


$rejim_PN_PT = strip_tags($str_one[0]);
$analiz_PN_PT = explode(")",$str_one[1])[0];
$rejim_SB =  strip_tags(explode("Сб:",  explode(")",$str_one[1])[1])[1]);
$analiz_SB = strip_tags(explode( ")", $str_one[2])[0]);
$rejim_VS = strip_tags(explode("Вс:" ,  explode( ")", $str_one[2])[1])[1]);
$analiz_VS  = strip_tags(explode(")", $str_one[3])[0]) ;


//$APPLICATION->SetPageProperty('title', $arResult['NAME'] . "  " .$arResult['PROPERTIES']['ADDRESS']['VALUE']);
?>
<div class="item item-shop-detail1  col-md-6">
    <div class="info_tel_and_email">
        <div class="info_tel">
            <div class="tel_block">
                <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE'][0]?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M16.6357 14.1501L19.7737 17.2881C19.8743 17.3883 19.9542 17.5075 20.0087 17.6386C20.0633 17.7698 20.0913 17.9104 20.0913 18.0525C20.0913 18.1945 20.0633 18.3352 20.0087 18.4664C19.9542 18.5975 19.8743 18.7166 19.7737 18.8168C18.6702 19.9205 17.2056 20.589 15.6489 20.6996C14.0922 20.8102 12.5478 20.3555 11.2994 19.4189L9.43295 18.0181C7.36679 16.4685 5.53136 14.6331 3.98174 12.5669L2.58102 10.7005C1.64442 9.45209 1.18965 7.90772 1.30024 6.35097C1.41083 4.79423 2.07935 3.32965 3.18302 2.22621C3.28323 2.12553 3.40234 2.04564 3.53351 1.99112C3.66468 1.9366 3.80533 1.90854 3.94738 1.90854C4.08943 1.90854 4.23008 1.9366 4.36125 1.99112C4.49242 2.04564 4.61153 2.12553 4.71173 2.22621L7.84973 5.36421C8.07189 5.58644 8.1967 5.88781 8.1967 6.20204C8.1967 6.51627 8.07189 6.81764 7.84973 7.03987L6.6398 8.2498C6.54536 8.34329 6.48301 8.46433 6.46172 8.5955C6.44042 8.72667 6.46128 8.86122 6.5213 8.97979C7.92726 11.7922 10.2077 14.0726 13.0201 15.4786C13.1387 15.5386 13.2732 15.5594 13.4044 15.5382C13.5355 15.5169 13.6566 15.4545 13.7501 15.3601L14.9588 14.1513C15.0689 14.0411 15.1996 13.9537 15.3434 13.8941C15.4873 13.8345 15.6415 13.8038 15.7972 13.8038C15.953 13.8038 16.1072 13.8345 16.251 13.8941C16.3949 13.9537 16.5256 14.0411 16.6357 14.1513V14.1501Z" stroke="#3B61B9" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                    <span><?=$arResult['PROPERTIES']['PHONE']['VALUE'][0]?></span>
                </a>
            </div>
            <div class="works_time">
                <h3 class="work_time_title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 20 20" fill="none">
                        <path d="M10 19C14.9706 19 19 14.9706 19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10C1 14.9706 5.02944 19 10 19Z" stroke="#777777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 6V11H14" stroke="#777777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p>
                        Режим работы
                    </p>
                </h3>

                <div class="works_times_list">
                    <div class="list_times_block_and_days">
                        <p class="days_works">Пн — Пт:</p>
                        <p class="time_works"><?=$rejim_PN_PT?></p>
                    </div>
                    <div class="list_times_block_and_days">
                        <p class="days_works">Сб:</p>
                        <p class="time_works"><?=$rejim_SB?></p>
                    </div>
                    <div class="list_times_block_and_days">
                        <p class="days_works">Вс:</p>
                        <p class="time_works"><?=$rejim_VS?></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="info_email">
            <div class="tel_block">
                <a href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                        <path d="M2 2L8.108 6.612L8.11 6.614C8.788 7.111 9.127 7.36 9.499 7.456C9.82759 7.54102 10.1724 7.54102 10.501 7.456C10.873 7.36 11.213 7.111 11.893 6.612C11.893 6.612 15.81 3.606 18 2M1 11.8V4.2C1 3.08 1 2.52 1.218 2.092C1.41 1.715 1.715 1.41 2.092 1.218C2.52 1 3.08 1 4.2 1H15.8C16.92 1 17.48 1 17.907 1.218C18.284 1.41 18.59 1.715 18.782 2.092C19 2.519 19 3.079 19 4.197V11.804C19 12.922 19 13.48 18.782 13.908C18.59 14.2845 18.2837 14.5904 17.907 14.782C17.48 15 16.921 15 15.803 15H4.197C3.079 15 2.519 15 2.092 14.782C1.71569 14.5903 1.40974 14.2843 1.218 13.908C1 13.48 1 12.92 1 11.8Z" stroke="#3B61B9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span><?=$arResult['PROPERTIES']['EMAIL']['VALUE']?></span>
                </a>
            </div>
            <div class="works_time">
                <h3 class="work_time_title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M22.0114 4.73583L17.4152 0.879104C16.7806 0.346634 15.8344 0.429417 15.3019 1.06399C14.8825 1.5639 14.8449 2.25809 15.1587 2.79004L3.85498 16.2613C2.61254 17.7419 2.80577 19.9501 4.28641 21.1925C5.76706 22.4349 7.97524 22.2418 9.21768 20.7611L20.5214 7.28988C21.0997 7.50649 21.7769 7.34899 22.1963 6.84908C22.7288 6.2145 22.646 5.2683 22.0114 4.73583ZM8.45125 20.118C7.5652 21.1739 5.98541 21.3122 4.92949 20.4261C3.87357 19.5401 3.73536 17.9603 4.62141 16.9044L7.51395 13.4572L8.66302 14.4214C8.87456 14.5989 9.18971 14.5708 9.36718 14.3593C9.54468 14.1477 9.51715 13.833 9.30565 13.6555L8.15658 12.6913L9.44229 11.1591L10.5914 12.1233C10.8029 12.3008 11.118 12.2727 11.2956 12.0611C11.473 11.8496 11.4455 11.5348 11.234 11.3574L10.0849 10.3932L11.3707 8.86091L15.2005 12.0745L8.45125 20.118ZM15.8431 11.3087L12.0133 8.09506L15.87 3.49879L19.6999 6.71241L15.8431 11.3087ZM20.7262 6.26753L16.1299 2.41081C15.919 2.23379 15.8908 1.91758 16.0678 1.70662C16.2453 1.49508 16.5616 1.46794 16.7726 1.64496L21.3688 5.50168C21.5798 5.6787 21.608 5.99491 21.4305 6.20645C21.2535 6.41741 20.9372 6.44455 20.7262 6.26753Z" fill="#777777" stroke="#777777" stroke-width="0.3"/>
                    </svg>
                    <p>
                        Забор анализов
                    </p>
                </h3>

                <div class="works_times_list">
                    <div class="list_times_block_and_days">
                        <p class="days_works">Пн — Пт:</p>
                        <p class="time_works"><?=$analiz_PN_PT?></p>
                    </div>
                    <div class="list_times_block_and_days">
                        <p class="days_works">Сб:</p>
                        <p class="time_works"><?=$analiz_SB?></p>
                    </div>
                    <div class="list_times_block_and_days">
                        <p class="days_works">Вс:</p>
                        <p class="time_works"><?=$analiz_VS?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <? if ( !empty($arResult['PROPERTIES']['METRO']['VALUE']) ): ?>
    <div class="metro_block">

        <h3 class="metro_title_block">Остановки общественного транспорта </h3>

        <div class="metro_block_list">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20.25 8.25H21.75V11.25H20.25V8.25ZM2.25 8.25H3.75V11.25H2.25V8.25ZM15 15H16.5V16.5H15V15ZM7.5 15H9V16.5H7.5V15Z" fill="#3B61B9"/>
                <path d="M15.75 3H8.25C7.2558 3.00119 6.30267 3.39666 5.59966 4.09966C4.89666 4.80267 4.50119 5.7558 4.5 6.75V17.25C4.5 17.6478 4.65804 18.0294 4.93934 18.3107C5.22064 18.592 5.60218 18.75 6 18.75V21H7.5V18.75H16.5V21H18V18.75C18.3976 18.7494 18.7788 18.5912 19.06 18.31C19.3412 18.0288 19.4994 17.6476 19.5 17.25V6.75C19.4988 5.7558 19.1033 4.80267 18.4003 4.09966C17.6973 3.39666 16.7442 3.00119 15.75 3ZM18 7.5V12H6V7.5H18ZM8.25 4.5H15.75C16.2138 4.50138 16.6659 4.64631 17.044 4.91488C17.4222 5.18346 17.7079 5.56252 17.862 6H6.138C6.29209 5.56252 6.57783 5.18346 6.95599 4.91488C7.33415 4.64631 7.78617 4.50138 8.25 4.5ZM6 17.25V13.5H18.0007L18.0015 17.25H6Z" fill="#3B61B9"/>
            </svg>
            <p><?=$arResult['PROPERTIES']['METRO']['VALUE'][0]?></p>
        </div>
    </div>
    <? endif; ?>
    <? if ($arResult['PROPERTIES']['MARSHRUT_LINK']['VALUE'] !== ""): ?>
        <div class="show_on_map">
            <a class="marshrut_btn" target="_blank" href="<?=$arResult['PROPERTIES']['MARSHRUT_LINK']['VALUE']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                    <path d="M6.385 15.793L6.193 15.663C5.23208 14.9907 4.33917 14.226 3.527 13.38C2.1 11.885 0.5 9.644 0.5 6.999C0.5 3.745 3.141 0.5 7 0.5C10.859 0.5 13.5 3.745 13.5 7C13.5 9.645 11.9 11.886 10.473 13.379C9.66083 14.225 8.76792 14.9897 7.807 15.662C7.72567 15.7187 7.66167 15.762 7.615 15.792C7.412 15.927 7.205 16.055 7 16.185C6.795 16.055 6.588 15.927 6.385 15.793ZM7 9C7.53043 9 8.03914 8.78929 8.41421 8.41421C8.78929 8.03914 9 7.53043 9 7C9 6.46957 8.78929 5.96086 8.41421 5.58579C8.03914 5.21071 7.53043 5 7 5C6.46957 5 5.96086 5.21071 5.58579 5.58579C5.21071 5.96086 5 6.46957 5 7C5 7.53043 5.21071 8.03914 5.58579 8.41421C5.96086 8.78929 6.46957 9 7 9Z" fill="white"/>
                </svg>
                ПРОЛОЖИТЬ МАРШРУТ
            </a>
        </div>
    <? endif; ?>
    <div class="img_block_store">
        <img src="<?=$arResult['PREVIEW_PICTURE']['SRC']  ?>" alt="<?=$arResult['PREVIEW_PICTURE']['ALT']  ?>">
    </div>




    <div class="social-block">
        <div class="wrap">
            <div class="social-icons">
                <!-- noindex -->
                <ul>
                    <li class="vk">
                        <a href="https://vk.com/tafimed" target="_blank" rel="nofollow" title="Вконтакте">
                            Вконтакте				</a>
                    </li>
                    <li class="telegram">
                        <a href="https://t.me/tafimed" target="_blank" rel="nofollow" title="Telegram">
                            Telegram				</a>
                    </li>
                    <li class="whats">
                        <a href="https://wa.me/+79941106261?text=%D0%94%D0%BE%D0%B1%D1%80%D1%8B%D0%B9%20%D0%B4%D0%B5%D0%BD%D1%8C%2C%20%D1%8F%20%D0%BF%D0%B8%D1%88%D1%83%20%D1%81%20%D1%81%D0%B0%D0%B9%D1%82%D0%B0%2C%20%D0%BC%D0%B5%D0%BD%D1%8F%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%B5%D1%81%D1%83%D0%B5%D1%82%20..." target="_blank" rel="nofollow" title="WhatsApp">
                            WhatsApp				</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="feedback item">
        <div class="wrap">
            <div class="button_wrap">
                <span>
                    <span class="btn  btn-transparent-border-color white  animate-load" data-event="jqm" data-param-form_id="ASK" data-name="contacts">Написать сообщение</span>
                </span>
            </div>
        </div>
    </div>

</div>

