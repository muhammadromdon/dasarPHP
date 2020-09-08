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
    $tmp = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
        echo "
            <script>
            alert('Pilih gambar terlebih dahulu!')
            </script
        ";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        echo "
            <script>
                alert('Upload gagal, silahkan upload jenis file gambar!')
            </script>
        ";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "
            <script>
                alert('Upload gagal, file anda terlalu besar')
            </script>
        ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmp, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $nrp = htmlspecialchars($data['nrp']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $mhs = mysqli_query($conn, "INSERT INTO mahasiswa VALUES('','$nama','$nrp','$email','$jurusan','$gambar')");

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
    $nama = htmlspecialchars($data['nama']);
    $nrp = htmlspecialchars($data['nrp']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarlama = htmlspecialchars($data['gambarlama']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    mysqli_query($conn, "UPDATE mahasiswa SET nama = '$nama',nrp = '$nrp',email = '$email',jurusan = '$jurusan',gambar = '$gambar' WHERE id = $id");

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

    $username = htmlspecialchars($data['username']);
    $password = mysqli_escape_string($conn, $data['password']);
    $password2 = mysqli_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Username sudah digunakan!')
            </script>
        ";
        return false;
    }

    if ($password !== $password2) {
        echo "
            <script>
                alert('Password tidak sesuai! silahkan periksa kembali..')
            </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}
