<h1>Login</h1>

<?php if ($errorFlash = \App\Core\Session\Flash::getError()): ?>
<div class="flash-error">
    <?= e($errorFlash) ?>
</div>
<?php endif; ?>

<form method="POST" action="<?= config('app.url') ?>/login">

    <div style="margin-bottom:15px;">

        <label>Email</label>

        <br>

        <input
            type="email"
            name="email"
            value="<?= e($old['email'] ?? '') ?>"
            required
        >

    </div>

    <div style="margin-bottom:15px;">

        <label>Password</label>

        <br>

        <input
            type="password"
            name="password"
            required
        >

    </div>

    <button type="submit">
        Login
    </button>

</form>

