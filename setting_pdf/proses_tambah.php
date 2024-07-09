<?php
include_once("../functions.php");
$db = dbConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tahun_akademik = $db->escape_string($_POST['tahun_akademik']);
    $semester = $db->escape_string($_POST['semester']);
    $semester_aktif = $db->escape_string($_POST['semester_aktif']);
    $tempat = $db->escape_string($_POST['tempat']);
    $tanggal = $db->escape_string($_POST['tanggal']);

    $query = "INSERT INTO tahun_akademik (tahun_akademik, semester, semester_aktif, tempat, tanggal) VALUES ('$tahun_akademik', '$semester', '$semester_aktif', '$tempat', '$tanggal')";
    if ($db->query($query)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data: ".$db->error."');
                window.location.href = 'tahun_akademik.php';
              </script>";
    }
}
?>
