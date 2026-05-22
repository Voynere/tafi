<?php
namespace Itb\Seo\Table;

use Beeralex\Core\Traits\TableManagerTrait;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class LinkTable extends DataManager
{
    use TableManagerTrait;
    
    public static function getTableName()
    {
        return 'itb_seo_link';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('URL_OLD', ['size' => 500, 'required' => true]),
            new StringField('URL_NEW', ['size' => 500, 'required' => true]),
        ];
    }
}

