<?php
declare(strict_types=1);
namespace Itb\Seo\Service;

use Bitrix\Main\ORM\Query\Query;
use Itb\Seo\Table\LinkTable;

class LinkService
{
    public function getLink(string $url): ?array
    {
        if(!$url) {
            return null;
        }
        
        $info = parse_url($url);
        $path = $info['path'] ?? '';
        $query = $info['query'] ?? '';
        $cleanQuery = http_build_query($this->filterQueryParams($query));
        $fullPath = $cleanQuery ? $path . '?' . $cleanQuery : $path;

        $pathsToCheck = [$fullPath, $path];

        $queryLink = LinkTable::query()
            ->setSelect(['ID', 'URL_OLD', 'URL_NEW'])
            ->where(
                Query::filter()
                    ->logic('or')
                    ->whereIn('URL_NEW', $pathsToCheck)
                    ->whereIn('URL_OLD', $pathsToCheck)
            )
            ->setLimit(1);

        $arItem = $queryLink->fetch();

        if ($arItem) {
            $redirect = $path == $arItem['URL_OLD'] || $fullPath == $arItem['URL_OLD'];

            $newInfo = parse_url($arItem['URL_NEW']);
            $newPath = $newInfo['path'] ?? '';
            $newQuery = $newInfo['query'] ?? '';

            parse_str($newQuery, $newQueryArray);
            $originalQueryArray = [];

            if (!$newQuery) {
                parse_str($cleanQuery, $cleanQueryArray);
                parse_str($query, $originalQueryArray);
                $originalQueryArray = $this->filterQueryParams($query, array_keys($cleanQueryArray));
            } else {
                parse_str($query, $originalQueryArray);
            }

            $finalQueryArray = array_merge($originalQueryArray, $newQueryArray);
            $finalQueryString = http_build_query($finalQueryArray);

            return [
                'REDIRECT'  => $redirect,
                'OLD'       => $arItem['URL_OLD'],
                'NEW'       => $newPath,
                'QUERY'     => $finalQueryString ?: false
            ];
        }

        return null;
    }

    protected function filterQueryParams(string $queryString, ?array $ignoreParams = null): array
    {
        if (!$queryString) return [];

        parse_str($queryString, $queryArray);

        $ignoreParams ??= [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'gclid',
            'yclid',
            'fbclid',
            'bxajaxid',
            'sessid',
            'bitrix_include_areas',
            'clear_cache',
            'show_include_exec_time',
            'show_sql_stat',
            'show_page_exec_time',
            'PAGEN_1'
        ];

        foreach ($ignoreParams as $param) {
            unset($queryArray[$param]);
        }

        return $queryArray;
    }
}
