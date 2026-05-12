<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header"><h1>Edit Driver</h1></div>

    <form method="POST" action="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/update" class="form-card" id="driverForm">
        <?= csrf_field() ?>

        <div id="driverFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">&#1055;&#1086;&#1078;&#1072;&#1083;&#1091;&#1081;&#1089;&#1090;&#1072;, &#1080;&#1089;&#1087;&#1088;&#1072;&#1074;&#1100;&#1090;&#1077; &#1086;&#1096;&#1080;&#1073;&#1082;&#1080; &#1092;&#1086;&#1088;&#1084;&#1099;</div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">&#1051;&#1080;&#1095;&#1085;&#1099;&#1077; &#1076;&#1072;&#1085;&#1085;&#1099;&#1077;</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Full Name *</span><button type="button" class="form-help-button" data-help="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1092;&#1072;&#1084;&#1080;&#1083;&#1080;&#1102;, &#1080;&#1084;&#1103; &#1080; &#1086;&#1090;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086; &#1087;&#1086;&#1083;&#1085;&#1086;&#1089;&#1090;&#1100;&#1102;.">?</button></span></td><td><input type="text" name="full_name" value="<?= e($driver['full_name'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: &#1048;&#1074;&#1072;&#1085;&#1086;&#1074; &#1048;&#1074;&#1072;&#1085; &#1048;&#1074;&#1072;&#1085;&#1086;&#1074;&#1080;&#1095;</div><div id="error-full_name" class="error"><?= e($errors['full_name'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Phone *</span><button type="button" class="form-help-button" data-help="&#1052;&#1086;&#1078;&#1085;&#1086; &#1074;&#1089;&#1090;&#1072;&#1074;&#1083;&#1103;&#1090;&#1100; &#1085;&#1086;&#1084;&#1077;&#1088; &#1074; &#1083;&#1102;&#1073;&#1086;&#1084; &#1092;&#1086;&#1088;&#1084;&#1072;&#1090;&#1077;, &#1092;&#1086;&#1088;&#1084;&#1072; &#1085;&#1086;&#1088;&#1084;&#1072;&#1083;&#1080;&#1079;&#1091;&#1077;&#1090; &#1077;&#1075;&#1086;.">?</button></span></td><td><input type="text" name="phone" value="<?= e($driver['phone'] ?? '') ?>"><div class="form-hint">&#1052;&#1086;&#1078;&#1085;&#1086; &#1074;&#1089;&#1090;&#1072;&#1074;&#1080;&#1090;&#1100;: 8 (999) 123-45-67</div><div id="error-phone" class="error"><?= e($errors['phone'] ?? '') ?></div></td></tr>
            <tr><td><span class="form-label"><span class="form-label-text">Email *</span><button type="button" class="form-help-button" data-help="&#1056;&#1072;&#1073;&#1086;&#1095;&#1072;&#1103; &#1087;&#1086;&#1095;&#1090;&#1072; &#1074;&#1086;&#1076;&#1080;&#1090;&#1077;&#1083;&#1103; &#1076;&#1083;&#1103; &#1089;&#1074;&#1103;&#1079;&#1080; &#1080; &#1076;&#1086;&#1082;&#1091;&#1084;&#1077;&#1085;&#1090;&#1086;&#1074;.">?</button></span></td><td><input type="text" name="email" value="<?= e($driver['email'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: test@test.ru</div><div id="error-email" class="error"><?= e($errors['email'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">&#1055;&#1072;&#1089;&#1087;&#1086;&#1088;&#1090;</th></tr>
            <tr><td>Passport Number *</td><td><input type="text" name="passport_number" value="<?= e($driver['passport_number'] ?? '') ?>"><div class="form-hint">10 &#1094;&#1080;&#1092;&#1088;</div><div id="error-passport_number" class="error"><?= e($errors['passport_number'] ?? '') ?></div></td></tr>
            <tr><td>Passport Issue Date *</td><td><input type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="passport_issue_date" value="<?= e($driver['passport_issue_date'] ?? '') ?>"><div id="error-passport_issue_date" class="error"><?= e($errors['passport_issue_date'] ?? '') ?></div></td></tr>
            <tr><td>Passport Issued By *</td><td><input type="text" name="passport_issued_by" value="<?= e($driver['passport_issued_by'] ?? '') ?>"><div id="error-passport_issued_by" class="error"><?= e($errors['passport_issued_by'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">&#1042;&#1086;&#1076;&#1080;&#1090;&#1077;&#1083;&#1100;&#1089;&#1082;&#1086;&#1077; &#1091;&#1076;&#1086;&#1089;&#1090;&#1086;&#1074;&#1077;&#1088;&#1077;&#1085;&#1080;&#1077;</th></tr>
            <tr><td>License Number *</td><td><input type="text" name="license_number" value="<?= e($driver['license_number'] ?? '') ?>"><div class="form-hint">10 &#1094;&#1080;&#1092;&#1088;</div><div id="error-license_number" class="error"><?= e($errors['license_number'] ?? '') ?></div></td></tr>
            <tr><td>License Issue Date *</td><td><input type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="license_issue_date" value="<?= e($driver['license_issue_date'] ?? '') ?>"><div id="error-license_issue_date" class="error"><?= e($errors['license_issue_date'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">&#1057;&#1053;&#1048;&#1051;&#1057;</th></tr>
            <tr><td><span class="form-label"><span class="form-label-text">SNILS *</span><button type="button" class="form-help-button" data-help="&#1057;&#1053;&#1048;&#1051;&#1057; &#1084;&#1086;&#1078;&#1085;&#1086; &#1074;&#1089;&#1090;&#1072;&#1074;&#1083;&#1103;&#1090;&#1100; &#1089; &#1076;&#1077;&#1092;&#1080;&#1089;&#1072;&#1084;&#1080; &#1080;&#1083;&#1080; &#1073;&#1077;&#1079; &#1085;&#1080;&#1093;.">?</button></span></td><td><input type="text" name="snils" value="<?= e($driver['snils'] ?? '') ?>"><div class="form-hint">&#1055;&#1088;&#1080;&#1084;&#1077;&#1088;: 123-456-789 01</div><div id="error-snils" class="error"><?= e($errors['snils'] ?? '') ?></div></td></tr>

            <tr><th colspan="2" class="form-section-title">&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1080; &#1080; &#1089;&#1090;&#1072;&#1090;&#1091;&#1089;</th></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="4"><?= e($driver['comments'] ?? '') ?></textarea></td></tr>
            <tr><td>Status</td><td><select name="status"><option value="active" <?= ($driver['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option><option value="blocked" <?= ($driver['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option><option value="archive" <?= ($driver['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option></select><?php if (!empty($errors['status'])): ?><div class="error"><?= e($errors['status']) ?></div><?php endif; ?></td></tr>
        </table>

        <div class="form-actions" style="margin-top:20px;"><button type="submit" class="btn btn-primary">Save</button><a href="<?= config('app.url') ?>/drivers" class="btn">Cancel</a></div>
    </form>

    <div style="margin-top:40px;" class="form-section">
        <h2 class="form-section-title">&#1044;&#1086;&#1082;&#1091;&#1084;&#1077;&#1085;&#1090;&#1099;</h2>

        <table border="1" width="100%" cellpadding="8">
            <thead><tr><th>Type</th><th>File Name</th><th>Size</th><th>Uploaded</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (empty($files)): ?><tr><td colspan="5">No files uploaded yet.</td></tr><?php endif; ?>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><?= e($file['file_type'] ?? '') ?></td>
                        <td><?= e($file['original_name'] ?? '') ?></td>
                        <td><?= e(isset($file['file_size']) ? number_format((int) $file['file_size'] / 1024, 0, '.', ' ') . ' KB' : '') ?></td>
                        <td><?= e($file['created_at'] ?? '') ?></td>
                        <td><a href="<?= config('app.url') ?>/drivers/files/<?= (int) $file['id'] ?>/download" class="btn">Download</a><form method="POST" action="<?= config('app.url') ?>/drivers/files/<?= (int) $file['id'] ?>/delete" style="display:inline-block; margin-left:8px;"><?= csrf_field() ?><button type="submit" class="btn">Delete</button></form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

                <?php
            $hasPassport = false;
            $hasLicense = false;
            $hasSnils = false;
            foreach ($files as $fileItem) {
                $type = (string) ($fileItem['file_type'] ?? '');
                if ($type === 'passport') { $hasPassport = true; }
                if ($type === 'license') { $hasLicense = true; }
                if ($type === 'snils') { $hasSnils = true; }
            }
        ?>

        <form method="POST" action="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/files/upload" enctype="multipart/form-data" class="driver-file-upload-form">
            <?= csrf_field() ?>

            <div class="upload-grid" style="margin-top:20px;">
                <?php if (!$hasPassport): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">&#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1087;&#1072;&#1089;&#1087;&#1086;&#1088;&#1090;</h3>
                        <input type="file" name="typed_files[passport][]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasLicense): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">&#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1042;&#1059;</h3>
                        <input type="file" name="typed_files[license][]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$hasSnils): ?>
                    <div class="upload-block">
                        <h3 class="upload-title">&#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1057;&#1053;&#1048;&#1051;&#1057;</h3>
                        <input type="file" name="typed_files[snils][]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                    </div>
                <?php endif; ?>

                <div class="upload-block">
                    <h3 class="upload-title">&#1055;&#1088;&#1086;&#1095;&#1080;&#1077; &#1092;&#1072;&#1081;&#1083;&#1099;</h3>
                    <textarea name="comments[other]" rows="3" placeholder="&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1081; (&#1085;&#1077;&#1086;&#1073;&#1103;&#1079;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;)"></textarea>
                    <input type="file" name="typed_files[other][]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                    <div class="error file-error"></div>
                </div>
            </div>

            <div style="margin-top:15px;">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>

    <script src="<?= config('app.url') ?>/assets/js/drivers-form.js?v=20260512_forms_fix"></script>
    <script src="<?= config('app.url') ?>/assets/js/driver-files.js"></script>
</div>



