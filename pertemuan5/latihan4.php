<?php

if (isset($_POST['submit'])) {
    if ($_POST['username'] == 'admin' && $_POST['password'] == '123') {
        header("Location: admin.php");
        exit;
    } else {
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login Admin</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic;">username / password salah!</p>
    <?php endif ?>

    <form action="" method="POST">
        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <br>
        <br>
        <label for="password">Password : </label>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>

</html>