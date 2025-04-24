<?php 
require'proses/function.php';
?>

<style>
select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}

/* Gaya dasar untuk input select */
select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    width: 100%;
    transition: border-color 0.3s;
}

/* Hover effect */
select:hover {
    border-color: #aaa;
}

/* Fokus effect */
select:focus {
    border-color: #2196F3;
    box-shadow: 0 0 5px rgba(33, 150, 243, 0.5);
}

/* Membuat panah kecil untuk menunjukkan dropdown */
select::after {
    content: '\25BC';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    pointer-events: none;
}

/* Membuat opsi select lebih mudah dibaca */
option {
    font-size: 14px;
}

/* Styling untuk dropdown */
select::-ms-expand {
    display: none;
}

label {
    font-size: 16px;
    margin-bottom: 5px;
    display: block;
}

.rp {
    position: absolute;
    color: black;
    margin-left: 0.5rem;
    font-weight: bold;
    top: 137px;
}

#uang {
    padding-left: 2rem;
}


.container {
    width: 100%;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

.container .card {
    width: 230px;
    position: relative;
    padding: 0.5rem;
    margin: 0.6rem;
    object-position: center;
    align-items: center;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    text-align: center;
    color: black;
}

.card img {
    width: 150px;
    height: 150px;
    margin: 10px;
}

.card .card-body h5 {
    font-size: 1.2rem;
    font-weight: 600;
    font-style: oblique;
}

.card a {
    text-decoration: none;
}

/* Style default */


/* Style untuk perangkat dengan lebar layar lebih besar dari 576px (misalnya tablet) */
@media (max-width: 570px) {
    .row {
        width: 348px;
    }

    .container {
        padding: 10px;
        width: 348px;
        margin-top: 2rem;
        margin: 0;
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: left;
    }

    .container .card {
        width: 130px;
        object-position: center;
        align-items: center;
        border-radius: 7px;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        text-align: center;
        color: black;
    }

    .container .card card-body {
        width: 120px;
    }


    .card img {
        width: 70px;
        height: 70px;
        margin: 5px;
    }

    .card .card-body h5 {
        font-size: 1rem;
        font-weight: 600;
        font-style: oblique;
    }

    .card .card-body p {
        font-size: 0.8rem;
    }
}

/* Style untuk perangkat dengan lebar layar lebih besar dari 768px (misalnya laptop) */
@media (max-width: 768px) {
    .card {
        width: 100%;
        /* Atur lebar kartu agar tiga kartu dapat ditampilkan dalam satu baris */
        margin-right: 2%;
        /* Berikan margin kanan pada setiap kartu untuk ruang antar kartu */
    }
}
</style>

<div class="container-fluid">
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-3 mtyyy-4 text-dark-800">Data menu</h1>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-5 my-2 my-md-0 mw-100 navbar-search"
            method="post">
            <div class="input-group">
                <input type="text" name="cari" class="form-control bg-light border-0 small" placeholder=" Cari menu"
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-primary btn-sm float-right p-2 p-2 mr-4 mb- " data-toggle="modal"
            data-target="#myModal">Tambah menu</button>
    </div>
    <!-- Content tables -->
    <div class="card-deck mt-6">
        <?php 
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $cari = $_POST['cari'];
            // echo $cari;
        $get = mysqli_query($con, "SELECT * FROM menu_makanan WHERE nm_menu_mkn LIKE '%$cari%' ");
        if (!$get) {
                die("Query failed: " . mysqli_error($con));
            }
        while($p=mysqli_fetch_array($get)){
        $res[] = $p;
        }
    }else{
                    $get = mysqli_query($con,"SELECT * FROM menu_makanan ORDER BY idmenumakanan");
                    while($p=mysqli_fetch_assoc($get)){
                        $res[] =$p; 
                    
                    }              
              }?>
        <div class="row">
            <div class="container">
                <?php 
        if(empty($res)){
            echo "<center><h5 style='margin-top:10rem;margin-left:4rem;'>Data menu Tidak ada</h5></center>";
        }else {

            foreach($res as $row){
                ?>
                <div>
                    <div class="card">
                        <img class="img" src="img/<?=$row['gambar']?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$row['nm_menu_mkn']?></h5>
                            <p class="card-text"><?=$row["deskripsi"]?></p>
                            <P class="card-text">Rp. <?=number_format($row["harga"],0,',','.')?><small
                                    class="text-muted"></small></p>
                            <div class="btn d-flex">
                                <button type="button" class="btn btn-warning btn-sm m-1" data-toggle="modal"
                                    data-target="#myModaledit<?=$row['idmenumakanan']?>">
                                    <i class="fas fa-fw fa-solid fa-pen"></i></button>
                                <button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal"
                                    data-target="#Modalhapus<?=$row['idmenumakanan']?>">
                                    <i class="fas fa-fw fa-regular fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">From Tambah menu </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="namamenumkn" class="form-control" id="exampleInputEmail"
                            aria-describedby="username" placeholder="Masukan Nama Menu Makanan" required>
                    </div>
                    <div class="form-group" id="container">
                        <select name="kategori" id="kategori" class="form-select" aria-label="Default select example">
                            <option selected>Pilih Kategori Menu</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>
                    <span id="format1"></span>
                    <div class="form-group">
                        <input type="text" name="hargamakanan" class="form-control" id="hargamakanan"
                            aria-describedby="username" placeholder=" Masukan harga makan" require
                            onkeyup="document.getElementById('format1').innerHTML = formatCurrency(this.value)">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukan gambar menu baru</label>
                        <input name="imgmkn" type="file" class="form-control-file" id="exampleFormControlFile1"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambahmenumakna" class="btn btn-primary btn ">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal edit  -->
<?php foreach($res as $row){ ?>
<div class="modal fade" id="myModaledit<?=$row['idmenumakanan']?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">From edit menu </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?=$row['idmenumakanan']?>" hidden>
                    <div class="form-group">
                        <input type="text" name="namamenumkn" class="form-control" id="exampleInputEmail"
                            aria-describedby="username" placeholder="Masukan Nama Menu Makanan"
                            value="<?=$row['nm_menu_mkn']?>" required>
                    </div>
                    <div class="form-group" id="container">
                        <select name="kategori" id="kategori" class="form-select" aria-label="Default select example">
                            <option selected hidden value="<?=$row['deskripsi']?>"><?=$row['deskripsi']?></option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>
                    <span id="format1"></span>
                    <div class="form-group">
                        <input type="text" value="<?=$row['harga']?>" name="hargamakanan" class="form-control"
                            id="hargamakanan" aria-describedby="username" placeholder=" Masukan harga makan" require
                            onkeyup="document.getElementById('format1').innerHTML = formatCurrency(this.value)">
                    </div>
                    <img class="card-img-top rounded " style="width:100px; height:100px;" src="img/<?=$row['gambar']?>"
                        alt="Card image cap">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukan gambar menu baru</label>
                        <input name="img" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="editmenumakan" class="btn btn-warning btn ">Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } 
    foreach( $res as $a) { 
        ?>
<div class="modal fade" id="Modalhapus<?=$a['idmenumakanan']?>" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Menu </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="proses/hapus_menu.php" method="POST">
                        <div class="col">

                            <input type="hidden" name="id_menu" class="form-control" value="<?=$a['idmenumakanan']?>"
                                id="floatingInput">
                            Apakah Anda ingin menghapus menu
                            <b>
                                <?= $a['nm_menu_mkn']?>
                            </b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" name="hapusmenu" class="btn btn-danger">
                                Hapus </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
 }
 ?>

<?php }?>
<!-- end modal hapus  -->

<script type="text/javascript">
function formatCurrency(hargamakanan) {
    hargamakanan = hargamakanan.toString().replace(/\$|\,/g, '');
    if (isNaN(uang))
        hargamakanan = "0";
    sign = (hargamakanan == (hargamakanan = Math.abs(hargamakanan)));
    hargamakanan = Math.floor(hargamakanan * 100 + 0.50000000001);
    cents = hargamakanan % 100;
    hargamakanan = Math.floor(hargamakanan / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((hargamakanan.length - (1 + i)) + 3); 1++)
        hargamakanan = hargamakanan.subString(0, hargamakanan.length - (4 * i + 3)) + '.' +
        hargamakanan.subString(hargamakanan.length - (4 * i + 3));
    return (((sign) ? '' : '-') + 'Rp.' + hargamakanan + ',' + cents);
}
</script>