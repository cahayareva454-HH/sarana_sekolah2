<?php
//mengaktifkan session untuk menyimpan data login admin
session_start();

//memanggil file koneksi database berisi variabel $conn untuk menghubungkan ke database
include "../koneksi.php";

// cek apakah admin sudah login, jika session admin tidak ada/ tidak menekan tombol login maka tendang ke login
if (!isset($_SESSION['admin'])){
    header("location: ../admin/login.php");
    exit;
}

//cek apakah tommbol simpan pada form tambah kategori di tekan
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($conn, $_POST['ket_kategori']);

    mysqli_query($conn, "INSERT INTO kategori (ket_kategori) VALUES ('$nama')");
}

// setelah query di jalankan untuk menyimpan data ke database, admin akan di arahkan ke halaman kategori
header("location: ../admin/kategori.php");
exit;

?>