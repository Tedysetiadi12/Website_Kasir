<?php 
// coneksi
$con = mysqli_connect("localhost","root","","kasir");
if(!$con){
    echo "Batabase belom connect";
} 
// tambah pelanggan 
if(isset($_POST["tambahpelanggan"])){

    $namapel = $_POST['namapelanggan'];
    $almat = $_POST['alamatpelanggan'];

    $insert = mysqli_query($con, "INSERT INTO pelanggan (nama, alamat) values ('$namapel','$almat')");
    if($insert){
        header("location:index.php?x=pelanggan");
    }else{
        echo"<script>alert('Gagal tambah pelanggan, Mohon di ulangi');
        window.location.href='index.php?x=pelanggan' </script>";
    }
}
// tambah pegawai
if(isset($_POST["tambahpegawai"])){

    $namapeg = $_POST['namapegawai'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamatpegawai'];

    $insert = mysqli_query($con, "INSERT INTO pegawai (namapegawai, nohp, alamat) values ('$namapeg','$nohp','$alamat')");

    if($insert){
        header("location:index.php?x=pegawai");
    }else{
        echo"<script>alert('Gagal tambah pegawai, Mohon di ulangi');
        window.location.href='index.php?x=pegawai' </script>";
    }
}
if(isset($_POST["tambahmenumakna"])){
  
    $namamkn = $_POST['namamenumkn'];
    $desmkn = $_POST['kategori'];
    $hargamkn = $_POST['hargamakanan'];
    $imgemkn = $_FILES['imgmkn']['name'];

    if($imgemkn != ""){
        
        $gambarvalid = ['jpg','jpeg','png'];
        $x = explode('.','$imgemkn');
        $gambarektensi = strtolower(end($x));
        $img_loc = $_FILES['imgmkn']['tmp_name'];
        $imgsize = $_FILES['imgmkn']['size'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.'-'.$imgemkn;
        
        if( !in_array($gambarektensi, $gambarvalid)){
            move_uploaded_file($img_loc,'img/'.$nama_gambar_baru);
            
            if($imgsize < 1000000 ){
                
                $insert = mysqli_query($con, "INSERT INTO menu_makanan (nm_menu_mkn, deskripsi, harga, gambar) values ('$namamkn','$desmkn','$hargamkn','$nama_gambar_baru')");
                if($insert){
                    echo"<script>alert('Menu berhasil ditambahkan');
                window.location.href='index.php?x=menu' </script>";
                }else{
                    die("Query error: ".mysqli_error($con)."-".mysqli_error($con));
                    header("location:index.php?x=menu");
                }
                die();
            }else{
                echo"<script>alert('ukuran gambar terlalu besar, Mohon di ulangi');
                window.location.href='index.php?x=menu' </script>";
            }
        }else {
            echo"<script>alert('file yang ada masukan salah, Mohon di ulangi');
            window.location.href='index.php?x=menu' </script>";
        }
    }else{
        echo"<script>alert('silakan upload gambar terlebih dahulu, Mohon di ulangi');
        window.location.href='index.php?x=menu' </script>";
    }
    
}
if(isset($_POST["editmenumakan"])){
  
    $id = $_POST['id'];
    $namamkn = $_POST['namamenumkn'];
    $desmkn = $_POST['kategori'];
    $hargamkn = $_POST['hargamakanan'];
   
    
        
    

$gambarvalid = ['jpg','jpeg','png'];
$x = explode('.','$imgemkn');
$gambarektensi = strtolower(end($x));
$imgsize = $_FILES['img']['size'];
// $angka_acak = rand(1, 999);

if( !in_array($gambarektensi, $gambarvalid)){

if($imgsize < 1000000 ){
      
    $get = mysqli_query($con,"SELECT * FROM menu_makanan WHERE idmenumakanan='$id' ");
    $p = mysqli_fetch_assoc($get);
        if($_FILES['img']['name'] == "") {
            $imgemkn = $p['gambar'];
        }else{
            $imgemkn = $_FILES['img']['name'];
            // unlink('img/'.$p['gambar']);
            move_uploaded_file($_FILES['img']['tmp_name'],'img/'.$imgemkn);
        }
    $insert=mysqli_query($con, "UPDATE menu_makanan SET nm_menu_mkn='$namamkn' ,deskripsi='$desmkn' ,harga='$hargamkn', gambar='$imgemkn' WHERE idmenumakanan='$id'"
    ); 
    if($insert){ 
        echo"<script>alert('Menu berhasil diedit');
        window.location.href='index.php?x=menu' </script>";
    }else{
    die("Query error: ".mysqli_error($con)."-".mysqli_error($con));
    header("location:index.php?x=menu");
    }
    }else{
    echo"<script>
    alert('ukuran gambar terlalu besar, Mohon di ulangi');
    window.location.href = 'index.php?x=menu'
    </script>";
    }
    }else {
    echo"<script>
    alert('file yang ada masukan salah, Mohon di ulangi');
    window.location.href = 'index.php?x=menu'
    </script>";
    }


    }


    ?>