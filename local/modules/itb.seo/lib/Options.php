<?php

namespace Itb\Seo;

use Beeralex\Core\Config\AbstractOptions;

class Options extends AbstractOptions
{
    public readonly string $catalogFile;
    public readonly string $filterName;
    public readonly string $filterCategory;
    public readonly string $iblockId;
    public readonly string $filterHead;
    public readonly string $filterTitle;
    public readonly string $filterDescription;

    protected function mapOptions(array $options): void
    {
        $this->catalogFile = $options['CATALOG_FILE'] ?? '';
        $this->filterName = $options['FILTER_NAME'] ?? '';
        $this->filterCategory = $options['FILTER_CATEGORY'] ?? '';
        $this->iblockId = $options['IBLOCK_ID'] ?? '';
        $this->filterHead = $options['FILTER_HEAD'] ?? '';
        $this->filterTitle = $options['FILTER_TITLE'] ?? '';
        $this->filterDescription = $options['FILTER_DESCRIPTION'] ?? '';
    }

    public function getModuleId(): string
    {
        return 'itb.seo';
    }
    public function getFileName(): string
    {
        return 'export_links.xlsx';
    }
}
