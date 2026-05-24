<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1>Связки / Экипажи</h1>
        <div class="page-header-actions">
            <a href="<?= config('app.url') ?>/crews/create" class="btn btn-primary">Новая связка</a>
        </div>
    </div>

    <div class="table-card">
        <form method="GET" action="<?= config('app.url') ?>/crews" class="table-toolbar">
            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Поиск по подрядчику, водителю, машине"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn btn-toolbar">Найти</button>
            <?php if (!empty($search)): ?>
                <a href="<?= config('app.url') ?>/crews" class="btn btn-toolbar">Сброс</a>
            <?php endif; ?>
        </form>

        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Подрядчик</th>
                        <th>Водитель</th>
                        <th>Машина</th>
                        <th>Статус</th>
                        <th>Предупреждения</th>
                        <th>Комментарий</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($crews)): ?>
                        <tr>
                            <td colspan="8" class="table-empty">Связки по запросу не найдены.</td>
                        </tr>
                    <?php endif; ?>

                    <?php
                        $statusLabels = [
                            'active' => 'Активна',
                            'inactive' => 'Неактивна',
                            'archived' => 'Архив',
                        ];
                    ?>

                    <?php foreach ($crews as $crew): ?>
                        <?php
                            $warnings = [];
                            if ((int) ($crew['duplicate_driver_active'] ?? 0) > 0) {
                                $warnings[] = 'Водитель уже используется в другой активной связке.';
                            }
                            if ((int) ($crew['duplicate_vehicle_active'] ?? 0) > 0) {
                                $warnings[] = 'Машина уже используется в другой активной связке.';
                            }

                            $status = (string) ($crew['status'] ?? '');
                            $badge = match ($status) {
                                'active' => 'badge badge-ok',
                                'inactive' => 'badge badge-warning',
                                'archived' => 'badge badge-neutral',
                                default => 'badge badge-neutral',
                            };
                            $label = $statusLabels[$status] ?? ($status ?: '—');
                        ?>
                        <tr>
                            <td class="table-num"><?= (int) ($crew['id'] ?? 0) ?></td>
                            <td>
                                <?= e((string) ($crew['contractor_name'] ?? '')) ?>
                                <?php if (!empty($crew['contractor_inn'])): ?>
                                    <div class="crew-sub">ИНН: <?= e((string) $crew['contractor_inn']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= e((string) ($crew['driver_name'] ?? '')) ?>
                                <?php if (!empty($crew['driver_phone'])): ?>
                                    <div class="crew-sub"><?= e((string) $crew['driver_phone']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= e((string) ($crew['vehicle_plate'] ?? '')) ?>
                                <?php if (!empty($crew['vehicle_brand'])): ?>
                                    <div class="crew-sub"><?= e((string) $crew['vehicle_brand']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><span class="<?= $badge ?>"><?= e($label) ?></span></td>
                            <td>
                                <?php if (empty($warnings)): ?>
                                    —
                                <?php else: ?>
                                    <?php foreach ($warnings as $warning): ?>
                                        <div class="crew-warning"><?= e($warning) ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td><?= e((string) ($crew['comment'] ?? '')) ?></td>
                            <td class="row-actions">
                                <a href="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/edit" class="row-btn">Редактировать</a>
                                <form method="POST" action="<?= config('app.url') ?>/crews/<?= (int) $crew['id'] ?>/delete" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="row-btn is-danger" onclick="return confirm('Удалить связку?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($pagination) && $pagination['pages'] > 1): ?>
            <div class="pagination">
                <div class="pagination-info">
                    Страница <?= (int) ($pagination['page'] ?? 1) ?> из <?= (int) ($pagination['pages'] ?? 1) ?>
                </div>
                <div class="pagination-pages">
                    <?php if (($pagination['has_prev'] ?? false)): ?>
                        <a href="?page=<?= (int) $pagination['prev_page'] ?>&search=<?= urlencode($search ?? '') ?>">←</a>
                    <?php else: ?>
                        <span>←</span>
                    <?php endif; ?>

                    <span class="is-current"><?= (int) ($pagination['page'] ?? 1) ?></span>

                    <?php if (($pagination['has_next'] ?? false)): ?>
                        <a href="?page=<?= (int) $pagination['next_page'] ?>&search=<?= urlencode($search ?? '') ?>">→</a>
                    <?php else: ?>
                        <span>→</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif (!empty($crews)): ?>
            <div class="pagination">
                <div class="pagination-info">Всего: <?= count($crews) ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>