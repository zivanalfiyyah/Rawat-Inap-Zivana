<?php
include "../connect.php";

$pasien = mysqli_query($conn, "
    SELECT id_pasien, nama 
    FROM pasien_zivana
");
$kamar = mysqli_query($conn, "
    SELECT * FROM kamar_zivana 
");

$prefix = "TR";

$sql = "SELECT kode_tr FROM transaksi_zivana ORDER BY id_transaksi DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $lastNumber = (int) substr($row['kode_tr'], -4);
    $newNumber = $lastNumber + 1;
} else {
    $newNumber = 1;
}

$kodeBaru = $prefix . str_pad($newNumber, 4, "0", STR_PAD_LEFT);


if (isset($_POST['simpan'])) {
    $kode_tr = $_POST['kode_tr'];
    $id_pasien    = $_POST['id_pasien'];
    $id_kamar     = $_POST['id_kamar'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $tgl          = date('Y-m-d');

   $q = mysqli_query($conn, "
    SELECT 
        DATEDIFF(
            IFNULL(ri.tgl_keluar, CURDATE()),
            ri.tgl_masuk
        ) * k.harga AS total
    FROM rawat_inap_zivana ri
    JOIN kamar_zivana k ON ri.id_kamar = k.id_kamar
    WHERE ri.id_pasien = '$id_pasien'
");


    $data = mysqli_fetch_assoc($q);
    $total_bayar = $data['total'];

     mysqli_query($conn, "
        INSERT INTO transaksi_zivana
        (kode_tr, id_pasien, id_kamar, total_bayar, status_pembayaran, tgl)
        VALUES
        ('$kode_tr', '$id_pasien', '$id_kamar', '$total_bayar', '$status_pembayaran' , '$tgl' )
    ");

    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Input Transaksi</title>
     <link rel="stylesheet" href="../asset/zivana.css">
    <script src="../js/star.js" defer></script>
</head>
<style>
    .box select option {
        background:rgb(181, 104, 216);
    }
     a{
        text-decoration:none;
        color:#fff;
    }
</style>
<body>

<div class="navbar">
    <h1>RS.Sudirman</h1>
    <div class="nav-links">
        <a href="../dashboard.php">Dashboard</a>
        <a href="../rawatinap/index.php">Rawat Inap</a>
        <a href="../transaksi/index.php">Transaksi</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="box">
<h2>Tambah Transaksi</h2>

<form method="post">

    <label>Pasien</label><br>
    <select name="id_pasien" required>
        <option value="">-- Pilih Pasien --</option>
        <?php while ($p = mysqli_fetch_assoc($pasien)) { ?>
            <option value="<?= $p['id_pasien'] ?>">
                <?= $p['nama'] ?>
            </option>
        <?php } ?>
    </select>
    <br><br>
    
    <input type="text" name="kode_tr" readonly value="<?=$kodeBaru?>" required>

    Kamar <br>
    <select name="id_kamar" required>
    <?php while($k = mysqli_fetch_assoc($kamar)) { ?>
    <option value="<?= $k['id_kamar'] ?>">
        No <?= $k['no_kamar'] ?> - Kelas <?= $k['kelas'] ?>
    </option>
    <?php } ?>
    </select><br><br>

    <label>Status Pembayaran</label><br>
    <select name="status_pembayaran">
        <option value="Lunas">Lunas</option>
        <option value="Belum Lunas">Belum Lunas</option>
    </select>
    <br><br>
    
    <button type="submit" name="simpan">Save</button>
    <button><a href="index.php">Back</a></button>

</form>
</div>
</body>
</html>

