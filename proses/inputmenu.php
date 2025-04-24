<?php 
// echo "dia";
include 'function.php';
session_start();
$idmenu = (isset($_POST["idmenu"])) ? (int)($_POST["idmenu"]) : "" ;
$jumlah = (isset($_POST["qty"])) ? htmlentities($_POST["qty"]) : "" ;
$kodeorder = (isset($_POST["kodeorder"])) ? htmlentities($_POST["kodeorder"]) : "" ;
$pelanggan = (isset($_POST["pelanggan"])) ? htmlentities($_POST["pelanggan"]) : "" ;

if(empty($_POST['tambahmenu'])){   
$ceck = mysqli_query($con,"SELECT * FROM pesan_makan WHERE id_makanan ='$idmenu' && kode_pesanan='$kodeorder'");
    if(mysqli_num_rows($ceck)>0){
        echo"<script>alert('menu telah yang di masukan sudah ada, Mohon ganti');
        window.location.href='../?x=tambahpesanan&order=".$kodeorder."&pelanggan=".$pelanggan."' </script>";
    }else {
        $query= mysqli_query($con, "INSERT INTO pesan_makan (id_makanan, qty, kode_pesanan) VALUES ('$idmenu','$jumlah','$kodeorder')");
        if ($query) {
            header("location:../?x=formpesanan&order=$kodeorder&pelanggan=$pelanggan");
        }else{
            die("Query failed: " . mysqli_error($con));
        }
    }
}
?>