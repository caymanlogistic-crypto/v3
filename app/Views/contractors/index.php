<?php declare(strict_types=1); ?>

<div class="page">
    <div class="page-header">
        <h1>Контрагенты</h1>
        <div class="page-header-actions">
            <a href="<?= config('app.url') ?>/contractors/create" class="btn btn-primary">Добавить контрагента</a>
        </div>
    </div>

    <div class="table-card">
        <form method="GET" action="<?= config('app.url') ?>/contractors" class="table-toolbar">
            <input
                type="text"
                name="search"
                class="search-input"
                placeholder="Поиск по названию, ИНН, телефону"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn btn-toolbar">Найти</button>
            <?php if (!empty($search)): ?>
                <a href="<?= config('app.url') ?>/contractors" class="btn btn-toolbar">Сброс</a>
            <?php endif; ?>
        </form>

        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>ИНН</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($contractors)): ?>
                        <tr>
                            <td colspan="7" class="table-empty">Контрагенты не найдены.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($contractors as $contractor): ?>
                        <?php
                            $status = (string) ($contractor['status'] ?? '');
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
                            <td class="table-num"><?= (int) $contractor['id'] ?></td>
                            <td><?= e($contractor['name']) ?></td>
                            <td><?= e($contractor['inn']) ?></td>
                            <td><?= e($contractor['contact1_phone']) ?></td>
                            <td><?= e($contractor['contact1_email']) ?></td>
                            <td><span class="<?= $badge ?>"><?= e($label) ?></span></td>
                            <td class="row-actions">
                                <a href="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/edit" class="row-btn">Изменить</a>
                                <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/delete" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="row-btn is-danger" onclick="return confirm('Удалить контрагента?')">Удалить</button>
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
        <?php elseif (!empty($contractors)): ?>
            <div class="pagination">
                <div class="pagination-info">Всего: <?= count($contractors) ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>