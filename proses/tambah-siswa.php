<?php
session_start();
include "../koneksi.php";

//cek login admin
if  (!isset($_SESSION['admin'])) {
    header("location: ../admin/login.php");
    exit;
}

//cek asal pengirim
if (!isset($_POST['simpan'])) {
    header("location: ../admin/tambah-siswa.php");
    exit;
}

// memberikan input form nis & kelas
$nis = mysqli_real_escape_string($conn, $_POST['nis']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

// cek data
$cek = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
     if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "NIS sudah terdaftar!";
        header("location: ../admin/tambah-siswa.php");
        exit;
     }

// proses simpan akun siswa
$simpan = mysqli_query($conn, "
     INSERT INTO siswa (nis, nama, kelas)
     VALUES ('$nis', '$nama', '$kelas')
");

// notif berhasil/ gagal
if ($simpan){
    $_SESSION['success'] = "Data siswa berhasil di simpan!";
}else {
    $_SESSION['error'] = "Gagal menyimpan data ke database";
}
    header("location: ../admin/tambah-siswa.php");
    exit;
?>