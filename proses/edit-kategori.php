<?php
//mengaktifkan session untuk menyimpan data login admin
session_start();

//memanggil file koneksi database
include "../koneksi.php";

//mengecek admin sudah login atau menekan tombol login 
if (!isset($_SESSION['admin'])){
    header("location: ../admin/login.php");
    exit;
}

//mengecek apakah parameter ID dan nama yang di kirim melalui URL
if (!isset($_GET['id'])){
    header("location: ../admin/kategori.php");
    exit;
}

//mengambil id dan nama kategori dari URL 
$id = (int) $_GET['id'];
$nama = $_GET['nama'];

//mengecek apakah tombol update di tekan
if (isset($_POST['update'])){
    $nama_baru = mysqli_real_escape_string($conn, $_POST['ket_kategori']);

    mysqli_query($conn, "UPDATE kategori
                         SET ket_kategori='$nama_baru'
                         WHERE id_kategori='$id'");


//menampilkan nontifikasi berhasil update dan tendang ke halaman kategori
echo "<script>
         alert('Data kategori berhasil di update');
         window.location='../admin/kategori.php';
      </script>";
exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Edit Kategori | Admin</title>
</head>
<body class="bg-light">

     <div class="container mt-5">
        <div class="card shadow">
            <!-- Header card -->
             <div class="card-header bg-warning text-dark">
               Edit Kategori
             </div>

             <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Nama Kategori</label>

                        <input type="text"
                               name="ket_kategori"
                               class="form-control"
                               value="<?= htmlspecialchars($nama) ?>"
                               required>
                    </div>

                    <!-- Tombol Simpan --> 
                    <button type="submit" name="update" class="btn btn-success">
                        Simpan
                    </button>

                    <!-- Tombol Kembali -->
                    <a href="../admin/kategori.php" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>