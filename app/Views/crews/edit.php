<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Редактирование связки #<?= (int) ($crew['id'] ?? 0) ?></h1>
    </div>

    <?php if (!empty($warnings)): ?>
        <div class="form-alert" style="display:block; margin-bottom: 12px;">
            <?php foreach ($warnings as $warning): ?>
                <div><?= e($warning) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= config('app.url') ?>/crews/<?= (int) ($crew['id'] ?? 0) ?>/update" class="entity-form">
        <?= csrf_field() ?>

        <div class="form-body">
            <div class="form-section">
                <div class="form-section-title">Участники связки</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-contractor_id">Подрядчик *</label>
                        <select id="field-contractor_id" name="contractor_id" class="field-select">
                            <option value="">-- Выберите --</option>
                            <?php foreach ($contractors as $contractor): ?>
                                <?php $value = (int) ($contractor['id'] ?? 0); ?>
                                <option value="<?= $value ?>" <?= (int) ($crew['contractor_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                    <?= e((string) ($contractor['name'] ?? '')) ?>
                                    <?php if (!empty($contractor['inn'])): ?>
                                        (INN: <?= e((string) $contractor['inn']) ?>)
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="error-contractor_id" class="field-msg is-error"><?= e((string) ($errors['contractor_id'] ?? '')) ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-driver_id">Водитель *</label>
                        <select id="field-driver_id" name="driver_id" class="field-select">
                            <option value="">-- Выберите --</option>
                            <?php foreach ($drivers as $driver): ?>
                                <?php $value = (int) ($driver['id'] ?? 0); ?>
                                <option value="<?= $value ?>" <?= (int) ($crew['driver_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                    <?= e((string) ($driver['full_name'] ?? '')) ?>
                                    <?php if (!empty($driver['phone'])): ?>
                                        (<?= e((string) $driver['phone']) ?>)
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="error-driver_id" class="field-msg is-error"><?= e((string) ($errors['driver_id'] ?? '')) ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-vehicle_id">Машина *</label>
                        <select id="field-vehicle_id" name="vehicle_id" class="field-select">
                            <option value="">-- Выберите --</option>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <?php $value = (int) ($vehicle['id'] ?? 0); ?>
                                <option value="<?= $value ?>" <?= (int) ($crew['vehicle_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                    <?= e((string) ($vehicle['truck_plate'] ?? '')) ?>
                                    <?php if (!empty($vehicle['truck_brand'])): ?>
                                        (<?= e((string) $vehicle['truck_brand']) ?>)
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="error-vehicle_id" class="field-msg is-error"><?= e((string) ($errors['vehicle_id'] ?? '')) ?></div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Статус и комментарий</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-status">Статус *</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($crew['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Активна</option>
                            <option value="inactive" <?= ($crew['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Неактивна</option>
                            <option value="archived" <?= ($crew['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Архив</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e((string) ($errors['status'] ?? '')) ?></div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-comment">Комментарий</label>
                        <textarea id="field-comment" name="comment" class="field-textarea" rows="3"><?= e((string) ($crew['comment'] ?? '')) ?></textarea>
                        <div id="error-comment" class="field-msg is-error"><?= e((string) ($errors['comment'] ?? '')) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/crews" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>