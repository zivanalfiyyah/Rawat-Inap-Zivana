<?php
include "../connect.php";
require "../fpdf/fpdf.php";

$data = mysqli_query($conn, "
    SELECT 
        transaksi_zivana.kode_tr,
        transaksi_zivana.id_pasien,
        transaksi_zivana.id_kamar,
        transaksi_zivana.total_bayar,
        transaksi_zivana.status_pembayaran,
        transaksi_zivana.tgl,
        pasien_zivana.nama,
        kamar_zivana.harga
    FROM transaksi_zivana
    JOIN pasien_zivana ON transaksi_zivana.id_pasien = pasien_zivana.id_pasien
    JOIN kamar_zivana ON transaksi_zivana.id_kamar = kamar_zivana.id_kamar
");

$pdf = new FPDF('L','mm','A4'); 
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN DATA TRANSAKSI RS SUDIRMAN',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'ID Transaksi',1);
$pdf->Cell(25,8,'ID Pasien',1);
$pdf->Cell(25,8,'ID Kamar',1);
$pdf->Cell(45,8,'Nama Pasien',1);
$pdf->Cell(30,8,'Harga',1);
$pdf->Cell(35,8,'Total Bayar',1);
$pdf->Cell(35,8,'Status',1);
$pdf->Cell(30,8,'Tanggal',1);
$pdf->Ln();

$pdf->SetFont('Arial','',9);
while($d = mysqli_fetch_assoc($data)){
    $pdf->Cell(30,8,$d['kode_tr'],1);
    $pdf->Cell(25,8,$d['id_pasien'],1);
    $pdf->Cell(25,8,$d['id_kamar'],1);
    $pdf->Cell(45,8,$d['nama'],1);
    $pdf->Cell(30,8,'Rp '.number_format($d['harga']),1);
    $pdf->Cell(35,8,'Rp '.number_format($d['total_bayar']),1);
    $pdf->Cell(35,8,$d['status_pembayaran'],1);
    $pdf->Cell(30,8,$d['tgl'],1);
    $pdf->Ln();
}

$pdf->Output();
