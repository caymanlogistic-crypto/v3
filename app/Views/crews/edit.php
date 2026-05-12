<?php declare(strict_types=1); ?>

<div class="page form-page">
    <div class="page-header">
        <h1>&#1056;&#1077;&#1076;&#1072;&#1082;&#1090;&#1080;&#1088;&#1086;&#1074;&#1072;&#1090;&#1100; &#1089;&#1074;&#1103;&#1079;&#1082;&#1091; #<?= (int) ($crew['id'] ?? 0) ?></h1>
    </div>

    <?php if (!empty($warnings)): ?>
        <div class="form-alert" style="display:block; margin-bottom: 12px;">
            <?php foreach ($warnings as $warning): ?>
                <div><?= e($warning) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= config('app.url') ?>/crews/<?= (int) ($crew['id'] ?? 0) ?>/update" class="form-card">
        <?= csrf_field() ?>

        <table class="form-table">
            <tr>
                <td>&#1055;&#1086;&#1076;&#1088;&#1103;&#1076;&#1095;&#1080;&#1082; *</td>
                <td>
                    <select name="contractor_id">
                        <option value="">-- &#1042;&#1099;&#1073;&#1077;&#1088;&#1080;&#1090;&#1077; --</option>
                        <?php foreach ($contractors as $contractor): ?>
                            <?php $value = (int) ($contractor['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($crew['contractor_id'] ?? 0) === $value ? 'selected' : '' ?>>
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
                <td>&#1042;&#1086;&#1076;&#1080;&#1090;&#1077;&#1083;&#1100; *</td>
                <td>
                    <select name="driver_id">
                        <option value="">-- &#1042;&#1099;&#1073;&#1077;&#1088;&#1080;&#1090;&#1077; --</option>
                        <?php foreach ($drivers as $driver): ?>
                            <?php $value = (int) ($driver['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($crew['driver_id'] ?? 0) === $value ? 'selected' : '' ?>>
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
                <td>&#1052;&#1072;&#1096;&#1080;&#1085;&#1072; *</td>
                <td>
                    <select name="vehicle_id">
                        <option value="">-- &#1042;&#1099;&#1073;&#1077;&#1088;&#1080;&#1090;&#1077; --</option>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <?php $value = (int) ($vehicle['id'] ?? 0); ?>
                            <option value="<?= $value ?>" <?= (int) ($crew['vehicle_id'] ?? 0) === $value ? 'selected' : '' ?>>
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
                <td>&#1057;&#1090;&#1072;&#1090;&#1091;&#1089; *</td>
                <td>
                    <select name="status">
                        <option value="active" <?= ($crew['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>&#1040;&#1082;&#1090;&#1080;&#1074;&#1085;&#1072;</option>
                        <option value="inactive" <?= ($crew['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>&#1053;&#1077;&#1072;&#1082;&#1090;&#1080;&#1074;&#1085;&#1072;</option>
                        <option value="archived" <?= ($crew['status'] ?? '') === 'archived' ? 'selected' : '' ?>>&#1040;&#1088;&#1093;&#1080;&#1074;</option>
                    </select>
                    <div class="error"><?= e((string) ($errors['status'] ?? '')) ?></div>
                </td>
            </tr>

            <tr>
                <td>&#1050;&#1086;&#1084;&#1084;&#1077;&#1085;&#1090;&#1072;&#1088;&#1080;&#1081;</td>
                <td>
                    <textarea name="comment" rows="3"><?= e((string) ($crew['comment'] ?? '')) ?></textarea>
                    <div class="error"><?= e((string) ($errors['comment'] ?? '')) ?></div>
                </td>
            </tr>
        </table>

        <div class="form-actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">&#1057;&#1086;&#1093;&#1088;&#1072;&#1085;&#1080;&#1090;&#1100;</button>
            <a href="<?= config('app.url') ?>/crews" class="btn">Cancel</a>
        </div>
    </form>
</div>
