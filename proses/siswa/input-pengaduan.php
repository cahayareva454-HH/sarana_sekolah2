<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("location: login-siswa.php");
    exit;
}

$siswa = $_SESSION['siswa'];
$kategori = mysqli_query(
    $conn, "SELECT * FROM kategori"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>input pengaduan</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-info">
        <div class="container-fluid">
            <a href="index-siswa.php" class="navbar-brand">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            <span class="navbar-text text-white">
                <b>NIS:</b> <?= htmlspecialchars($siswa['nis']); ?>
                <b>Kelas:</b> <?= htmlspecialchars($siswa['kelas']); ?>
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Form Pengaduan Siswa</h5>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="../proses/simpan-pengaduan.php" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Lokasi :</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">--Silahkan pilih lokasi --</option>
                        <?php while ($k = mysqli_fetch_assoc($kategori)){ ?>
                            <option value="<?= $k['id_kategori']; ?>">
                                <?= $k['ket_kategori']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kategori Sarana</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Pengaduan</label>
                    <textarea name="ket" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bukti Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index-siswa.php">
                        <i class="fa-solid fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" name="kirim" class="btn btn-success">
                        kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>