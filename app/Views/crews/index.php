<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1><?= "\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0438} / \u{042D}\u{043A}\u{0438}\u{043F}\u{0430}\u{0436}\u{0438}" ?></h1>

        <form method="GET" action="<?= config('app.url') ?>/crews" style="margin-top:20px;">
            <input type="text" name="search" value="<?= e($search ?? '') ?>" placeholder="<?= "\u{041F}\u{043E}\u{0438}\u{0441}\u{043A} \u{043F}\u{043E} \u{043F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A}\u{0443}, \u{0432}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044E}, \u{043C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0435}" ?>">
            <button type="submit"><?= "\u{041D}\u{0430}\u{0439}\u{0442}\u{0438}" ?></button>
            <a href="<?= config('app.url') ?>/crews/create"><?= "\u{041D}\u{043E}\u{0432}\u{0430}\u{044F} \u{0441}\u{0432}\u{044F}\u{0437}\u{043A}\u{0430}" ?></a>
        </form>
    </div>

    <table border="1" width="100%" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th><?= "\u{041F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A}" ?></th>
                <th><?= "\u{0412}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044C}" ?></th>
                <th><?= "\u{041C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0430}" ?></th>
                <th><?= "\u{0421}\u{0442}\u{0430}\u{0442}\u{0443}\u{0441}" ?></th>
                <th><?= "\u{041F}\u{0440}\u{0435}\u{0434}\u{0443}\u{043F}\u{0440}\u{0435}\u{0436}\u{0434}\u{0435}\u{043D}\u{0438}\u{044F}" ?></th>
                <th><?= "\u{041A}\u{043E}\u{043C}\u{043C}\u{0435}\u{043D}\u{0442}\u{0430}\u{0440}\u{0438}\u{0439}" ?></th>
                <th><?= "\u{0414}\u{0435}\u{0439}\u{0441}\u{0442}\u{0432}\u{0438}\u{044F}" ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($crews)): ?>
            <tr>
                <td colspan="8"><?= "\u{0421}\u{0432}\u{044F}\u{0437}\u{043A}\u{0438} \u{043F}\u{043E} \u{0437}\u{0430}\u{043F}\u{0440}\u{043E}\u{0441}\u{0443} \u{043D}\u{0435} \u{043D}\u{0430}\u{0439}\u{0434}\u{0435}\u{043D}\u{044B}." ?></td>
            </tr>
        <?php endif; ?>

        <?php
            $statusLabels = [
                'active' => "\u{0410}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{0430}",
                'inactive' => "\u{041D}\u{0435}\u{0430}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{0430}",
                'archived' => "\u{0410}\u{0440}\u{0445}\u{0438}\u{0432}",
            ];
        ?>

        <?php foreach ($crews as $crew): ?>
            <?php
                $warnings = [];
                if ((int) ($crew['duplicate_driver_active'] ?? 0) > 0) {
                    $warnings[] = "\u{0412}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044C} \u{0443}\u{0436}\u{0435} \u{0438}\u{0441}\u{043F}\u{043E}\u{043B}\u{044C}\u{0437}\u{0443}\u{0435}\u{0442}\u{0441}\u{044F} \u{0432} \u{0434}\u{0440}\u{0443}\u{0433}\u{043E}\u{0439} \u{0430}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{043E}\u{0439} \u{0441}\u{0432}\u{044F}\u{0437}\u{043A}\u{0435}.";
                }
                if ((int) ($crew['duplicate_vehicle_active'] ?? 0) > 0) {
                    $warnings[] = "\u{041C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0430} \u{0443}\u{0436}\u{0435} \u{0438}\u{0441}\u{043F}\u{043E}\u{043B}\u{044C}\u{0437}\u{0443}\u{0435}\u{0442}\u{0441}\u{044F} \u{0432} \u{0434}\u{0440}\u{0443}\u{0433}\u{043E}\u{0439} \u{0430}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{043E}\u{0439} \u{0441}\u{0432}\u{044F}\u{0437}\u{043A}\u{0435}.";
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
                <td><?= e($statusLabels[(string) ($crew['status'] ?? '')] ?? (string) ($crew['status'] ?? '')) ?></td>
                <td>
                    <?php if (empty($warnings)): ?>
                        -
                    <?php else: ?>
                        <?php foreach ($warnings as $warning): ?>
                            <div><?= e($warning) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
                <td><?= e((string) ($crew['comment'] ?? '')) ?></td>
                <td>
                    <a href="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/edit"><?= "\u{0420}\u{0435}\u{0434}\u{0430}\u{043A}\u{0442}\u{0438}\u{0440}\u{043E}\u{0432}\u{0430}\u{0442}\u{044C}" ?></a>
                    <form method="POST" action="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/delete" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" onclick="return confirm('<?= "\u{0423}\u{0434}\u{0430}\u{043B}\u{0438}\u{0442}\u{044C} \u{0441}\u{0432}\u{044F}\u{0437}\u{043A}\u{0443}?" ?>')"><?= "\u{0423}\u{0434}\u{0430}\u{043B}\u{0438}\u{0442}\u{044C}" ?></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <?php if (($pagination['has_prev'] ?? false)): ?>
            <a href="?page=<?= (int) $pagination['prev_page'] ?>&search=<?= urlencode($search ?? '') ?>">&larr; <?= "\u{041D}\u{0430}\u{0437}\u{0430}\u{0434}" ?></a>
        <?php endif; ?>

        <?= "\u{0421}\u{0442}\u{0440}\u{0430}\u{043D}\u{0438}\u{0446}\u{0430}" ?> <?= (int) ($pagination['page'] ?? 1) ?> <?= "\u{0438}\u{0437}" ?> <?= (int) ($pagination['pages'] ?? 1) ?>

        <?php if (($pagination['has_next'] ?? false)): ?>
            <a href="?page=<?= (int) $pagination['next_page'] ?>&search=<?= urlencode($search ?? '') ?>"><?= "\u{0412}\u{043F}\u{0435}\u{0440}\u{0435}\u{0434}" ?> &rarr;</a>
        <?php endif; ?>
    </div>
</div>
