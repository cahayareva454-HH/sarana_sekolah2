<?php
session_start();

include "../koneksi.php";

// cek tombol daftar ditekan
if (!isset($_POST["daftar"])) {
    header("location: ../siswa/daftar-akun.php");
    exit;
}

// ambil data dari form
$nis = trim(mysqli_real_escape_string($conn, $_POST['nis']));
$nama = trim(mysqli_real_escape_string($conn, $_POST['nama']));
$kelas = trim(mysqli_real_escape_string($conn, $_POST['kelas']));

// cek apakah NIS sudah ada
$cek = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('NIS sudah terdaftar!');
        window.location='../siswa/daftar-akun.php';
    </script>";
    exit;
}

// simpan ke database
$query = mysqli_query(
    $conn,
    "INSERT INTO siswa (nis, nama, kelas) 
     VALUES ('$nis','$nama','$kelas')"
);

if ($query) {
    echo "<script>
        alert('Pendaftaran berhasil!');
        window.location='../siswa/login-siswa.php';
    </script>";
} else {
    die("Error: " . mysqli_error($conn));
}
?>