<h1>Create Contractor</h1>

<?php if (!empty($errors)): ?>

    <div
        style="
            color:red;
            margin-bottom:20px;
        "
    >

        <?php foreach ($errors as $fieldErrors): ?>

            <?php foreach ($fieldErrors as $error): ?>

                <div>
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endforeach; ?>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

<form
    method="POST"
    action="/v3/public/contractors/store"
>

    <div
        style="
            margin-bottom:15px;
        "
    >

        <label>
            Name
        </label>

        <br>

        <input
            type="text"
            name="name"
            style="
                width:400px;
            "
        >

    </div>

    <div
        style="
            margin-bottom:15px;
        "
    >

        <label>
            INN
        </label>

        <br>

        <input
            type="text"
            name="inn"
            style="
                width:400px;
            "
        >

    </div>

    <button type="submit">
        Save
    </button>

</form>
