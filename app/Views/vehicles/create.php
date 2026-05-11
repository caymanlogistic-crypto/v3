<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header"><h1>Create Vehicle</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/store" class="form-card">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">РџРѕР¶Р°Р»СѓР№СЃС‚Р°, РёСЃРїСЂР°РІСЊС‚Рµ РѕС€РёР±РєРё С„РѕСЂРјС‹</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">РўСЏРіР°С‡</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Truck Plate *</span><button type="button" class="form-help-button" data-help="Р“РѕСЃРЅРѕРјРµСЂ С‚СЏРіР°С‡Р°. РњРѕР¶РЅРѕ РІРІРѕРґРёС‚СЊ Р»Р°С‚РёРЅРёС†РµР№, С„РѕСЂРјР° РїСЂРёРІРµРґРµС‚ Рє СЂСѓСЃСЃРєРёРј Р±СѓРєРІР°Рј.">?</button></span></td><td><input type="text" name="truck_plate" value="<?= e($old['truck_plate'] ?? '') ?>"><div class="form-hint">РџСЂРёРјРµСЂ: Рљ816РҐРљ147</div><div id="error-truck_plate" class="error"><?= e($errors['truck_plate'] ?? '') ?></div></td></tr>
            <tr><td>Truck Brand</td><td><input type="text" name="truck_brand" value="<?= e($old['truck_brand'] ?? '') ?>"><div id="error-truck_brand" class="error"><?= e($errors['truck_brand'] ?? '') ?></div></td></tr>
            <tr><td>Truck Model</td><td><input type="text" name="truck_model" value="<?= e($old['truck_model'] ?? '') ?>"><div id="error-truck_model" class="error"><?= e($errors['truck_model'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Truck VIN</span><button type="button" class="form-help-button" data-help="VIN СЃРѕСЃС‚РѕРёС‚ РёР· 17 СЃРёРјРІРѕР»РѕРІ, Р±РµР· РїСЂРѕР±РµР»РѕРІ.">?</button></span></td><td><input type="text" name="truck_vin" value="<?= e($old['truck_vin'] ?? '') ?>"><div class="form-hint">17 СЃРёРјРІРѕР»РѕРІ</div><div id="error-truck_vin" class="error"><?= e($errors['truck_vin'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РџСЂРёС†РµРї / РїРѕР»СѓРїСЂРёС†РµРї</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Trailer Plate</span><button type="button" class="form-help-button" data-help="РџРѕР»Рµ РЅРµРѕР±СЏР·Р°С‚РµР»СЊРЅРѕРµ. Р”Р»СЏ РЅРѕРјРµСЂР° РїСЂРёС†РµРїР° СЂР°Р±РѕС‚Р°РµС‚ РјСЏРіРєР°СЏ РЅРѕСЂРјР°Р»РёР·Р°С†РёСЏ Р±СѓРєРІ.">?</button></span></td><td><input type="text" name="trailer_plate" value="<?= e($old['trailer_plate'] ?? '') ?>"><div class="form-hint">РџСЂРёРјРµСЂ: Р’Рљ432947</div><div id="error-trailer_plate" class="error"><?= e($errors['trailer_plate'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Brand</td><td><input type="text" name="trailer_brand" value="<?= e($old['trailer_brand'] ?? '') ?>"><div id="error-trailer_brand" class="error"><?= e($errors['trailer_brand'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Model</td><td><input type="text" name="trailer_model" value="<?= e($old['trailer_model'] ?? '') ?>"><div id="error-trailer_model" class="error"><?= e($errors['trailer_model'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Trailer VIN</span><button type="button" class="form-help-button" data-help="Р•СЃР»Рё РїСЂРёС†РµРїР° РЅРµС‚, РѕСЃС‚Р°РІСЊС‚Рµ РїРѕР»Рµ РїСѓСЃС‚С‹Рј.">?</button></span></td><td><input type="text" name="trailer_vin" value="<?= e($old['trailer_vin'] ?? '') ?>"><div class="form-hint">17 СЃРёРјРІРѕР»РѕРІ</div><div id="error-trailer_vin" class="error"><?= e($errors['trailer_vin'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РџР°СЂР°РјРµС‚СЂС‹</th></tr>
            <tr><td>Load Capacity (tons)</td><td><input type="text" name="load_capacity" value="<?= e($old['load_capacity'] ?? '') ?>"><div class="form-hint">РњРѕР¶РЅРѕ: 20,5</div><div id="error-load_capacity" class="error"><?= e($errors['load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Body Volume (mВі)</td><td><input type="text" name="body_volume" value="<?= e($old['body_volume'] ?? '') ?>"><div class="form-hint">РњРѕР¶РЅРѕ: 90,5</div><div id="error-body_volume" class="error"><?= e($errors['body_volume'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">РљРѕРјРјРµРЅС‚Р°СЂРёРё Рё СЃС‚Р°С‚СѓСЃ</th></tr>
            <tr><td>Status *</td><td><select name="status"><option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><div id="error-status" class="error"><?= e($errors['status'] ?? '') ?></div></td></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="3"><?= e($old['comments'] ?? '') ?></textarea><div id="error-comments" class="error"><?= e($errors['comments'] ?? '') ?></div></td></tr>
        </table>

        <div class="form-actions" style="margin-top: 20px;"><button type="submit" class="btn btn-primary">Create Vehicle</button><a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a></div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js"></script>
</div>
