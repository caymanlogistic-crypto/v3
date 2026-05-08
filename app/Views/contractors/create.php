<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Create Contractor</h1>
    </div>

    <form method="POST" action="/v3/public/contractors/store">

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
                <td>Phone</td>
                <td>

                    <input
                        type="text"
                        name="contact1_phone"
                        value="<?= e($old['contact1_phone'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Email</td>
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
                <td>Legal Address</td>
                <td>

                    <textarea
                        name="legal_address"
                        rows="4"
                    ><?= e($old['legal_address'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>

                    <select name="status">

                        <option value="active">
                            Active
                        </option>

                        <option value="blocked">
                            Blocked
                        </option>

                        <option value="archive">
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
