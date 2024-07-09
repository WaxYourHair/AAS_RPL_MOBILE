<?php
// Database connection
function getDatabaseConnection() {
    $host = 'localhost'; // Adjust these values according to your setup
    $dbname = 'raport';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }
}

// Fetch nilai siswa
function getNilaiSiswa($nis) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM nilai WHERE nis = ?");
    $stmt->execute([$nis]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch wali kelas
function getWaliKelas($nis) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT wali_kelas FROM kelas WHERE nis = ?");
    $stmt->execute([$nis]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['wali_kelas'];
}

// Fetch tahun ajaran
function getTahunAjaran($nis) {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT tahun_ajaran FROM kelas WHERE nis = ?");
    $stmt->execute([$nis]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['tahun_ajaran'];
}
?>
