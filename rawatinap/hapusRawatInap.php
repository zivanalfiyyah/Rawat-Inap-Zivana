<?php
include "../connect.php";

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM rawat_inap_zivana
    WHERE id_rawat = '$id'
");

header("Location: index.php");
