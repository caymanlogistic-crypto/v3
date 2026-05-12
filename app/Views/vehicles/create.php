<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header"><h1>Create Vehicle</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/vehicles/store" class="form-card" id="vehicleForm">
        <?= csrf_field() ?>
        <div id="vehicleFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">&#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072;, &#1080;&#1089;&#1087;&#1088;&#1072;&#1074;&#1100;&#1090;&#1077; &#1086;&#1096;&#1080;&#1073;&#1082;&#1080; &#1092;&#1086;&#1088;&#1084;&#1099;</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">&#1058;&#1103;&#1075;&#1072;&#1095;</th></tr>
            <tr><td>Truck Plate *</td><td><input type="text" name="truck_plate" value="<?= e($old['truck_plate'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: &#1050;816&#1061;&#1050;147</div><div id="error-truck_plate" class="error"><?= e($errors['truck_plate'] ?? '') ?></div></td></tr>
            <tr><td>Truck Brand *</td><td><input type="text" name="truck_brand" value="<?= e($old['truck_brand'] ?? '') ?>"><div id="error-truck_brand" class="error"><?= e($errors['truck_brand'] ?? '') ?></div></td></tr>
            <tr><td>Truck Model</td><td><input type="text" name="truck_model" value="<?= e($old['truck_model'] ?? '') ?>"><div id="error-truck_model" class="error"><?= e($errors['truck_model'] ?? '') ?></div></td></tr>
            <tr><td>Truck VIN *</td><td><input type="text" name="truck_vin" value="<?= e($old['truck_vin'] ?? '') ?>"><div class="form-hint">17 &#1089;&#1080;&#1084;&#1074;&#1086;&#1083;&#1086;&#1074;</div><div id="error-truck_vin" class="error"><?= e($errors['truck_vin'] ?? '') ?></div></td></tr>
            <tr><td>Truck Load Capacity (tons) *</td><td><input type="text" name="truck_load_capacity" value="<?= e($old['truck_load_capacity'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 20,5</div><div id="error-truck_load_capacity" class="error"><?= e($errors['truck_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Truck Body Volume (m3) *</td><td><input type="text" name="truck_body_volume" value="<?= e($old['truck_body_volume'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 90,5</div><div id="error-truck_body_volume" class="error"><?= e($errors['truck_body_volume'] ?? '') ?></div></td></tr>

            <tr>
                <td colspan="2">
                    <button type="button" class="btn btn-secondary" id="toggleTrailerSection">&#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1080;&#1090;&#1100; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077; &#1087;&#1086;&#1083;&#1091;&#1087;&#1088;&#1080;&#1094;&#1077;&#1087;&#1072;</button>
                </td>
            </tr>
        </table>

        <table class="form-table" id="trailerSection" style="display:none; margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">&#1055;&#1088;&#1080;&#1094;&#1077;&#1087; / &#1087;&#1086;&#1083;&#1091;&#1087;&#1088;&#1080;&#1094;&#1077;&#1087;</th></tr>
            <tr><td>Trailer Plate</td><td><input type="text" name="trailer_plate" value="<?= e($old['trailer_plate'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: &#1042;&#1050;432947</div><div id="error-trailer_plate" class="error"><?= e($errors['trailer_plate'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Brand</td><td><input type="text" name="trailer_brand" value="<?= e($old['trailer_brand'] ?? '') ?>"><div id="error-trailer_brand" class="error"><?= e($errors['trailer_brand'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Model</td><td><input type="text" name="trailer_model" value="<?= e($old['trailer_model'] ?? '') ?>"><div id="error-trailer_model" class="error"><?= e($errors['trailer_model'] ?? '') ?></div></td></tr>
            <tr><td>Trailer VIN</td><td><input type="text" name="trailer_vin" value="<?= e($old['trailer_vin'] ?? '') ?>"><div class="form-hint">17 &#1089;&#1080;&#1084;&#1074;&#1086;&#1083;&#1086;&#1074;</div><div id="error-trailer_vin" class="error"><?= e($errors['trailer_vin'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Load Capacity (tons)</td><td><input type="text" name="trailer_load_capacity" value="<?= e($old['trailer_load_capacity'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 20,5</div><div id="error-trailer_load_capacity" class="error"><?= e($errors['trailer_load_capacity'] ?? '') ?></div></td></tr>
            <tr><td>Trailer Body Volume (m3)</td><td><input type="text" name="trailer_body_volume" value="<?= e($old['trailer_body_volume'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086;: 90,5</div><div id="error-trailer_body_volume" class="error"><?= e($errors['trailer_body_volume'] ?? '') ?></div></td></tr>
        </table>

        <table class="form-table" style="margin-top: 12px;">
            <tr><th colspan="2" class="form-section-title">&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1080; &#1080; &#1089;&#1090;&#1072;&#1090;&#1091;&#1089;</th></tr>
            <tr><td>Status</td><td><select name="status"><option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><div id="error-status" class="error"><?= e($errors['status'] ?? '') ?></div></td></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="3"><?= e($old['comments'] ?? '') ?></textarea><div id="error-comments" class="error"><?= e($errors['comments'] ?? '') ?></div></td></tr>
        </table>

        <div class="form-actions" style="margin-top: 20px;"><button type="submit" class="btn btn-primary">Create Vehicle</button><a href="<?= config('app.url') ?>/vehicles" class="btn">Cancel</a></div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/vehicles-form.js?v=20260512_forms_fix"></script>
</div>

