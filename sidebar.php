<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
        <div class="sidebar-brand-icon">
            <img style="width:50px; height:50px; margin-left:7px; border-radius:50%;" src="uploadImage/logo.png"
                alt="#">
        </div>
        <div class="sidebar-brand-text mx-3">White.famous</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'home') ? 'active' : 'link-dark' ;?>">
        <a class="nav-link" href="home"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-solid fa-users"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'pegawai') ? 'active' : 'link-dark' ;?>"
                    href="pegawai">Pegawai</a>
                <?php if($h['level']==1){ ?>
                <a class="collapse-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'pelanggan') ? 'active' : 'link-dark' ;?>"
                    href="pelanggan">Customer</a>
            </div>
        </div>
    </li>
    <?php }?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active' : 'link-dark' ;?>">
        <a class="nav-link" href="menu"><i class="fas fa-fw fa-utensils"></i><span>Menu</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <?php if($h['level']==1){?>
    <li class="nav-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active' : 'link-light' ;?>">
        <a class="nav-link link-light" href="order">
            <i class="fas fa-fw fa-file-alt"></i><span>Order</span></a>
    </li>
    <?php }?>
    <li class="nav-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'laporan') ? 'active' : 'link-light' ;?>">
        <a class="nav-link link-light " href="transaksi">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-coin"
                viewBox="0 0 16 16">
                <path
                    d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
            </svg></i><span> Transaksi</span></a>
    </li>
    <li class="nav-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'laporan') ? 'active' : 'link-light' ;?>">
        <a class="nav-link link-light " href="laporan">
            <i class="fas fa-fw fa-table"></i><span>Laporan</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#pengaturan" aria-expanded="true"
            aria-controls="collapseTwo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path
                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                <path
                    d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
            </svg>
            <span>Pengaturan</span>
        </a>
        <div id="pengaturan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if($h['level']==1){ ?>

                <a class="collapse-item <?php echo (isset($_GET['x']) && $_GET['x'] == 'pegawai') ? 'active' : 'link-dark' ;?>"
                    data-toggle="modal" data-target="#Modalriset">Riset data </a>
            </div>
        </div>
    </li>
    <?php }?>
    <!-- Divider -->
    <hr class=" sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<div class="modal fade" id="Modalriset" role="dialog">
    <div class="modal-dialog modal-ml">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riset</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action="proses/riset_transaksi.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><b>Apakah ingin Me-Riset Semua Data transaksi</b></p>
                        </div>

                    </div>
                    <div class="modal-footer d-flex-right">
                        <input type="submit" name="editorderan" class="btn btn-danger" value="Riset">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>