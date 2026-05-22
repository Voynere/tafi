<?php
namespace Itb\Seo\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\StringField;
use Beeralex\Core\Traits\TableManagerTrait;

class TagGroupTable extends DataManager
{
    use TableManagerTrait;

    public static function getTableName()
    {
        return 'itb_seo_tag_group';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('TITLE', ['size' => 500]),
            (new OneToMany('TAG_TO_GROUP', TagToGroupTable::class, 'GROUP'))->configureJoinType('inner'),
        ];
    }
}
