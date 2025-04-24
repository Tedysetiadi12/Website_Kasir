<?php 
include 'function.php';
session_start();
$id = (isset($_POST["id"])) ? htmlentities($_POST["id"]) : "" ;
$nama = (isset($_POST["namapegawai"])) ? htmlentities($_POST["namapegawai"]) : "" ;
$nohp = (isset($_POST["nohp"])) ? htmlentities($_POST["nohp"]) : "" ;
$alamat = (isset($_POST["alamatpegawai"])) ? htmlentities($_POST["alamatpegawai"]) : "" ;
if(empty($_POST['editpegawai'])){   
        $query= mysqli_query($con, "UPDATE pegawai SET
         namapegawai = '$nama',alamat='$alamat',nohp='$nohp' WHERE idpegawai ='$id' ");
        if ($query) {
            header("location:../pegawai");
        }else{
            die("Query failed: " . mysqli_error($con));
        
    }
}
?>