<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Новый водитель</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/drivers/store" class="driver-form entity-form" id="driverForm">
        <?= csrf_field() ?>
        <div id="driverFormValidationAlert" class="form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <div class="form-body">
            <!-- Основные данные -->
            <div class="form-section">
                <div class="form-section-title">Основные данные</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-full_name">ФИО *</label>
                        <input id="field-full_name" type="text" name="full_name" class="field-input" value="<?= e($old['full_name'] ?? '') ?>">
                        <div id="error-full_name" class="field-msg is-error"><?= e($errors['full_name'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-phone">Телефон *</label>
                        <input id="field-phone" type="text" name="phone" class="field-input" value="<?= e($old['phone'] ?? '') ?>">
                        <div class="form-hint">Пример: +7 912 345-67-89, 89123456789</div>
                        <div id="error-phone" class="field-msg is-error"><?= e($errors['phone'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Паспорт -->
            <div class="form-section">
                <div class="form-section-title">Паспорт</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-passport_number">Passport Number *</label>
                        <input id="field-passport_number" type="text" name="passport_number" class="field-input" value="<?= e($old['passport_number'] ?? '') ?>">
                        <div class="form-hint">10 цифр</div>
                        <div id="error-passport_number" class="field-msg is-error"><?= e($errors['passport_number'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-passport_issue_date">Passport Issue Date *</label>
                        <input id="field-passport_issue_date" type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="passport_issue_date" class="field-input" value="<?= e($old['passport_issue_date'] ?? '') ?>">
                        <div id="error-passport_issue_date" class="field-msg is-error"><?= e($errors['passport_issue_date'] ?? '') ?></div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-passport_issued_by">Passport Issued By *</label>
                        <input id="field-passport_issued_by" type="text" name="passport_issued_by" class="field-input" value="<?= e($old['passport_issued_by'] ?? '') ?>">
                        <div id="error-passport_issued_by" class="field-msg is-error"><?= e($errors['passport_issued_by'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Водительское удостоверение -->
            <div class="form-section">
                <div class="form-section-title">Водительское удостоверение</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-license_number">License Number *</label>
                        <input id="field-license_number" type="text" name="license_number" class="field-input" value="<?= e($old['license_number'] ?? '') ?>">
                        <div class="form-hint">10 цифр</div>
                        <div id="error-license_number" class="field-msg is-error"><?= e($errors['license_number'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-license_issue_date">License Issue Date *</label>
                        <input id="field-license_issue_date" type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="license_issue_date" class="field-input" value="<?= e($old['license_issue_date'] ?? '') ?>">
                        <div id="error-license_issue_date" class="field-msg is-error"><?= e($errors['license_issue_date'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- СНИЛС -->
            <div class="form-section">
                <div class="form-section-title">СНИЛС</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-snils">
                            <span class="field-label-text">SNILS *</span>
                            <button type="button" class="form-help-button" data-help="СНИЛС можно вставлять с дефисами или без них.">?</button>
                        </label>
                        <input id="field-snils" type="text" name="snils" class="field-input" value="<?= e($old['snils'] ?? '') ?>">
                        <div class="form-hint">Пример: 123-456-789 01</div>
                        <div id="error-snils" class="field-msg is-error"><?= e($errors['snils'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Комментарии и статус -->
            <div class="form-section">
                <div class="form-section-title">Комментарии и статус</div>
                <div class="form-grid">
                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-comments">Comments</label>
                        <textarea id="field-comments" name="comments" class="field-textarea" rows="4"><?= e($old['comments'] ?? '') ?></textarea>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-status">Status</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                            <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/drivers" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/drivers-form.js?v=20260512_forms_fix"></script>
</div>