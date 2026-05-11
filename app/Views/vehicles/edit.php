<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header"><h1>Edit Vehicle</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/update" class="form-card" id="vehicleForm">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">&#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072;, &#1080;&#1089;&#1087;&#1088;&#1072;&#1074;&#1100;&#1090;&#1077; &#1086;&#1096;&#1080;&#1073;&#1082;&#1080; &#1092;&#1086;&#1088;&#1084;&#1099;</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">&#1058;&#1103;&#1075;&#1072;&#1095;</th></tr>
            <tr><td>Truck Plate *</td><td><input type="text" name="truck_plate" value="<?= e($vehicle['truck_plate'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: &#1050;816&#1061;&#1050;147</div><div id="error-truck_plate" class="error"><?= e($errors['truck_plate'] ?? '') ?></div></td></tr>
            <tr><td>Truck Brand</td><td><input type="text" name="truck_brand" value="<?= e($vehicle['truck_brand'] ?? '') ?>"><div id="error-truck_brand" class="error"><?= e($errors['truck_brand'] ?? '') ?></div></td></tr>
            <tr><td>Truck Model</td><td><input type="text" name="truck_model" value="<?= e($vehicle['truck_model'] ?? '') ?>"><div id="error-truck_model" class="error"><?= e($errors['truck_model'] ?? '') ?></div></td></tr>
            <tr><td>Truck VIN</td><td><input type="text" name="truck_vin" value="<?= e($vehicle['truck_vin'] ?? '') ?>"><div class="form-hint">17 &#1089;&#1080;&#1084;&#1074;&#1086;&#1083;&#1086;&#1074;</div><div id="error-truck_vin" class="error"><?= e($errors['truck_vin'] ?? '') ?></div></td></tr>
            <tr><td>Truck Load Capacity (tons)</td><td><input type="text" name="truck_load_capacity" value="<?= e($vehicle['truck_load_capacity'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 20,5</div><div id="error-truck_load_capacity" class="error"><?= e($errors['truck_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Truck Body Volume (m3)</td><td><input type="text" name="truck_body_volume" value="<?= e($vehicle['truck_body_volume'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 90,5</div><div id="error-truck_body_volume" class="error"><?= e($errors['truck_body_volume'] ?? '') ?></div></td></tr>
            <tr><td colspan="2"><button type="button" class="btn btn-secondary" id="toggleTrailerSection">&#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1100; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1087;&#1086;&#1083;&#1091;&#1087;&#1088;&#1080;&#1094;&#1077;&#1087;&#1072;</button></td></tr>
        </table>

        <table class="form-table" id="trailerSection" style="display:none; margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">&#1055;&#1088;&#1080;&#1094;&#1077;&#1087; / &#1087;&#1086;&#1083;&#1091;&#1087;&#1088;&#1080;&#1094;&#1077;&#1087;</th></tr>
            <tr><td>Trailer Plate</td><td><input type="text" name="trailer_plate" value="<?= e($vehicle['trailer_plate'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: &#1042;&#1050;432947</div><div id="error-trailer_plate" class="error"><?= e($errors['trailer_plate'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Brand</td><td><input type="text" name="trailer_brand" value="<?= e($vehicle['trailer_brand'] ?? '') ?>"><div id="error-trailer_brand" class="error"><?= e($errors['trailer_brand'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Model</td><td><input type="text" name="trailer_model" value="<?= e($vehicle['trailer_model'] ?? '') ?>"><div id="error-trailer_model" class="error"><?= e($errors['trailer_model'] ?? '') ?></div></td></tr>
            <tr><td>Trailer VIN</td><td><input type="text" name="trailer_vin" value="<?= e($vehicle['trailer_vin'] ?? '') ?>"><div class="form-hint">17 &#1089;&#1080;&#1084;&#1074;&#1086;&#1083;&#1086;&#1074;</div><div id="error-trailer_vin" class="error"><?= e($errors['trailer_vin'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Load Capacity (tons)</td><td><input type="text" name="trailer_load_capacity" value="<?= e($vehicle['trailer_load_capacity'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 20,5</div><div id="error-trailer_load_capacity" class="error"><?= e($errors['trailer_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Body Volume (m3)</td><td><input type="text" name="trailer_body_volume" value="<?= e($vehicle['trailer_body_volume'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 90,5</div><div id="error-trailer_body_volume" class="error"><?= e($errors['trailer_body_volume'] ?? '') ?></div></td></tr>
        </table>

        <table class="form-table" style="margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1080; &#1080; &#1089;&#1090;&#1072;&#1090;&#1091;&#1089;</th></tr>
            <tr><td>Status *</td><td><select name="status"><option value="active" <?= ($vehicle['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($vehicle['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($vehicle['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><div id="error-status" class="error"><?= e($errors['status'] ?? '') ?></div></td></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="3"><?= e($vehicle['comments'] ?? '') ?></textarea><div id="error-comments" class="error"><?= e($errors['comments'] ?? '') ?></div></td></tr>
        </table>

        <div class="form-actions" style="margin-top: 20px;"><button type="submit" class="btn btn-primary">Update Vehicle</button><a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a></div>
    </form>

    <div class="section form-section" style="margin-top: 40px;">
        <h2 class="form-section-title">&#1044;&#1086;&#1082;&#1091;&#1084;&#1077;&#1085;&#1090;&#1099;</h2>

                <?php
            $hasSts = false;
            $hasDiagnosticCard = false;
            foreach ($files as $fileItem) {
                $type = (string) ($fileItem['file_type'] ?? '');
                if ($type === 'sts') { $hasSts = true; }
                if ($type === 'diagnostic_card') { $hasDiagnosticCard = true; }
            }
        ?>

        <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="vehicle-file-upload-form" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="upload-grid">
                <?php if (!$hasSts): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">&#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1057;&#1058;&#1057;</h3>
                        <input type="file" name="typed_files[sts][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasDiagnosticCard): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">&#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1076;&#1080;&#1072;&#1075;&#1085;&#1086;&#1089;&#1090;&#1080;&#1095;&#1077;&#1089;&#1082;&#1091;&#1102; &#1082;&#1072;&#1088;&#1090;&#1091;</h3>
                        <input type="file" name="typed_files[diagnostic_card][]" multiple>
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <div class="upload-block">
                    <h3 class="upload-title">&#1055;&#1088;&#1086;&#1095;&#1080;&#1077; &#1092;&#1072;&#1081;&#1083;&#1099;</h3>
                    <input type="file" name="typed_files[other][]" multiple>
                    <div class="error file-error"></div>
                    <input type="text" name="comments[other]" value="" style="margin-top:8px;" placeholder="&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1081; (&#1085;&#1077;&#1086;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;)">
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
                            <td><?= e($file['file_type'] ?? '') ?></td>
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

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/vehicle-files.js"></script>
</div>

