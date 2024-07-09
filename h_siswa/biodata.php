<?php
session_start();
include_once '../functions.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    header("Location: ../login.php");
    exit();
}

$nis = $_SESSION['user']['nis'];
$biodata = getBiodataSiswa($nis); // Fungsi ini harus diimplementasikan di functions.php

// Proses unggah gambar jika ada
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $path = '../uploads/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file = $path . $nis . '.' . $file_ext;

    if (!in_array($file_ext, $extensions)) {
        $errors[] = 'Ekstensi file tidak diperbolehkan: ' . $file_name;
    }

    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $file)) {
            $db = dbConnect();
            $file_path = $db->escape_string($file);
            $query = "UPDATE siswa SET foto='$file_path' WHERE nis='$nis'";
            if ($db->query($query)) {
                $_SESSION['user']['photo'] = $file;
                header("Location: biodata.php");
                exit();
            } else {
                $errors[] = 'Gagal menyimpan path foto di database: ' . $db->error;
            }
        } else {
            $errors[] = 'Gagal mengunggah file.';
        }
    }
}

// Proses penyimpanan biodata jika ada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_FILES['image'])) {
    $nama = $db->escape_string($_POST['nama']);
    $alamat = $db->escape_string($_POST['alamat']);
    $tanggal_lahir = $db->escape_string($_POST['tanggal_lahir']);
    $jenis_kelamin = $db->escape_string($_POST['jenis_kelamin']);
    $agama = $db->escape_string($_POST['agama']);
    $orang_tua = $db->escape_string($_POST['orang_tua']);
    $asal_sekolah = $db->escape_string($_POST['asal_sekolah']);
    $id_kelas = $db->escape_string($_POST['id_kelas']);
    
    $query = "UPDATE siswa SET 
                nama='$nama', 
                alamat='$alamat', 
                tanggal_lahir='$tanggal_lahir', 
                jenis_kelamin='$jenis_kelamin', 
                agama='$agama', 
                orang_tua='$orang_tua', 
                asal_sekolah='$asal_sekolah', 
                id_kelas='$id_kelas' 
              WHERE nis='$nis'";
    if ($db->query($query)) {
        echo "<script type='text/javascript'>
            alert('Data berhasil diperbarui.');
            window.location.href = 'biodata.php';
        </script>";
        exit();
    } else {
        $errors[] = 'Gagal menyimpan biodata di database: ' . $db->error;
    }
}

$title = 'Biodata Siswa'; // Set title untuk menandai menu aktif
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Biodata Siswa</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Profile Picture Column -->
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                                </div>
                                <div class="card-body text-center">
                                    <?php
                                    $photo_path = isset($biodata['foto']) && !empty($biodata['foto']) ? $biodata['foto'] : '../uploads/default.png';
                                    ?>
                                    <img src="<?php echo $photo_path; ?>" alt="Foto Siswa" class="img-fluid img-thumbnail mb-2">
                                    <p>JPG or PNG no larger than 5 MB</p>
                                    <?php if (!empty($errors)): ?>
                                        <div class="alert alert-danger">
                                            <?php foreach ($errors as $error): ?>
                                                <p><?php echo $error; ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="biodata.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="form-control-file">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload new image</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Account Details Column -->
                        <div class="col-lg-8 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="biodata.php">
                                        <div class="form-group">
                                            <label for="username">Username (NIS)</label>
                                            <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($biodata['nis']); ?>" disabled>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control" id="first_name" name="nama" value="<?php echo htmlspecialchars($biodata['nama']); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control" id="last_name" value="Luna" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo htmlspecialchars($biodata['alamat']); ?>">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($biodata['tanggal_lahir']); ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                    <option value="Laki-laki" <?php echo ($biodata['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                                    <option value="Perempuan" <?php echo ($biodata['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="agama">Agama</label>
                                                <select class="form-control" id="agama" name="agama">
                                                    <option value="Islam" <?php echo ($biodata['agama'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                                    <option value="Kristen" <?php echo ($biodata['agama'] == 'Kristen') ? 'selected' : ''; ?>>Kristen</option>
                                                    <option value="Katolik" <?php echo ($biodata['agama'] == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
                                                    <option value="Hindu" <?php echo ($biodata['agama'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                                    <option value="Buddha" <?php echo ($biodata['agama'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                                    <option value="Konghucu" <?php echo ($biodata['agama'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="orang_tua">Orang Tua</label>
                                                <input type="text" class="form-control" id="orang_tua" name="orang_tua" value="<?php echo htmlspecialchars($biodata['orang_tua']); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="asal_sekolah">Asal Sekolah</label>
                                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?php echo htmlspecialchars($biodata['asal_sekolah']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <input type="text" class="form-control" id="kelas" name="id_kelas" value="<?php echo htmlspecialchars($biodata['id_kelas']); ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
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
