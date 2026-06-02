<?php
session_start();

include "../koneksi.php";

mysqli_query($conn,"
UPDATE pengaduan
SET notif='dibaca'
WHERE notif='baru'
");


    if (!isset($_SESSION['admin'])) {
        header("location: login.php");
        exit;
    }

    if (!isset($_GET['id'])) {
        header("location: data-pengaduan.php");
        exit;
    }

    $id = (int) $_GET['id'];

    $query = mysqli_query($conn, "
         SELECT
            ia.id_pelaporan,
            ia.id_kategori,
            ia.status,
            ia.tanggal,
            s.nis,
            s.nama,
            s.kelas,
            ia.lokasi,
            k.ket_kategori,
            ia.ket AS pengaduan,
            a.feedback,
            ia.foto
        FROM input_aspirasi ia
        JOIN siswa s ON ia.nis = s.nis
        JOIN kategori k ON ia.id_kategori = k.id_kategori
        LEFT JOIN aspirasi a ON ia.id_pelaporan = a.id_pelaporan
        WHERE ia.id_pelaporan = '$id'
    ");

    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        header("location: data-pengaduan.php");
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
    <title>Lihat Pengaduan</title>
</head>
<body>
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

                    <a href="data-pengaduan.php" class="btn btn-light btn-sm me-2">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
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
                    Detail Pengaduan
                </h5>
            </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">NIS</th>
                            <td><?= htmlspecialchars($data['nis']); ?></td>
                        </tr>

                        <tr>
                            <th>Nama</th>
                            <td><?= htmlspecialchars($data['nama']); ?></td>
                        </tr>

                        <tr>
                            <th>Kelas</th>
                            <td><?= htmlspecialchars($data['kelas']); ?></td>
                        </tr>

                        <tr>
                            <th>Kategori</th>
                            <td><?= htmlspecialchars($data['ket_kategori']); ?></td>
                        </tr>

                        <tr>
                            <th>Lokasi</th>
                            <td><?= htmlspecialchars($data['lokasi']); ?></td>
                        </tr>

                        <tr>
                            <th>Keterangan</th>
                            <td><?= htmlspecialchars($data['pengaduan']); ?></td>
                        </tr>

                        <tr>
                            <th>Foto Bukti</th>
                            <td class="text-center">
                                <?php if(!empty($data['foto'])) { ?>
                                
                                    <a href="../foto-pengaduan/<?= htmlspecialchars($data['foto']); ?>" target="_blank">
                                        <img src="../foto-pengaduan/<?= htmlspecialchars($data['foto']); ?>"
                                        width="120"
                                        class="img-thumbnail"
                                        alt="Foto Pengaduan">
                                    </a>

                                <?php } else { ?>
                                    <span class="text-muted">
                                        Tidak ada foto
                                    </span>
                                <?php } ?>

                            </td>
                        </tr>
                    </table>

                        <form method="post" action="../proses/update-pengaduan.php">
                            <input type="hidden" name="id_pelaporan" value="<?= $data['id_pelaporan']; ?>">
                            <input type="hidden" name="id_kategori" value="<?= $data['id_kategori']; ?>">

                            <div class="mb-3">
                                <label class="form-label"><strong>Status Pengaduan</strong></label>
                                <select name="status" class="form-select" required>
                                    <option value="menunggu" <?= ($data['status']=='menunggu')? 'selected': '';?>> Menunggu</option>
                                    <option value="proses" <?= ($data['status']=='proses')? 'selected': '';?>> Proses</option>
                                    <option value="selesai" <?= ($data['status']=='selesai')? 'selected': '';?>> Selesai</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Feedback</label>
                                <textarea name="feedback"
                                class="form-control"
                                rows="3"><?= htmlspecialchars($data['feedback']); ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="data-pengaduan.php" class="btn btn-secondary">
                                    Kembali
                                </a>

                                <button class="btn btn-success" type="submit" name="simpan">
                                    Simpan
                                </button>
                            </div>
                        </form>
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