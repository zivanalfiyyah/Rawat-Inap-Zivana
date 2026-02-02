<?php
include "../connect.php";

$data = mysqli_query($conn, 
    "SELECT rawat_inap_zivana.*, pasien_zivana.id_pasien, kamar_zivana.id_kamar, kamar_zivana.harga, kamar_zivana.kelas
     FROM rawat_inap_zivana 
     JOIN pasien_zivana ON rawat_inap_zivana.id_pasien = pasien_zivana.id_pasien
     JOIN kamar_zivana ON rawat_inap_zivana.id_kamar = kamar_zivana.id_kamar"
     
);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
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

<h2 style="margin-top:100px; text-align:center;">Data Rawat Inap</h2>



<table>
    <tr>
        <th>ID Rawat</th>
        <th>ID Pasien</th>
        <th>ID Kamar</th>
        <th>Harga</th>
        <th>Kelas</th>
        <th>tgl_masuk</th>
        <th>tgl_keluar</th>
        <th>Action</th>
    </tr>

    <?php while($d = mysqli_fetch_array($data)) { ?>
    <tr>
        <td><?= $d['kode_ri'] ?></td>
        <td><?= $d['id_pasien'] ?></td>
        <td><?= $d['id_kamar'] ?></td>
        <td><?= $d['harga'] ?></td>
        <td><?= $d['kelas'] ?></td>
        <td><?= $d['tgl_masuk'] ?></td>
        <td><?= $d['tgl_keluar'] ?></td>
        <td>
            <a class="back" href="editRawatInap.php?id=<?= $d['id_rawat'] ?>">Edit</a> |
            <a class="back" href="hapusRawatInap.php?id=<?= $d['id_rawat'] ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>
<a href="inputRawatInap.php" class="back" style="margin-left:15%;">+ Add Data</a>
 <a href="cetakRawatInap.php" target="_blank">
    <input type="button" value="Cetak" class="cetak-btn">
</a>

</body>
</html>