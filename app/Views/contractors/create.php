<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Create Contractor</h1>
    </div>

    <form method="POST" action="<?= config('app.url') ?>/contractors/store">
        <?= csrf_field() ?>

        <table class="form-table">

            <tr>
                <td>Name</td>
                <td>

                    <input
                        type="text"
                        name="name"
                        value="<?= e($old['name'] ?? '') ?>"
                    >

                    <?php if (!empty($errors['name'])): ?>
                        <div class="error">
                            <?= e($errors['name']) ?>
                        </div>
                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <td>INN</td>
                <td>

                    <input
                        type="text"
                        name="inn"
                        value="<?= e($old['inn'] ?? '') ?>"
                    >

                    <?php if (!empty($errors['inn'])): ?>
                        <div class="error">
                            <?= e($errors['inn']) ?>
                        </div>
                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <td>KPP</td>
                <td>

                    <input
                        type="text"
                        name="kpp"
                        value="<?= e($old['kpp'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>OGRN</td>
                <td>

                    <input
                        type="text"
                        name="ogrn"
                        value="<?= e($old['ogrn'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>OKVED</td>
                <td>

                    <input
                        type="text"
                        name="okved"
                        value="<?= e($old['okved'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Primary Contact Phone</td>
                <td>

                    <input
                        type="text"
                        name="contact1_phone"
                        value="<?= e($old['contact1_phone'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Primary Contact Email</td>
                <td>

                    <input
                        type="text"
                        name="contact1_email"
                        value="<?= e($old['contact1_email'] ?? '') ?>"
                    >

                    <?php if (!empty($errors['contact1_email'])): ?>
                        <div class="error">
                            <?= e($errors['contact1_email']) ?>
                        </div>
                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <td>Primary Contact Name</td>
                <td>

                    <input
                        type="text"
                        name="contact1_name"
                        value="<?= e($old['contact1_name'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Legal Address</td>
                <td>

                    <textarea
                        name="legal_address"
                        rows="4"
                    ><?= e($old['legal_address'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Actual Address</td>
                <td>

                    <textarea
                        name="actual_address"
                        rows="4"
                    ><?= e($old['actual_address'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Director</td>
                <td>

                    <input
                        type="text"
                        name="director"
                        value="<?= e($old['director'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Director Post</td>
                <td>

                    <input
                        type="text"
                        name="director_post"
                        value="<?= e($old['director_post'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Bank Name</td>
                <td>

                    <input
                        type="text"
                        name="bank_name"
                        value="<?= e($old['bank_name'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Bank Account</td>
                <td>

                    <input
                        type="text"
                        name="bank_account"
                        value="<?= e($old['bank_account'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Bank Corr Account</td>
                <td>

                    <input
                        type="text"
                        name="bank_corr_account"
                        value="<?= e($old['bank_corr_account'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Bank BIK</td>
                <td>

                    <input
                        type="text"
                        name="bank_bik"
                        value="<?= e($old['bank_bik'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Comments</td>
                <td>

                    <textarea
                        name="comments"
                        rows="4"
                    ><?= e($old['comments'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>

                    <select name="status">

                        <option value="active" <?= ($old['status'] ?? '') === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option value="blocked" <?= ($old['status'] ?? '') === 'blocked' ? 'selected' : '' ?>>
                            Blocked
                        </option>

                        <option value="archive" <?= ($old['status'] ?? '') === 'archive' ? 'selected' : '' ?>>
                            Archive
                        </option>

                    </select>

                </td>
            </tr>

        </table>

        <div style="margin-top:20px;">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Create
            </button>

            <a
                href="/v3/public/contractors"
                class="btn"
            >
                Cancel
            </a>

        </div>

    </form>

</div>
