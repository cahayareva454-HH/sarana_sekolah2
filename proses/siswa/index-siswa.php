<?php
session_start();

    if (!isset($_SESSION['siswa'])) {
        header("location: ../login-siswa.php");
        exit;
    }

    $siswa = $_SESSION['siswa'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Halaman Siswa</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-info">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="fa-solid fa-chalkboard-user"></i> Halaman Siswa
            </span>

            <a href="../proses/logout-siswa.php" class="btn btn-sm btn-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </a>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Anda login dengan nis: <?= htmlspecialchars($siswa['nis']); ?></h5>
                <p>Nama: <b><?= htmlspecialchars($siswa['nama']); ?></b></p>
                <p>Kelas: <b><?= htmlspecialchars($siswa['kelas']); ?></b></p>

                <hr>

                <a href="input-pengaduan.php" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Buat pengaduan
                </a>

                <a href="riwayat-pengaduan.php" class="btn btn-warning">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat pengaduan
                </a>
            </div>
        </div>
    </div>
    
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>