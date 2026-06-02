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
    <title>Data Pengaduan Siswa</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container-fluid">

            <span class="navbar-brand fw-bold">
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

                    <a href="../proses/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </a>
            </div>
        </div>
    </nav>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fa-solid fa-comment"></i> Data Pengaduan Sarana Sekolah</h5>
        </div>

        <div class="card-body">

        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control"
                        placeholder="Cari nama / kelas / kategori..."
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i> Cari
                    </button>

                    <a href="data-pengaduan.php" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $no = 1;
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                            $query = mysqli_query($conn, "
                            SELECT
                                ia.id_pelaporan,
                                ia.tanggal,
                                s.nis,
                                s.nama,
                                s.kelas,
                                ia.lokasi,
                                ia.foto,
                                k.ket_kategori,
                                ia.ket,
                                IFNULL(a.status, 'menunggu') AS status
                            FROM input_aspirasi ia
                            -- ia = alias tabel input_aspirasi
                            JOIN siswa s ON ia.nis = s.nis
                            -- menggabungkan tabel siswa berdasarkan nis
                            JOIN kategori k ON ia.id_kategori = k.id_kategori
                            LEFT JOIN aspirasi a ON ia.id_pelaporan = a.id_pelaporan
                            WHERE
                                s.nama LIKE '%$search%'
                                OR s.kelas LIKE '%$search%'
                                OR k.ket_kategori LIKE '%$search%'
                                OR ia.lokasi LIKE '%$search%'
                                OR ia.ket LIKE '%$search%'
                                OR DATE_FORMAT(ia.tanggal, '%d %m %Y') LIKE '%$search%'
                                OR DATE_FORMAT(ia.tanggal, '%Y %m %d') LIKE '%$search%'
                            ORDER BY ia.tanggal DESC
                            ");

                            if ($query && mysqli_num_rows($query) > 0 ) {

                                while ($row= mysqli_fetch_assoc($query)) {
                        ?>

                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= date('d m Y H:i', strtotime($row['tanggal'])); ?> </td>
                                <td class="text-center"><?= htmlspecialchars($row['nis']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['nama']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['kelas']); ?></td>
                                <td><?= htmlspecialchars($row['lokasi']); ?></td>
                                <td><?= htmlspecialchars($row['ket_kategori']); ?></td>
                                <td><?= htmlspecialchars($row['ket']); ?></td>

                                <td>
                                    <?php if (!empty($row['foto'])) { ?>
                                    
                                        <a href="../foto-pengaduan/<?= htmlspecialchars($row['foto']); ?>" target="_blank">
                                            <img src="../foto-pengaduan/<?= htmlspecialchars($row['foto']); ?>"
                                            width="120"
                                            class="img-thumbnail"
                                            alt="Foto Pengaduan">
                                        </a>

                                    <?php } else { ?>
                                        <span class="text-muted">Tidak ada foto</span>
                                    <?php } ?>
                                
                                </td>

                                <td class="text-center">
                                    <?php
                                        if ($row['status'] == 'menunggu') {
                                            echo '<span class="badge bg-secondary">Menunggu</span>';
                                        }elseif ($row['status'] == 'proses') {
                                            echo '<span class="badge bg-warning text-dark">Proses</span>';
                                        }elseif ($row['status'] == 'selesai') {
                                            echo '<span class="badge bg-success">Selesai</span>';
                                        }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <a href="lihat-pengaduan.php?id=<?= $row['id_pelaporan']; ?>" class="btn btn-info btn-sm me-2">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>

                                    <a href="../proses/hapus-pengaduan.php?id=<?= $row['id_pelaporan']; ?>" class="btn btn-danger btn-sm me-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </a>

                                </td>
                            </tr>

                            <?php
                            }
                            }else{
                                echo "<tr>
                                        <td colspan='11' class='text-center'>
                                        Data tidak ada
                                        </td>
                                    </tr>";
                            }
                            ?>
                            
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