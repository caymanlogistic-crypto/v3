<?php declare(strict_types=1); ?>

<div class="page form-page">

    <div class="page-header">
        <h1>Edit Contractor</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/update" class="form-card">
        <?= csrf_field() ?>

        <div id="contractorFormValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <table class="form-table">
            <tr><th colspan="2" class="form-section-title">Основные данные</th></tr>
            <tr>
                <td>
                    <span class="form-label"><span class="form-label-text">Name</span><button type="button" class="form-help-button" data-help="Юридическое наименование компании или ФИО ИП.">?</button></span>
                </td>
                <td>
                    <input type="text" name="name" value="<?= e($contractor['name'] ?? '') ?>">
                    <div class="form-hint">Пример: ООО "Ромашка"</div>
                    <div id="error-name" class="error"><?= e($errors['name'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form-label"><span class="form-label-text">INN</span><button type="button" class="form-help-button" data-help="Введите ИНН компании или ИП. Можно вставлять с пробелами, форма нормализует значение.">?</button></span>
                </td>
                <td>
                    <input type="text" name="inn" value="<?= e($contractor['inn'] ?? '') ?>">
                    <button type="button" id="contractorDadataAutofill" disabled>Автозаполнить</button>
                    <div id="contractorDadataMessage" class="error" style="display:none;"></div>
                    <div class="form-hint">10 цифр для юрлица, 12 цифр для ИП</div>
                    <div id="error-inn" class="error"><?= e($errors['inn'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>KPP</td>
                <td>
                    <input type="text" name="kpp" value="<?= e($contractor['kpp'] ?? '') ?>">
                    <div class="form-hint">Пример: 773601001</div>
                    <div id="error-kpp" class="error"><?= e($errors['kpp'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>OGRN</td>
                <td>
                    <input type="text" name="ogrn" value="<?= e($contractor['ogrn'] ?? '') ?>">
                    <div class="form-hint">Пример: 1027700132195</div>
                    <div id="error-ogrn" class="error"><?= e($errors['ogrn'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>OKVED</td>
                <td>
                    <input type="text" name="okved" value="<?= e($contractor['okved'] ?? '') ?>">
                    <div class="form-hint">Пример: 52.29</div>
                    <div id="error-okved" class="error"><?= e($errors['okved'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Контакты</th></tr>
            <tr>
                <td>Primary Contact Phone</td>
                <td>
                    <input type="text" name="contact1_phone" value="<?= e($contractor['contact1_phone'] ?? '') ?>">
                    <div class="form-hint">Можно вставить: 8 (999) 123-45-67</div>
                </td>
            </tr>
            <tr>
                <td>Primary Contact Email</td>
                <td>
                    <input type="text" name="contact1_email" value="<?= e($contractor['contact1_email'] ?? '') ?>">
                    <div class="form-hint">Пример: test@test.ru</div>
                    <div id="error-contact1_email" class="error"><?= e($errors['contact1_email'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Primary Contact Name</td>
                <td>
                    <input type="text" name="contact1_name" value="<?= e($contractor['contact1_name'] ?? '') ?>">
                    <div class="form-hint">Пример: Иванов Иван Иванович</div>
                    <div id="error-contact1_name" class="error"><?= e($errors['contact1_name'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Адреса</th></tr>
            <tr>
                <td>Legal Address</td>
                <td><textarea name="legal_address" rows="4"><?= e($contractor['legal_address'] ?? '') ?></textarea></td>
            </tr>
            <tr>
                <td>Actual Address</td>
                <td><textarea name="actual_address" rows="4"><?= e($contractor['actual_address'] ?? '') ?></textarea></td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Реквизиты</th></tr>
            <tr>
                <td>Director</td>
                <td>
                    <input type="text" name="director" value="<?= e($contractor['director'] ?? '') ?>">
                    <div id="error-director" class="error"><?= e($errors['director'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Director Post</td>
                <td><input type="text" name="director_post" value="<?= e($contractor['director_post'] ?? '') ?>"></td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Банк</th></tr>
            <tr>
                <td>Bank Name</td>
                <td>
                    <input type="text" name="bank_name" value="<?= e($contractor['bank_name'] ?? '') ?>">
                    <div id="error-bank_name" class="error"><?= e($errors['bank_name'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank Account</td>
                <td>
                    <input type="text" name="bank_account" value="<?= e($contractor['bank_account'] ?? '') ?>">
                    <div class="form-hint">20 цифр</div>
                    <div id="error-bank_account" class="error"><?= e($errors['bank_account'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank Corr Account</td>
                <td>
                    <input type="text" name="bank_corr_account" value="<?= e($contractor['bank_corr_account'] ?? '') ?>">
                    <div id="error-bank_corr_account" class="error"><?= e($errors['bank_corr_account'] ?? '') ?></div>
                </td>
            </tr>
            <tr>
                <td>Bank BIK</td>
                <td>
                    <input type="text" name="bank_bik" value="<?= e($contractor['bank_bik'] ?? '') ?>">
                    <div class="form-hint">9 цифр</div>
                    <div id="error-bank_bik" class="error"><?= e($errors['bank_bik'] ?? '') ?></div>
                </td>
            </tr>

            <tr><th colspan="2" class="form-section-title">Комментарии и статус</th></tr>
            <tr>
                <td>Comments</td>
                <td><textarea name="comments" rows="4"><?= e($contractor['comments'] ?? '') ?></textarea></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="status">
                        <option value="active" <?= ($contractor['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="blocked" <?= ($contractor['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                        <option value="archive" <?= ($contractor['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                    </select>
                    <?php if (!empty($errors['status'])): ?>
                        <div class="error"><?= e($errors['status']) ?></div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?= config('app.url') ?>/contractors" class="btn">Cancel</a>
        </div>

    </form>

    <script>
        window.contractorDadataLookupUrl = "<?= config('app.url') ?>/contractors/dadata/lookup";
    </script>
    <script src="<?= config('app.url') ?>/assets/js/contractors-form.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/contractor-contacts-form.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/contractor-files.js"></script>
    <script src="<?= config('app.url') ?>/assets/js/contractor-dadata.js"></script>

    <div style="margin-top:40px;" class="form-section">

        <div id="contractorContactValidationAlert" class="error form-alert form-alert-error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки контакта
        </div>

        <h2 class="form-section-title">Contacts</h2>

        <table border="1" width="100%" cellpadding="8">
            <thead>
                <tr>
                    <th>Full name</th>
                    <th>Role</th>
                    <th>Position</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Flags</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($contacts)): ?>
                    <tr><td colspan="8">No contacts added yet.</td></tr>
                <?php endif; ?>

                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td>
                            <form method="POST" action="<?= config('app.url') ?>/contractors/contacts/<?= (int) $contact['id'] ?>/update">
                                <?= csrf_field() ?>
                                <input type="text" name="full_name" value="<?= e($contact['full_name'] ?? '') ?>">
                                <div class="error contact-error-full_name"></div>
                                <input type="hidden" name="comment" value="<?= e($contact['comment'] ?? '') ?>">
                        </td>
                        <td>
                                <select name="role">
                                    <option value="director" <?= ($contact['role'] ?? '') === 'director' ? 'selected' : '' ?>>Director</option>
                                    <option value="manager" <?= ($contact['role'] ?? '') === 'manager' ? 'selected' : '' ?>>Manager</option>
                                    <option value="accounting" <?= ($contact['role'] ?? '') === 'accounting' ? 'selected' : '' ?>>Accounting</option>
                                    <option value="dispatcher" <?= ($contact['role'] ?? '') === 'dispatcher' ? 'selected' : '' ?>>Dispatcher</option>
                                    <option value="owner" <?= ($contact['role'] ?? '') === 'owner' ? 'selected' : '' ?>>Owner</option>
                                    <option value="other" <?= ($contact['role'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                        </td>
                        <td><input type="text" name="position" value="<?= e($contact['position'] ?? '') ?>"></td>
                        <td><input type="text" name="phone" value="<?= e($contact['phone'] ?? '') ?>"></td>
                        <td>
                            <input type="text" name="email" value="<?= e($contact['email'] ?? '') ?>">
                            <div class="error contact-error-email"></div>
                        </td>
                        <td>
                            <label><input type="checkbox" name="is_primary" value="1" <?= !empty($contact['is_primary']) ? 'checked' : '' ?>> Primary</label><br>
                            <label><input type="checkbox" name="is_payment_recipient" value="1" <?= !empty($contact['is_payment_recipient']) ? 'checked' : '' ?>> Payment</label><br>
                            <label><input type="checkbox" name="is_document_recipient" value="1" <?= !empty($contact['is_document_recipient']) ? 'checked' : '' ?>> Documents</label>
                        </td>
                        <td>
                            <select name="status">
                                <option value="active" <?= ($contact['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= ($contact['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form method="POST" action="<?= config('app.url') ?>/contractors/contacts/<?= (int) $contact['id'] ?>/delete" style="margin-top:8px;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="margin-top:20px;">
            <h3 class="form-section-title">Add Contact</h3>
            <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/contacts/store">
                <?= csrf_field() ?>
                <table class="form-table">
                    <tr><td>Full name</td><td><input type="text" name="full_name" value=""><div class="error contact-error-full_name"></div></td></tr>
                    <tr><td>Role</td><td><select name="role"><option value="director">Director</option><option value="manager">Manager</option><option value="accounting">Accounting</option><option value="dispatcher">Dispatcher</option><option value="owner">Owner</option><option value="other">Other</option></select></td></tr>
                    <tr><td>Position</td><td><input type="text" name="position" value=""></td></tr>
                    <tr><td>Phone</td><td><input type="text" name="phone" value=""></td></tr>
                    <tr><td>Email</td><td><input type="text" name="email" value=""><div class="error contact-error-email"></div></td></tr>
                    <tr><td>Flags</td><td><label><input type="checkbox" name="is_primary" value="1"> Primary</label><br><label><input type="checkbox" name="is_payment_recipient" value="1"> Payment recipient</label><br><label><input type="checkbox" name="is_document_recipient" value="1"> Document recipient</label></td></tr>
                    <tr><td>Status</td><td><select name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></td></tr>
                    <tr><td>Comment</td><td><textarea name="comment" rows="3"></textarea></td></tr>
                </table>
                <div style="margin-top:15px;"><button type="submit" class="btn btn-primary">Add Contact</button></div>
            </form>
        </div>

        <div style="margin-top:40px;" class="form-section">
            <h2 class="form-section-title">Files</h2>
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
                            <td>
                                <a href="<?= config('app.url') ?>/contractors/files/<?= (int) $file['id'] ?>/download" class="btn">Download</a>
                                <form method="POST" action="<?= config('app.url') ?>/contractors/files/<?= (int) $file['id'] ?>/delete" style="display:inline-block; margin-left:8px;"><?= csrf_field() ?><button type="submit" class="btn">Delete</button></form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="upload-grid" style="margin-top:20px;">
                <div class="upload-block">
                    <h3 class="upload-title">Загрузить договор</h3>
                    <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/files/upload" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="file_type" value="contract">
                        <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                        <div style="margin-top:15px;"><button type="submit" class="btn btn-primary">Upload</button></div>
                    </form>
                </div>

                <div class="upload-block">
                    <h3 class="upload-title">Загрузить карточку компании</h3>
                    <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/files/upload" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="file_type" value="company_card">
                        <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                        <div style="margin-top:15px;"><button type="submit" class="btn btn-primary">Upload</button></div>
                    </form>
                </div>

                <div class="upload-block">
                    <h3 class="upload-title">Прочие файлы</h3>
                    <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) $contractor['id'] ?>/files/upload" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="file_type" value="other">
                        <textarea name="comment" rows="3" placeholder="Комментарий (необязательно)"></textarea>
                        <input type="file" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp">
                        <div class="error file-error"></div>
                        <div style="margin-top:15px;"><button type="submit" class="btn btn-primary">Upload</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

