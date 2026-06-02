<?php
session_start();
include "../koneksi.php";

//proteksi
if (!isset($_SESSION['admin'])){
    header("location: ../admin/login.php");
    exit;
}
 
if (!isset($_GET['id'])){
    header("location: ../admin/data-pengaduan.php");
    exit; 
}

$id_pelaporan = (int) $_GET['id'];

if ($id_pelaporan <= 0) {
    header("location: ../admin/data-pengaduan.php");
    exit;
}

//ambil id_kategori
mysqli_query($conn, "
     DELETE FROM aspirasi
     WHERE id_pelaporan = $id_pelaporan
");

//Hapus laporan
mysqli_query($conn, "
        DELETE FROM input_aspirasi
        WHERE id_pelaporan = $id_pelaporan
        ");

    header("location: ../admin/data-pengaduan.php");
    exit;

?>