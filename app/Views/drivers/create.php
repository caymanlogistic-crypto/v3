<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Create Driver</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/drivers/store" class="form-card">
        <?= csrf_field() ?>

        <div id="driverFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            РџРѕР¶Р°Р»СѓР№СЃС‚Р°, РёСЃРїСЂР°РІСЊС‚Рµ РѕС€РёР±РєРё С„РѕСЂРјС‹
        </div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">Р›РёС‡РЅС‹Рµ РґР°РЅРЅС‹Рµ</th></tr>
            <tr>
                <td><span class="form-label"><span class="form-label-text">Full Name</span><button type="button" class="form-help-button" data-help="Р’РІРµРґРёС‚Рµ С„Р°РјРёР»РёСЋ, РёРјСЏ Рё РѕС‚С‡РµСЃС‚РІРѕ РїРѕР»РЅРѕСЃС‚СЊСЋ.">?</button></span></td>
                <td>
                    <input type="text" name="full_name" value="<?= e($old['full_name'] ?? '') ?>">
                    <div class="form-hint">РџСЂРёРјРµСЂ: РРІР°РЅРѕРІ РРІР°РЅ РРІР°РЅРѕРІРёС‡</div>
                    <div id="error-full_name" class="error"><?= e($errors['full_name'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td><span class="form-label"><span class="form-label-text">Phone</span><button type="button" class="form-help-button" data-help="РњРѕР¶РЅРѕ РІСЃС‚Р°РІР»СЏС‚СЊ РЅРѕРјРµСЂ РІ Р»СЋР±РѕРј С„РѕСЂРјР°С‚Рµ, С„РѕСЂРјР° РЅРѕСЂРјР°Р»РёР·СѓРµС‚ РµРіРѕ.">?</button></span></td>
                <td>
                    <input type="text" name="phone" value="<?= e($old['phone'] ?? '') ?>">
                    <div class="form-hint">РњРѕР¶РЅРѕ РІСЃС‚Р°РІРёС‚СЊ: 8 (999) 123-45-67</div>
                    <div id="error-phone" class="error"><?= e($errors['phone'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td><span class="form-label"><span class="form-label-text">Email</span><button type="button" class="form-help-button" data-help="Р Р°Р±РѕС‡Р°СЏ РїРѕС‡С‚Р° РІРѕРґРёС‚РµР»СЏ РґР»СЏ СЃРІСЏР·Рё Рё РґРѕРєСѓРјРµРЅС‚РѕРІ.">?</button></span></td>
                <td>
                    <input type="text" name="email" value="<?= e($old['email'] ?? '') ?>">
                    <div class="form-hint">РџСЂРёРјРµСЂ: test@test.ru</div>
                    <div id="error-email" class="error"><?= e($errors['email'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">РџР°СЃРїРѕСЂС‚</th></tr>
            <tr>
                <td>Passport Number</td>
                <td>
                    <input type="text" name="passport_number" value="<?= e($old['passport_number'] ?? '') ?>">
                    <div class="form-hint">10 С†РёС„СЂ</div>
                    <div id="error-passport_number" class="error"><?= e($errors['passport_number'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Passport Issue Date</td>
                <td>
                    <input type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="passport_issue_date" value="<?= e($old['passport_issue_date'] ?? '') ?>">
                    <div id="error-passport_issue_date" class="error"><?= e($errors['passport_issue_date'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Passport Issued By</td>
                <td><input type="text" name="passport_issued_by" value="<?= e($old['passport_issued_by'] ?? '') ?>"></td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Р’РѕРґРёС‚РµР»СЊСЃРєРѕРµ СѓРґРѕСЃС‚РѕРІРµСЂРµРЅРёРµ</th></tr>
            <tr>
                <td>License Number</td>
                <td>
                    <input type="text" name="license_number" value="<?= e($old['license_number'] ?? '') ?>">
                    <div class="form-hint">10 С†РёС„СЂ</div>
                    <div id="error-license_number" class="error"><?= e($errors['license_number'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>License Issue Date</td>
                <td>
                    <input type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="license_issue_date" value="<?= e($old['license_issue_date'] ?? '') ?>">
                    <div id="error-license_issue_date" class="error"><?= e($errors['license_issue_date'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">РЎРќРР›РЎ</th></tr>
            <tr>
                <td><span class="form-label"><span class="form-label-text">SNILS</span><button type="button" class="form-help-button" data-help="РЎРќРР›РЎ РјРѕР¶РЅРѕ РІСЃС‚Р°РІР»СЏС‚СЊ СЃ РґРµС„РёСЃР°РјРё РёР»Рё Р±РµР· РЅРёС….">?</button></span></td>
                <td>
                    <input type="text" name="snils" value="<?= e($old['snils'] ?? '') ?>">
                    <div class="form-hint">РџСЂРёРјРµСЂ: 123-456-789 01</div>
                    <div id="error-snils" class="error"><?= e($errors['snils'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">РљРѕРјРјРµРЅС‚Р°СЂРёРё Рё СЃС‚Р°С‚СѓСЃ</th></tr>
            <tr><td>Comments</td><td><textarea name="comments" rows="4"><?= e($old['comments'] ?? '') ?></textarea></td></tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                        <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                    </select>
                    <?php if (!empty($errors['status'])): ?><div class="error"><?= e($errors['status']) ?></div><?php endif; ?>
                </td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="<?= config('app.url') ?>/drivers" class="btn">Cancel</a>
        </div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/drivers-form.js"></script>
</div>
