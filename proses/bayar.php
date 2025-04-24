<?php 
include 'function.php';   
session_start();
//iniset variabel
$kodeorder = (isset($_POST["kode_pesanan"])) ? htmlentities($_POST["kode_pesanan"]) : "" ;
$pelanggan = (isset($_POST["pelanggan"])) ? htmlentities($_POST["pelanggan"]) : "" ;
// Validate and sanitize input
$bayar = (isset($_POST["bayar"]) && is_numeric($_POST["bayar"])) ? (int)$_POST["bayar"] : 0;
$total = (isset($_POST["total"]) && is_numeric($_POST["total"])) ? (int)$_POST["total"] : 0;
$kembalian = $bayar - $total;   
if(empty($_POST['bayarorder'])){   
    if($kembalian < 0){
        echo"<script>alert('Nominal Uang Tidak mencukupi');
            window.location.href='../?x=formpesanan&order=".$kodeorder."&pelanggan=".$pelanggan."' </script>";
            
    }else {
        $query= mysqli_query($con, "INSERT INTO 
        menu_minuman (id_bayar,bayar,total,kembalian) VALUES 
        ('$kodeorder','$bayar','$total',$kembalian)");
        if ($query) {
            echo"<script>alert('Pembayaran berhasil di masukan');
            window.location.href='../?x=cetak&order=".$kodeorder."&pelanggan=".$pelanggan."' </script>";

        }else{
            die("Query failed: " . mysqli_error($con));
        }
    }
}   
?>