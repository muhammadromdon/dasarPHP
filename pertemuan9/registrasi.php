<?php
session_start();

require 'function.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['register'])) {
    if (regist($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan')
        </script>
        ";
    } else {
        mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>

    <h1>Registrasi</h1>

    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password2">Konfirmasi Password</label>
        <input type="password" name="password2" id="password2">
        <br>
        <br>
        <button type="submit" name="register">Registrasi</button>

    </form>

</body>

</html>