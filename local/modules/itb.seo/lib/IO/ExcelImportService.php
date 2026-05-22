<?php
namespace Itb\Seo\IO;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Itb\Seo\Table\LinkTable;
class ExcelImportService{
    private string $filename;
    private array $linksFile;
    public function __construct()
    {
        $this->filename = 'export_link.xlsx';
        $this->linksFile = $this->readExcel();
    }

    /**
     * Метод для чтения excel файла
     * @return ?array
     */

    public function readExcel() : ?array
    {
        $reader = new Xlsx();
        $spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/upload/itb.seo/export_link.xlsx");
        $sheet = $spreadsheet->getActiveSheet();

        $columns = $sheet->toArray();

        /*Удалить названия колонок*/
        array_shift($columns);




        return $columns;
    }

    /**
     * Добавление ссылка в БД
     * @return array
     * @throws \Exception
     */
    public function addLink()
    {
        $linksFromFile = $this->linksFile;
        $result = [];
        if(!empty($linksFromFile)){
            foreach ($linksFromFile as $link){
                if($this->linkExist($link[0])) continue;
                $arFields = [
                    'URL_OLD' => $link[0],
                    'URL_NEW' => $link[1],
                ];

                $result[] = [
                    'URL_OLD' => $link[0],
                    'URL_NEW' => $link[1],
                ];

                LinkTable::add($arFields);
            }

            return $result;
        }
    }

    /**
     * Метод для проверки существования ссылки в БД
     */
    public function linkExist(string $link) : bool{
        $arResult = [];
        $linksFromDB = LinkTable::getList(['select' => ['URL_OLD']]);
        while ($linksDB = $linksFromDB->fetch()) {
            $arResult[] = $linksDB['URL_OLD'];
        }



        return in_array($link,$arResult);
    }

    public function import()
    {

    }

}