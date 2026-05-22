<?php
namespace Itb\Seo\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Beeralex\Core\Traits\TableManagerTrait;

class TagToGroupTable extends DataManager
{
    use TableManagerTrait;
    
    public static function getTableName()
    {
        return 'itb_seo_tag_to_group';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new IntegerField('GROUP_ID'),
            new IntegerField('TAG_ID'),

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

