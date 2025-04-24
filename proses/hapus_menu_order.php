<?php 
include 'function.php';
session_start();
$pelanggan = (isset($_POST["pelanggan"])) ? htmlentities($_POST["pelanggan"]) : "" ;
$kodeorder = (isset($_POST["kode_pesanan"])) ? htmlentities($_POST["kode_pesanan"]) : "" ;
$id = (isset($_POST["id_pesanan"])) ? htmlentities($_POST["id_pesanan"]) : "" ;
if(empty($_POST['hapusordertmenu'])){   
        $query= mysqli_query($con, "DELETE FROM pesan_makan WHERE id_pesanan ='$id' ");
        if ($query) {
            header("location:../?x=formpesanan&order=$kodeorder&pelanggan=$pelanggan");
        }else{
            die("Query failed: " . mysqli_error($con));
        
    }
}
?>