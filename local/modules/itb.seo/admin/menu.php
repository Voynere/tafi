<?

return [
    [
        "parent_menu"   => "global_menu_content",
        "section"       => "content",
        "icon"          => "util_menu_icon",
        "page_icon"     => "util_menu_icon",
        "sort"          => "0",
        "text"          => "СЕО везде",
        "title"         => "СЕО везде",
        "url"           => "/bitrix/admin/itb_seo_meta.php",
        "more_url"      => array("itb_seo_meta.php"),
        "items_id"      => "menu_content",
        "items"         => array(
            array(
                "text" => "Список мета тегов",
                "url" => "/bitrix/admin/itb_seo_meta.php",
                "more_url" => array("itb_seo_meta")
            ),
            array(
                "text" => "Список ссылок",
                "url" => "/bitrix/admin/itb_seo_link.php",
                "more_url" => array("itb_seo_link")
            ),
            array(
                "text" => "Список тегов",
                "url" => "/bitrix/admin/itb_seo_tag.php",
                "more_url" => array("itb_seo_tag")
            ),
                array(
                "text" => "Экспорт ссылок",
                "url" => "/bitrix/admin/itb_seo_export.php",
                "more_url" => array("itb_seo_tag")
            ),
            array(
                "text" => "Импорт ссылок",
                "url" => "/bitrix/admin/itb_seo_import.php",
                "more_url" => array("itb_seo_tag")
            ),
            array(
                "text" => "Настройки",
                "url" => "/bitrix/admin/settings.php?mid=itb.seo",
                "more_url" => array()
            )
        )
    ]
];
