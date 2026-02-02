<?php
include "../connect.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * 
    FROM rawat_inap_zivana 
    WHERE id_rawat = '$id'
"));

$id_kamar_lama = $data['id_kamar'];

$kamar = mysqli_query($conn, "
    SELECT * 
    FROM kamar_zivana 
    WHERE status_kamar = 'tersedia'
       OR id_kamar = '$id_kamar_lama'
");

if (isset($_POST['update'])) {
    $id_kamar_baru = $_POST['id_kamar'];
    $tgl_keluar    = $_POST['tgl_keluar'];

    mysqli_query($conn, "
        UPDATE rawat_inap_zivana SET
        id_kamar   = '$id_kamar_baru',
        tgl_keluar = '$tgl_keluar'
        WHERE id_rawat = '$id'
    ");

    mysqli_query($conn, "
        UPDATE kamar_zivana
        SET status_kamar = 'tersedia'
        WHERE id_kamar = '$id_kamar_lama'
    ");

    mysqli_query($conn, "
        UPDATE kamar_zivana
        SET status_kamar = 'tidak'
        WHERE id_kamar = '$id_kamar_baru'
    ");

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<h2>Edit Rawat Inap</h2>

<form method="post">

ID Rawat : <?= $data['id_rawat'] ?><br>
ID Pasien : <?= $data['id_pasien'] ?><br><br>

Kamar <br>
<select name="id_kamar" required>
<?php while($k = mysqli_fetch_assoc($kamar)) { ?>
    <option value="<?= $k['id_kamar'] ?>"
        <?= $k['id_kamar'] == $data['id_kamar'] ? 'selected' : '' ?>>
        No <?= $k['no_kamar'] ?> | Kelas <?= $k['kelas'] ?>
    </option>
<?php } ?>
</select><br><br>

Tanggal Keluar <br>
<input type="date" name="tgl_keluar"
       value="<?= $data['tgl_keluar'] ?>"><br><br>

<button type="submit" name="update">Update</button>
<button><a href="index.php">Back</a></button> 

</form>
</div>
</body>
</html>

