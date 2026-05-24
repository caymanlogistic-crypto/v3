<?php declare(strict_types=1); ?>
<?php
    $hasTrailer = ((int) ($old['has_trailer'] ?? 0)) === 1;
    if ((int) ($vehicle['has_trailer'] ?? 0) === 1) $hasTrailer = true;

    $hasSts = false;
    $hasDiagnosticCard = false;
    $hasTrailerSts = false;
    $hasTrailerDiagnosticCard = false;
    $hasTruckPhoto = false;
    $hasTrailerPhoto = false;
    foreach ($files as $fileItem) {
        $type = (string) ($fileItem['file_type'] ?? '');
        if ($type === 'sts') $hasSts = true;
        if ($type === 'diagnostic_card') $hasDiagnosticCard = true;
        if ($type === 'trailer_sts') $hasTrailerSts = true;
        if ($type === 'trailer_diagnostic_card') $hasTrailerDiagnosticCard = true;
        if ($type === 'truck_photo') $hasTruckPhoto = true;
        if ($type === 'trailer_photo') $hasTrailerPhoto = true;
    }
?>

<div class="page form-page">
    <div class="page-header">
        <h1>Редактирование транспорта #<?= (int) ($vehicle['id'] ?? 0) ?></h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) ($vehicle['id'] ?? 0) ?>/update" class="entity-form" id="vehicleForm">
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
                        <input id="field-truck_plate" type="text" name="truck_plate" class="field-input" value="<?= e($old['truck_plate'] ?? $vehicle['truck_plate'] ?? '') ?>">
                        <div class="form-hint">Пример: К816ХК147</div>
                        <div id="error-truck_plate" class="field-msg is-error"><?= e($errors['truck_plate'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_brand">Truck Brand *</label>
                        <input id="field-truck_brand" type="text" name="truck_brand" class="field-input" value="<?= e($old['truck_brand'] ?? $vehicle['truck_brand'] ?? '') ?>">
                        <div id="error-truck_brand" class="field-msg is-error"><?= e($errors['truck_brand'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_model">Truck Model</label>
                        <input id="field-truck_model" type="text" name="truck_model" class="field-input" value="<?= e($old['truck_model'] ?? $vehicle['truck_model'] ?? '') ?>">
                        <div id="error-truck_model" class="field-msg is-error"><?= e($errors['truck_model'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_vin">Truck VIN *</label>
                        <input id="field-truck_vin" type="text" name="truck_vin" class="field-input" value="<?= e($old['truck_vin'] ?? $vehicle['truck_vin'] ?? '') ?>">
                        <div class="form-hint">17 символов</div>
                        <div id="error-truck_vin" class="field-msg is-error"><?= e($errors['truck_vin'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_load_capacity">Truck Load Capacity (tons) *</label>
                        <input id="field-truck_load_capacity" type="text" name="truck_load_capacity" class="field-input" value="<?= e($old['truck_load_capacity'] ?? $vehicle['truck_load_capacity'] ?? '') ?>">
                        <div class="form-hint">Можно: 20,5</div>
                        <div id="error-truck_load_capacity" class="field-msg is-error"><?= e($errors['truck_load_capacity'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-truck_body_volume">Truck Body Volume (m3) *</label>
                        <input id="field-truck_body_volume" type="text" name="truck_body_volume" class="field-input" value="<?= e($old['truck_body_volume'] ?? $vehicle['truck_body_volume'] ?? '') ?>">
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
                        <input id="field-trailer_plate" type="text" name="trailer_plate" class="field-input" value="<?= e($old['trailer_plate'] ?? $vehicle['trailer_plate'] ?? '') ?>">
                        <div class="form-hint">Пример: ВК432947</div>
                        <div id="error-trailer_plate" class="field-msg is-error"><?= e($errors['trailer_plate'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_brand">Trailer Brand</label>
                        <input id="field-trailer_brand" type="text" name="trailer_brand" class="field-input" value="<?= e($old['trailer_brand'] ?? $vehicle['trailer_brand'] ?? '') ?>">
                        <div id="error-trailer_brand" class="field-msg is-error"><?= e($errors['trailer_brand'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_model">Trailer Model</label>
                        <input id="field-trailer_model" type="text" name="trailer_model" class="field-input" value="<?= e($old['trailer_model'] ?? $vehicle['trailer_model'] ?? '') ?>">
                        <div id="error-trailer_model" class="field-msg is-error"><?= e($errors['trailer_model'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_vin">Trailer VIN</label>
                        <input id="field-trailer_vin" type="text" name="trailer_vin" class="field-input" value="<?= e($old['trailer_vin'] ?? $vehicle['trailer_vin'] ?? '') ?>">
                        <div class="form-hint">17 символов</div>
                        <div id="error-trailer_vin" class="field-msg is-error"><?= e($errors['trailer_vin'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_load_capacity">Trailer Load Capacity (tons)</label>
                        <input id="field-trailer_load_capacity" type="text" name="trailer_load_capacity" class="field-input" value="<?= e($old['trailer_load_capacity'] ?? $vehicle['trailer_load_capacity'] ?? '') ?>">
                        <div class="form-hint">Можно: 20,5</div>
                        <div id="error-trailer_load_capacity" class="field-msg is-error"><?= e($errors['trailer_load_capacity'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-trailer_body_volume">Trailer Body Volume (m3)</label>
                        <input id="field-trailer_body_volume" type="text" name="trailer_body_volume" class="field-input" value="<?= e($old['trailer_body_volume'] ?? $vehicle['trailer_body_volume'] ?? '') ?>">
                        <div class="form-hint">Можно: 90,5</div>
                        <div id="error-trailer_body_volume" class="field-msg is-error"><?= e($errors['trailer_body_volume'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Статус -->
            <div class="form-section">
                <div class="form-section-title">Статус</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-status">Status</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($old['status'] ?? $vehicle['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= ($old['status'] ?? $vehicle['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                            <option value="archive" <?= ($old['status'] ?? $vehicle['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/vehicles" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>

    <!-- Документы -->
    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="entity-form vehicle-file-upload-form" enctype="multipart/form-data" style="margin-top: 32px;">
        <?= csrf_field() ?>
        <div class="form-body">
            <div class="form-section-title" style="margin-bottom: var(--space-3);">Документы</div>

            <div class="upload-grid">
                <?php if (!$hasSts): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить СТС</div>
                        <input type="file" name="typed_files[sts][]" multiple>
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasDiagnosticCard): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить диагностическую карту</div>
                        <input type="file" name="typed_files[diagnostic_card][]" multiple>
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerSts): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить СТС полуприцепа</div>
                        <input type="file" name="typed_files[trailer_sts][]" multiple>
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerDiagnosticCard): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить диагностическую карту полуприцепа</div>
                        <input type="file" name="typed_files[trailer_diagnostic_card][]" multiple>
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasTruckPhoto): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить фото машины</div>
                        <input type="file" name="typed_files[truck_photo][]" multiple accept=".jpg,.jpeg,.png,.webp">
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerPhoto): ?>
                    <div class="upload-block">
                        <div class="upload-title">Загрузить фото полуприцепа</div>
                        <input type="file" name="typed_files[trailer_photo][]" multiple accept=".jpg,.jpeg,.png,.webp">
                        <div class="field-msg is-error file-error"></div>
                    </div>
                <?php endif; ?>

                <div class="upload-block">
                    <div class="upload-title">Прочие файлы</div>
                    <input type="file" name="typed_files[other][]" multiple>
                    <div class="field-msg is-error file-error"></div>
                    <input type="text" name="comments[other]" value="" style="margin-top:8px;" placeholder="Комментарий (необязательно)">
                </div>
            </div>

            <div style="margin-top: 12px;">
                <button type="submit" class="btn btn-primary">Загрузить</button>
            </div>
        </div>
    </form>

    <!-- Существующие файлы -->
    <?php if (!empty($files)): ?>
    <div class="form-section" style="margin-top: 24px;">
        <div class="form-section-title">Загруженные файлы</div>
        <table class="table" style="width:100%;">
            <thead><tr><th>Загружен</th><th>Название</th><th>Тип</th><th>Размер</th><th>Комментарий</th><th>Действия</th></tr></thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><?= e($file['created_at'] ?? '') ?></td>
                        <td><?= e($file['original_name'] ?? '') ?></td>
                        <td><?php
                            $fileType = (string) ($file['file_type'] ?? '');
                            $labels = [
                                'sts' => 'СТС', 'diagnostic_card' => 'Диагностическая карта',
                                'trailer_sts' => 'СТС полуприцепа', 'trailer_diagnostic_card' => 'Диагностическая карта полуприцепа',
                                'truck_photo' => 'Фото машины', 'trailer_photo' => 'Фото полуприцепа',
                                'other' => 'Прочее',
                            ];
                            echo e($labels[$fileType] ?? $fileType);
                        ?></td>
                        <td><?= e(isset($file['file_size']) ? round((int) $file['file_size'] / 1024, 2) . ' KB' : '') ?></td>
                        <td><?= e($file['comment'] ?? '') ?></td>
                        <td>
                            <a href="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/download" class="row-btn">Скачать</a>
                            <form method="POST" action="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/delete" style="display:inline; margin-left: 8px;">
                                <?= csrf_field() ?>
                                <button type="submit" class="row-btn">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js?v=20260512_has_trailer"></script>
    <script src="<?= config('app.url') ?>/assets/js/vehicle-files.js"></script>
</div>