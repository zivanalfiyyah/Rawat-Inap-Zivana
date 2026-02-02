<?php
session_start();
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit;
}

include "connect.php";

$q1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM rawat_inap_zivana"));
$q2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM transaksi_zivana"));
$q3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM pasien_zivana"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="asset/zivana.css">
    <link rel="stylesheet" href="dashboard.css">

    <script src="js/star.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="navbar">
    <h1>RS.Sudirman</h1>
    <div class="nav-links">
        <a href="../dashboard.php">Dashboard</a>
        <a href="rawatinap/index.php">Rawat Inap</a>
        <a href="transaksi/index.php">Transaksi</a>
        <a href="pasien/index.php">Pasien</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h2 class="dash-title">Selamat Datang di Dashboard</h2>

<div class="welcome-box">
    <h3><i class="fa-solid fa-user"></i> Halo !</h3>
    <p>Selamat datang di sistem RS. Sudirman ✨</p>
</div>

<div class="stat-container">

    <div class="stat-card">
        <i class="fa-solid fa-tags"></i>
        <h3>Total Data Rawat Inap</h3>
        <p><?= $q1['jml']; ?></p>
    </div>

    <div class="stat-card">
        <i class="fa-solid fa-toolbox"></i>
        <h3>Total Data Transaksi</h3>
        <p><?= $q2['jml']; ?></p>
    </div>

     <div class="stat-card">
        <i class="fa-solid fa-toolbox"></i>
        <h3>Total Data Pasien</h3>
        <p><?= $q3['jml']; ?></p>
    </div>

</div>

<h2 class="dash-subtitle">Menu Navigasi</h2>

<div class="dashboard-container">

    <a href="rawatinap/index.php" class="menu-link">
        <div class="menu-card">
            <i class="fa-solid fa-tags"></i>
            <h3>Data Rawat Inap</h3>
        </div>
    </a>

    <a href="transaksi/index.php" class="menu-link">
        <div class="menu-card">
            <i class="fa-solid fa-toolbox"></i>
            <h3>Data Transaksi</h3>
        </div>
    </a>

    <a href="pasien/index.php" class="menu-link">
        <div class="menu-card">
            <i class="fa-solid fa-toolbox"></i>
            <h3>Data Pasien</h3>
        </div>
    </a>

    <a href="logout.php" class="menu-link">
        <div class="menu-card">
            <i class="fa-solid fa-right-from-bracket"></i>
            <h3>Logout</h3>
        </div>
    </a>

</div>

</body>
</html>
