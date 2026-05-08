<h1>Contractors</h1>

<p>
    <a href="/v3/public/contractors/create">
        Create contractor
    </a>
</p>

<table
    width="100%"
    border="1"
    cellpadding="10"
    cellspacing="0"
>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>INN</th>
        <th>Director</th>
        <th>Created</th>
        <th width="160">Actions</th>
    </tr>

    <?php foreach ($contractors as $contractor): ?>

        <tr>

            <td>
                <?= (int) $contractor['id'] ?>
            </td>

            <td>
                <?= htmlspecialchars($contractor['name']) ?>
            </td>

            <td>
                <?= htmlspecialchars($contractor['inn']) ?>
            </td>

            <td>
                <?= htmlspecialchars($contractor['director'] ?? '') ?>
            </td>

            <td>
                <?= htmlspecialchars($contractor['created_at']) ?>
            </td>

            <td>

                <?php
                    $href = '/v3/public/contractors/edit?id=' . $contractor['id'];
                    $label = 'Edit';

                    require APP_ROOT . '/app/Views/components/button-link.php';
                ?>

                <form
                    method="POST"
                    action="/v3/public/contractors/delete"
                    style="display:inline-block;"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $contractor['id'] ?>"
                    >

                    <button type="submit">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>
