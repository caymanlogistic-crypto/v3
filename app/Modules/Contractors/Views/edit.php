<h1>Edit Contractor</h1>

<form
    method="POST"
    action="/v3/public/contractors/update?id=<?= $contractor['id'] ?>"
>

    <p>

        <label>
            Name
        </label>

        <br>

        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($contractor['name']) ?>"
            required
        >

        <br>

        <small style="color:red;">
            <?= htmlspecialchars($errors['name'] ?? '') ?>
        </small>

    </p>

    <p>

        <label>
            INN
        </label>

        <br>

        <input
            type="text"
            name="inn"
            value="<?= htmlspecialchars($contractor['inn']) ?>"
            required
        >

        <br>

        <small style="color:red;">
            <?= htmlspecialchars($errors['inn'] ?? '') ?>
        </small>

    </p>

    <button type="submit">
        Update
    </button>

</form>
