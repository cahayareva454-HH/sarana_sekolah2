<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("location: login-siswa.php");
    exit;
}

$nis = $_SESSION['siswa']['nis'];

$query = mysqli_query($conn, "
        SELECT
            ia.id_pelaporan,
            ia.tanggal,
            k.ket_kategori,
            ia.lokasi,
            ia.ket,
            ia.foto,
            a.status,
            a.feedback
        FROM input_aspirasi ia
        JOIN kategori k ON ia.id_kategori = k.id_kategori
        LEFT JOIN aspirasi a ON ia.id_pelaporan = a.id_pelaporan
        WHERE ia.nis = '$nis'
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
    <title>Riwayat Pengaduan Siswa</title>
    <style>
        table td {
            vertical-align: middle !important;
        }

        .img-thumbnail{
            padding:2px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-info">
        <div class="container-fluid">

            <a href="index-siswa.php" class="navbar-brand">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            <span class="navbar-text text-white">
                Riwayat Pengaduan
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card shadow-sm">
            <h5 class="mb-0">
                Riwayat Pengaduan
            </h5>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                            ?>

                        <tr>
                            <td class="text-center"> <?= $no++;?> </td>
                            <td class="text-center"> <?= date('d m y H:i', strtotime($row['tanggal'])); ?> </td>
                            <td><?= htmlspecialchars($row['ket_kategori']); ?></td>
                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td><?= htmlspecialchars($row['ket']); ?></td>
                            
                            <td>
                            <a href="../foto-pengaduan/<?= $row['foto']; ?>" target="_blank">
                                <img src="../foto-pengaduan/<?= $row['foto']; ?>"
                                style="width:90px; height:90px; object-fit:cover;"
                                class="img-thumbnail">
                            </a>
                            </td>

                            <td class="text-center">
                                <?php if(empty($row['status'])) { ?>
                                    <span class="badge bg-secondary">
                                        Menunggu
                                    </span>

                                <?php } elseif($row['status'] == 'proses') { ?>
                                    <span class="badge bg-warning text-dark">
                                        Proses
                                    </span>

                                <?php } elseif($row['status'] == 'selesai') { ?>
                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                <?php } else { ?>
                                    <span class="badge bg-secondary">
                                        <?= htmlspecialchars($row['status']); ?>
                                    </span>

                                <?php } ?>
                            </td>
                            
                            <td>
                                <?= !empty($row['feedback']) ? htmlspecialchars($row['feedback']) : 'Menunggu balasan'; ?>
                            </td>
                        </tr>

                            <?php
                            }
                                }else{
                                    echo "<tr><td colspan='8' class='text-center'> Belum ada pengaduan </td></tr>";
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>