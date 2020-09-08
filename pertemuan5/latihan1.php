<!-- Array -->
<!-- Array adalah variabel yang memiliki banyak nilai -->

<?php

$hari = ['Senin', 'Selasa', 'Rabu'];
$bulan = ['Januari', 'Februari', 'Maret'];

var_dump($hari);                    //Debug untuk sisi programmer
echo "<br>";
var_dump($bulan);
echo "<br>";
$hari[] = "Kamis";                 //Menambahkan elemen ke array hari
var_dump($hari);
echo "<br>";
echo $hari[3];                     //Menampilkan elemen ke 3 dari array hari
?>