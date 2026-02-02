<?php
include "../connect.php";

$data = mysqli_query($conn, 
    "SELECT transaksi_zivana.*, pasien_zivana.id_pasien, pasien_zivana.nama, kamar_zivana.id_kamar, kamar_zivana.harga
     FROM transaksi_zivana 
     JOIN pasien_zivana ON transaksi_zivana.id_pasien = pasien_zivana.id_pasien
     JOIN kamar_zivana ON transaksi_zivana.id_kamar = kamar_zivana.id_kamar"

     
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="../asset/zivana.css">
    <script src="../js/star.js" defer></script>
</head>

<style>

.cetak-btn {
    width: 15%;
    margin-left: 43%;
}

</style>

<body>

<div class="navbar">
    <h1>RS.Sudirman</h1>
    <div class="nav-links">
        <a href="../dashboard.php">Dashboard</a>
        <a href="../rawatinap/index.php">Rawat Inap</a>
        <a href="../transaksi/index.php">Transaksi</a>
        <a href="../pasien/index.php">Pasien</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<h2 style="margin-top:100px; text-align:center;">Data Transaksi</h2>

<table>
    <tr>
        <th>ID Transaksi</th>
        <th>ID Pasien</th>
        <th>ID Kamar</th>
        <th>Nama Pasien</th>
        <th>Harga</th>
        <th>Total Bayar</th>
        <th>Status Pembayaran</th>
        <th>tgl</th>
        <th>Action</th>
    </tr>

    <?php while($d = mysqli_fetch_assoc($data)){ ?>
    <tr>
        <td><?= $d['kode_tr'] ?></td>
        <td><?= $d['id_pasien'] ?></td>
        <td><?= $d['id_kamar'] ?></td>
        <td><?= $d['nama'] ?></td>
        <td><?= $d['harga'] ?></td>
        <td><?= $d['total_bayar'] ?></td>
        <td><?= $d['status_pembayaran'] ?></td>
        <td><?= $d['tgl'] ?></td>
        <td>
            <a class="back" href="editTransaksi.php?id=<?= $d['id_transaksi'] ?>">Edit</a> 
            <a class="back" href="hapusTransaksi.php?id=<?= $d['id_transaksi'] ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="inputTransaksi.php" class="back" style="margin-left:15%;">+ Add Data</a>
  <a href="cetakTransaksi.php" target="_blank">
    <input type="button" value="Cetak" class="cetak-btn">
</a>

</body>
</html>