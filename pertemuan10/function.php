<?php

$conn = mysqli_connect("localhost", "root", "", "dasarphp");

function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu!')
            </script>
        ";
        return false;
    }

    //pengecekan extensi gambar
    $ektensiValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ektensiValid)) {
        echo "
            <script>
                alert('Upload gagal, silahkan cek file anda!')
            </script>
        ";
    }

    if ($ukuranFile > 1000000) {
        echo "
            <script>
                alert('Ukuran gambar terlalu besar!')
            </script>
        ";
        return false;
    }

    //setelah selesai pengecekan lalu upload
    //generate nama baru supaya tidak bentrok jika user mengupload photo dgn string yg sama
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmp, 'img/' . $namaFileBaru);
    return $namaFileBaru;                                                   //di return untuk kembali ke variabel gambar di fungsi tambah
}

function tambah($data)
{
    global $conn;

    $nrp = htmlspecialchars($data['nrp']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);

    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $mhs = mysqli_query($conn, "INSERT INTO mahasiswa VALUES('','$nrp','$nama','$email','$jurusan','$gambar')");

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;

    $id = htmlspecialchars($data['id']);
    $nrp = htmlspecialchars($data['nrp']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);

    $gambarlama = htmlspecialchars($data['gambarlama']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    $mhs = mysqli_query($conn, "UPDATE mahasiswa SET nrp = '$nrp',nama = '$nama',email = '$email',jurusan = '$jurusan',gambar = '$gambar' WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' OR nrp LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
    return query($query);
}

function regist($data)
{
    global $conn;

    $username = $data["username"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM user where username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('username sudah dipakai!')
        </script>
        ";
        return false;
    }

    if ($password !== $password2) {
        echo "
        <script>
            alert('password anda tidak cocok!')
        </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}
