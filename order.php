<?php 
include'proses/function.php';
?>
<?php
date_default_timezone_set('Asia/Jakarta') ;
$gete = mysqli_query($con,"SELECT * FROM pesan_makan 
LEFT JOIN transaksi ON transaksi.id_transaksi = pesan_makan.kode_pesanan
LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
LEFT JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
GROUP BY id_pesanan DESC");
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
        <h1 class="h3 mt-4 text-dark-800">Data Orderan</h1>
    </div>
    <div class="col" style="margin: 2rem; width:100%;">
        <div class="rows">
            <a type="button" class="btn btn-primary p-2 p-2 btn-sm mb-4 float-right" data-toggle="modal"
                data-target="#ModalTambahpelanggan">Tambah
                pesanan +</a>
        </div>
    </div>
    <?php
      if(empty($res)){
        echo "<center><h5 style='margin-top:10rem;'>Data Orderan Tidak ada</h5></center>";
    }else {
    ?>
    <div class="table-responsive">
        <table id="example" class="table table-hover ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>kode pesanan</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($res as $row) {?>
                <tr>
                    <td><?= $n++; ?></td>
                    <td><?=$row['id_transaksi']?></td>
                    <td><?=$row['nm_menu_mkn']?></td>
                    <td>Rp. <?=number_format($row['harga'],0,',','.')?></td>
                    <td><?=$row['qty']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <?php } ?>
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
<!-- end modal pesanan -->