<?php
session_start();

include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("location: ../admin/kategori.php");
    exit;
}

//mengambil ID kategori dari parameter URL 
$id = (int) $_GET['id'];

//mengecek apakah kategori masih digunakan di halaman data pengaduan
$cek = mysqli_query($conn, "SELECT * FROM input_aspirasi WHERE id_kategori = $id");

//jika jumlah data lebih dari 0 berarti kategori masih digunakan
if (mysqli_num_rows($cek) > 0) {

    //menampilkan pesan peringatan
    echo "<script>
            alert('Kategori tidak bisa di hapus karena masih digunakan di data pengaduan! '+
            'Hapus terlebih dahulu data yang terkait dengan kategori ini di data pengaduan');
            window.location='../admin/kategori.php';
        </script>";
    exit;
}

//jika kategori tidak di gunakan, maka data kategori dapat di hapus
$hapus = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");

if ($hapus) {
    echo "<script>
            alert('Kategori berhasil dihapus');
            window.location='../admin/kategori.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus kategori');
            window.location='../admin/kategori.php';
          </script>";
}

exit;
?>