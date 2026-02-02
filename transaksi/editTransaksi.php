<?php
include "../connect.php";

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan");
}

$id = $_GET['id'];

if (isset($_POST['update'])) {

    $id_transaksi = $_POST['id_transaksi'];
    $id_pasien = $_POST['id_pasien'];
    $status = $_POST['status_pembayaran'];

    $q = mysqli_query($conn, "
        SELECT 
            DATEDIFF(ri.tgl_keluar, ri.tgl_masuk) * k.harga AS total
        FROM rawat_inap_zivana ri
        JOIN kamar_zivana k ON ri.id_kamar = k.id_kamar
        WHERE ri.id_pasien = '$id_pasien'
    ");

    $data = mysqli_fetch_assoc($q);
    $total = $data['total'];

    mysqli_query($conn, "
        UPDATE transaksi_zivana SET
            total_bayar = '$total',
            status_pembayaran = '$status'
        WHERE id_transaksi = '$id_transaksi'
    ");

    header("Location: index.php");
    exit;
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM transaksi_zivana WHERE id_transaksi='$id'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
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
<h2>Edit Transaksi</h2>

<form method="post">
    <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">
    <input type="hidden" name="id_pasien" value="<?= $data['id_pasien'] ?>">

    <label>Total Bayar</label><br>
    <input type="text" value="<?= $data['total_bayar'] ?>" readonly><br><br>

    <label>Status Pembayaran</label><br>
    <select name="status_pembayaran">
        <option value="Lunas" <?= $data['status_pembayaran']=="Lunas"?"selected":"" ?>>Lunas</option>
        <option value="Belum Lunas" <?= $data['status_pembayaran']=="Belum Lunas"?"selected":"" ?>>Belum Lunas</option>
    </select><br><br>

    <button type="submit" name="update">Update</button>
    <button><a href="index.php">Back</a></button>
</form>
</div>
</body>
</html>
