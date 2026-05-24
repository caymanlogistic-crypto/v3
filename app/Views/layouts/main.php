<?php

declare(strict_types=1);

use App\Core\Auth\Auth;
use App\Core\Session\Flash;

$successFlash = Flash::getSuccess();
$errorFlash = Flash::getError();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= config('app.url') ?>/assets/css/app.css">
    <title>TransportERP v3</title>
</head>
<body>

<div class="app-shell">

    <!-- Sidebar -->
    <aside class="app-sidebar">
        <div class="sidebar-brand">TransportERP v3</div>

        <?php if (Auth::check() && Auth::can('contractors.view')): ?>
            <div class="sidebar-nav-group">Справочники</div>
            <ul class="sidebar-nav">
                <li><a href="<?= config('app.url') ?>/contractors" class="<?= isActivePath('/contractors') ?>">Контрагенты</a></li>
                <li><a href="<?= config('app.url') ?>/drivers" class="<?= isActivePath('/drivers') ?>">Водители</a></li>
                <li><a href="<?= config('app.url') ?>/vehicles" class="<?= isActivePath('/vehicles') ?>">Транспорт</a></li>
                <li><a href="<?= config('app.url') ?>/crews" class="<?= isActivePath('/crews') ?>">Экипажи</a></li>
            </ul>
        <?php endif; ?>
    </aside>

    <!-- Main -->
    <div class="app-main">

        <!-- Topbar -->
        <div class="app-topbar">
            <div class="topbar-left">
                <?php if (Auth::check()): ?>
                    <span><?= htmlspecialchars(Auth::user()['email']) ?></span>
                <?php endif; ?>
            </div>
            <div class="topbar-user">
                <?php if (Auth::check()): ?>
                    <form method="POST" action="<?= config('app.url') ?>/logout" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-ghost">Выход</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Flash messages -->
        <?php if ($successFlash): ?>
            <div class="flash flash-success"><?= e($successFlash) ?></div>
        <?php endif; ?>
        <?php if ($errorFlash): ?>
            <div class="flash flash-error"><?= e($errorFlash) ?></div>
        <?php endif; ?>

        <!-- Content -->
        <?= $content ?>

    </div>

</div>

<script src="<?= config('app.url') ?>/assets/js/form-ux.js?v=20260512_forms_fix"></script>
</body>
</html>



