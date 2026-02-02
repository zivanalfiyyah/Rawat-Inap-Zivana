<?php

include "../connect.php";
require "../fpdf/fpdf.php";

$pdf = new FPDF('L','mm','A4'); 
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN DATA RAWAT INAP RS SUDIRMAN',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'ID Rawat',1);
$pdf->Cell(25,8,'ID Pasien',1);
$pdf->Cell(25,8,'ID Kamar',1);
$pdf->Cell(30,8,'Harga',1);
$pdf->Cell(30,8,'Kelas',1);
$pdf->Cell(35,8,'Tanggal Masuk',1);
$pdf->Cell(35,8,'Tanggal Keluar',1);
$pdf->Ln();

$data = mysqli_query($conn, 
    "SELECT 
       rawat_inap_zivana.*, 
       pasien_zivana.id_pasien, 
       kamar_zivana.id_kamar, 
       kamar_zivana.harga, 
       kamar_zivana.kelas
     FROM rawat_inap_zivana 
     JOIN pasien_zivana ON rawat_inap_zivana.id_pasien = pasien_zivana.id_pasien
     JOIN kamar_zivana ON rawat_inap_zivana.id_kamar = kamar_zivana.id_kamar"
     
);

$pdf->SetFont('Arial','',9);
while($d = mysqli_fetch_assoc($data)){
    $pdf->Cell(30,8,$d['kode_ri'],1);
    $pdf->Cell(25,8,$d['id_pasien'],1);
    $pdf->Cell(25,8,$d['id_kamar'],1);
    $pdf->Cell(30,8,'Rp '.number_format($d['harga']),1);
    $pdf->Cell(30,8,$d['kelas'],1);
    $pdf->Cell(35,8,$d['tgl_masuk'],1);
    $pdf->Cell(35,8,$d['tgl_keluar'],1);
    $pdf->Ln();
}

$pdf->Output();
