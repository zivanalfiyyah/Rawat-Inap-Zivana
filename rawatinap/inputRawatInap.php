<?php
include "../connect.php";

$pasien = mysqli_query($conn, "SELECT id_pasien, nama FROM pasien_zivana");

$kamar = mysqli_query($conn, "
    SELECT * FROM kamar_zivana 
    WHERE status_kamar = 'tersedia'
");

$prefix = "RI";

$sql = "SELECT kode_ri FROM rawat_inap_zivana ORDER BY id_rawat DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $lastNumber = (int) substr($row['kode_ri'], -4);
    $newNumber = $lastNumber + 1;
} else {
    $newNumber = 1;
}

$kodeBaru = $prefix . str_pad($newNumber, 4, "0", STR_PAD_LEFT);



if (isset($_POST['simpan'])) {
    $kode_ri  = $_POST['kode_ri'];
    $id_pasien = $_POST['id_pasien'];
    $id_kamar  = $_POST['id_kamar'];
    $tgl_masuk = $_POST['tgl_masuk'];

    mysqli_query($conn, "
        INSERT INTO rawat_inap_zivana
        (kode_ri, id_pasien, id_kamar, tgl_masuk, tgl_keluar)
        VALUES
        ('$kode_ri', '$id_pasien', '$id_kamar', '$tgl_masuk', NULL)
    ");

    mysqli_query($conn, "
        UPDATE kamar_zivana 
        SET status_kamar = 'tidak'
        WHERE id_kamar = '$id_kamar'
    ");

    header("Location: index.php");
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
    <form method="post">
ID Rawat <br>
<input type="text" name="kode_ri" readonly value="<?=$kodeBaru?>" required><br><br>

Pasien <br>
<select name="id_pasien" required>
<?php while($p = mysqli_fetch_assoc($pasien)) { ?>
<option value="<?= $p['id_pasien'] ?>"><?= $p['nama'] ?></option>
<?php } ?>
</select><br><br>

Kamar <br>
<select name="id_kamar" required>
<?php while($k = mysqli_fetch_assoc($kamar)) { ?>
<option value="<?= $k['id_kamar'] ?>">
    No <?= $k['no_kamar'] ?> - Kelas <?= $k['kelas'] ?>
</option>
<?php } ?>
</select><br><br>

Tanggal Masuk <br>
<input type="date" name="tgl_masuk" required><br><br>

<button name="simpan">Save</button>
<button><a href="index.php">Back</a></button>
</form>
</div>
</body>
</html>