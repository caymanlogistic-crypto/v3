<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1>Водители</h1>
        <div class="page-header-actions">
            <a href="<?= config('app.url') ?>/drivers/create" class="btn btn-primary">Добавить водителя</a>
        </div>
    </div>

    <div class="table-card">
        <form method="GET" action="<?= config('app.url') ?>/drivers" class="table-toolbar">
            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Поиск по имени, телефону, номеру прав"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn btn-toolbar">Найти</button>
            <?php if (!empty($search)): ?>
                <a href="<?= config('app.url') ?>/drivers" class="btn btn-toolbar">Сброс</a>
            <?php endif; ?>
        </form>

        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Номер прав</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($drivers)): ?>
                        <tr>
                            <td colspan="6" class="table-empty">Водители не найдены.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($drivers as $driver): ?>
                        <?php
                            $status = (string) ($driver['status'] ?? '');
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
                            <td><?= e($driver['full_name'] ?? '') ?></td>
                            <td><?= e($driver['license_number'] ?? '') ?></td>
                            <td><?= e($driver['phone'] ?? '') ?></td>
                            <td><?= e($driver['email'] ?? '') ?></td>
                            <td><span class="<?= $badge ?>"><?= e($label) ?></span></td>
                            <td class="row-actions">
                                <a href="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/edit" class="row-btn">Изменить</a>
                                <form method="POST" action="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/delete" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="row-btn is-danger" onclick="return confirm('Удалить водителя?')">Удалить</button>
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
        <?php elseif (!empty($drivers)): ?>
            <div class="pagination">
                <div class="pagination-info">Всего: <?= count($drivers) ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>