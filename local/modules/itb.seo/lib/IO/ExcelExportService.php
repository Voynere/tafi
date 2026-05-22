<?
namespace Itb\Seo\IO;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelExportService
{

    private array $links;
    private string $filename;
    private const FILE_PATH = '/upload/itb.seo';

    /*
     * Нужно передать массив ссылок вида ['старая ссылка:новая ссылка']
     */
    public function __construct(array $links)
    {
        $this->links = $links;
        $this->filename = 'export_link.xlsx';
    }

    /**
     * Установка имени файла
     * @param string $filename
     * @return self
     */

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Получение имени файла
     * @return string
     */

    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Проверка и создание директории для хранения файлов экспорта
     * @return void
     */
    public function dirExist(): void
    {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . self::FILE_PATH;
        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
    }

    /**
     * Получение полного пути к файлу экспорта
     * @return string
     */
    public function getFullPath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . self::FILE_PATH . '/' . $this->filename;
    }

    /**
     * Метод для форматирования вида ссылок 
     * из вида старая ссылка:новая ссылка
     * в массив [['старая ссылка', 'новая ссылка'], ...]
     * @return string[]
     */
    private function parseLinks(): array
    {
        $arLinks = [];
        foreach ($this->links as $link) {
            $linkParts = explode(':', $link);
            if (count($linkParts) >= 2) {
                $linkOld = $linkParts[0];
                $linkNew = $linkParts[1];
                $arLinks[] = [$linkOld, $linkNew];
            }
        }
        return $arLinks;
    }

    /**
     * Создание разметки Excel файла и заполнение данными
     * @param array $arLinks
     * @return Spreadsheet
     */
    private function createSpreadsheet(array $arLinks): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'OLD_URL');
        $sheet->setCellValue('B1', 'NEW_URL');

        $row = 2;
        foreach ($arLinks as $item) {
            $sheet->setCellValue('A' . $row, $item[0]);
            $sheet->setCellValue('B' . $row, $item[1]);
            $row++;
        }

        return $spreadsheet;
    }


    /**
     * Экспорт ссылок в Excel файл
     * @return string - путь к созданному файлу
     * @throws Exception
     */
    public function export(): string
    {
        $arLinks = $this->parseLinks();

        if (empty($arLinks)) {
            throw new Exception('Нет данных для экспорта');
        }

        //Проверить есть ли дериктория /upload/itb.seo
        $this->dirExist();

        $spreadsheet = $this->createSpreadsheet($arLinks);

        $writer = new Xlsx($spreadsheet);
        $fullPath = $this->getFullPath();
        $writer->save($fullPath);

        return $fullPath;
    }
}

