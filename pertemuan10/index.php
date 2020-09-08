<?php

session_start();
require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DASAR</title>
</head>

<body>

    <h1>Data Mahasiswa</h1>

    <a href="logout.php">Logout</a><br><br>

    <a href="tambah.php">Tambah Data Mahasiswa</a><br><br>

    <a href="registrasi.php">Register Username</a><br><br>

    <form action="" method="POST">
        <input type="text" name="keyword" placeholder="Cari data mahasiswa.." size="40" autofocus autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombolcari">Cari !</button>
        <br>
        <br>
    </form>

    <div id="container">
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NRP</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $mhs['nama'] ?></td>
                        <td><?php echo $mhs['nrp'] ?></td>
                        <td><?php echo $mhs['email'] ?></td>
                        <td><?php echo $mhs['jurusan'] ?></td>
                        <td><img src="img/<?php echo $mhs['gambar'] ?>" width="40px"></td>
                        <td>
                            <a href="update.php?id=<?php echo $mhs['id'] ?>">Update</a>
                            <a href="hapus.php?id=<?php echo $mhs['id'] ?>" onclick="return confirm('anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<script src="js/script.js"></script>