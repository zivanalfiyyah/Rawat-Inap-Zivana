<?php 
include "../connect.php";

$data = mysqli_query($conn, "SELECT * FROM pasien_zivana");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Kategori</title>
    <link rel="stylesheet" href="../asset/zivana.css">
<script src="../js/star.js" defer></script>
</head>

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

<table>


    <th>ID Pasien</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Kontak</th>

    <?php while( $d = mysqli_fetch_array($data)) { ?>
        <tr>
            <td><?= $d['id_pasien'] ?></td>
            <td><?= $d['nama'] ?></td>
            <td><?= $d['alamat'] ?></td>
            <td><?= $d['kontak'] ?></td>
        </tr>
   <?php } ?>
   </table>
  <a href="cetak.php" target="_blank">
    <input type="button" value="Cetak">
</a>
</body>
</html>