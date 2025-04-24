<?php 
include 'function.php';
session_start();
$id = (isset($_POST["kodepesanan"])) ? htmlentities($_POST["kodepesanan"]) : "" ;
$pelanggan = (isset($_POST["nama"])) ? htmlentities($_POST["nama"]) : "" ;
$kasir = (isset($_POST["kasir"])) ? htmlentities($_POST["kasir"]) : "" ;
if(!empty($_POST['editorderan'])){   
        $query= mysqli_query($con, "UPDATE transaksi SET
         id_transaksi = '$id',nama_pelanggan = '$pelanggan',id_pegawai='$kasir' WHERE id_transaksi ='$id' ");
        if ($query) {
            header("location:../transaksi");
        }else{
            
        
            header("location:../transaksi");
    }
}
?>