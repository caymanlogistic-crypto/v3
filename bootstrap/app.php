<?php

declare(strict_types=1);

define(
    'APP_ROOT',
    dirname(__DIR__)
);

$envPath = APP_ROOT . '/.env';

if (file_exists($envPath)) {

    $lines = file($envPath);

    foreach ($lines as $line) {

        $line = trim($line);

        if (
            $line === ''
            || str_starts_with($line, '#')
        ) {
            continue;
        }

        [$key, $value] = explode(
            '=',
            $line,
            2
        );

        $_ENV[trim($key)] = trim($value);
    }
}

require_once APP_ROOT . '/vendor/autoload.php';

require_once APP_ROOT . '/app/Core/Support/helpers.php';

require_once __DIR__ . '/session.php';
