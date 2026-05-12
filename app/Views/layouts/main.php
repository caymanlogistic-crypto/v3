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
    <link rel="stylesheet" href="<?= config('app.url') ?>/assets/css/app.css">

    <title>
        Transport ERP Platform v3
    </title>
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

        <a href="<?= config('app.url') ?>/">
            Home
        </a>

        <?php if (
            Auth::check()
            && Auth::can('contractors.view')
        ): ?>

            <a href="<?= config('app.url') ?>/contractors">
                Contractors
            </a>

            <a href="<?= config('app.url') ?>/drivers">
                Drivers
            </a>

            <a href="<?= config('app.url') ?>/vehicles">
                Vehicles
            </a>

            <a href="<?= config('app.url') ?>/crews">
                <?= "\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0438}" ?>
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

<script src="<?= config('app.url') ?>/assets/js/form-ux.js?v=20260512_forms_fix"></script>

</body>
</html>



