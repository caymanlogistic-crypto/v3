<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1><?= "\u{041D}\u{043E}\u{0432}\u{0430}\u{044F} \u{0441}\u{0432}\u{044F}\u{0437}\u{043A}\u{0430}" ?></h1>
    </div>

    <?php if (!empty($warnings)): ?>
        <div class="form-alert" style="display:block; margin-bottom: 12px;">
            <?php foreach ($warnings as $warning): ?>
                <div><?= e($warning) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= config('app.url') ?>/crews/store" class="form-card">
        <?= csrf_field() ?>

        <table class="form-table">
            <tr>
                <td><?= "\u{041F}\u{043E}\u{0434}\u{0440}\u{044F}\u{0434}\u{0447}\u{0438}\u{043A}" ?> *</td>
                <td>
                    <select name="contractor_id">
                        <option value="">-- <?= "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435}" ?> --</option>
                        <?php foreach ($contractors as $contractor): ?>
                            <?php $value = (int) ($contractor['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($old['contractor_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                <?= e((string) ($contractor['name'] ?? '')) ?>
                                <?php if (!empty($contractor['inn'])): ?>
                                    (INN: <?= e((string) $contractor['inn']) ?>)
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="error"><?= e((string) ($errors['contractor_id'] ?? '')) ?></div>
                </td>
            </tr>

            <tr>
                <td><?= "\u{0412}\u{043E}\u{0434}\u{0438}\u{0442}\u{0435}\u{043B}\u{044C}" ?> *</td>
                <td>
                    <select name="driver_id">
                        <option value="">-- <?= "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435}" ?> --</option>
                        <?php foreach ($drivers as $driver): ?>
                            <?php $value = (int) ($driver['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($old['driver_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                <?= e((string) ($driver['full_name'] ?? '')) ?>
                                <?php if (!empty($driver['phone'])): ?>
                                    (<?= e((string) $driver['phone']) ?>)
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="error"><?= e((string) ($errors['driver_id'] ?? '')) ?></div>
                </td>
            </tr>

            <tr>
                <td><?= "\u{041C}\u{0430}\u{0448}\u{0438}\u{043D}\u{0430}" ?> *</td>
                <td>
                    <select name="vehicle_id">
                        <option value="">-- <?= "\u{0412}\u{044B}\u{0431}\u{0435}\u{0440}\u{0438}\u{0442}\u{0435}" ?> --</option>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <?php $value = (int) ($vehicle['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($old['vehicle_id'] ?? 0) === $value ? 'selected' : '' ?>>
                                <?= e((string) ($vehicle['truck_plate'] ?? '')) ?>
                                <?php if (!empty($vehicle['truck_brand'])): ?>
                                    (<?= e((string) $vehicle['truck_brand']) ?>)
                                <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="error"><?= e((string) ($errors['vehicle_id'] ?? '')) ?></div>
                </td>
            </tr>

            <tr>
                <td><?= "\u{0421}\u{0442}\u{0430}\u{0442}\u{0443}\u{0441}" ?> *</td>
                <td>
                    <select name="status">
                        <option value="active" <?= ($old['status'] ?? 'active') === 'active' ? 'selected' : '' ?>><?= "\u{0410}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{0430}" ?></option>
                        <option value="inactive" <?= ($old['status'] ?? '') === 'inactive' ? 'selected' : '' ?>><?= "\u{041D}\u{0435}\u{0430}\u{043A}\u{0442}\u{0438}\u{0432}\u{043D}\u{0430}" ?></option>
                        <option value="archived" <?= ($old['status'] ?? '') === 'archived' ? 'selected' : '' ?>><?= "\u{0410}\u{0440}\u{0445}\u{0438}\u{0432}" ?></option>
                    </select>
                    <div class="error"><?= e((string) ($errors['status'] ?? '')) ?></div>
                </td>
            </tr>

            <tr>
                <td><?= "\u{041A}\u{043E}\u{043C}\u{043C}\u{0435}\u{043D}\u{0442}\u{0430}\u{0440}\u{0438}\u{0439}" ?></td>
                <td>
                    <textarea name="comment" rows="3"><?= e((string) ($old['comment'] ?? '')) ?></textarea>
                    <div class="error"><?= e((string) ($errors['comment'] ?? '')) ?></div>
                </td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary"><?= "\u{0421}\u{043E}\u{0437}\u{0434}\u{0430}\u{0442}\u{044C}" ?></button>
            <a href="<?= config('app.url') ?>/crews" class="btn"><?= "\u{041E}\u{0442}\u{043C}\u{0435}\u{043D}\u{0430}" ?></a>
        </div>
    </form>
</div>
