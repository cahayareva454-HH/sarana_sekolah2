 <?php

session_start();

//mengambil file koneksi yang berisi $conn agar terhubung ke database
include "../koneksi.php";

// Proteksi halaman admin
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit;
}

// mengambil data kategori dari database
$data = mysqli_query($conn, "
    SELECT * FROM kategori
    ORDER By id_kategori DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Import css dan icon dari fontawesome -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Data kategori | admin</title>
    <style>
    .card {
        border: none;
        border-radius: 15px;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    </style>
</head>
<body class="bg-light">

        <!-- NAVBAR -->
        <nav class="navbar navbar-dark bg-primary">

            <div class="container-fluid">
                <span class="navbar-brand fw-bold" href="#">
                    <i class="fa-solid fa-tags"></i> Data Kategori
                </span>
            
            <div class="d-flex">
                <span class="text-white me-3">
                    <i class="fa-solid fa-user-gear"></i>
                    <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>

                <!-- Tombol kembali -->
                <div class="d-flex">
                    <a href="index-admin.php" class="btn btn-sm btn-light me-2">
                         <i class="fa-solid fa-arrow-left"></i> kembali
                    </a>
                </div>

                    <a href="../proses/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </a>
            </div>
            </div>
        </nav>

         <!-- Konten -->
        <div class="container mt-4">
            <div class="card shadow-sm">

                 <!-- card header -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-list"></i> kategori sarana
                    </h5>
                </div>

                <div class="card-body">
                    <form method="post" action="../proses/tambah-kategori.php" class="mb-3">
                        <div class="row">

                            <div class="col-md-8">
                                <input type="text"
                                    name="ket_kategori"
                                    class="form-control"
                                    placeholder="nama kategori" required>
                            
                            </div>

                                    <!-- Tombol tambah -->
                            <div class="col-md-4 d-grid">
                                <button class="btn btn-success" name="simpan">
                                    <i class="fa-solid fa-plus"></i> Tambah 
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- tabel data kategori -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-light text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th> Nama Kategori</th>
                                    <th width="20%"> Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                $no= 1;
                                while ($row = mysqli_fetch_assoc($data)){
                            ?>
                                      
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                            
                                    <td>
                                        <?= htmlspecialchars($row['ket_kategori']); ?>
                                    </td>

                                    <!-- tombol edit -->
                                    <td class="text-center">
                                        <a href="../proses/edit-kategori.php?id=<?= $row['id_kategori']; ?>&nama=<?= urlencode($row['ket_kategori']); ?>"
                                            class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- tombol hapus -->
                                        <a href="../proses/hapus-kategori.php?id=<?= $row['id_kategori']; ?>"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<footer class="text-center text-muted mt-4 mb-3">
    &copy; 2026 Sistem Pengaduan Sarana Sekolah
</footer>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>