<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1>&#1057;&#1074;&#1103;&#1079;&#1082;&#1080; / &#1069;&#1082;&#1080;&#1087;&#1072;&#1078;&#1080;</h1>

        <form method="GET" action="<?= config('app.url') ?>/crews" style="margin-top:20px;">
            <input type="text" name="search" value="<?= e($search ?? '') ?>" placeholder="����� �� ����������, ��������, ������">
            <button type="submit">Search</button>
            <a href="<?= config('app.url') ?>/crews/create">&#1057;&#1086;&#1079;&#1076;&#1072;&#1090;&#1100; &#1089;&#1074;&#1103;&#1079;&#1082;&#1091;</a>
        </form>
    </div>

    <table border="1" width="100%" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>&#1055;&#1086;&#1076;&#1088;&#1103;&#1076;&#1095;&#1080;&#1082;</th>
                <th>&#1042;&#1086;&#1076;&#1080;&#1090;&#1077;&#1083;&#1100;</th>
                <th>&#1052;&#1072;&#1096;&#1080;&#1085;&#1072;</th>
                <th>&#1057;&#1090;&#1072;&#1090;&#1091;&#1089;</th>
                <th>&#1055;&#1088;&#1077;&#1076;&#1091;&#1087;&#1088;&#1077;&#1078;&#1076;&#1077;&#1085;&#1080;&#1103;</th>
                <th>&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1081;</th>
                <th>&#1044;&#1077;&#1081;&#1089;&#1090;&#1074;&#1080;&#1103;</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($crews)): ?>
            <tr>
                <td colspan="8">&#1057;&#1087;&#1080;&#1089;&#1086;&#1082; &#1089;&#1074;&#1103;&#1079;&#1086;&#1082; &#1087;&#1086;&#1082;&#1072; &#1087;&#1091;&#1089;&#1090;.</td>
            </tr>
        <?php endif; ?>

        <?php
            $statusLabels = [
                'active' => '&#1040;&#1082;&#1090;&#1080;&#1074;&#1085;&#1072;',
                'inactive' => '&#1053;&#1077;&#1072;&#1082;&#1090;&#1080;&#1074;&#1085;&#1072;',
                'archived' => '&#1040;&#1088;&#1093;&#1080;&#1074;',
            ];
        ?>

        <?php foreach ($crews as $crew): ?>
            <?php
                $warnings = [];
                if ((int) ($crew['duplicate_driver_active'] ?? 0) > 0) {
                    $warnings[] = '&#1042;&#1086;&#1076;&#1080;&#1090;&#1077;&#1083;&#1100; &#1091;&#1078;&#1077; &#1080;&#1089;&#1087;&#1086;&#1083;&#1100;&#1079;&#1091;&#1077;&#1090;&#1089;&#1103; &#1074; &#1076;&#1088;&#1091;&#1075;&#1086;&#1081; &#1072;&#1082;&#1090;&#1080;&#1074;&#1085;&#1086;&#1081; &#1089;&#1074;&#1103;&#1079;&#1082;&#1077;.';
                }
                if ((int) ($crew['duplicate_vehicle_active'] ?? 0) > 0) {
                    $warnings[] = '&#1052;&#1072;&#1096;&#1080;&#1085;&#1072; &#1091;&#1078;&#1077; &#1080;&#1089;&#1087;&#1086;&#1083;&#1100;&#1079;&#1091;&#1077;&#1090;&#1089;&#1103; &#1074; &#1076;&#1088;&#1091;&#1075;&#1086;&#1081; &#1072;&#1082;&#1090;&#1080;&#1074;&#1085;&#1086;&#1081; &#1089;&#1074;&#1103;&#1079;&#1082;&#1077;.';
                }
            ?>
            <tr>
                <td><?= (int) ($crew['id'] ?? 0) ?></td>
                <td>
                    <?= e((string) ($crew['contractor_name'] ?? '')) ?>
                    <?php if (!empty($crew['contractor_inn'])): ?>
                        <br><small>INN: <?= e((string) $crew['contractor_inn']) ?></small>
                    <?php endif; ?>
                </td>
                <td>
                    <?= e((string) ($crew['driver_name'] ?? '')) ?>
                    <?php if (!empty($crew['driver_phone'])): ?>
                        <br><small><?= e((string) $crew['driver_phone']) ?></small>
                    <?php endif; ?>
                </td>
                <td>
                    <?= e((string) ($crew['vehicle_plate'] ?? '')) ?>
                    <?php if (!empty($crew['vehicle_brand'])): ?>
                        <br><small><?= e((string) $crew['vehicle_brand']) ?></small>
                    <?php endif; ?>
                </td>
                <td><?= $statusLabels[(string) ($crew['status'] ?? '')] ?? e((string) ($crew['status'] ?? '')) ?></td>
                <td>
                    <?php if (empty($warnings)): ?>
                        -
                    <?php else: ?>
                        <?php foreach ($warnings as $warning): ?>
                            <div><?= $warning ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
                <td><?= e((string) ($crew['comment'] ?? '')) ?></td>
                <td>
                    <a href="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/edit">Edit</a>
                    <form method="POST" action="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/delete" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" onclick="return confirm('Delete crew link?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <?php if (($pagination['has_prev'] ?? false)): ?>
            <a href="?page=<?= (int) $pagination['prev_page'] ?>&search=<?= urlencode($search ?? '') ?>">&larr; Prev</a>
        <?php endif; ?>

        Page <?= (int) ($pagination['page'] ?? 1) ?> of <?= (int) ($pagination['pages'] ?? 1) ?>

        <?php if (($pagination['has_next'] ?? false)): ?>
            <a href="?page=<?= (int) $pagination['next_page'] ?>&search=<?= urlencode($search ?? '') ?>">Next &rarr;</a>
        <?php endif; ?>
    </div>
</div>
