<?php
namespace Itb\Seo\EventHandlers;

use \Bitrix\Main\Context;
use Itb\Seo\Service\LinkService;
use Itb\Seo\Options;
use Itb\Seo\Service\MetaService;

class Main
{
    public static function onBeforeEndBufferContent()
    {
        global $APPLICATION;

        if(Context::getCurrent()->getRequest()->isAdminSection()) return;

        $url        = defined('ITB_SEO_REQUEST_URI') ? ITB_SEO_REQUEST_URI : $_SERVER['REQUEST_URI'];
        $domain     = $_SERVER['HTTP_HOST'];
        $subdomain  = false;
        $options = service(Options::class);
        $metaService = service(MetaService::class);

        if(mb_substr_count($domain, '.') == 2) {
            list($subdomain, $domain) = explode('.', $domain, 2);
        }

        if (!$url) $url = 'tafimed.ru';

        $meta = $metaService->getMeta($url, $subdomain);

        if($meta) {
            $metaService->setMeta($meta);
        } else {
            $filter = $metaService->getFilter();

            if($filter && (count($filter) > 1 || !isset($filter["FACET_OPTIONS"]))) {
                $options = [
                    'FILTER_HEAD'           => $options->filterHead,
                    'FILTER_TITLE'          => $options->filterTitle,
                    'FILTER_DESCRIPTION'    => $options->filterDescription,
                ];
                $category = $metaService->getCategory();

                foreach ($options as $key => $option) {
                    $params = $metaService->parseParams($option);
                    if($category) {
                        $params["CATEGORY"]["VALUE"] = $category;
                    }

                    $metaService->prepareParams($params, $filter);
                    $text = $metaService->insertParams($params, $option);

                    if(!trim($text)){
                        continue;
                    }

                    switch ($key) {
                        case 'FILTER_HEAD':
                            $APPLICATION->SetTitle($text);
                            break;
                        case 'FILTER_TITLE':
                            $APPLICATION->SetPageProperty('title', $text);
                            break;
                        case 'FILTER_DESCRIPTION':
                            $APPLICATION->SetPageProperty('description', $text);
                            break;
                    }
                }
            }
        }
    }

    public static function onEndBufferContent(&$content)
    {
        global $APPLICATION;

        if($text = $APPLICATION->GetProperty('text', '')) {
            $content = preg_replace('/<!-- PATTERN -->(.+)<!-- END_PATTERN -->/siU', $text, $content);
        }

        if(defined('ITB_SEO_LINK_NEW')) {
            $canonical = !isset($_GET['PAGEN_1']) ? '' : '<link rel="canonical" href="' . ITB_SEO_LINK_NEW . '" />';

            if(preg_match('/(<link rel="canonical" href=".*\/.*\/.*\/.*" \/>?)/', $content)) {
                $content = preg_replace('/(<link rel="canonical" href=".*\/.*\/.*\/.*" \/>?)/', $canonical, $content);
            } else {
                $content = preg_replace('/<title>(.*)<\/title>/i', '$0 ' . PHP_EOL . $canonical . PHP_EOL, $content);
            }
        }
    }

    public static function onPageStart()
    {
        global $APPLICATION;

        define('ITB_SEO_REQUEST_URI', $_SERVER['REQUEST_URI']);

        $context        = \Bitrix\Main\Application::getInstance()->getContext();
        $request        = $context->getRequest();
        $server         = $context->getServer();
        $request_uri    = $request->getRequestUri();

        $data = service(LinkService::class)->getLink($request_uri ?? '');
        if($data !== null) {
            if($data['REDIRECT']) {
                $request_uri = $data['NEW'];
                if($data['QUERY']) {
                    $request_uri .= "?" . $data['QUERY'];
                }
                LocalRedirect($request_uri, false, '301 Moved Permanently');
            } else {
                $request_uri = $data['OLD'];
                if($data['QUERY']) {
                    $request_uri .= "?" . $data['QUERY'];
                }
                $request_new_uri = $data['NEW'];
                if($data['QUERY']) {
                    $request_new_uri .= "?" . $data['QUERY'];
                }

                $serverArray                = $server->toArray();
                $_SERVER['REQUEST_URI']     = $request_uri;
                $serverArray['REQUEST_URI'] = $request_uri;
                $server->set($serverArray);

                $context->initialize(new \Bitrix\Main\HttpRequest($server, $_GET, [], [], $_COOKIE), $context->getResponse(), $server);
                $APPLICATION->sDocPath2 = GetPagePath(false, true);
                $APPLICATION->sDirPath = GetDirPath($APPLICATION->sDocPath2);;

                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$data[NEW]";
                define('ITB_SEO_LINK_NEW', $actual_link);
                define('ITB_SEO_REQUEST_URI', $request_new_uri);
            }
        } else {
            define('ITB_SEO_REQUEST_URI', $request_uri);
        }
    }
}