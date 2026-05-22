<?

use Itb\Seo\Options;
use Itb\Seo\Service\LinkService;
use Itb\Seo\Service\MetaService;
use Itb\Seo\Service\MorphyService;
use Itb\Seo\Service\TagService;

return [
    'services' => [
        'value' => [
            Options::class => [
                'className' => Options::class
            ],
            LinkService::class => [
                'className' => LinkService::class
            ],
            MetaService::class => [
                'className' => MetaService::class
            ],
            MorphyService::class => [
                'className' => MorphyService::class
            ],
            TagService::class => [
                'className' => TagService::class
            ],
        ],
    ]
];