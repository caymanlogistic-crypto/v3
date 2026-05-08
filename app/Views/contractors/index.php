<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">

        <h1>Contractors</h1>

        <div style="margin-top:20px;">

            <form method="GET" action="/v3/public/contractors">

                <input
                    type="text"
                    name="search"
                    value="<?= e($search ?? '') ?>"
                    placeholder="Search contractor..."
                >

                <button type="submit">
                    Search
                </button>

                <a href="/v3/public/contractors/create">
                    Create Contractor
                </a>

            </form>

        </div>

    </div>

    <table border="1" width="100%" cellpadding="10">

        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>INN</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>

        </thead>

        <tbody>

        <?php foreach ($contractors as $contractor): ?>

            <tr>

                <td>
                    <?= (int) $contractor['id'] ?>
                </td>

                <td>
                    <?= e($contractor['name']) ?>
                </td>

                <td>
                    <?= e($contractor['inn']) ?>
                </td>

                <td>
                    <?= e($contractor['contact1_phone']) ?>
                </td>

                <td>
                    <?= e($contractor['contact1_email']) ?>
                </td>

                <td>
                    <?= e($contractor['status']) ?>
                </td>

                <td>

                    <a href="/v3/public/contractors/<?= (int) $contractor['id'] ?>/edit">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="/v3/public/contractors/<?= (int) $contractor['id'] ?>/delete"
                        style="display:inline;"
                    >

                        <button
                            type="submit"
                            onclick="return confirm('Delete contractor?')"
                        >
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

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

</div>
