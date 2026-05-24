<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Редактирование водителя #<?= (int) ($driver['id'] ?? 0) ?></h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/drivers/<?= (int) ($driver['id'] ?? 0) ?>/update" class="driver-form entity-form" id="driverForm">
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
                        <input id="field-full_name" type="text" name="full_name" class="field-input" value="<?= e($old['full_name'] ?? $driver['full_name'] ?? '') ?>">
                        <div id="error-full_name" class="field-msg is-error"><?= e($errors['full_name'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-phone">Телефон *</label>
                        <input id="field-phone" type="text" name="phone" class="field-input" value="<?= e($old['phone'] ?? $driver['phone'] ?? '') ?>">
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
                        <input id="field-passport_number" type="text" name="passport_number" class="field-input" value="<?= e($old['passport_number'] ?? $driver['passport_number'] ?? '') ?>">
                        <div class="form-hint">10 цифр</div>
                        <div id="error-passport_number" class="field-msg is-error"><?= e($errors['passport_number'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-passport_issue_date">Passport Issue Date *</label>
                        <input id="field-passport_issue_date" type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="passport_issue_date" class="field-input" value="<?= e($old['passport_issue_date'] ?? $driver['passport_issue_date'] ?? '') ?>">
                        <div id="error-passport_issue_date" class="field-msg is-error"><?= e($errors['passport_issue_date'] ?? '') ?></div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-passport_issued_by">Passport Issued By *</label>
                        <input id="field-passport_issued_by" type="text" name="passport_issued_by" class="field-input" value="<?= e($old['passport_issued_by'] ?? $driver['passport_issued_by'] ?? '') ?>">
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
                        <input id="field-license_number" type="text" name="license_number" class="field-input" value="<?= e($old['license_number'] ?? $driver['license_number'] ?? '') ?>">
                        <div class="form-hint">10 цифр</div>
                        <div id="error-license_number" class="field-msg is-error"><?= e($errors['license_number'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-license_issue_date">License Issue Date *</label>
                        <input id="field-license_issue_date" type="text" inputmode="numeric" autocomplete="off" placeholder="01.01.2025" name="license_issue_date" class="field-input" value="<?= e($old['license_issue_date'] ?? $driver['license_issue_date'] ?? '') ?>">
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
                        <input id="field-snils" type="text" name="snils" class="field-input" value="<?= e($old['snils'] ?? $driver['snils'] ?? '') ?>">
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
                        <textarea id="field-comments" name="comments" class="field-textarea" rows="4"><?= e($old['comments'] ?? $driver['comments'] ?? '') ?></textarea>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-status">Status</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($old['status'] ?? $driver['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= ($old['status'] ?? $driver['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                            <option value="archive" <?= ($old['status'] ?? $driver['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/drivers" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>

    <!-- Документы -->
    <div class="form-section" style="margin-top: 32px;">
        <div class="form-section-title">Документы</div>

        <?php
            $hasLicense = false;
            $hasPassport = false;
            $hasSnils = false;
            $hasPhoto = false;
            foreach ($documents as $doc) {
                $fileDocType = $doc['doc_type'] ?? '';
                if ($fileDocType === 'driver_license') $hasLicense = true;
                if ($fileDocType === 'driver_passport') $hasPassport = true;
                if ($fileDocType === 'driver_snils') $hasSnils = true;
                if ($fileDocType === 'driver_photo') $hasPhoto = true;
            }
        ?>

        <div class="upload-grid">
            <?php
            $docTypes = [
                ['slug' => 'driver_license',   'label' => 'Водительское удостоверение', 'has' => $hasLicense],
                ['slug' => 'driver_passport',  'label' => 'Паспорт', 'has' => $hasPassport],
                ['slug' => 'driver_snils',    'label' => 'СНИЛС', 'has' => $hasSnils],
                ['slug' => 'driver_photo',    'label' => 'Фото', 'has' => $hasPhoto],
            ];
            foreach ($docTypes as $dt):
                $slug = $dt['slug'];
                $label = $dt['label'];
            ?>
                <div class="upload-block">
                    <div class="upload-title"><?= e($label) ?></div>
                    <?php
                        $docFile = null;
                        foreach ($documents as $doc) {
                            if (($doc['doc_type'] ?? '') === $slug) {
                                $docFile = $doc;
                                break;
                            }
                        }
                    ?>
                    <?php if ($docFile): ?>
                        <div class="doc-status doc-ok">Загружен</div>
                        <div class="text-sm text-muted mt-2">
                            <?= e($docFile['original_name'] ?? 'Файл') ?><br>
                            <?= e($docFile['created_at'] ?? '') ?>
                        </div>
                        <div class="mt-2">
                            <a href="<?= config('app.url') ?>/documents/<?= (int) ($docFile['id'] ?? 0) ?>/download" class="btn" style="font-size: var(--text-xs); padding: 2px 8px;">Скачать</a>
                        </div>
                    <?php else: ?>
                        <div class="doc-status doc-pending">Не загружен</div>
                    <?php endif; ?>
                    <div class="mt-2">
                        <form method="POST" action="<?= config('app.url') ?>/documents/upload/<?= (int) ($driver['id'] ?? 0) ?>" enctype="multipart/form-data" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="entity_type" value="driver">
                            <input type="hidden" name="doc_type" value="<?= e($slug) ?>">
                            <input type="file" name="file" style="font-size: var(--text-xs);">
                            <button type="submit" class="btn" style="font-size: var(--text-xs); padding: 2px 8px;">Загрузить</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="<?= config('app.url') ?>/assets/js/drivers-form.js?v=20260512_forms_fix"></script>
</div>