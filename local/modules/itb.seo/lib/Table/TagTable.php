<?php

namespace Itb\Seo\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Beeralex\Core\Traits\TableManagerTrait;

class TagTable extends DataManager
{
    use TableManagerTrait;

    public static function getTableName()
    {
        return 'itb_seo_tag';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('TITLE', ['size' => 500, 'required' => true]),
            new StringField('URL', ['size' => 500, 'required' => true]),
            new StringField('ACTIVE', ['size' => 50, 'required' => true]),
        ];
    }
}
