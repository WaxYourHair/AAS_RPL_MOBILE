<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../../index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Akademik</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($title == 'dashboard') echo "active" ?>">
        <a class="nav-link" href="siswa_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Biodata -->
    <li class="nav-item <?php if($title == 'biodata') echo 'active' ?>">
        <a class="nav-link" href="biodata.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Biodata</span>
        </a>
    </li>

    <!-- Nav Item - Cetak Raport -->
    <li class="nav-item <?php if($title == 'cetak_raport') echo 'active' ?>">
        <a class="nav-link" href="cetak_raport.php">
            <i class="fas fa-fw fa-print"></i>
            <span>Cetak Raport</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
