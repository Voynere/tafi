<?
declare(strict_types=1);

namespace Itb\Seo;

function log(string $message, int $traceDepth = 6, bool $showArgs = false): void
{
    \AddMessage2Log($message, service(Options::class)->getModuleId(), $traceDepth, $showArgs);
}

if (!function_exists('isCli')) {
    /**
     * Проверяет, что скрипт запущен из-под cron
     *
     * @return bool
     */
    function isCli(): bool
    {
       return true;
    }
}

