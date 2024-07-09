<?php
session_start();
include_once("functions.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$title = 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include_once("layout/sidebar_index.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include_once("layout/topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Siswa (Jumlah)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $datasiswa = getList("SELECT count(nis) as jumlahSiswa FROM siswa");
                                                    foreach ($datasiswa as $row) {
                                                        echo $row['jumlahSiswa'];
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Guru (Jumlah)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $dataguru = getList("SELECT count(nip) as jumlahGuru FROM guru");
                                                    foreach ($dataguru as $row) {
                                                        echo $row['jumlahGuru'];
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Konten kartu lainnya... -->
                    </div>

                    <!-- Data Profil Sekolah Section -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Profil Sekolah</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <form class="form-horizontal" action="<?=base_url('dashboard/save_profil');?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-4 control-label">NAMA SEKOLAH</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="idprofil_sekolah" value="<?=$school_profil->idprofil_sekolah;?>">
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?=$school_profil->nama;?>" placeholder="Nama sekolah">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="npsn" class="col-sm-4 control-label">NPSN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="npsn" name="npsn" value="<?=$school_profil->npsn;?>" placeholder="NPSN">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-sm-4 control-label">Status</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" style="width: 100%;" name="status" value="<?=$school_profil->status;?>">
                                                    <option value="Negeri" <?=$school_profil->status=='Negeri'?'selected':'';?>>Negeri</option>
                                                    <option value="Swasta" <?=$school_profil->status=='Swasta'?'selected':'';?>>Swasta</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_kepsek" class="col-sm-4 control-label">Nama Kepala Sekolah</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek" value="<?=$school_profil->nama_kepsek;?>" placeholder="Kepala sekolah">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip_kepsek" class="col-sm-4 control-label">NIP Kepala Sekolah</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nip_kepsek" name="nip_kepsek" value="<?=$school_profil->nip_kepsek;?>" placeholder="NIP Kepala sekolah">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-sm-4 control-label">Akreditasi</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" style="width: 100%;" name="akreditasi" value="<?=$school_profil->akreditasi;?>">
                                                    <option value="kosong" <?=$school_profil->akreditasi=='kosong'?'selected':'';?>>Belum Ada</option>
                                                    <option value="A" <?=$school_profil->akreditasi=='A'?'selected':'';?>>A</option>
                                                    <option value="B" <?=$school_profil->akreditasi=='B'?'selected':'';?>>B</option>
                                                    <option value="C" <?=$school_profil->akreditasi=='C'?'selected':'';?>>C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo" class="col-sm-4 control-label">Logo Sekolah</label>
                                            <div class="col-sm-8">
                                                <img src="<?=base_url('uploads/').$school_profil->logo;?>" alt="view foto" style="border:1px dashed;width:75px;height:75px;" id="viewfoto">
                                                <input type="file" class="form-control" id="logo" name="logo" value="<?=$school_profil->logo;?>" onchange="preview_foto(event)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="provinsi" class="col-sm-4 control-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?=$school_profil->provinsi;?>" placeholder="Provinsi">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten" class="col-sm-4 control-label">Kabupaten</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?=$school_profil->kabupaten;?>" placeholder="Kabupaten">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kecamatan" class="col-sm-4 control-label">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?=$school_profil->kecamatan;?>" placeholder="Kecamatan">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelurahan" class="col-sm-4 control-label">Desa / Kelurahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="<?=$school_profil->kelurahan;?>" placeholder="Desa / Kelurahan">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dusun" class="col-sm-4 control-label">Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="dusun" name="dusun" value="<?=$school_profil->dusun;?>" placeholder="Dusun">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">RT / RW</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="rt" name="rt" value="<?=$school_profil->rt;?>" placeholder="RT">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="rw" name="rw" value="<?=$school_profil->rw;?>" placeholder="RW">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?=$school_profil->alamat;?>" placeholder="Alamat">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Kodepos / Lintang / Bujur</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?=$school_profil->kodepos;?>" placeholder="Kodepos">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="lintang" name="lintang" value="<?=$school_profil->lintang;?>" placeholder="Lintang">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="bujur" name="bujur" value="<?=$school_profil->bujur;?>" placeholder="Bujur">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-save"></i> Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <div class="d-flex justify-content-end mb-4 mr-3">
            
                    <a href="database/backup.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="backup">
                        <i class="fas fa-download fa-sm text-white-50"></i> Backup Database
                    </a>
                </div>
                <?php include 'layout/footer.php'; ?>
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="assets/js/demo/chart-area-demo.js"></script>
        <script src="assets/js/demo/chart-pie-demo.js"></script>

        <script src="assets/js/script.js"></script>
    </div>
</body>
