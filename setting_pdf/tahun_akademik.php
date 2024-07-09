<?php
include_once("../functions.php");
$db = dbConnect();

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tahun_akademik = $db->escape_string($_POST['tahun_akademik']);
    $semester = $db->escape_string($_POST['semester']);
    $semester_aktif = $db->escape_string($_POST['semester_aktif']);
    $tempat = $db->escape_string($_POST['tempat']);
    $tanggal = $db->escape_string($_POST['tanggal']);

    $query = "INSERT INTO tahun_akademik (tahun_akademik, semester, semester_aktif, tempat, tanggal) VALUES ('$tahun_akademik', '$semester', '$semester_aktif', '$tempat', '$tanggal')";
    if ($db->query($query)) {
        $successMessage = "Data berhasil ditambahkan";
    } else {
        $errorMessage = "Gagal menambahkan data: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tahun Akademik</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Tahun Akademik</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Baru</h6>
                        </div>
                        <div class="card-body">
                            <form id="tambahTahunAkademikForm" method="POST" action="proses_tambah.php">
                                <div class="form-group">
                                    <label for="tahun_akademik">Tahun Akademik</label>
                                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester" required>
                                </div>
                                <div class="form-group">
                                    <label for="semester_aktif">Semester Aktif</label>
                                    <select class="form-control" id="semester_aktif" name="semester_aktif" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                                <a href="index.php" class="btn btn-primary">Lihat Data Tahun Akademik</a>
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

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $successMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $errorMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if ($successMessage != ""): ?>
                $('#successModal').modal('show');
            <?php endif; ?>
            <?php if ($errorMessage != ""): ?>
                $('#errorModal').modal('show');
            <?php endif; ?>
        });
    </script>
</body>
</html>
