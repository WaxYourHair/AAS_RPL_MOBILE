<?php
include_once("../functions.php");

$db = dbConnect();

// Function to check if the slot is available
function isSlotAvailable($db, $id_kelas, $tanggal, $waktu) {
    $check_query = "
        SELECT COUNT(*) AS count FROM kelas_guru
        WHERE id_kelas = '$id_kelas'
        AND tanggal = '$tanggal'
        AND waktu = '$waktu'";
    
    $check_result = $db->query($check_query);
    
    if (!$check_result) {
        die("Query Error: " . $db->error);
    }
    
    $row = $check_result->fetch_assoc();
    return $row['count'] == 0;
}

// Function to check if the class and subject combination is available
function isClassSubjectAvailable($db, $id_kelas, $kd_mp, $nip) {
    $check_query = "
        SELECT COUNT(*) AS count FROM kelas_guru
        WHERE id_kelas = '$id_kelas'
        AND kd_mp = '$kd_mp'
        AND nip = '$nip'";
    
    $check_result = $db->query($check_query);
    
    if (!$check_result) {
        die("Query Error: " . $db->error);
    }
    
    $row = $check_result->fetch_assoc();
    return $row['count'] == 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tahun_akademik = $db->escape_string($_POST['id']);
    $id_kelas = $db->escape_string($_POST['id_kelas']);
    $nip = $db->escape_string($_POST['nip']);
    $tanggal = $db->escape_string($_POST['tanggal']);
    $waktu = $db->escape_string($_POST['waktu']);

    // Debugging: log received data
    error_log("Received data: id_tahun_akademik=$id_tahun_akademik, id_kelas=$id_kelas, nip=$nip, tanggal=$tanggal, waktu=$waktu");

    // Mengambil kd_mp berdasarkan nip
    $kd_mp_query = "SELECT kd_mp FROM guru WHERE nip='$nip'";
    $kd_mp_result = $db->query($kd_mp_query);
    if ($kd_mp_result) {
        $kd_mp_row = $kd_mp_result->fetch_assoc();
        $kd_mp = $kd_mp_row['kd_mp'];

        // Check if the class and subject combination is available
        if (isClassSubjectAvailable($db, $id_kelas, $kd_mp, $nip)) {
            // Check if the slot is available
            if (isSlotAvailable($db, $id_kelas, $tanggal, $waktu)) {
                // Menyimpan data ke tabel kelas_guru
                $sql_relasi = "INSERT INTO kelas_guru (id_tahun_akademik, id_kelas, kd_mp, nip, tanggal, waktu) VALUES ('$id_tahun_akademik', '$id_kelas', '$kd_mp', '$nip', '$tanggal', '$waktu')";
                if ($db->query($sql_relasi) === TRUE) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Query Execution Failed: ' . $db->error]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Slot already taken']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Class and subject combination already exists']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query Execution Failed: ' . $db->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request Method']);
}
?>
