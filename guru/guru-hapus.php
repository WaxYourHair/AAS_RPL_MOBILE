<?php
include_once("../functions.php");

if(isset($_GET['nip'])){
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $nip = $db->real_escape_string($_GET['nip']);
        $query = "DELETE FROM guru WHERE nip='$nip'";
        $execute = $db->query($query);

        if($execute){
            header('location: guru.php');
        } else {
            echo "Gagal menghapus data: " . $db->error;
        }
    } else {
        echo "Gagal koneksi: " . $db->connect_error;
    }
} else {
    echo "NIP tidak ditemukan.";
}
?>
