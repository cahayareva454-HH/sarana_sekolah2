<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Sarana Sekolah</title>
    <style>
        body {
            background-color: #ccdeef;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .icon-box {
            font-size: 50px;
            color: #7cc6f4
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-home"></i>  Sarana Sekolah
            </a>
        </div>
    </nav>
    
    <section class="text-center py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 text-center text-md-start">
                    <h1 class="fw-bold">Sistem Pengaduan Sarana Prasarana Sekolah</h1>
                    <p class="text-muted mt-3">Aplikasi Sarana Sekolah</p>

                    <div class="mt-4">
                        <a href="siswa/login-siswa.php" class="btn btn-success btn-lg me-2">
                            <i class="fas fa-graduation-cap"></i> Login Siswa
                        </a>

                        <a href="admin/login.php" class="btn btn-outline-dark btn-lg">
                            <i class="fas fa-user"></i> Login Admin
                        </a>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <div class="icon-box mb-3">
                        <i class="fas fa-comments fa-3x text-primary"></i>
                    </div>

                    <h5 class="fw-semibold">
                        Pengaduan | Umpan balik | Progres
                    </h5>

                    <p class="text-muted">
                        Setiap laporan akan diproses dan ditindaklanjuti oleh pihak sekolah.
                        <br>
                        <strong>Aplikasi ini dibuat oleh XI PPLG</strong><br>
                        <strong>Dibuat oleh: Elsa dan Cahaya</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-3 text-center">
        <small class="text-muted">
           &copy; <?php echo date('Y'); ?>
           sarana pengaduan sekolah
        </small>
    </footer>
    
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>