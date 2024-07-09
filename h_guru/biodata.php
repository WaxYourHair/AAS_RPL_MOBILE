<?php
session_start();
if (!isset($_SESSION['guru']) || $_SESSION['guru']['role'] != 'guru') {

}

$title = 'biodata'; // Set title untuk menandai menu aktif

include '../functions.php';
$conn = dbConnect(); // Pastikan file ini sudah ada dan mendefinisikan $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_guru = $conn->escape_string($_POST['nama_guru']);
    $nip = $conn->escape_string($_POST['nip']);
    $alamat = $conn->escape_string($_POST['alamat']);
    $jenis_kelamin = $conn->escape_string($_POST['jenis_kelamin']);
    $agama = $conn->escape_string($_POST['agama']);
    $kd_mp = $conn->escape_string($_POST['kd_mp']);

    // Update data ke database
    $sql = "UPDATE guru SET nama_guru = '$nama_guru', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', agama = '$agama', kd_mp = '$kd_mp' WHERE nip = '$nip'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['user']['nama_guru'] = $nama_guru;
        $_SESSION['user']['alamat'] = $alamat;
        $_SESSION['user']['jenis_kelamin'] = $jenis_kelamin;
        $_SESSION['user']['agama'] = $agama;
        $_SESSION['user']['kd_mp'] = $kd_mp;
        $saved = true;
    } else {
        $saved = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Guru</title>
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'layout/sidebar_index.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include 'layout/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Biodata Guru</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <!-- Form untuk menampilkan dan mengedit data guru -->
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="nama_guru">Nama</label>
                                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $_SESSION['user']['nama_guru']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $_SESSION['user']['nip']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $_SESSION['user']['alamat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki" <?php if($_SESSION['user']['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if($_SESSION['user']['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" value="<?php echo $_SESSION['user']['agama']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kd_mp">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="kd_mp" name="kd_mp" value="<?php echo $_SESSION['user']['kd_mp']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                            <?php if (isset($saved) && $saved): ?>
                                <script>
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                            <?php elseif (isset($saved) && !$saved): ?>
                                <script>
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Data gagal disimpan.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'layout/footer.php'; ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>
</html>
