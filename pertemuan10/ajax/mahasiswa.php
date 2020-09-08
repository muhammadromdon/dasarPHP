<?php

require '../function.php';

$keyword = $_GET['keyword'];
$mahasiswa = query("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR nrp LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'");

?>

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