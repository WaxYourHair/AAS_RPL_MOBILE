<?php
include_once("../functions.php");

$db = dbConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kelas = $db->escape_string($_POST['id_kelas']);
    $id_mapel = $db->escape_string($_POST['id_mapel']);

    // Menghapus data dari tabel kelas_guru
    $sql_hapus = "DELETE FROM kelas_guru WHERE id_kelas='$id_kelas' AND kd_mp='$id_mapel'";
    if ($db->query($sql_hapus) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query Execution Failed: ' . $db->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request Method']);
}
?>
