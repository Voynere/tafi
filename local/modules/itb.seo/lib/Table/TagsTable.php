<?php
namespace Itb\Seo\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Beeralex\Core\Traits\TableManagerTrait;

class TagsTable extends DataManager
{
    use TableManagerTrait;

    public static function getTableName()
    {
        return 'itb_seo_tags';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new IntegerField('TAG_ID'),
            new IntegerField('GROUP_ID'),
            new StringField('TITLE', ['size' => 500]),
            new StringField('URL', ['size' => 500]),

            // связи
            new Reference(
                'TAG',
                TagTable::class,
                ['=this.TAG_ID' => 'ref.ID']
            ),
            new Reference(
                'GROUP',
                TagGroupTable::class,
                ['=this.GROUP_ID' => 'ref.ID']
            ),
        ];
    }
}

