<?php
include_once("../functions.php");

$con = dbConnect(); // Pastikan koneksi database diinisialisasi

$nis = $con->escape_string($_GET['nis']);

$query = "DELETE FROM siswa WHERE nis='$nis'";

$execute = bisa($con, $query);

if($execute == 1){
    header('Location: siswa.php');
    exit;
} else {
    echo "Gagal menghapus data";
}
?>
