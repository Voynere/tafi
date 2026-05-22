<?php

use Bitrix\Main\Loader;
use Itb\Seo\Service\TagService;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

Loader::requireModule('itb.seo');

$request_uri = defined('ITB_SEO_REQUEST_URI') ? ITB_SEO_REQUEST_URI : $_SERVER['REQUEST_URI'];

if ($this->StartResultCache(false, $request_uri))
{
    $arResult['GROUPS'] = service(TagService::class)->getTags($request_uri);

    $this->IncludeComponentTemplate();
}