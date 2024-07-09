<?php
include_once("functions.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Try to find the user in all roles
    $user = getUser($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        $role = $user['role']; // Ensure role is set in session

        // Redirect based on user role
        if ($role == 'admin') {
            header("Location: /rapot_sederhana/index.php");
        } elseif ($role == 'guru') {
            header("Location: /rapot_sederhana/h_guru/nilai.php");
        } elseif ($role == 'siswa') {
            header("Location: /rapot_sederhana/h_siswa/siswa_dashboard.php");
        }
        exit();
    } else {
        $error = "Username atau password salah";
        echo $error; // Display error message
    }
}
?>

