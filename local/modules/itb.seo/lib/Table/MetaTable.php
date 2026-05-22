<?php
namespace Itb\Seo\Table;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Beeralex\Core\Traits\TableManagerTrait;

class MetaTable extends DataManager
{
    use TableManagerTrait;
    
    public static function getTableName()
    {
        return 'itb_seo_meta';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('SUBDOMAIN', [
                'size' => 255,
                'default_value' => null,
            ]),
            new StringField('URL', [
                'size' => 500,
                'default_value' => null,
            ]),
            new StringField('TITLE', ['size' => 500]),
            new StringField('DESCRIPTION', ['size' => 500]),
            new StringField('KEYWORDS', ['size' => 500]),
            new StringField('H1', ['size' => 500]),
            new TextField('TEXT'),
        ];
    }
}
