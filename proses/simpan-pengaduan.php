<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("location: ../siswa/login-siswa.php");
    exit;
}

$nis = $_SESSION['siswa']['nis'];
$nama = $_SESSION['siswa']['nama'];
$tanggal = date("Y-m-d H:i:s");

$id_kategori = mysqli_real_escape_string($conn, $_POST['id_kategori']);
$lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
$ket = mysqli_real_escape_string($conn, $_POST['ket']);

$namaFoto = $_FILES['foto']['name'];
$tmpFoto  = $_FILES['foto']['tmp_name'];
    
$namaBaru = time() . '-' . $namaFoto;

move_uploaded_file(
    $tmpFoto,
    "../foto-pengaduan/" . $namaBaru
);
    
$query = mysqli_query($conn,
    "INSERT INTO input_aspirasi (nama, nis, ket, lokasi, id_kategori, tanggal, foto, notif)
    VALUES ('$nama', '$nis', '$ket', '$lokasi', '$id_kategori', '$tanggal', '$namaBaru', 'baru')"
);

if(!$query){
    echo "
    <script>
        alert('Data gagal disimpan');
        window.history.back();
    </script>";
}else {
    echo "
    <script>
        alert('Data berhasil disimpan');
        window.location.href = '../siswa/index-siswa.php';
    </script>";
}

?>