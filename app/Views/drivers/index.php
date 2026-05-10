<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Drivers</h1>
    </div>

    <form method="GET" action="<?= config('app.url') ?>/drivers">

        <div>
            <input
                type="text"
                name="search"
                placeholder="Search by name, phone, or license number"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn">Search</button>
            <a href="<?= config('app.url') ?>/drivers/create" class="btn btn-primary">Create Driver</a>
        </div>

    </form>

    <table border="1" width="100%" cellpadding="8">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>License</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($drivers)): ?>
                <tr>
                    <td colspan="6">No drivers found.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($drivers as $driver): ?>
                <tr>
                    <td><?= e($driver['full_name'] ?? '') ?></td>
                    <td><?= e($driver['license_number'] ?? '') ?></td>
                    <td><?= e($driver['phone'] ?? '') ?></td>
                    <td><?= e($driver['email'] ?? '') ?></td>
                    <td><?= e($driver['status'] ?? '') ?></td>
                    <td>
                        <a
                            href="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/edit"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="<?= config('app.url') ?>/drivers/<?= (int) $driver['id'] ?>/delete"
                            style="display:inline-block; margin-left:8px;"
                        >
                            <?= csrf_field() ?>
                            <button type="submit" class="btn" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (isset($pagination)): ?>
        <div style="margin-top:20px;">

            <?php if (($pagination['has_prev'] ?? false)): ?>

                <a href="?page=<?= (int) $pagination['prev_page'] ?>&search=<?= urlencode($search ?? '') ?>">
                    ← Prev
                </a>

            <?php endif; ?>

            Page
            <?= (int) ($pagination['page'] ?? 1) ?>
            of
            <?= (int) ($pagination['pages'] ?? 1) ?>

            <?php if (($pagination['has_next'] ?? false)): ?>

                <a href="?page=<?= (int) $pagination['next_page'] ?>&search=<?= urlencode($search ?? '') ?>">
                    Next →
                </a>

            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>
