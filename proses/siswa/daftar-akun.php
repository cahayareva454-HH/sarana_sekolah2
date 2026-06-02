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
    <title>Daftar Register Siswa</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <div class="card shadow-sm">

                    <div class="card-header bg-info text-white text-center">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-user"></i> Daftar Siswa
                        </h5>
                    </div>

                    <div class="card-body">
                        <form method="post" action="../proses/daftar-akun.php">
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                             <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-select" required>
                                    <option value="">-- Pilih Kelas --</option>

                                    <optgroup label="Kelas X">
                                    <option value="X RPL">X PPLG</option>
                                    <option value="X TKJ">X TKJ</option>
                                    <option value="X HOTEL">X HOTEL</option>
                                    <option value="X TL">X TL</option>
                                    <option value="X AKL">X AKL</option>
                                    <option value="X TPU">X TPU</option>
                                    <option value="X TBSM">X TBSM</option>
                                    <option value="X TKR">X TKR</option>
                                    </optgroup>

                                    <optgroup label="Kelas XI">
                                    <option value="XI RPL">XI RPL</option>
                                    <option value="XI TKJ">XI TKJ</option>
                                    <option value="XI HOTEL">XI HOTEL</option>
                                    <option value="XI TL">XI TL</option>
                                    <option value="XI AKL">XI AKL</option>
                                    <option value="XI TPU">XI TPU</option>
                                    <option value="XI TBSM">XI TBSM</option>
                                    <option value="XI TKR">XI TKR</option>
                                    </optgroup>
                                    
                                    <optgroup label="Kelas XII">
                                    <option value="XII RPL">XII RPL</option>
                                    <option value="XII TKJ">XII TKJ</option>
                                    <option value="XII HOTEL">XII HOTEL</option>
                                    <option value="XII TL">XII TL</option>
                                    <option value="XII AKL">XII AKL</option>
                                    <option value="XII TPU">XII TPU</option>
                                    <option value="XII TBSM">XII TBSM</option>
                                    <option value="XII TKR">XII TKR</option>
                                    </optgroup>
                                </select>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="daftar" class="btn btn-info">
                                    Daftar
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="login-siswa.php">Sudah punya akun? Login</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>