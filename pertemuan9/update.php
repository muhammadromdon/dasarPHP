<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET['id'];

$mahasiswa = query("SELECT * FROM mahasiswa where id = $id")[0];

if (isset($_POST['submit'])) {

    if (update($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diupdate')
                document.location.href = 'index.php'
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal diupdate')
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

    <h1>Update Data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mahasiswa['id'] ?>">
        <input type="hidden" name="gambarlama" value="<?php echo $mahasiswa['gambar'] ?>">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo $mahasiswa['nama'] ?>">
            </li>
            <br>
            <li>
                <label for="nrp">NRP</label>
                <input type="text" name="nrp" id="nrp" value="<?php echo $mahasiswa['nrp'] ?>">
            </li>
            <br>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $mahasiswa['email'] ?>">
            </li>
            <br>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" value="<?php echo $mahasiswa['jurusan'] ?>">
            </li>
            <br>
            <li>
                <label for="gambar">Gambar</label>
                <img src="img/<?php echo $mahasiswa['gambar'] ?>" width="40px">
                <input type="file" name="gambar" id="gambar">
            </li>
            <br>
            <button type="submit" name="submit">Tambah Data</button>
        </ul>

    </form>

</body>

</html>