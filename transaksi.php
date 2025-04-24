<?php 
include'proses/function.php';

?>
<?php 
$bulan_ini = date("Y-m");
$gete = mysqli_query($con,"SELECT transaksi.*,pesan_makan.*,menu_minuman.*,nama_pelanggan,namapegawai,SUM(harga*qty) AS harganya FROM transaksi 
LEFT JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
LEFT JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
LEFT JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
GROUP BY id_transaksi DESC");
if (!$gete) {
    die("Query failed: " . mysqli_error($con));
}
$n=1;
while($p = mysqli_fetch_array($gete)){
$res[] = $p;
}
$select = mysqli_query($con,"SELECT idpegawai,namapegawai FROM pegawai ");
if (!$select) {
    die("Query failed: " . mysqli_error($con));
}
?>
<style>
.bayar {
    border-radius: 5px;
    padding: 4px;
    font-weight: 400i;
    background-color: green;
    color: white;
}

.blmbayar {
    border-radius: 7px;
    padding: 4px;
    font-weight: 400i;
    background-color: red;
    color: white;
}

/* Reset gaya bawaan dari browser */
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
    width: 200px;
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
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-4 text-gray-800">Data Transaksi</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
    </div>
    <?php  if($_SESSION['lever_access']==2){
        ?>
    <div class="rows">
        <a type="button" style="display: none;" class="btn btn-primary p-2 p-2 btn-sm mb-4 float-right"
            data-toggle="modal" data-target="#ModalTambahpelanggan">Tambah
            pesanan +</a>
    </div>
    <?php 
                    }else{
                        ?>
    <div class="rows">
        <a type="button" class="btn btn-primary p-2 p-2 btn-sm mb-4 float-right" data-toggle="modal"
            data-target="#ModalTambahpelanggan">Tambah
            pesanan </a>
    </div>
    <?php 
                    } ?>

    <!-- Content Row -->
    <?php
      if(empty($res)){
        echo "<center><h5 style='margin:1rem;'>Data Transaksi Tidak ada</h5></center>";
    }else {
        $total = 0;
    ?>
    <div class="container">
        <div class="table-responsive">
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>kode order</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                        <th>status</th>
                        <th>Total harga</th>
                        <th>Tanggal</th>
                        <?php  if($_SESSION['lever_access']==2){ ?>
                        <?php }else{ ?>
                        <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($res as $row){
                    ?>
                    <tr>
                        <td><?= $n++; ?></td>
                        <td><?=$row['id_transaksi']?></td>
                        <td><?=$row['nama_pelanggan']?></td>
                        <td><?=$row['namapegawai']?></td>
                        <td><?php echo (!empty($row['id_bayar'])) ? "<span class='bayar'>DiBayar</span>" : "<span class='blmbayar'>Belom</span>" ;?>
                        </td>
                        <td>Rp.<?=number_format($row['harganya'],0,'.','.')?></td>
                        <td><?=date("d-M-Y H:s", strtotime($row['tanggal']))?></td>
                        <?php  if($_SESSION['lever_access']==2){ ?>
                        <?php }else{ ?>
                        <td>
                            <a href="./?x=formpesanan&order=<?=$row['id_transaksi']?>&pelanggan=<?=$row['nama_pelanggan']?>"
                                class="btn btn-info btn-sm m-1"><i class="fas fa-fw fa-regular fa-eye"></i></a>
                            <button type="button"
                                class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm m-1 disabled " : "btn btn-warning btn-sm m-1" ;?>"
                                data-toggle="modal" data-target="#Modaledit<?= $row['id_transaksi']?>">
                                <i class="fas fa-fw fa-solid fa-pen"></i></button>
                            <button
                                class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm m-1 disabled  " : "btn btn-danger btn-sm m-1" ;?>"
                                data-toggle="modal" data-target="#Modalhapus<?= $row['id_transaksi']?>">
                                <i class=" fas fa-fw fa-regular fa-trash"></i>
                            </button>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Content Row -->

</div>
<!-- modal tambah pesanan -->
<div class="modal fade" id="ModalTambahpelanggan" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">From Tambah pesanan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action="proses/input_pesanan.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <label for="kodepesanan">Kode pesanan</label>
                                <input name="kodepesanan" type="number" class="form-control" id="kodepesanan"
                                    value="<?php echo date('ymdHi').rand(10, 99)?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <label for="namapelanggan">Nama pelanggan</label>
                                <input name="nama" type="text" class="form-control" id="namapelanggan">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="select">Pilih kasir</label>
                            <select id="select" name="kasir" class="form-select form-select-lg mb-3"
                                aria-label="Large select example">
                                <option selected hidden value="">Nama Kasir</option>
                                <?php 
                                    foreach($select as $v){
                                    echo "<option value=$v[idpegawai]>$v[namapegawai]</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex-right">
                        <input type="submit" name="tambahorder" class="btn btn-primary btn " value="order">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit -->
<?php foreach($res as $row){?>
<div class="modal fade" id="Modaledit<?= $row['id_transaksi']?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Orderan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action="proses/edit_transaksi.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <label for="kodepesanan">Kode pesanan</label>
                                <input name="kodepesanan" type="number" class="form-control" id="kodepesanan"
                                    value="<?php echo $row['id_transaksi']?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <label for="namapelanggan">Nama pelanggan</label>
                                <input value="<?php echo $row['nama_pelanggan']?>" name="nama" type="text"
                                    class="form-control" id="namapelanggan">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="select">Pilih kasir</label>
                            <select id="select" name="kasir" class="form-select form-select-lg mb-3"
                                aria-label="Large select example">
                                <option selected hidden value="<?=$row['namapegawai']?>"><?=$row['namapegawai']?>
                                </option>
                                <?php 
                                    foreach($select as $v){
                                    echo "<option value=$v[idpegawai]>$v[namapegawai]</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex-right">
                        <input type="submit" name="editorderan" class="btn btn-primary btn " value="Edit">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- end edit -->

<!-- hapus -->
<?php foreach($res as $row){?>
<div class="modal fade" id="Modalhapus<?= $row['id_transaksi']?>" role="dialog">
    <div class="modal-dialog modal-ml">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Orderan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post" action="proses/hapus_transaksi.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Apakah ingin mengapus transaksi <b><?=$row['nama_pelanggan'] ?></b></p>
                            <div class="form-floating mb-3">
                                <input name="id" type="number" class="form-control"
                                    value="<?php echo $row['id_pesanan']?>" hidden>
                                <input name="kodepesanan" type="number" class="form-control" id="kodepesanan"
                                    value="<?php echo $row['id_transaksi']?>" hidden>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex-right">
                        <input type="submit" name="editorderan" class="btn btn-danger btn " value="Hapus">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- end hapus -->
<?php }?>