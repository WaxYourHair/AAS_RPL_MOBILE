<?php
include_once("../functions.php");
$title = 'Tambah Kelas';

$db = dbConnect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kelas = $db->escape_string($_POST['nama_kelas']);
    $wali_kelas = $db->escape_string($_POST['wali_kelas']);
    $query = "INSERT INTO kelas (nama_kelas, wali_kelas) VALUES ('$nama_kelas', '$wali_kelas')";
    if ($db->query($query) === TRUE) {
        echo "<script type='text/javascript'>
            alert('Data berhasil disimpan.');
            window.location.href = 'kelas.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

// Fetch list of teachers for wali_kelas dropdown
$guruQuery = "SELECT nip, nama_guru FROM guru";
$guruResult = $db->query($guruQuery);
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
                    <h1 class="h3 mb-4 text-gray-800">Tambah Kelas</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Kelas Baru</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Wali Kelas</label>
                                    <select name="wali_kelas" class="form-control" required>
                                        <option value="">Pilih Wali Kelas</option>
                                        <?php while ($guruRow = $guruResult->fetch_assoc()): ?>
                                            <option value="<?php echo $guruRow['nip']; ?>"><?php echo $guruRow['nama_guru']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Simpan Data</button>
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
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/demo/datatables-demo.js"></script>
</body>
</html>
