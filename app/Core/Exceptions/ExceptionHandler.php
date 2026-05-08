<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Throwable;
use App\Core\Logging\Logger;

final class ExceptionHandler
{
    public static function register(): void
    {
        set_exception_handler(
            static function (Throwable $e): void {

                Logger::error($e->getMessage());

                echo '<pre>';

                echo 'ERROR: ' . $e->getMessage() . PHP_EOL . PHP_EOL;

                echo $e->getFile() . ':' . $e->getLine() . PHP_EOL . PHP_EOL;

                echo $e->getTraceAsString();

                echo '</pre>';

                exit;
            }
        );
    }
}
