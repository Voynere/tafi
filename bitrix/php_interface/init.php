AddEventHandler("search", "BeforeIndex", "clearTagsBeforeIndex");
function clearTagsBeforeIndex($arFields) {
    if(isset($arFields["TITLE"])) {
        // Удаляем все HTML-теги включая мета-теги
        $arFields["TITLE"] = strip_tags(html_entity_decode($arFields["TITLE"]));
        // Удаляем текст в скобках (теги)
        $arFields["TITLE"] = preg_replace('/\s*\([^)]*\)/', '', $arFields["TITLE"]);
    }
    return $arFields;
}

AddEventHandler("search", "BeforeIndex", function($arFields) {
    if(isset($arFields["TITLE"])) {
        $arFields["TITLE"] = strip_tags($arFields["TITLE"]);
    }
    return $arFields;
});