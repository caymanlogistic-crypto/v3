<?php declare(strict_types=1); ?>
<?php $hasTrailer = ((int) ($old['has_trailer'] ?? 0)) === 1; ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Новый транспорт</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/store" class="entity-form" id="vehicleForm">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <div class="form-body">
            <!-- Тягач -->
            <div class="form-section">
                <div class="form-section-title">Тягач</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-truck_plate">Truck Plate *</label>
                        <input id="field-truck_plate" type="text" name="truck_plate" class="field-input" value="<?= e($old['truck_plate'] ?? '') ?>">
                        <div class="form-hint">Пример: К816ХК147</div>
                        <div id="error-truck_plate" class="field-msg is-error"><?= e($errors['truck_plate'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_brand">Truck Brand *</label>
                        <input id="field-truck_brand" type="text" name="truck_brand" class="field-input" value="<?= e($old['truck_brand'] ?? '') ?>">
                        <div id="error-truck_brand" class="field-msg is-error"><?= e($errors['truck_brand'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_model">Truck Model</label>
                        <input id="field-truck_model" type="text" name="truck_model" class="field-input" value="<?= e($old['truck_model'] ?? '') ?>">
                        <div id="error-truck_model" class="field-msg is-error"><?= e($errors['truck_model'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_vin">Truck VIN *</label>
                        <input id="field-truck_vin" type="text" name="truck_vin" class="field-input" value="<?= e($old['truck_vin'] ?? '') ?>">
                        <div class="form-hint">17 символов</div>
                        <div id="error-truck_vin" class="field-msg is-error"><?= e($errors['truck_vin'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_load_capacity">Truck Load Capacity (tons) *</label>
                        <input id="field-truck_load_capacity" type="text" name="truck_load_capacity" class="field-input" value="<?= e($old['truck_load_capacity'] ?? '') ?>">
                        <div class="form-hint">Можно: 20,5</div>
                        <div id="error-truck_load_capacity" class="field-msg is-error"><?= e($errors['truck_load_capacity'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_body_volume">Truck Body Volume (m3) *</label>
                        <input id="field-truck_body_volume" type="text" name="truck_body_volume" class="field-input" value="<?= e($old['truck_body_volume'] ?? '') ?>">
                        <div class="form-hint">Можно: 90,5</div>
                        <div id="error-truck_body_volume" class="field-msg is-error"><?= e($errors['truck_body_volume'] ?? '') ?></div>
                    </div>
                </div>

                <div class="field" style="margin-top: var(--space-2);">
                    <label class="form-toggle">
                        <input type="checkbox" id="hasTrailerCheckbox" name="has_trailer" value="1" <?= $hasTrailer ? 'checked' : '' ?>>
                        <span>Есть полуприцеп</span>
                    </label>
                </div>
            </div>

            <!-- Прицеп / полуприцеп -->
            <div class="form-section" id="trailerSection" style="display:<?= $hasTrailer ? '' : 'none' ?>;">
                <div class="form-section-title">Прицеп / полуприцеп</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-trailer_plate">Trailer Plate</label>
                        <input id="field-trailer_plate" type="text" name="trailer_plate" class="field-input" value="<?= e($old['trailer_plate'] ?? '') ?>">
                        <div class="form-hint">Пример: ВК432947</div>
                        <div id="error-trailer_plate" class="field-msg is-error"><?= e($errors['trailer_plate'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_brand">Trailer Brand</label>
                        <input id="field-trailer_brand" type="text" name="trailer_brand" class="field-input" value="<?= e($old['trailer_brand'] ?? '') ?>">
                        <div id="error-trailer_brand" class="field-msg is-error"><?= e($errors['trailer_brand'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_model">Trailer Model</label>
                        <input id="field-trailer_model" type="text" name="trailer_model" class="field-input" value="<?= e($old['trailer_model'] ?? '') ?>">
                        <div id="error-trailer_model" class="field-msg is-error"><?= e($errors['trailer_model'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_vin">Trailer VIN</label>
                        <input id="field-trailer_vin" type="text" name="trailer_vin" class="field-input" value="<?= e($old['trailer_vin'] ?? '') ?>">
                        <div class="form-hint">17 символов</div>
                        <div id="error-trailer_vin" class="field-msg is-error"><?= e($errors['trailer_vin'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_load_capacity">Trailer Load Capacity (tons)</label>
                        <input id="field-trailer_load_capacity" type="text" name="trailer_load_capacity" class="field-input" value="<?= e($old['trailer_load_capacity'] ?? '') ?>">
                        <div class="form-hint">Можно: 20,5</div>
                        <div id="error-trailer_load_capacity" class="field-msg is-error"><?= e($errors['trailer_load_capacity'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_body_volume">Trailer Body Volume (m3)</label>
                        <input id="field-trailer_body_volume" type="text" name="trailer_body_volume" class="field-input" value="<?= e($old['trailer_body_volume'] ?? '') ?>">
                        <div class="form-hint">Можно: 90,5</div>
                        <div id="error-trailer_body_volume" class="field-msg is-error"><?= e($errors['trailer_body_volume'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Комментарии и статус -->
            <div class="form-section">
                <div class="form-section-title">Комментарии и статус</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-status">Status</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                            <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-comments">Comments</label>
                        <textarea id="field-comments" name="comments" class="field-textarea" rows="3"><?= e($old['comments'] ?? '') ?></textarea>
                        <div id="error-comments" class="field-msg is-error"><?= e($errors['comments'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/vehicles" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js?v=20260512_has_trailer"></script>
</div>