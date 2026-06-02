<?php
session_start();

include "../koneksi.php";

//cek login admin
if(!isset($_SESSION['admin'])){
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
    <title>Cetak Laporan</title> 
    <style>
        body {font-family: arial, sans-serif;}
        h2, p {text-align: center;}
        h2 {margin-bottom: 5px;}
        p {margin-top: 0; font-size: 14px;}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        table, th, td { border: 1px solid #000 ; }
        th, td {padding: 6px; text-align: center; }

        @media print {
            body {margin: 0;}
        }

        @media print {

        body {
            background: white !important;
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            vertical-align: top;
            word-wrap: break-word;
        }
    }

        @page {
            size: landscape;
            margin: 10mm;
        }
    </style>

</head>
<body>

     <h2>LAPORAN PENGADUAN SARANA SEKOLAH</h2>
     <p>Sistem informasi pengaduan sarana</p>
    
    <table>
    <thead>
        <tr>
           <th>No</th>
           <th>Tanggal</th>
           <th>NIS</th>
           <th>Nama</th>
           <th>Kelas</th>
           <th>Kategori</th>
           <th>Pengaduan</th>
           <th>Feedback</th>
        </tr>
        </thead>

        <tbody>
            <?php
            $no =1;
            $query = mysqli_query($conn, "
                SELECT
                    ia.tanggal,
                    s.nis,
                    s.nama,
                    s.kelas,
                    k.ket_kategori,
                    ia.ket,
                    a.feedback
                FROM input_aspirasi ia
                JOIN siswa s ON ia.nis = s.nis
                JOIN kategori k ON ia.id_kategori = k.id_kategori
                LEFT JOIN aspirasi a
                ON ia.id_pelaporan = a.id_pelaporan
                ORDER BY ia.tanggal DESC
                LIMIT 10
            ");
 
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)){
            ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                <td><?= htmlspecialchars($row['nis']);?></td>
                <td><?= htmlspecialchars($row['nama']);?></td>
                <td><?= htmlspecialchars($row['kelas']);?></td>
                <td><?= htmlspecialchars($row['ket_kategori']);?></td>

                <td style="text-align: left">
                    <?= htmlspecialchars($row['ket']);?>
                </td>
                <td style="text-align: left">
                    <?= !empty($row['feedback'])
                        ? htmlspecialchars($row['feedback'])
                        : '-' ; ?>
                </td>
            </tr>

            <?php
                }
            } else {
                echo "<tr><td colspan='8'>Data Belum Tersedia</td></tr>";
            }
            ?>

        </tbody>
    </table>

    <script>
    setTimeout(function(){
        window.print();
    },1000);

    window.onafterprint = function(){
        window.close();
    }
</script>
</body>
</html>