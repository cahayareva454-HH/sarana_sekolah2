<?php
session_start();
include "../koneksi.php";

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Tanggal');
$sheet->setCellValue('C1', 'Nama');
$sheet->setCellValue('D1', 'Kelas');
$sheet->setCellValue('E1', 'Lokasi');
$sheet->setCellValue('F1', 'Pengaduan');
$sheet->setCellValue('G1', 'Kategori');
$sheet->setCellValue('H1', 'Feedback');

$query = mysqli_query($conn,"
    SELECT
        ia.tanggal,
        s.nama,
        s.kelas,
        ia.lokasi,
        ia.ket,
        k.ket_kategori,
        a.feedback
    FROM input_aspirasi ia
    JOIN siswa s ON ia.nis = s.nis
    JOIN kategori k ON ia.id_kategori = k.id_kategori
    LEFT JOIN aspirasi a
    ON ia.id_pelaporan = a.id_pelaporan
");

$rowNumber = 2;
$no = 1;

while($row = mysqli_fetch_assoc($query)){

    $sheet->setCellValue('A'.$rowNumber, $no++);
    $sheet->setCellValue('B'.$rowNumber, date('d m Y', strtotime($row['tanggal'])));
    $sheet->setCellValue('C'.$rowNumber, $row['nama']);
    $sheet->setCellValue('D'.$rowNumber, $row['kelas']);
    $sheet->setCellValue('E'.$rowNumber, $row['lokasi']);
    $sheet->setCellValue('F'.$rowNumber, $row['ket']);
    $sheet->setCellValue('G'.$rowNumber, $row['ket_kategori']);
    $sheet->setCellValue('H'.$rowNumber, $row['feedback']);

    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan-pengaduan.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>