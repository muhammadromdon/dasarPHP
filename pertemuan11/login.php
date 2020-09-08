<?php

session_start();
require 'function.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;

            if (isset($_POST['remember'])) {
                $id = setcookie('id', $row['id'], time() + 60);
                $key = setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
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

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red;font-style: italic;">username / password anda salah!</p>
    <?php endif ?>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
            </li>
            <br>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>
            <br>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
            <br>
            <br>
            <button type="submit" name="login">Login</button>
        </ul>
    </form>

</body>

</html>