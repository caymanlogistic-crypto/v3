<?php

declare(strict_types=1);

use App\Core\Auth\Auth;
use App\Core\Session\Flash;

$successFlash = Flash::getSuccess();
$errorFlash = Flash::getError();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>
        Transport ERP Platform v3
    </title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        header {
            background: #1f2937;
            color: white;
            padding: 15px 20px;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        .container {
            padding: 20px;
        }

        .topbar {
            float: right;
        }

        .topbar a {
            color: #fff;
            margin-left: 15px;
            text-decoration: none;
        }

        .flash-success {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .flash-error {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

    </style>

</head>
<body>

<header>

    <div>

        <strong>
            Transport ERP Platform v3
        </strong>

        <div class="topbar">

            <?php if (Auth::check()): ?>

                <?= htmlspecialchars(
                    Auth::user()['email']
                ) ?>

                <form method="POST" action="<?= config('app.url') ?>/logout" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit">Logout</button>
                </form>

            <?php endif; ?>

        </div>

    </div>

    <nav>

        <a href="/v3/public/">
            Home
        </a>

        <?php if (
            Auth::check()
            && Auth::can('contractors.view')
        ): ?>

            <a href="/v3/public/contractors">
                Contractors
            </a>

            <a href="<?= config('app.url') ?>/drivers">
                Drivers
            </a>

            <a href="<?= config('app.url') ?>/vehicles">
                Vehicles
            </a>

        <?php endif; ?>

    </nav>

</header>

<div class="container">

    <?php if ($successFlash): ?>

        <div class="flash-success">
            <?= e($successFlash) ?>
        </div>

    <?php endif; ?>

    <?php if ($errorFlash): ?>

        <div class="flash-error">
            <?= e($errorFlash) ?>
        </div>

    <?php endif; ?>

    <?= $content ?>

</div>

</body>
</html>
