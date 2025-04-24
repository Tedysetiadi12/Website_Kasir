<?php 
require'proses/function.php';

?>
<?php 
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $cari = $_POST['cari'];
    // echo $cari;
$get = mysqli_query($con, "SELECT * FROM menu_makanan WHERE nm_menu_mkn LIKE '%$cari%' ");
if (!$get) {
        die("Query failed: " . mysqli_error($con));
    }
while($res=mysqli_fetch_array($get)){
$result[] = $res;
}
$kode_order = $_GET['order'];
$pelanggan = $_GET['pelanggan'];
}else {
    $get = mysqli_query($con, "SELECT * FROM menu_makanan ");
while($res=mysqli_fetch_array($get)){
$result[] = $res;
}
$kode_order = $_GET['order'];
$pelanggan = $_GET['pelanggan'];
}
// $id_menu = $_GET['id_menu'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>aplikasi kasir</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style></style>
</head>
<style>
.container {
    margin-top: 2rem;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

#col {
    background-color: #f2f2f2;
    border-bottom: 2px solid #000000;
    text-align: center;
}

h3 {

    font-size: 1.3rem;
    color: blue;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.card-body {
    width: 200px;
    position: relative;
    object-position: center;
    padding: 0.5rem;
    align-items: center;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    text-align: center;
    color: #000000;
}

.img {
    margin: 1rem;
}

.card-body img {
    width: 100px;
}

@media (max-width: 570px) {


    .container {
        padding-left: 5px;
        width: 400px;
        margin: 0;
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: left;
    }

    .container .card-body {
        width: 140px;
        object-position: center;
        align-items: center;
        border-radius: 7px;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        text-align: center;
        color: black;
    }

    .container.btn {
        width: 10px;
    }

    .card-body img {
        width: 70px;
        height: 70px;
        margin: 5px;
    }

    .card .card-body h5 {
        font-size: 1rem;
        font-weight: 600;
        font-style: oblique;
    }

    .card .card-body p {
        font-size: 0.8rem;
    }
}
</style>

<body style="margin-top:4.6rem;" id="page-top">
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- end navbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
                        <div class="sidebar-brand-icon rotate-n-15">
                        </div>
                        <div class="sidebar-brand-text mx-3">white.famous</div>
                    </a>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        method="post">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search" method="post">
                                    <div class="input-group">
                                        <input type="text" name="cari" class="form-control bg-light border-0 small"
                                            placeholder="Search menu" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" name="carimenu" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="login.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->
                <!--  judul  -->
                <div class="row p-3">
                    <div class="col" id="col">
                        <h3>Halaman tambah Menu</h3>
                    </div>
                </div>
                <!-- Begin Page Content -->


                <!-- cari -->
                <?php if (empty($result)) {
                    echo"<center><h4>Data menu makanan Kosong </h4></center>";
                }else {?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <?php foreach( $result as $a) {
                                $harga = $a['harga'];
                                ?>
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal<?=$a['idmenumakanan']?>">
                                <div class="card-body">
                                    <form method="post" action="">
                                        <div class="img">
                                            <img style="width: 100px; height:100px;"
                                                src="img/<?php echo $a['gambar'];?>" alt=" 1">
                                        </div>
                                        <h5>
                                            <?php echo $a['nm_menu_mkn'];?>
                                        </h5>
                                        <p><?php echo $a['deskripsi'];?></p>
                                        <p>Rp. <?= number_format($harga,0,',','.')?></p>
                                        <input name="id_menu" type="hidden" readonly
                                            value=" <?php $a['idmenumakanan']; ?>">
                                    </form>
                                </div>
                            </button>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Button trigger modal -->
            <!-- Modal -->

            <?php foreach( $result as $a) { ?>
            <div class="modal fade" id="exampleModal<?=$a['idmenumakanan']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form action="proses/inputmenu.php" method="POST">
                                    <div class="col">
                                        <input type="hidden" name="idmenu" value="<?=$a['idmenumakanan']?>">
                                        <input type="hidden" name="pelanggan" value="<?=$pelanggan?>">
                                        <input type="hidden" name="kodeorder" value="<?=$kode_order?>">
                                        <div class="img"
                                            style="text-align: center; justify-content:center;border-radius:50px;">
                                            <img style="width:150px;height:150px;" src="img/<?php echo $a['gambar'];?>"
                                                alt=" 1">
                                            <h5><?=$a['nm_menu_mkn']?></h5>
                                            <b>
                                                <p>Rp. <?= number_format($a['harga'],0,',','.')?></p>
                                            </b>
                                        </div>
                                    </div>
                                    <div class="col" style="margin-top: 4rem;margin-right:1.3rem;">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="qty" class="form-control" id="floatingInput"
                                                placeholder="qty">
                                            <label for="floatingInput">Masukan Qty</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="tambahmenu" class="btn btn-primary">Tambah menu
                                            ini</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- modal tambah menu -->
            <?php }?>
            <!-- end modal menu -->
            <!-- Footer -->
            <footer class=" sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">Apakah anda ingin keluar dari akun ini ?</div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
<!-- modal tambah menu -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">From Tambah Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action="proses/tambahorder">
                    <div class="form-group">
                        <input type="text" value="<?=$id_menu?>" readonly name="namapegawai" class="form-control"
                            id="exampleInputEmail" aria-describedby="username">
                    </div>
                    <div class="form-group">
                        <input type="text" name="alamatpegawai" class="form-control" id="exampleInputEmail"
                            aria-describedby="username" placeholder="Masukan Alamat Pegawai" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambahpegawai" class="btn btn-primary btn ">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal tambah menu -->

</html>


<!-- navbar -->