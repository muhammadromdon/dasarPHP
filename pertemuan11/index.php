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
    <style>
        @media print {

            .logout,
            .tambah,
            .regist,
            .aksi,
            .formcari {
                display: none;
            }
        }

        .loader {
            width: 40px;
            position: absolute;
            top: 210px;
            left: 340px;
            z-index: -1;
            display: none;
        }
    </style>
</head>

<body>

    <h1>Data Mahasiswa</h1>

    <a href="logout.php" class="logout">Logout</a><br><br>

    <a href="tambah.php" class="tambah">Tambah Data Mahasiswa</a><br><br>

    <a href="registrasi.php" class="regist">Register Username</a><br><br>

    <a href="cetak.php" target="_blank">Print</a><br><br>

    <form action="" method="POST" class="formcari">
        <input type="text" name="keyword" placeholder="Cari data mahasiswa.." size="40" autofocus autocomplete="off" id="keyword">
        <img src="img/loading.gif" class="loader">
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
                    <th class="aksi">Aksi</th>
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
                        <td class="aksi">
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

<script src="js/jquery.min.js"></script>
<script src="js/script.js"></script>