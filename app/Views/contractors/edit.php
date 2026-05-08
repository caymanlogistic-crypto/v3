<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Edit Contractor</h1>
    </div>

    <form method="POST" action="/v3/public/contractors/<?= (int) $contractor['id'] ?>/update">

        <table class="form-table">

            <tr>
                <td>Name</td>
                <td>

                    <input
                        type="text"
                        name="name"
                        value="<?= e($contractor['name'] ?? '') ?>"
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
                        value="<?= e($contractor['inn'] ?? '') ?>"
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
                        value="<?= e($contractor['contact1_phone'] ?? '') ?>"
                    >

                </td>
            </tr>

            <tr>
                <td>Email</td>
                <td>

                    <input
                        type="text"
                        name="contact1_email"
                        value="<?= e($contractor['contact1_email'] ?? '') ?>"
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
                    ><?= e($contractor['legal_address'] ?? '') ?></textarea>

                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>

                    <select name="status">

                        <option
                            value="active"
                            <?= ($contractor['status'] ?? '') === 'active'
                                ? 'selected'
                                : '' ?>
                        >
                            Active
                        </option>

                        <option
                            value="blocked"
                            <?= ($contractor['status'] ?? '') === 'blocked'
                                ? 'selected'
                                : '' ?>
                        >
                            Blocked
                        </option>

                        <option
                            value="archive"
                            <?= ($contractor['status'] ?? '') === 'archive'
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
                href="/v3/public/contractors"
                class="btn"
            >
                Cancel
            </a>

        </div>

    </form>

</div>
