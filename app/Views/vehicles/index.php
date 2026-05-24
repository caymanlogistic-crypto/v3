<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1>Транспорт</h1>
        <div class="page-header-actions">
            <a href="<?= config('app.url') ?>/vehicles/create" class="btn btn-primary">Добавить транспорт</a>
        </div>
    </div>

    <div class="table-card">
        <form method="GET" action="<?= config('app.url') ?>/vehicles" class="table-toolbar">
            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Поиск по госномеру, марке, модели, VIN"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn btn-toolbar">Найти</button>
            <?php if (!empty($search)): ?>
                <a href="<?= config('app.url') ?>/vehicles" class="btn btn-toolbar">Сброс</a>
            <?php endif; ?>
        </form>

        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Госномер</th>
                        <th>Марка / Модель</th>
                        <th>Прицеп</th>
                        <th>Г/п, т</th>
                        <th>Объём, м³</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($vehicles)): ?>
                        <tr>
                            <td colspan="8" class="table-empty">Транспорт не найден.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($vehicles as $vehicle): ?>
                        <?php
                            $status = (string) ($vehicle['status'] ?? '');
                            $badge = match ($status) {
                                'active' => 'badge badge-ok',
                                'blocked' => 'badge badge-danger',
                                'archive' => 'badge badge-neutral',
                                default => 'badge badge-neutral',
                            };
                            $label = match ($status) {
                                'active' => 'Активен',
                                'blocked' => 'Заблокирован',
                                'archive' => 'Архив',
                                default => $status ?: '—',
                            };
                        ?>
                        <tr>
                            <td class="table-num"><?= (int) $vehicle['id'] ?></td>
                            <td><?= e($vehicle['truck_plate'] ?? '') ?></td>
                            <td>
                                <?php if (!empty($vehicle['truck_brand']) || !empty($vehicle['truck_model'])): ?>
                                    <?= e($vehicle['truck_brand'] ?? '') ?> <?= e($vehicle['truck_model'] ?? '') ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($vehicle['trailer_plate'])): ?>
                                    <?= e($vehicle['trailer_plate']) ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td class="table-num">
                                <?php if (!empty($vehicle['load_capacity'])): ?>
                                    <?= e($vehicle['load_capacity']) ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td class="table-num">
                                <?php if (!empty($vehicle['body_volume'])): ?>
                                    <?= e($vehicle['body_volume']) ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td><span class="<?= $badge ?>"><?= e($label) ?></span></td>
                            <td class="row-actions">
                                <a href="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/edit" class="row-btn">Изменить</a>
                                <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/delete" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="row-btn is-danger" onclick="return confirm('Удалить транспорт?')">Удалить</button>
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
        <?php elseif (!empty($vehicles)): ?>
            <div class="pagination">
                <div class="pagination-info">Всего: <?= count($vehicles) ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>