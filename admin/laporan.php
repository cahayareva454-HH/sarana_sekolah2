<?php
session_start();

include "../koneksi.php";

//cek login admin
if(!isset($_SESSION['admin'])){
    header("location: login.php");
    exit;
}

// query gabungan
$query = mysqli_query($conn, "
    SELECT 
        ia.tanggal,
        s.nis,
        s.nama,
        s.kelas,
        k.ket_kategori,
        ia.ket AS pengaduan,
        a.feedback
    FROM input_aspirasi ia
    JOIN siswa s ON ia.nis = s.nis
    JOIN kategori k ON ia.id_kategori = k.id_kategori
    LEFT JOIN aspirasi a ON ia.id_pelaporan = a.id_pelaporan
    ORDER BY ia.tanggal DESC 
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Laporan</title>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container-fluid">
            <span class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-house-chimney-user"></i> Halaman Admin
            </span>

            <div class="d-flex">
                <span class="text-white me-3">
                    <i class="fa-solid fa-user-gear"></i>
                    <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>

                    <a href="index-admin.php" class="btn btn-light btn-sm me-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>

                    <a href="cetak-laporan.php" target="_blank" class="btn btn-warning btn-sm me-2">
                       <i class="fa-solid fa-print"></i> Cetak
                    </a>

                    <a href="download-excel.php" class="btn btn-success btn-sm me-2">
                        <i class="fa-solid fa-file-excel"></i> Download Excel
                    </a>

                    <a href="../proses/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </a>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fa-solid fa-file-lines"></i>
                    Laporan Pengaduan Sarana Sekolah
                </h5>
            </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Lokasi</th>
                            <th>Pengaduan</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no= 1;
                            while ($row = mysqli_fetch_assoc($query)) : ?>

                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= date('d m Y', strtotime($row['tanggal'])); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['nis'])?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['nama'])?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['kelas'])?></td>
                                    <td><?= htmlspecialchars($row['ket_kategori'])?></td>
                                    <td><?= htmlspecialchars($row['pengaduan'])?></td>

                                    <td><?= $row['feedback'] ? htmlspecialchars($row['feedback']) : '<em class="text-muted">Belum Ada Tanggapan</em>' ;?></td>
                                </tr>
                            <?php endwhile; ?>
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