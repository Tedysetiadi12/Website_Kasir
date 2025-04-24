<?php 
include 'function.php';
session_start();
$pelanggan = (isset($_POST["pelanggan"])) ? htmlentities($_POST["pelanggan"]) : "" ;
$id = (isset($_POST["id_pesanan"])) ? htmlentities($_POST["id_pesanan"]) : "" ;
$idmkn = (isset($_POST["id_makanan"])) ? htmlentities($_POST["id_makanan"]) : "" ;
$qty = (isset($_POST["qty"])) ? htmlentities($_POST["qty"]) : "" ;
$idorder = (isset($_POST["kode_pesanan"])) ? htmlentities($_POST["kode_pesanan"]) : "" ;
if(empty($_POST['ediordertmenu'])){   
        $query= mysqli_query($con, "UPDATE pesan_makan SET
         id_pesanan = '$id',id_makanan = '$idmkn',qty='$qty',kode_pesanan='$idorder' WHERE id_pesanan ='$id' ");
        if ($query) {
            header("location:../?x=formpesanan&order=$idorder&pelanggan=$pelanggan");
        }else{
            die("Query failed: " . mysqli_error($con));
        
    }
}
?>