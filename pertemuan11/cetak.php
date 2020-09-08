<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>

    <h1>Daftar Mahasiswa</h1>
    
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NRP</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Gambar</th>
        </tr>';
$i = 1;
foreach ($mahasiswa as $row) {
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td><img src="img/' . $row["gambar"] . '" width="50"></td>
        <td>' . $row["nrp"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["email"] . '</td>
        <td>' . $row["jurusan"] . '</td>
    </tr>';
}

$html .= '</table>

</body>
</html> ';

$mpdf->WriteHTML($html);
$mpdf->Output('daftarMahasiswa.pdf', \Mpdf\Output\Destination::INLINE);
