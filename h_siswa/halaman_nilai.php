<?php
session_start();
include_once '../functions.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    // header("Location: login.php");
    // exit();
}

$nis = $_SESSION['user']['nis'];
$biodata = getBiodataSiswa($nis);

 
if ($biodata['status_pembayaran'] != 1) {
    echo "<script type='text/javascript'>
        alert('Anda belum melakukan pembayaran. Silakan lunasi pembayaran terlebih dahulu.');
        window.location.href='siswa_dashboard.php'; // Optional: Redirect to a specific page after the alert
    </script>";
    exit();
}
 


$title = 'Cetak Raport';
$nilai_siswa = getNilaiSiswa($nis);
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
                        <h1 class="h3 mb-0 text-gray-800">Cetak Raport</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <!-- Card -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Nilai Siswa</h6>
                                    <a href="cetak_pdf.php" class="btn btn-success">Cetak PDF</a>
                                </div>
                                <div class="card-body">
                                    <!-- Tabel Nilai -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Nilai TP1</th>
                                                    <th>Nilai TP2</th>
                                                    <th>Nilai TP3</th>
                                                    <th>Nilai TP4</th>
                                                    <th>Nilai TP5</th>
                                                    <th>Nilai TP6</th>
                                                    <th>Nilai TP7</th>
                                                    <th>Rata-rata TP</th>
                                                    <th>Nilai UH1</th>
                                                    <th>Nilai UH2</th>
                                                    <th>Nilai UH3</th>
                                                    <th>Nilai UH4</th>
                                                    <th>Nilai UH5</th>
                                                    <th>Nilai UH6</th>
                                                    <th>Nilai UH7</th>
                                                    <th>Rata-rata UH</th>
                                                    <th>Nilai PTS</th>
                                                    <th>Nilai UAS</th>
                                                    <th>Nilai Akhir</th>
                                                    <th>Nilai Huruf</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($nilai_siswa as $nilai): ?>
                                                <?php
                                                // Convert predikat to letter grades
                                                $predikat = '';
                                                if ($nilai['nilai_akhir'] >= 90) {
                                                    $predikat = 'A';
                                                } elseif ($nilai['nilai_akhir'] >= 80) {
                                                    $predikat = 'B';
                                                } elseif ($nilai['nilai_akhir'] >= 70) {
                                                    $predikat = 'C';
                                                } else {
                                                    $predikat = 'D';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $nilai['nama_mp']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp1']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp2']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp3']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp4']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp5']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp6']; ?></td>
                                                    <td><?php echo $nilai['nilai_tp7']; ?></td>
                                                    <td><?php echo $nilai['rata_tp']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh1']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh2']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh3']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh4']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh5']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh6']; ?></td>
                                                    <td><?php echo $nilai['nilai_uh7']; ?></td>
                                                    <td><?php echo $nilai['rata_uh']; ?></td>
                                                    <td><?php echo $nilai['nilai_pts']; ?></td>
                                                    <td><?php echo $nilai['nilai_uas']; ?></td>
                                                    <td><?php echo $nilai['nilai_akhir']; ?></td>
                                                    <td><?php echo $predikat; ?></td>
                                                    <td><?php echo $nilai['deskripsi']; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Akhir Tabel Nilai -->
                                </div>
                            </div>
                            <!-- Akhir Card -->
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
