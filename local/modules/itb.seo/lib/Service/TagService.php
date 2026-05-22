<?php
declare(strict_types=1);
namespace Itb\Seo\Service;

use Itb\Seo\Table\TagTable;
use Itb\Seo\Table\TagsTable;

class TagService
{
    public function getTags($url)
    {
        $info = parse_url($url);

        if (isset($info['path'])) {
            $path = $info['path'];

            $tag = TagTable::getRow([
                'filter' => [
                    '=URL'    => $path,
                    '=ACTIVE' => 'Y',
                ],
                'select' => ['ID'],
            ]);

            if ($tag) {
                $tagID = $tag['ID'];

                $rows = TagsTable::query()
                    ->setSelect([
                        '*',
                        'GROUP_TITLE' => 'GROUP.TITLE',
                    ])
                    ->where('TAG_ID', $tagID)
                    ->fetchAll();

                $arGroups = [];
                foreach ($rows as $arTag) {
                    $groupTitle = $arTag['GROUP_TITLE'];
                    if (!isset($arGroups[$groupTitle])) {
                        $arGroups[$groupTitle]['TITLE'] = $groupTitle;
                        $arGroups[$groupTitle]['ITEMS'] = [];
                    }
                    $arGroups[$groupTitle]['ITEMS'][] = $arTag;
                }

                return $arGroups;
            }
        }

        return false;
    }
}
