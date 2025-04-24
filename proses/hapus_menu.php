<?php 
include 'function.php';
session_start();
$id = (isset($_POST["id_menu"])) ? htmlentities($_POST["id_menu"]) : "" ;
if(empty($_POST['hapusmenu'])){   
        $query= mysqli_query($con, "DELETE FROM menu_makanan WHERE idmenumakanan ='$id' ");
        if ($query) {
            header("location:../menu");
        }else{
            echo"<script>alert('Data sudah Berelasi, MAAF TIDAK BISA DIHAPUS');
                window.location.href='../menu' </script>";
                
        
    }
}
?>