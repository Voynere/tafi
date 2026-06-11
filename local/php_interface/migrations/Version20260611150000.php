<?php

namespace Sprint\Migration;

class Version20260611150000 extends Version
{
    protected $author = 'tafiadmin';

    protected $description = 'Травматология: иконка lupa.svg для 5-го преимущества';

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
        $filePath = __DIR__ . '/Version20260611150000_files/lupa.svg';

        if (!is_readable($filePath)) {
            throw new Exceptions\MigrationException('Файл lupa.svg не найден: ' . $filePath);
        }

        \CIBlockElement::SetPropertyValuesEx(
            self::ELEMENT_ID,
            $iblockId,
            ['PROP_ADV_BLOCK_ITEM5_ICON' => \CFile::MakeFileArray($filePath)]
        );
    }
}
