<?php

namespace Sprint\Migration;

class Version20260611160000 extends Version
{
    protected $author = 'tafiadmin';

    protected $description = 'Травматология: убрать 5-е преимущество «Фокус на долгосрочный результат»';

    protected $moduleVersion = '5.5.2';

    private const ELEMENT_ID = 6647;

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('directions', 'aspro_max_content');

        \CIBlockElement::SetPropertyValuesEx(
            self::ELEMENT_ID,
            $iblockId,
            [
                'PROP_ADV_BLOCK_ITEM5_TITLE' => '',
                'PROP_ADV_BLOCK_ITEM5_DESCR' => '',
                'PROP_ADV_BLOCK_ITEM5_ICON' => ['del' => 'Y', 'VALUE' => false],
            ]
        );
    }
}
