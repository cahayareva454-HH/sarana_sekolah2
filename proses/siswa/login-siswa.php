<?php
session_start();
include "../koneksi.php";

if (isset($_SESSION['siswa'])) {
    header("location: index-siswa.php");
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
    <title>Login Siswa</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <div class="card shadow-sm">

                    <div class="card-header bg-info text-white text-center">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-user"></i> Login Siswa
                        </h5>
                    </div>

                    <div class="card-body">
                        <form method="post" action="../proses/login-siswa.php">
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-info">
                                    Masuk
                                </button>
                            </div>

                            <div class="mt-2">
                                <a href="../proses/daftar-akun.php" class="btn btn-outline-primary w-100">
                                    Belum punya akun? Daftar di sini
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="../index.php" class="text-decoration-none">
                       <i class="fa-solid fa-arrow-left"></i> Kembali ke halaman utama
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>