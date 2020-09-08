<?php
$mahasiswa = [
    ["Muhammad Romdon", 777, "IT", "romdon@asd.asd"],                   //Array Numeric
    ["Muhammad Ali", 888, "IT", "ali@asd.asd"]
];

$student = [
    [
        "nama" => "Muhammad Romdon",                                   //Array Associative
        "nrp" => "28123123",
        "email" => 'romdon@asd.asd',
        "jurusan" => 'IT',
        "gambar" => 'romdon.jpg'
    ],
    [
        "nama" => "Muhammad Ali",
        "nrp" => "2812323123",
        "email" => 'ali@asd.asd',
        "jurusan" => 'IT',
        "gambar" => 'ali.jpg'
    ],

];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <ul>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <li>Nama : <?php echo $mhs[0] ?></li>
            <li>NRP : <?php echo $mhs[1] ?></li>
            <li>Jurusan : <?php echo $mhs[2] ?></li>
            <li>Email : <?php echo $mhs[3] ?></li>
            <br>
        <?php endforeach ?>
    </ul>

    <br>

    <ul>
        <?php foreach ($student as $st) : ?>
            <li>Nama : <?php echo $st["nama"] ?></li>
            <li>NRP : <?php echo $st["nrp"] ?></li>
            <li>Jurusan : <?php echo $st["jurusan"] ?></li>
            <li>Email : <?php echo $st["email"] ?></li>
            <li><img src="img/<?php echo $st["gambar"] ?>" alt="" style="width: 100px;"></li>
            <br>
        <?php endforeach ?>
    </ul>
</body>

</html>