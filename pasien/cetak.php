<?php
include "../connect.php";
require "../fpdf/fpdf.php";

$data = mysqli_query($conn, "SELECT * FROM pasien_zivana");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'DATA PASIEN RS SUDIRMAN',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,8,'ID Pasien',1);
$pdf->Cell(50,8,'Nama',1);
$pdf->Cell(70,8,'Alamat',1);
$pdf->Cell(40,8,'Kontak',1);
$pdf->Ln();

$pdf->SetFont('Arial','',10);
while($d = mysqli_fetch_assoc($data)){
    $pdf->Cell(30,8,$d['id_pasien'],1);
    $pdf->Cell(50,8,$d['nama'],1);
    $pdf->Cell(70,8,$d['alamat'],1);
    $pdf->Cell(40,8,$d['kontak'],1);
    $pdf->Ln();
}

$pdf->Output();
