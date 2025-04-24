<?php 
include 'function.php';
session_start();
$id = (isset($_POST["id"])) ? htmlentities($_POST["id"]) : "" ;
$nama = (isset($_POST["namapegawai"])) ? htmlentities($_POST["namapegawai"]) : "" ;
$nohp = (isset($_POST["nohp"])) ? htmlentities($_POST["nohp"]) : "" ;
$alamat = (isset($_POST["alamatpegawai"])) ? htmlentities($_POST["alamatpegawai"]) : "" ;
if(empty($_POST['hapuspegawai'])){   
        $query= mysqli_query($con, "DELETE FROM pegawai WHERE idpegawai ='$id' ");
        if ($query) {
            header("location:../pegawai");
        }else{
            echo"<script>alert('Mohon Maaf pegawai sudah Berelasi');
            window.location.href='../pegawai' </script>";
        
    }
}
?>