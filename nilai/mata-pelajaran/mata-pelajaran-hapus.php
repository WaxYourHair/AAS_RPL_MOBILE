<?php
include_once("../functions.php");

$con = dbConnect(); // Inisialisasi koneksi database

if(isset($_GET['kd_mp'])) {
    $kd_mp = $con->real_escape_string($_GET['kd_mp']);

    $query = "DELETE FROM mata_pelajaran WHERE kd_mp = $kd_mp";
    $execute = bisa($con, $query);

    if($execute) {
        header('location: mata-pelajaran.php');
    } else {
        echo "Gagal menghapus data: " . $con->error;
    }
} else {
    echo "Kode mata pelajaran tidak ditemukan.";
}
?>
