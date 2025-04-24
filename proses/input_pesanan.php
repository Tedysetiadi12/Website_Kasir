<?php 
include 'function.php';   
session_start();
//iniset variabel
$kodeorder = (isset($_POST["kodepesanan"])) ? htmlentities($_POST["kodepesanan"]) : "" ;
$pelanggan = (isset($_POST["nama"])) ? htmlentities($_POST["nama"]) : "" ;
$pegawai = (isset($_POST["kasir"])) ? htmlentities($_POST["kasir"]) : "" ;
if(!empty($_POST['tambahorder'])){   
    $ceck = mysqli_query($con,"SELECT * FROM transaksi WHERE id_transaksi ='$kodeorder'");
    if(mysqli_num_rows($ceck)>0){
        echo"<script>alert('Order yang di masukan telah ada, Mohon di ulangi');
        window.location.href='../order' </script>";
    }else {
        $query= mysqli_query($con, "INSERT INTO 
        transaksi (id_transaksi,nama_pelanggan,id_pegawai) VALUES 
        ('$kodeorder','$pelanggan','$pegawai')");
        if ($query) {
            header("location:../?x=tambahpesanan&order=".$kodeorder."&pelanggan=".$pelanggan."");  
        }else{
            header("location:../?x=tambahpesanan&order=".$kodeorder."&pelanggan=".$pelanggan."");  
        }
    }
}   
?>