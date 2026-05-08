<?php

declare(strict_types=1);

namespace App\Core\Logging;

final class Logger
{
    private const LOG_FILE = __DIR__ . '/../../../storage/logs/app.log';

    public static function info(string $message): void
    {
        self::write('INFO', $message);
    }

    public static function error(string $message): void
    {
        self::write('ERROR', $message);
    }

    private static function write(string $level, string $message): void
    {
        $date = date('Y-m-d H:i:s');

        $line = "[{$date}] {$level}: {$message}" . PHP_EOL;

        file_put_contents(
            self::LOG_FILE,
            $line,
            FILE_APPEND
        );
    }
}
