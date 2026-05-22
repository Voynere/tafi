<?php

namespace Sprint\Migration;

class Version20251006084411 extends Version
{
    protected $author = "admin";

    protected $description   = "элементы инфоблока виды рентгенографии";

    protected $moduleVersion = "5.0.0";

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function up()
    {
        $this->getExchangeManager()
             ->IblockElementsImport()
             ->setLimit(20)
             ->execute(function ($item) {
                 $this->getHelperManager()
                      ->Iblock()
                      ->saveElementByXmlId(
                          $item['iblock_id'],
                          $item['fields'],
                          $item['properties']
                      );
             });
    }

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function down()
    {
        $this->getExchangeManager()
             ->IblockElementsImport()
             ->setLimit(10)
             ->execute(function ($item) {
                 $this->getHelperManager()
                     ->Iblock()
                     ->deleteElementByXmlId(
                         $item['iblock_id'],
                         $item['fields']['XML_ID']
                     );
             });
    }
}
