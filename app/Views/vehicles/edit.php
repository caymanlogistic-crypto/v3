<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Edit Vehicle</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/update">
        <?= csrf_field() ?>

        <div id="vehicleFormValidationAlert" class="error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <table class="form-table">

            <tr>
                <th colspan="2">Truck</th>
            </tr>

            <tr>
                <td>Truck Plate *</td>
                <td>

                    <input
                        type="text"
                        name="truck_plate"
                        value="<?= e($vehicle['truck_plate'] ?? '') ?>"
                    >

                    <div id="error-truck_plate" class="error">
                        <?= e($errors['truck_plate'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Truck Brand</td>
                <td>

                    <input
                        type="text"
                        name="truck_brand"
                        value="<?= e($vehicle['truck_brand'] ?? '') ?>"
                    >

                    <div id="error-truck_brand" class="error">
                        <?= e($errors['truck_brand'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Truck Model</td>
                <td>

                    <input
                        type="text"
                        name="truck_model"
                        value="<?= e($vehicle['truck_model'] ?? '') ?>"
                    >

                    <div id="error-truck_model" class="error">
                        <?= e($errors['truck_model'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Truck VIN</td>
                <td>

                    <input
                        type="text"
                        name="truck_vin"
                        value="<?= e($vehicle['truck_vin'] ?? '') ?>"
                    >

                    <div id="error-truck_vin" class="error">
                        <?= e($errors['truck_vin'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <th colspan="2">Trailer / Semitrailer (optional)</th>
            </tr>

            <tr>
                <td>Trailer Plate</td>
                <td>

                    <input
                        type="text"
                        name="trailer_plate"
                        value="<?= e($vehicle['trailer_plate'] ?? '') ?>"
                    >

                    <div id="error-trailer_plate" class="error">
                        <?= e($errors['trailer_plate'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Trailer Brand</td>
                <td>

                    <input
                        type="text"
                        name="trailer_brand"
                        value="<?= e($vehicle['trailer_brand'] ?? '') ?>"
                    >

                    <div id="error-trailer_brand" class="error">
                        <?= e($errors['trailer_brand'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Trailer Model</td>
                <td>

                    <input
                        type="text"
                        name="trailer_model"
                        value="<?= e($vehicle['trailer_model'] ?? '') ?>"
                    >

                    <div id="error-trailer_model" class="error">
                        <?= e($errors['trailer_model'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Trailer VIN</td>
                <td>

                    <input
                        type="text"
                        name="trailer_vin"
                        value="<?= e($vehicle['trailer_vin'] ?? '') ?>"
                    >

                    <div id="error-trailer_vin" class="error">
                        <?= e($errors['trailer_vin'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <th colspan="2">Parameters</th>
            </tr>

            <tr>
                <td>Load Capacity (tons)</td>
                <td>

                    <input
                        type="text"
                        name="load_capacity"
                        value="<?= e($vehicle['load_capacity'] ?? '') ?>"
                    >

                    <div id="error-load_capacity" class="error">
                        <?= e($errors['load_capacity'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Body Volume (m³)</td>
                <td>

                    <input
                        type="text"
                        name="body_volume"
                        value="<?= e($vehicle['body_volume'] ?? '') ?>"
                    >

                    <div id="error-body_volume" class="error">
                        <?= e($errors['body_volume'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <th colspan="2">Status & Comments</th>
            </tr>

            <tr>
                <td>Status *</td>
                <td>

                    <select name="status">
                        <option value="active" <?= ($vehicle['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="blocked" <?= ($vehicle['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                        <option value="archive" <?= ($vehicle['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                    </select>

                    <div id="error-status" class="error">
                        <?= e($errors['status'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Comments</td>
                <td>

                    <textarea
                        name="comments"
                        rows="3"
                    ><?= e($vehicle['comments'] ?? '') ?></textarea>

                    <div id="error-comments" class="error">
                        <?= e($errors['comments'] ?? '') ?>
                    </div>

                </td>
            </tr>

        </table>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Update Vehicle</button>
            <a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a>
        </div>

    </form>

    <div class="section" style="margin-top: 40px;">
        <h2>Vehicle Files</h2>

        <div class="vehicle-file-upload-sections" style="display: grid; gap: 20px;">
            <form
                method="POST"
                action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload"
                class="vehicle-file-upload-form"
                enctype="multipart/form-data"
            >
                <?= csrf_field() ?>
                <input type="hidden" name="file_type" value="sts">

                <table class="form-table" style="margin-bottom: 0;">
                    <tr>
                        <th colspan="2">Загрузить СТС</th>
                    </tr>
                    <tr>
                        <td>Файл</td>
                        <td>
                            <input type="file" name="file">`r`n                            <div class="error file-error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Upload STS</button>
                        </td>
                    </tr>
                </table>
            </form>

            <form
                method="POST"
                action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload"
                class="vehicle-file-upload-form"
                enctype="multipart/form-data"
            >
                <?= csrf_field() ?>
                <input type="hidden" name="file_type" value="diagnostic_card">

                <table class="form-table" style="margin-bottom: 0;">
                    <tr>
                        <th colspan="2">Загрузить диагностическую карту</th>
                    </tr>
                    <tr>
                        <td>Файл</td>
                        <td>
                            <input type="file" name="file">`r`n                            <div class="error file-error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Upload Diagnostic Card</button>
                        </td>
                    </tr>
                </table>
            </form>

            <form
                method="POST"
                action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload"
                class="vehicle-file-upload-form"
                enctype="multipart/form-data"
            >
                <?= csrf_field() ?>
                <input type="hidden" name="file_type" value="other">

                <table class="form-table" style="margin-bottom: 0;">
                    <tr>
                        <th colspan="2">Прочие файлы</th>
                    </tr>
                    <tr>
                        <td>Файл</td>
                        <td>
                            <input type="file" name="file">`r`n                            <div class="error file-error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Комментарий</td>
                        <td>
                            <input type="text" name="comment" value="">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Upload File</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <?php if (!empty($files)): ?>
            <table class="table" style="margin-top: 24px; width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Uploaded</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?= e($file['created_at'] ?? '') ?></td>
                            <td><?= e($file['original_name'] ?? '') ?></td>
                            <td><?= e($file['file_type'] ?? '') ?></td>
                            <td><?= e(isset($file['file_size']) ? round((int) $file['file_size'] / 1024, 2) . ' KB' : '') ?></td>
                            <td><?= e($file['comment'] ?? '') ?></td>
                            <td>
                                <a href="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/download">Download</a>
                                <form method="POST" action="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/delete" style="display:inline; margin-left: 12px;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-link" style="padding:0;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No files uploaded yet.</p>
        <?php endif; ?>
    </div>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/vehicle-files.js"></script>

</div>
