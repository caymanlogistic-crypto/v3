<h1>Login</h1>

<form method="POST" action="/v3/public/login">

    <div style="margin-bottom:15px;">

        <label>Email</label>

        <br>

        <input
            type="email"
            name="email"
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