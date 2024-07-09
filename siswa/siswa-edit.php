<?php
include_once("../functions.php");
$title = 'Edit Siswa';

$con = dbConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $con->escape_string($_POST['nis']);
    $nama = $con->escape_string($_POST['nama']);
    $id_kelas = $con->escape_string($_POST['id_kelas']);
    $status_pembayaran = $con->escape_string($_POST['status_pembayaran']);
    // Query untuk update data siswa
    $query = "UPDATE siswa SET nama='$nama', id_kelas='$id_kelas', status_pembayaran='$status_pembayaran' WHERE nis='$nis'";
    if ($con->query($query) === TRUE) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $query . "<br>" . $con->error;
    }
    header("Location: siswa.php");
    exit;
}

$nis = $con->escape_string($_GET['nis']);
$siswa = ambilsatubaris($con, "SELECT * FROM siswa WHERE nis='$nis'");
$kelas = ambilbanyakbaris($con, "SELECT * FROM kelas");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include_once("../layout/sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once("../layout/topbar.php") ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Siswa</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control" value="<?= $siswa['nis'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $siswa['nama'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="id_kelas" class="form-control" required>
                                        <?php foreach ($kelas as $k): ?>
                                            <option value="<?= $k['id_kelas'] ?>" <?= $siswa['id_kelas'] == $k['id_kelas'] ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select name="status_pembayaran" class="form-control" required>
                                        <option value="0" <?= $siswa['status_pembayaran'] == '0' ? 'selected' : '' ?>>Belum Lunas</option>
                                        <option value="1" <?= $siswa['status_pembayaran'] == '1' ? 'selected' : '' ?>>Lunas</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Update Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("../layout/footer.php") ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>
</html>
