<?php 
include 'function.php';   
session_start();
//iniset variabel
$usename = (isset($_POST["username"])) ? htmlentities($_POST["username"]) : "" ;
$password = (isset($_POST["password"])) ? htmlentities($_POST["password"]) : "" ;
if(!empty($_POST['login'])){   
    $ceck = mysqli_query($con,"SELECT * FROM user WHERE username ='$usename' && password ='$password' ");
    $h = mysqli_fetch_array($ceck);
    if (!empty($h)) {
        // jika ditemukan
        $_SESSION['user_nama'] = $usename;
        $_SESSION['lever_access'] =$h['level'];
        // var_dump()
        header('location:../home');
    }else{
        echo"<script>alert('Username atau password salah, Mohon di ulangi');
        window.location.href='../login' </script>";
    }
}
?>