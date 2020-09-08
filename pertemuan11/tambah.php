<?php

session_start();
require 'function.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {

    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan')
                document.location.href = 'index.php'
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan')
                document.location.href = 'index.php'
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>

    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li>
            <br>
            <li>
                <label for="nrp">NRP</label>
                <input type="text" name="nrp" id="nrp">
            </li>
            <br>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </li>
            <br>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan">
            </li>
            <br>
            <li>
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <button type="submit" name="submit">Tambah Data</button>
        </ul>

    </form>

</body>

</html>