<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Edit Driver</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/update">
        <?= csrf_field() ?>

        <div id="driverFormValidationAlert" class="error" style="display:none; margin-bottom: 16px;">
            Пожалуйста, исправьте ошибки формы
        </div>

        <table class="form-table">

            <tr>
                <td>Full Name</td>
                <td>

                    <input
                        type="text"
                        name="full_name"
                        value="<?= e($driver['full_name'] ?? '') ?>"
                    >

                    <div id="error-full_name" class="error">
                        <?= e($errors['full_name'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Phone</td>
                <td>

                    <input
                        type="text"
                        name="phone"
                        value="<?= e($driver['phone'] ?? '') ?>"
                    >

                    <div id="error-phone" class="error">
                        <?= e($errors['phone'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Email</td>
                <td>

                    <input
                        type="text"
                        name="email"
                        value="<?= e($driver['email'] ?? '') ?>"
                    >

                    <div id="error-email" class="error">
                        <?= e($errors['email'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Passport Number</td>
                <td>

                    <input
                        type="text"
                        name="passport_number"
                        value="<?= e($driver['passport_number'] ?? '') ?>"
                    >

                    <div id="error-passport_number" class="error">
                        <?= e($errors['passport_number'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Passport Issue Date</td>
                <td>

                    <input
                        type="date"
                        name="passport_issue_date"
                        value="<?= e($driver['passport_issue_date'] ?? '') ?>"
                    >

                    <div id="error-passport_issue_date" class="error">
                        <?= e($errors['passport_issue_date'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Passport Issued By</td>
                <td>

                    <input
                        type="text"
                        name="passport_issued_by"
                        value="<?= e($driver['passport_issued_by'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>License Number</td>
                <td>

                    <input
                        type="text"
                        name="license_number"
                        value="<?= e($driver['license_number'] ?? '') ?>"
                    >

                    <div id="error-license_number" class="error">
                        <?= e($errors['license_number'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>License Issue Date</td>
                <td>

                    <input
                        type="date"
                        name="license_issue_date"
                        value="<?= e($driver['license_issue_date'] ?? '') ?>"
                    >

                    <div id="error-license_issue_date" class="error">
                        <?= e($errors['license_issue_date'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>SNILS</td>
                <td>

                    <input
                        type="text"
                        name="snils"
                        value="<?= e($driver['snils'] ?? '') ?>"
                    >

                    <div id="error-snils" class="error">
                        <?= e($errors['snils'] ?? '') ?>
                    </div>

                </td>
            </tr>

            <tr>
                <td>Comments</td>
                <td>

                    <textarea
                        name="comments"
                        rows="4"
                    ><?= e($driver['comments'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>

                    <select name="status">

                        <option
                            value="active"
                            <?= ($driver['status'] ?? '') === 'active'
                                ? 'selected'
                                : '' ?>
                        >
                            Active
                        </option>

                        <option
                            value="blocked"
                            <?= ($driver['status'] ?? '') === 'blocked'
                                ? 'selected'
                                : '' ?>
                        >
                            Blocked
                        </option>

                        <option
                            value="archive"
                            <?= ($driver['status'] ?? '') === 'archive'
                                ? 'selected'
                                : '' ?>
                        >
                            Archive
                        </option>

                    </select>

                    <?php if (!empty($errors['status'])): ?>
                        <div class="error">
                            <?= e($errors['status']) ?>
                        </div>
                    <?php endif; ?>

                </td>
            </tr>

        </table>

        <div style="margin-top:20px;">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save
            </button>

            <a
                href="<?= config('app.url') ?>/drivers"
                class="btn"
            >
                Cancel
            </a>

        </div>

    </form>

    <script src="<?= config('app.url') ?>/assets/js/drivers-form.js"></script>

</div>
