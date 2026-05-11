<?php declare(strict_types=1); ?>

<div class="page">

    <div class="page-header">
        <h1>Vehicles</h1>
    </div>

    <form method="GET" action="<?= config('app.url') ?>/vehicles">

        <div>
            <input
                type="text"
                name="search"
                placeholder="Search by plate, brand, model, or VIN"
                value="<?= e($search ?? '') ?>"
            >
            <button type="submit" class="btn">Search</button>
            <a href="<?= config('app.url') ?>/vehicles/create" class="btn btn-primary">Create Vehicle</a>
        </div>

    </form>

    <table border="1" width="100%" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Truck Plate</th>
                <th>Truck</th>
                <th>Trailer Plate</th>
                <th>Trailer</th>
                <th>Load Capacity</th>
                <th>Body Volume</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($vehicles)): ?>
                <tr>
                    <td colspan="9">No vehicles found.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($vehicles as $vehicle): ?>
                <tr>
                    <td><?= (int) $vehicle['id'] ?></td>
                    <td><?= e($vehicle['truck_plate'] ?? '') ?></td>
                    <td>
                        <?php if (!empty($vehicle['truck_brand']) || !empty($vehicle['truck_model'])): ?>
                            <?= e($vehicle['truck_brand'] ?? '') ?> <?= e($vehicle['truck_model'] ?? '') ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= e($vehicle['trailer_plate'] ?? '-') ?></td>
                    <td>
                        <?php if (!empty($vehicle['trailer_brand']) || !empty($vehicle['trailer_model'])): ?>
                            <?= e($vehicle['trailer_brand'] ?? '') ?> <?= e($vehicle['trailer_model'] ?? '') ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($vehicle['load_capacity'])): ?>
                            <?= e($vehicle['load_capacity']) ?> т
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($vehicle['body_volume'])): ?>
                            <?= e($vehicle['body_volume']) ?> м³
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= e($vehicle['status'] ?? '') ?></td>
                    <td>
                        <a
                            href="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/edit"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="<?= config('app.url') ?>/vehicles/<?= (int) $vehicle['id'] ?>/delete"
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