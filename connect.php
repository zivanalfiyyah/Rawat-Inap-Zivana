<?php
$conn = mysqli_connect("localhost", "root", "", "db_zivana_rawatinap");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
