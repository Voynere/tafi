<?php

namespace Sprint\Migration;

class Version20260611120000 extends Version
{
    protected $author = "tafiadmin";

    protected $description = "Врачи: переименовать свойство PROP_ABILITY_CHILD в «Принимает взрослых и детей»";

    protected $moduleVersion = "5.5.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('doctors', 'aspro_max_content');

        $helper->Iblock()->saveProperty($iblockId, [
            'NAME' => 'Принимает взрослых и детей',
            'CODE' => 'PROP_ABILITY_CHILD',
        ]);
    }
}
