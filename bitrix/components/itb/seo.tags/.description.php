<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME"              => GetMessage("Произвольные теги"),
    "DESCRIPTION"       => GetMessage("Произвольные теги по url"),
    "PATH" => array(
        "ID" => "itb_seo_components",
        "CHILD" => array(
            "ID" => "tags",
            "NAME" => "Произвольные теги"
        )
    )
);