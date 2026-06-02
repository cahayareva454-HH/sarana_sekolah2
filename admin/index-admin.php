<?php
session_start();

include "../koneksi.php";

if (!isset($_SESSION['admin'])) {
    header("location: login.php");
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
    <title>Halaman Admin</title>
    <style>
    .card {
        transition: 0.3s;
        border: none;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
</style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container-fluid">
            <span class="navbar-brand fw-bold">
                <i class="fa-solid fa-house-chimney-user"></i> Halaman Admin
            </span>

            <div class="d-flex align-items-center">

                <span class="text-white me-3">
                    <i class="fa-solid fa-user-gear"></i>
                    <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>

                    <a href="../proses/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </a>
            </div>

        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="alert alert-primary">
                    <strong>Selamat Datang!</strong>
                    Anda login sebagai <b>Admin</b>.
                    Silahkan kelola data pengaduan sarana sekolah.
                </div>
            </div>

            <!--=== CARD 1 ===-->
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <i class="fas fa-eye"></i>
                        <i class="fa-solid fa-cogs"></i>
                        <h5>Data Pengaduan</h5>
                            <p class="text-muted">Lihat dan kelola pengaduan siswa</p>
                            <a href="data-pengaduan.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>

            <!--===CARD 2===-->
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-chalkboard-teacher"></i>
                        <h5>Kategori</h5>
                            <p class="text-muted">Kelola kategori pengaduan siswa</p>
                            <a href="kategori.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>

            <!--===CARD 3===-->
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user-plus"></i>
                        <h5>Akun Siswa</h5>
                            <p class="text-muted">Kelola akun siswa</p>
                            <a href="tambah-siswa.php" class="btn btn-primary">Tambah Akun</a>
                    </div>
                </div>
            </div>

            <!--===CARD 4===-->
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5>Laporan</h5>
                            <p class="text-muted">Rekap pengaduan siswa</p>
                            <a href="laporan.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>