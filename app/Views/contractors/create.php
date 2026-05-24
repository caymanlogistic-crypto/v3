<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Новый контрагент</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/contractors/store" class="entity-form" id="contractorForm">
        <?= csrf_field() ?>
        <div id="contractorFormValidationAlert" class="form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <div class="form-body">
            <!-- Основные данные -->
            <div class="form-section">
                <div class="form-section-title">Основные данные</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-name">Наименование *</label>
                        <input id="field-name" type="text" name="name" class="field-input" value="<?= e($old['name'] ?? '') ?>">
                        <div id="error-name" class="field-msg is-error"><?= e($errors['name'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-inn">ИНН *</label>
                        <input id="field-inn" type="text" name="inn" class="field-input" autocomplete="off" value="<?= e($old['inn'] ?? '') ?>" placeholder="10 или 12 цифр">
                        <div class="form-hint">10 цифр для юрлица, 12 для ИП</div>
                        <div id="error-inn" class="field-msg is-error"><?= e($errors['inn'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-kpp">КПП</label>
                        <input id="field-kpp" type="text" name="kpp" class="field-input" value="<?= e($old['kpp'] ?? '') ?>" placeholder="9 цифр">
                        <div class="form-hint">9 цифр</div>
                        <div id="error-kpp" class="field-msg is-error"><?= e($errors['kpp'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-ogrn">ОГРН</label>
                        <input id="field-ogrn" type="text" name="ogrn" class="field-input" value="<?= e($old['ogrn'] ?? '') ?>" placeholder="13 или 15 цифр">
                        <div class="form-hint">13 цифр для юрлица, 15 для ИП</div>
                        <div id="error-ogrn" class="field-msg is-error"><?= e($errors['ogrn'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-legal_address">Юридический адрес</label>
                        <input id="field-legal_address" type="text" name="legal_address" class="field-input" value="<?= e($old['legal_address'] ?? '') ?>">
                        <div id="error-legal_address" class="field-msg is-error"><?= e($errors['legal_address'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-physical_address">Фактический адрес</label>
                        <input id="field-physical_address" type="text" name="physical_address" class="field-input" value="<?= e($old['physical_address'] ?? '') ?>">
                        <div id="error-physical_address" class="field-msg is-error"><?= e($errors['physical_address'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Контакты -->
            <div class="form-section">
                <div class="form-section-title">Контакты</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-contact_person">Контактное лицо</label>
                        <input id="field-contact_person" type="text" name="contact_person" class="field-input" value="<?= e($old['contact_person'] ?? '') ?>">
                        <div id="error-contact_person" class="field-msg is-error"><?= e($errors['contact_person'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-contact_phone">Телефон</label>
                        <input id="field-contact_phone" type="text" name="contact_phone" class="field-input" value="<?= e($old['contact_phone'] ?? '') ?>">
                        <div id="error-contact_phone" class="field-msg is-error"><?= e($errors['contact_phone'] ?? '') ?></div>
                    </div>

                    <div class="field">
                        <label class="field-label" for="field-contact_email">Email</label>
                        <input id="field-contact_email" type="text" name="contact_email" class="field-input" value="<?= e($old['contact_email'] ?? '') ?>">
                        <div id="error-contact_email" class="field-msg is-error"><?= e($errors['contact_email'] ?? '') ?></div>
                    </div>
                </div>
            </div>

            <!-- Комментарии и статус -->
            <div class="form-section">
                <div class="form-section-title">Комментарии и статус</div>
                <div class="form-grid">
                    <div class="field">
                        <label class="field-label" for="field-status">Status</label>
                        <select id="field-status" name="status" class="field-select">
                            <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                            <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                        </select>
                        <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label class="field-label" for="field-comments">Comments</label>
                        <textarea id="field-comments" name="comments" class="field-textarea" rows="3"><?= e($old['comments'] ?? '') ?></textarea>
                        <div id="error-comments" class="field-msg is-error"><?= e($errors['comments'] ?? '') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="<?= config('app.url') ?>/contractors" class="btn btn-ghost">Отмена</a>
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>

    <script src="<?= config('app.url') ?>/assets/js/contractors-form.js?v=20260512_forms_fix"></script>
</div>