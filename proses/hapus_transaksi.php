<?php 
include 'function.php';
session_start();
$id = (isset($_POST["id"])) ? htmlentities($_POST["id"]) : "" ;
$idtrans = (isset($_POST["kodepesanan"])) ? htmlentities($_POST["kodepesanan"]) : "" ;
$pelanggan = (isset($_POST["nama"])) ? htmlentities($_POST["nama"]) : "" ;
$kasir = (isset($_POST["kasir"])) ? htmlentities($_POST["kasir"]) : "" ;
if(!empty($_POST['editorderan'])){ 
        $query= mysqli_query($con, "DELETE FROM pesan_makan WHERE id_pesanan ='$id' ");
        $query= mysqli_query($con, "DELETE FROM transaksi WHERE id_transaksi ='$idtrans' ");
        if ($query) {
            echo"<script>alert('berhasil di hapus');
            window.location.href='../transaksi' </script>";
        }else{
            
            die("Query failed: " . mysqli_error($con));
    }
}
?>