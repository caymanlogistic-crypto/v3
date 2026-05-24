<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>Редактирование контрагента #<?= (int) ($contractor['id'] ?? 0) ?></h1>
    </div>

    <div class="form-layout">
        <div class="form-primary">
            <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) ($contractor['id'] ?? 0) ?>/update" class="entity-form" id="contractorForm">
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
                                <input id="field-name" type="text" name="name" class="field-input" value="<?= e($old['name'] ?? $contractor['name'] ?? '') ?>">
                                <div id="error-name" class="field-msg is-error"><?= e($errors['name'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-inn">ИНН *</label>
                                <input id="field-inn" type="text" name="inn" class="field-input" autocomplete="off" value="<?= e($old['inn'] ?? $contractor['inn'] ?? '') ?>" placeholder="10 или 12 цифр">
                                <div class="form-hint">10 цифр для юрлица, 12 для ИП</div>
                                <div id="error-inn" class="field-msg is-error"><?= e($errors['inn'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-kpp">КПП</label>
                                <input id="field-kpp" type="text" name="kpp" class="field-input" value="<?= e($old['kpp'] ?? $contractor['kpp'] ?? '') ?>" placeholder="9 цифр">
                                <div class="form-hint">9 цифр</div>
                                <div id="error-kpp" class="field-msg is-error"><?= e($errors['kpp'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-ogrn">ОГРН</label>
                                <input id="field-ogrn" type="text" name="ogrn" class="field-input" value="<?= e($old['ogrn'] ?? $contractor['ogrn'] ?? '') ?>" placeholder="13 или 15 цифр">
                                <div class="form-hint">13 цифр для юрлица, 15 для ИП</div>
                                <div id="error-ogrn" class="field-msg is-error"><?= e($errors['ogrn'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-legal_address">Юридический адрес</label>
                                <input id="field-legal_address" type="text" name="legal_address" class="field-input" value="<?= e($old['legal_address'] ?? $contractor['legal_address'] ?? '') ?>">
                                <div id="error-legal_address" class="field-msg is-error"><?= e($errors['legal_address'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-physical_address">Фактический адрес</label>
                                <input id="field-physical_address" type="text" name="physical_address" class="field-input" value="<?= e($old['physical_address'] ?? $contractor['physical_address'] ?? '') ?>">
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
                                <input id="field-contact_person" type="text" name="contact_person" class="field-input" value="<?= e($old['contact_person'] ?? $contractor['contact_person'] ?? '') ?>">
                                <div id="error-contact_person" class="field-msg is-error"><?= e($errors['contact_person'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-contact_phone">Телефон</label>
                                <input id="field-contact_phone" type="text" name="contact_phone" class="field-input" value="<?= e($old['contact_phone'] ?? $contractor['contact_phone'] ?? '') ?>">
                                <div id="error-contact_phone" class="field-msg is-error"><?= e($errors['contact_phone'] ?? '') ?></div>
                            </div>

                            <div class="field">
                                <label class="field-label" for="field-contact_email">Email</label>
                                <input id="field-contact_email" type="text" name="contact_email" class="field-input" value="<?= e($old['contact_email'] ?? $contractor['contact_email'] ?? '') ?>">
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
                                    <option value="active" <?= ($old['status'] ?? $contractor['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="blocked" <?= ($old['status'] ?? $contractor['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>Blocked</option>
                                    <option value="archive" <?= ($old['status'] ?? $contractor['status'] ?? '') === 'archive' ? 'selected' : '' ?>>Archive</option>
                                </select>
                                <div id="error-status" class="field-msg is-error"><?= e($errors['status'] ?? '') ?></div>
                            </div>

                            <div class="field" style="grid-column: 1 / -1;">
                                <label class="field-label" for="field-comments">Comments</label>
                                <textarea id="field-comments" name="comments" class="field-textarea" rows="3"><?= e($old['comments'] ?? $contractor['comments'] ?? '') ?></textarea>
                                <div id="error-comments" class="field-msg is-error"><?= e($errors['comments'] ?? '') ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?= config('app.url') ?>/contractors" class="btn btn-ghost">Отмена</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>

            <!-- Документы -->
            <div class="form-section" style="margin-top: 24px;">
                <div class="form-section-title">Документы</div>

                <!-- Кнопка загрузки документа -->
                <div class="mb-3">
                    <a href="<?= config('app.url') ?>/contractors/<?= (int) ($contractor['id'] ?? 0) ?>/documents/create" class="btn btn-primary">Добавить документ</a>
                </div>

                <table class="table" style="width:105%;">
                    <thead><tr><th>Название</th><th>Тип</th><th>Дата загрузки</th><th>Комментарий</th><th>Действия</th></tr></thead>
                    <tbody>
                        <?php foreach (($contractor['documents'] ?? []) as $doc): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($doc['file_path'])): ?>
                                        <a href="<?= config('app.url') ?>/storage/<?= e($doc['file_path'] ?? '') ?>" target="_blank"><?= e($doc['title'] ?? $doc['original_name'] ?? 'Без названия') ?></a>
                                    <?php else: ?>
                                        <?= e($doc['title'] ?? $doc['original_name'] ?? 'Без названия') ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= e($doc['doc_type'] ?? '') ?></td>
                                <td><?= e($doc['created_at'] ?? '') ?></td>
                                <td><?= e($doc['comment'] ?? '') ?></td>
                                <td>
                                    <a href="<?= config('app.url') ?>/contractors/<?= (int) ($contractor['id'] ?? 0) ?>/documents/<?= (int) ($doc['id'] ?? 0) ?>/edit" class="row-btn">Изменить</a>
                                    <form method="POST" action="<?= config('app.url') ?>/contractors/<?= (int) ($contractor['id'] ?? 0) ?>/documents/<?= (int) ($doc['id'] ?? 0) ?>/delete" style="display:inline; margin-left: 8px;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="row-btn">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($contractor['documents'] ?? [])): ?>
                            <tr><td colspan="5" class="text-muted" style="text-align:center;">Нет документов</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- DaData sidebar -->
        <div class="form-sidebar">
            <div class="inspector">
                <div class="inspector-header">
                    <div class="insp-name">DaData</div>
                    <div class="insp-sub">Проверка контрагента</div>
                </div>
                <div class="inspector-body">
                    <div class="dadata-block" id="dadataBlock">
                        <!-- Заполняется через JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= config('app.url') ?>/assets/js/contractors-form.js?v=20260512_forms_fix"></script>
</div>