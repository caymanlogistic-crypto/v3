<?php declare(strict_types=1); ?>
<?php $hasTrailer = ((int) ($vehicle['has_trailer'] ?? 0)) === 1; ?>

<div class="page form-page">
    <div class="page-header"><h1>Edit Vehicle</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/update" class="form-card" id="vehicleForm">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">Пожалуйста, исправьте ошибки формы</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">Тягач</th></tr>
            <tr><td>Truck Plate *</td><td><input type="text" name="truck_plate" value="<?= e($vehicle['truck_plate'] ?? '') ?>"><div class="form-hint">Пример: К816ХК147</div><div id="error-truck_plate" class="error"><?= e($errors['truck_plate'] ?? '') ?></div></td></tr>
            <tr><td>Truck Brand *</td><td><input type="text" name="truck_brand" value="<?= e($vehicle['truck_brand'] ?? '') ?>"><div id="error-truck_brand" class="error"><?= e($errors['truck_brand'] ?? '') ?></div></td></tr>
            <tr><td>Truck Model</td><td><input type="text" name="truck_model" value="<?= e($vehicle['truck_model'] ?? '') ?>"><div id="error-truck_model" class="error"><?= e($errors['truck_model'] ?? '') ?></div></td></tr>
            <tr><td>Truck VIN *</td><td><input type="text" name="truck_vin" value="<?= e($vehicle['truck_vin'] ?? '') ?>"><div class="form-hint">17 символов</div><div id="error-truck_vin" class="error"><?= e($errors['truck_vin'] ?? '') ?></div></td></tr>
            <tr><td>Truck Load Capacity (tons) *</td><td><input type="text" name="truck_load_capacity" value="<?= e($vehicle['truck_load_capacity'] ?? '') ?>"><div class="form-hint">Можно: 20,5</div><div id="error-truck_load_capacity" class="error"><?= e($errors['truck_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Truck Body Volume (m3) *</td><td><input type="text" name="truck_body_volume" value="<?= e($vehicle['truck_body_volume'] ?? '') ?>"><div class="form-hint">Можно: 90,5</div><div id="error-truck_body_volume" class="error"><?= e($errors['truck_body_volume'] ?? '') ?></div></td></tr>
            <tr><td colspan="2"><label><input type="checkbox" id="hasTrailerCheckbox" name="has_trailer" value="1" <?= $hasTrailer ? 'checked' : '' ?>> Есть полуприцеп</label></td></tr>
        </table>

        <table class="form-table" id="trailerSection" style="display:<?= $hasTrailer ? '' : 'none' ?>; margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">Прицеп / полуприцеп</th></tr>
            <tr><td>Trailer Plate</td><td><input type="text" name="trailer_plate" value="<?= e($vehicle['trailer_plate'] ?? '') ?>"><div class="form-hint">Пример: ВК432947</div><div id="error-trailer_plate" class="error"><?= e($errors['trailer_plate'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Brand</td><td><input type="text" name="trailer_brand" value="<?= e($vehicle['trailer_brand'] ?? '') ?>"><div id="error-trailer_brand" class="error"><?= e($errors['trailer_brand'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Model</td><td><input type="text" name="trailer_model" value="<?= e($vehicle['trailer_model'] ?? '') ?>"><div id="error-trailer_model" class="error"><?= e($errors['trailer_model'] ?? '') ?></div></td></tr>
            <tr><td>Trailer VIN</td><td><input type="text" name="trailer_vin" value="<?= e($vehicle['trailer_vin'] ?? '') ?>"><div class="form-hint">17 символов</div><div id="error-trailer_vin" class="error"><?= e($errors['trailer_vin'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Load Capacity (tons)</td><td><input type="text" name="trailer_load_capacity" value="<?= e($vehicle['trailer_load_capacity'] ?? '') ?>"><div class="form-hint">Можно: 20,5</div><div id="error-trailer_load_capacity" class="error"><?= e($errors['trailer_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Body Volume (m3)</td><td><input type="text" name="trailer_body_volume" value="<?= e($vehicle['trailer_body_volume'] ?? '') ?>"><div class="form-hint">Можно: 90,5</div><div id="error-trailer_body_volume" class="error"><?= e($errors['trailer_body_volume'] ?? '') ?></div></td></tr>
        </table>

        <table class="form-table" style="margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">Комментарии и статус</th></tr>
            <tr><td>Status</td><td><select name="status"><option value="active" <?= ($vehicle['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($vehicle['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($vehicle['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><div id="error-status" class="error"><?= e($errors['status'] ?? '') ?></div></td></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="3"><?= e($vehicle['comments'] ?? '') ?></textarea><div id="error-comments" class="error"><?= e($errors['comments'] ?? '') ?></div></td></tr>
        </table>

        <div class="form-actions" style="margin-top: 20px;"><button type="submit" class="btn btn-primary">Update Vehicle</button><a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a></div>
    </form>

    <div class="section form-section" style="margin-top: 40px;">
        <h2 class="form-section-title">Документы</h2>

        <?php
            $hasSts = false;
            $hasDiagnosticCard = false;
            $hasTrailerSts = false;
            $hasTrailerDiagnosticCard = false;
            $hasTruckPhoto = false;
            $hasTrailerPhoto = false;

            foreach ($files as $fileItem) {
                $type = (string) ($fileItem['file_type'] ?? '');
                if ($type === 'sts') { $hasSts = true; }
                if ($type === 'diagnostic_card') { $hasDiagnosticCard = true; }
                if ($type === 'trailer_sts') { $hasTrailerSts = true; }
                if ($type === 'trailer_diagnostic_card') { $hasTrailerDiagnosticCard = true; }
                if ($type === 'truck_photo') { $hasTruckPhoto = true; }
                if ($type === 'trailer_photo') { $hasTrailerPhoto = true; }
            }

        ?>

        <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="vehicle-file-upload-form" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="upload-grid">
                <?php if (!$hasSts): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить СТС</h3>
                        <input type="file" name="typed_files[sts][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasDiagnosticCard): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить диагностическую карту</h3>
                        <input type="file" name="typed_files[diagnostic_card][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerSts): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить СТС полуприцепа</h3>
                        <input type="file" name="typed_files[trailer_sts][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerDiagnosticCard): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить диагностическую карту полуприцепа</h3>
                        <input type="file" name="typed_files[trailer_diagnostic_card][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasTruckPhoto): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить фото машины</h3>
                        <input type="file" name="typed_files[truck_photo][]" multiple accept=".jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if ($hasTrailer && !$hasTrailerPhoto): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">Загрузить фото полуприцепа</h3>
                        <input type="file" name="typed_files[trailer_photo][]" multiple accept=".jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <div class="upload-block">
                    <h3 class="upload-title">Прочие файлы</h3>
                    <input type="file" name="typed_files[other][]" multiple>
                    <div class="error file-error"></div>
                    <input type="text" name="comments[other]" value="" style="margin-top:8px;" placeholder="Комментарий (необязательно)">
                </div>
            </div>

            <div style="margin-top: 12px;">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>

        <?php if (!empty($files)): ?>
            <table class="table" style="margin-top: 24px; width:100%; border-collapse: collapse;">
                <thead><tr><th>Uploaded</th><th>Name</th><th>Type</th><th>Size</th><th>Comment</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?= e($file['created_at'] ?? '') ?></td>
                            <td><?= e($file['original_name'] ?? '') ?></td>
                            <td><?php
                                $fileType = (string) ($file['file_type'] ?? '');
                                $fileTypeLabels = [
                                    'sts' => 'СТС',
                                    'diagnostic_card' => 'Диагностическая карта',
                                    'trailer_sts' => 'СТС полуприцепа',
                                    'trailer_diagnostic_card' => 'Диагностическая карта полуприцепа',
                                    'truck_photo' => 'Фото машины',
                                    'trailer_photo' => 'Фото полуприцепа',
                                    'other' => 'Прочее',
                                ];
                                echo e($fileTypeLabels[$fileType] ?? $fileType);
                            ?></td>
                            <td><?= e(isset($file['file_size']) ? round((int) $file['file_size'] / 1024, 2) . ' KB' : '') ?></td>
                            <td><?= e($file['comment'] ?? '') ?></td>
                            <td><a href="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/download">Download</a><form method="POST" action="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/delete" style="display:inline; margin-left: 12px;"><?= csrf_field() ?><button type="submit" class="btn btn-link" style="padding:0;">Delete</button></form></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No files uploaded yet.</p>
        <?php endif; ?>
    </div>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js?v=20260512_has_trailer"></script>
    <script src="<?= config('app.url') ?>/assets/js/vehicle-files.js"></script>
</div>
