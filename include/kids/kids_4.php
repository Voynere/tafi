<div class="kids-reviews maxwidth-theme">
    <div class="kids-reviews__top">
        <div class="kids-reviews__left">
            <h2 class="kids-reviews__title">Отзывы</h2>
            <span class="btn btn-default btn-lg animate-load has-ripple" data-event="jqm" data-param-form_id="REVIEW" data-name="send_review">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1035_15)">
                    <path d="M7.33333 6.94267V8C7.33333 8.368 7.63133 8.66667 8 8.66667H9.05733C9.76933 8.66667 10.4393 8.38867 10.9427 7.88533L15.414 3.414C15.7913 3.036 16 2.534 16 1.99933C16 1.46467 15.7913 0.962667 15.414 0.585333C14.634 -0.194667 13.366 -0.194667 12.586 0.585333L8.11466 5.05667C7.61066 5.56 7.33333 6.23067 7.33333 6.94267ZM8.66666 6.94267C8.66666 6.592 8.80933 6.248 9.05733 6L13.5287 1.52867C13.7893 1.26867 14.2107 1.26867 14.4713 1.52867C14.5973 1.654 14.6667 1.82133 14.6667 2C14.6667 2.17867 14.5973 2.34533 14.4713 2.47133L10 6.94267C9.748 7.19467 9.41333 7.33333 9.05733 7.33333H8.66666V6.94267ZM16 6.66667V10.6667C16 12.1373 14.804 13.3333 13.3333 13.3333H11.4313L8.86666 15.4533C8.626 15.668 8.31733 15.776 8.00533 15.776C7.688 15.776 7.36866 15.664 7.114 15.4373L4.61466 13.3333H2.666C1.19533 13.3333 -0.000671387 12.1373 -0.000671387 10.6667V2.66667C-4.72e-06 1.196 1.196 0 2.66666 0H9.33333C9.702 0 10 0.298667 10 0.666667C10 1.03467 9.702 1.33333 9.33333 1.33333H2.66666C1.93133 1.33333 1.33333 1.93133 1.33333 2.66667V10.6667C1.33333 11.402 1.93133 12 2.66666 12H4.85866C5.01533 12 5.168 12.0553 5.28866 12.1567L7.98733 14.4293L10.768 12.1527C10.8873 12.054 11.0373 12 11.1927 12H13.334C14.0693 12 14.6673 11.402 14.6673 10.6667V6.66667C14.6673 6.29867 14.9653 6 15.334 6C15.7027 6 16 6.29867 16 6.66667Z" fill="#1063C0"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1035_15">
                    <rect width="16" height="16" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                Оставить отзыв
            </span>
        </div>
        <a class="kids-reviews__link" target="_blank" href="/company/reviews/">Все отзывы</a>
    </div>
    <?
    $GLOBALS['arrFilter'] = ['ACTIVE' => 'Y', "PROPERTY_SHOW_IN_KIDS" => 323];
    ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "kids_reviews",
        array(
            'IBLOCK_TYPE' => 'aspro_max_content',
            'IBLOCK_ID' => 19,
            'NEWS_COUNT' => 20,
            'SORT_BY1' => 'ACTIVE_FROM',
            'FILTER_NAME' => 'arrFilter',
            'SORT_ORDER1' => 'DESC',
            'SORT_BY2' => 'ID',
            'SORT_ORDER2' => 'DESC',
            'FIELD_CODE' => array(
                'NAME',
                'PREVIEW_TEXT',
                'PREVIEW_PICTURE',
                'DETAIL_TEXT',
                'DETAIL_PICTURE',
                'DATE_ACTIVE_FROM',
            ),
            'PROPERTY_CODE' => array(
                'POST',
                'VIDEO',
                'STAFF',
                'RATING',
                'COMPANY_RESPONSE',
                'NAME',
                'MESSAGE',
                'FILE',
            ),
            'AJAX_MODE' => 'N',
            'AJAX_OPTION_JUMP' => 'N',
            'AJAX_OPTION_STYLE' => 'Y',
            'AJAX_OPTION_HISTORY' => 'N',
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => 100000,
            'CACHE_FILTER' => 'N',
            'CACHE_GROUPS' => 'N',
            'PREVIEW_TRUNCATE_LEN' => '',
            'ACTIVE_DATE_FORMAT' => 'd.m.Y',
            'DISPLAY_PANEL' => '',
            'SET_TITLE' => 'N',
            'SHOW_DETAIL_LINK' => 'N',
            'SET_STATUS_404' => 'Y',
            'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
            'ADD_SECTIONS_CHAIN' => 'N',
            'HIDE_LINK_WHEN_NO_DETAIL' => 'Y',
            'CHECK_DATES' => 'Y',
            'PARENT_SECTION' => '',
            'PARENT_SECTION_CODE' => '',
            'DISPLAY_TOP_PAGER' => 'N',
            'DISPLAY_BOTTOM_PAGER' => 'Y',
            'PAGER_SHOW_ALWAYS' => 'N',
            'PAGER_DESC_NUMBERING' => 'N',
            'PAGER_DESC_NUMBERING_CACHE_TIME' => 36000,
            'PAGER_SHOW_ALL' => 'N',
            'DISPLAY_DATE' => '',
            'DISPLAY_NAME' => 'N',
            'DISPLAY_PICTURE' => '',
            'DISPLAY_PREVIEW_TEXT' => '',
            'USE_PERMISSIONS' => 'N',
            'GROUP_PERMISSIONS' => '',
            'SHOW_SECTION_PREVIEW_DESCRIPTION' => 'Y',
            'AJAX_OPTION_ADDITIONAL' => '',
            'SET_BROWSER_TITLE' => 'N',
            'SET_LAST_MODIFIED' => 'N',
            'INCLUDE_SUBSECTIONS' => 'Y',
            'STRICT_SECTION_CHECK' => 'N',
            'TITLE_BLOCK' => '',
            'TITLE_BLOCK_ALL' => '',
            'SHOW_ADD_REVIEW' => '',
            'TITLE_ADD_REVIEW' => '',
            'ALL_URL' => '',
            'PAGER_BASE_LINK_ENABLE' => 'N',
            'SHOW_404' => 'Y',
            'NOT_SLIDER' => 'N',
            'SIZE_IN_ROW' => '3'
        ),
        $component
    );?>
</div>