 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <i class="fas fa-book-reader"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Akademik</div>
</a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->


<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
                Menu
            </div>


         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item <?php if($title == 'Biodata') echo 'active' ?>">
                <a class="nav-link" href="Biodata.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Biodata</span>
                </a>
            </li>

           

             <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php if($title == 'nilai') echo 'active' ?>">
                <a class="nav-link" href="nilai.php">
                     <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Nilai</span>
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