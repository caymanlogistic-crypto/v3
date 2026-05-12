<?php declare(strict_types=1); ?>

<div class="page form-page">

    <div class="page-header">
        <h1>Create Contractor</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/contractors/store" class="form-card">
        <?= csrf_field() ?>

        <div id="contractorFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">Основные данные</th></tr>
            <tr>
                <td>
                    <span class="form-label"><span class="form-label-text">Name *</span><button type="button" class="form-help-button" data-help="Юридическое наименование компании или ФИО ИП.">?</button></span>
                </td>
                <td>
                    <input type="text" name="name" value="<?= e($old['name'] ?? '') ?>">
                    <div class="form-hint">Пример: ООО "Ромашка"</div>
                    <div id="error-name" class="error"><?= e($errors['name'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form-label"><span class="form-label-text">INN *</span><button type="button" class="form-help-button" data-help="Введите ИНН компании или ИП. Можно вставлять с пробелами, форма нормализует значение.">?</button></span>
                </td>
                <td>
                    <input type="text" name="inn" value="<?= e($old['inn'] ?? '') ?>">
                    <button type="button" id="contractorDadataAutofill" disabled>Автозаполнить</button>
                    <div id="contractorDadataMessage" class="error" style="display:none;"></div>
                    <div class="form-hint">10 цифр для юрлица, 12 цифр для ИП</div>
                    <div id="error-inn" class="error"><?= e($errors['inn'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>KPP</td>
                <td>
                    <input type="text" name="kpp" value="<?= e($old['kpp'] ?? '') ?>">
                    <div class="form-hint">Пример: 773601001</div>
                    <div id="error-kpp" class="error"><?= e($errors['kpp'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>OGRN</td>
                <td>
                    <input type="text" name="ogrn" value="<?= e($old['ogrn'] ?? '') ?>">
                    <div class="form-hint">Пример: 1027700132195</div>
                    <div id="error-ogrn" class="error"><?= e($errors['ogrn'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>OKVED</td>
                <td>
                    <input type="text" name="okved" value="<?= e($old['okved'] ?? '') ?>">
                    <div class="form-hint">Пример: 52.29</div>
                    <div id="error-okved" class="error"><?= e($errors['okved'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Контакты</th></tr>
            <tr>
                <td>Primary Contact Phone</td>
                <td>
                    <input type="text" name="contact1_phone" value="<?= e($old['contact1_phone'] ?? '') ?>">
                    <div class="form-hint">Можно вставить: 8 (999) 123-45-67</div>
                </td>
            </tr>
            <tr>
                <td>Primary Contact Email</td>
                <td>
                    <input type="text" name="contact1_email" value="<?= e($old['contact1_email'] ?? '') ?>">
                    <div class="form-hint">Пример: test@test.ru</div>
                    <div id="error-contact1_email" class="error"><?= e($errors['contact1_email'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Primary Contact Name</td>
                <td>
                    <input type="text" name="contact1_name" value="<?= e($old['contact1_name'] ?? '') ?>">
                    <div class="form-hint">Пример: Иванов Иван Иванович</div>
                    <div id="error-contact1_name" class="error"><?= e($errors['contact1_name'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Адреса</th></tr>
            <tr>
                <td>Legal Address</td>
                <td><textarea name="legal_address" rows="4"><?= e($old['legal_address'] ?? '') ?></textarea></td>
            </tr>
            <tr>
                <td>Actual Address</td>
                <td><textarea name="actual_address" rows="4"><?= e($old['actual_address'] ?? '') ?></textarea></td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Реквизиты</th></tr>
            <tr>
                <td>Director</td>
                <td>
                    <input type="text" name="director" value="<?= e($old['director'] ?? '') ?>">
                    <div id="error-director" class="error"><?= e($errors['director'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Director Post</td>
                <td><input type="text" name="director_post" value="<?= e($old['director_post'] ?? '') ?>"></td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Банк</th></tr>
            <tr>
                <td>Bank Name</td>
                <td>
                    <input type="text" name="bank_name" value="<?= e($old['bank_name'] ?? '') ?>">
                    <div id="error-bank_name" class="error"><?= e($errors['bank_name'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank Account</td>
                <td>
                    <input type="text" name="bank_account" value="<?= e($old['bank_account'] ?? '') ?>">
                    <div class="form-hint">20 цифр</div>
                    <div id="error-bank_account" class="error"><?= e($errors['bank_account'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank Corr Account</td>
                <td>
                    <input type="text" name="bank_corr_account" value="<?= e($old['bank_corr_account'] ?? '') ?>">
                    <div id="error-bank_corr_account" class="error"><?= e($errors['bank_corr_account'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank BIK</td>
                <td>
                    <input type="text" name="bank_bik" value="<?= e($old['bank_bik'] ?? '') ?>">
                    <div class="form-hint">9 цифр</div>
                    <div id="error-bank_bik" class="error"><?= e($errors['bank_bik'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Комментарии и статус</th></tr>
            <tr>
                <td>Comments</td>
                <td><textarea name="comments" rows="4"><?= e($old['comments'] ?? '') ?></textarea></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                        <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                    </select>
                </td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="<?= config('app.url') ?>/contractors" class="btn">Cancel</a>
        </div>
    </form>

    <script>
        window.contractorDadataLookupUrl = "<?= config('app.url') ?>/contractors/dadata/lookup";
    </script>
    <script src="<?= config('app.url') ?>/assets/js/contractors-form.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/contractor-dadata.js"></script>

</div>
