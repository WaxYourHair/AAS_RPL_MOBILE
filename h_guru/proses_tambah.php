<?php
include_once("../functions.php");

$db = dbConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tahun_akademik = $db->escape_string($_POST['id']);
    $id_kelas = $db->escape_string($_POST['id_kelas']);
    $nip = $db->escape_string($_POST['nip']);

    // Mengambil kd_mp berdasarkan nip
    $kd_mp_query = "SELECT kd_mp FROM guru WHERE nip='$nip'";
    $kd_mp_result = $db->query($kd_mp_query);
    if ($kd_mp_result) {
        $kd_mp_row = $kd_mp_result->fetch_assoc();
        $kd_mp = $kd_mp_row['kd_mp'];

        // Menyimpan data ke tabel kelas_guru
        $sql_relasi = "INSERT INTO kelas_guru (id_tahun_akademik, id_kelas, kd_mp, nip) VALUES ('$id_tahun_akademik', '$id_kelas', '$kd_mp', '$nip')";
        if ($db->query($sql_relasi) === TRUE) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Query Execution Failed: ' . $db->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query Execution Failed: ' . $db->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request Method']);
}
?>
