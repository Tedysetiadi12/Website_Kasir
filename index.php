<!-- Begin Page Content -->
<?php 
include ('proses/function.php');
session_start();

 
?>
<?php if(isset($_GET["x"]) && $_GET['x'] == 'home') {
                    $page = "home.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'pegawai') {
                    $page ="pegawai.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'kasir') {
                    $page ="kasir.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'pelanggan') {
                    $page ="pelanggan.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'menu') {
                    $page ="menu.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'order') {
                    if($_SESSION['lever_access']==1){
                        $page ="order.php";
                        include('main.php');
                    }else{
                        $page = "home.php";
                        include('main.php');
                    }
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'laporan') {
                    $page ="laporan.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'transaksi') {
                    $page ="transaksi.php";
                    include('main.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'tambahpesanan') {
                    include('tambahpesanan.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'formpesanan') {
                    include('from_pemesanan.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'cetak') {
                    include('cetak.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'login') {
                    include('login.php');
                }elseif(isset($_GET["x"]) && $_GET['x'] == 'logout') {
                    include('proses/logout.php');
                }else{
                    $page ="home.php";
                    include 'main.php';
                } ?>
<!-- /.container-fluid -->