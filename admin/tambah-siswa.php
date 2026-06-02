<?php
session_start();

//cek login admin
if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

//koneksi database
include "../koneksi.php";

// ambil data dari database
$dataSiswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nis ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Tambah Siswa</title>
</head>
<body class="bg-light">
     <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container-fluid">
            <span class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-house-chimney-user"></i>
                Halaman Admin
            </span>
            
            <div class="d-flex">
                <span class="text-white me-3">
                    <i class="fa-solid fa-user-gear"></i>
                    <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>

                <!-- Tombol kembali -->
                <div class="d-flex">
                    <a href="index-admin.php" class="btn btn-sm btn-light me-2">
                         <i class="fa-solid fa-arrow-left"></i>
                         Kembali
                    </a>
                </div>

                    <a href="../proses/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Keluar
                    </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <!--- notifikasi -->
        <?php
        if (isset($_SESSION['success'])) : ?>

            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check"></i>
                <?= htmlspecialchars($_SESSION['success']); ?>

                <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
                </button>
            </div>

    <?php unset($_SESSION['success']); endif; ?>

    <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            Form Tambah Siswa
        </h5>
    </div>

    <div class="card-body">
        <form method="post" action="../proses/tambah-siswa.php">

            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NAMA</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">KELAS</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            </div>

        </form>
    </div>
    </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-secondary text-white">
                 <h5 class="mb-0">Daftar Siswa</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA</th>
                                <th>KELAS</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $no = 1;
                                if (mysqli_num_rows($dataSiswa) >0) :
                                    while ($row = mysqli_fetch_assoc($dataSiswa)) :
                            ?>

                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nis']); ?></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['kelas']); ?></td>
                            </tr>

                            <?php endwhile; else : ?>

                                <tr>
                                    <td colspan="3" class="text-center">
                                        Belum Ada Data
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<footer class="text-center text-muted mt-4 mb-3 small">
    <i class="fa-regular fa-copyright"></i>
    2026 Sistem Pengaduan Sarana Sekolah
</footer>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html> 