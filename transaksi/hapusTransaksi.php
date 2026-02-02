<?php
include "../connect.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM transaksi_zivana WHERE id_transaksi='$id'");
header("Location: index.php");