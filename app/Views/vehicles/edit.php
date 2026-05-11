<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header"><h1>Edit Vehicle</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/update" class="form-card">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">РџРѕР¶Р°Р»СѓР№СЃС‚Р°, РёСЃРїСЂР°РІСЊС‚Рµ РѕС€РёР±РєРё С„РѕСЂРјС‹</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">РўСЏРіР°С‡</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Truck Plate *</span><button type="button" class="form-help-button" data-help="Р“РѕСЃРЅРѕРјРµСЂ С‚СЏРіР°С‡Р°. РњРѕР¶РЅРѕ РІРІРѕРґРёС‚СЊ Р»Р°С‚РёРЅРёС†РµР№, С„РѕСЂРјР° РїСЂРёРІРµРґРµС‚ Рє СЂСѓСЃСЃРєРёРј Р±СѓРєРІР°Рј.">?</button></span></td><td><input type="text" name="truck_plate" value="<?= e($vehicle['truck_plate'] ?? '') ?>"><div class="form-hint">РџСЂРёРјРµСЂ: Рљ816РҐРљ147</div><div id="error-truck_plate" class="error"><?= e($errors['truck_plate'] ?? '') ?></div></td></tr>
            <tr><td>Truck Brand</td><td><input type="text" name="truck_brand" value="<?= e($vehicle['truck_brand'] ?? '') ?>"><div id="error-truck_brand" class="error"><?= e($errors['truck_brand'] ?? '') ?></div></td></tr>
            <tr><td>Truck Model</td><td><input type="text" name="truck_model" value="<?= e($vehicle['truck_model'] ?? '') ?>"><div id="error-truck_model" class="error"><?= e($errors['truck_model'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Truck VIN</span><button type="button" class="form-help-button" data-help="VIN СЃРѕСЃС‚РѕРёС‚ РёР· 17 СЃРёРјРІРѕР»РѕРІ, Р±РµР· РїСЂРѕР±РµР»РѕРІ.">?</button></span></td><td><input type="text" name="truck_vin" value="<?= e($vehicle['truck_vin'] ?? '') ?>"><div class="form-hint">17 СЃРёРјРІРѕР»РѕРІ</div><div id="error-truck_vin" class="error"><?= e($errors['truck_vin'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РџСЂРёС†РµРї / РїРѕР»СѓРїСЂРёС†РµРї</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Trailer Plate</span><button type="button" class="form-help-button" data-help="РџРѕР»Рµ РЅРµРѕР±СЏР·Р°С‚РµР»СЊРЅРѕРµ. Р”Р»СЏ РЅРѕРјРµСЂР° РїСЂРёС†РµРїР° СЂР°Р±РѕС‚Р°РµС‚ РјСЏРіРєР°СЏ РЅРѕСЂРјР°Р»РёР·Р°С†РёСЏ Р±СѓРєРІ.">?</button></span></td><td><input type="text" name="trailer_plate" value="<?= e($vehicle['trailer_plate'] ?? '') ?>"><div class="form-hint">РџСЂРёРјРµСЂ: Р’Рљ432947</div><div id="error-trailer_plate" class="error"><?= e($errors['trailer_plate'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Brand</td><td><input type="text" name="trailer_brand" value="<?= e($vehicle['trailer_brand'] ?? '') ?>"><div id="error-trailer_brand" class="error"><?= e($errors['trailer_brand'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Model</td><td><input type="text" name="trailer_model" value="<?= e($vehicle['trailer_model'] ?? '') ?>"><div id="error-trailer_model" class="error"><?= e($errors['trailer_model'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Trailer VIN</span><button type="button" class="form-help-button" data-help="Р•СЃР»Рё РїСЂРёС†РµРїР° РЅРµС‚, РѕСЃС‚Р°РІСЊС‚Рµ РїРѕР»Рµ РїСѓСЃС‚С‹Рј.">?</button></span></td><td><input type="text" name="trailer_vin" value="<?= e($vehicle['trailer_vin'] ?? '') ?>"><div class="form-hint">17 СЃРёРјРІРѕР»РѕРІ</div><div id="error-trailer_vin" class="error"><?= e($errors['trailer_vin'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РџР°СЂР°РјРµС‚СЂС‹</th></tr>
            <tr><td>Load Capacity (tons)</td><td><input type="text" name="load_capacity" value="<?= e($vehicle['load_capacity'] ?? '') ?>"><div class="form-hint">РњРѕР¶РЅРѕ: 20,5</div><div id="error-load_capacity" class="error"><?= e($errors['load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Body Volume (mВі)</td><td><input type="text" name="body_volume" value="<?= e($vehicle['body_volume'] ?? '') ?>"><div class="form-hint">РњРѕР¶РЅРѕ: 90,5</div><div id="error-body_volume" class="error"><?= e($errors['body_volume'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РљРѕРјРјРµРЅС‚Р°СЂРёРё Рё СЃС‚Р°С‚СѓСЃ</th></tr>
            <tr><td>Status *</td><td><select name="status"><option value="active" <?= ($vehicle['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($vehicle['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($vehicle['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><div id="error-status" class="error"><?= e($errors['status'] ?? '') ?></div></td></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="3"><?= e($vehicle['comments'] ?? '') ?></textarea><div id="error-comments" class="error"><?= e($errors['comments'] ?? '') ?></div></td></tr>
        </table>

        <div class="form-actions" style="margin-top: 20px;"><button type="submit" class="btn btn-primary">Update Vehicle</button><a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a></div>
    </form>

    <div class="section form-section" style="margin-top: 40px;">
        <h2 class="form-section-title">Р”РѕРєСѓРјРµРЅС‚С‹</h2>

        <div class="upload-grid">
            <div class="upload-block">
                <h3 class="upload-title">Р—Р°РіСЂСѓР·РёС‚СЊ РЎРўРЎ</h3>
                <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="vehicle-file-upload-form" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="file_type" value="sts">
                    <input type="file" name="file">
                    <div class="error file-error"></div>
                    <div style="margin-top: 12px;"><button type="submit" class="btn btn-primary">Upload STS</button></div>
                </form>
            </div>

            <div class="upload-block">
                <h3 class="upload-title">Р—Р°РіСЂСѓР·РёС‚СЊ РґРёР°РіРЅРѕСЃС‚РёС‡РµСЃРєСѓСЋ РєР°СЂС‚Сѓ</h3>
                <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="vehicle-file-upload-form" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="file_type" value="diagnostic_card">
                    <input type="file" name="file">
                    <div class="error file-error"></div>
                    <div style="margin-top: 12px;"><button type="submit" class="btn btn-primary">Upload Diagnostic Card</button></div>
                </form>
            </div>

            <div class="upload-block">
                <h3 class="upload-title">РџСЂРѕС‡РёРµ С„Р°Р№Р»С‹</h3>
                <form method="POST" action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/files/upload" class="vehicle-file-upload-form" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="file_type" value="other">
                    <input type="file" name="file">
                    <div class="error file-error"></div>
                    <input type="text" name="comment" value="" style="margin-top:8px;" placeholder="РљРѕРјРјРµРЅС‚Р°СЂРёР№ (РЅРµРѕР±СЏР·Р°С‚РµР»СЊРЅРѕ)">
                    <div style="margin-top: 12px;"><button type="submit" class="btn btn-primary">Upload File</button></div>
                </form>
            </div>
        </div>

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
                            <td>
                                <a href="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/download">Download</a>
                                <form method="POST" action="<?= config('app.url') ?>/vehicles/files/<?= (int) $file['id'] ?>/delete" style="display:inline; margin-left: 12px;"><?= csrf_field() ?><button type="submit" class="btn btn-link" style="padding:0;">Delete</button></form>
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
