<?php
include_once("../functions.php");

// session_start();

// Pastikan user sudah login sebagai guru
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'guru') {
    die("Anda harus login terlebih dahulu");
}

$nip = $_SESSION['user']['nip'];

$db = dbConnect();

if ($db->connect_errno == 0) {
    $query = "
        SELECT 
            kg.id,
            k.nama_kelas,
            g.nama_guru,
            mp.nama_mp AS nama_mapel,
            ta.tahun_akademik,
            kg.tanggal,
            kg.waktu
        FROM 
            kelas_guru kg
        JOIN 
            guru g ON kg.nip = g.nip
        JOIN 
            kelas k ON kg.id_kelas = k.id_kelas
        JOIN 
            mata_pelajaran mp ON kg.kd_mp = mp.kd_mp
        JOIN 
            tahun_akademik ta ON kg.id_tahun_akademik = ta.id
        WHERE 
            kg.nip = '$nip'
        ORDER BY 
            kg.tanggal, kg.waktu";

    $result = $db->query($query);

    if (!$result) {
        die("Query Error: " . $db->error);
    }
} else {
    die("Connection Error: " . $db->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jadwal Mengajar Saya</title>
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include_once("layout/sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once("layout/topbar.php") ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Jadwal Guru</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jadwal Mengajar Guru</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kelas</th>
                                            <th>Nama Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Tahun Akademik</th>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($result->num_rows > 0): ?>
                                            <?php while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['nama_kelas'] ?></td>
                                                    <td><?= $row['nama_guru'] ?></td>
                                                    <td><?= $row['nama_mapel'] ?></td>
                                                    <td><?= $row['tahun_akademik'] ?></td>
                                                    <td><?= $row['tanggal'] ?></td>
                                                    <td><?= $row['waktu'] ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7">Tidak ada data yang ditemukan.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once("../layout/footer.php") ?>
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
