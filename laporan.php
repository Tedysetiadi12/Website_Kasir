<?php 
include'proses/function.php';
date_default_timezone_set('Asia/Jakarta');
?>
<?php 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize the input
    $awal = isset($_POST["tanggalawal"]) ? $_POST["tanggalawal"] : "";
    $akhir = isset($_POST["tanggalakhir"]) ? $_POST["tanggalakhir"] : "";
    
    $gete = mysqli_query($con,"SELECT transaksi.*,menu_minuman.*,nama_pelanggan,namapegawai,SUM(harga*qty) AS harganya FROM transaksi 
    LEFT JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
    LEFT JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
    LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
    JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
    GROUP BY id_transaksi
    HAVING DATE(transaksi.tanggal) BETWEEN '$awal' AND '$akhir'");
    if (!$gete) {
        die("Query failed: " . mysqli_error($con));
    }
    $n=1;
    while($p = mysqli_fetch_array($gete)){
    $res[] = $p;
    }
}else{
    $gete = mysqli_query($con,"SELECT transaksi.*,menu_minuman.*,nama_pelanggan,namapegawai,SUM(harga*qty) AS harganya FROM transaksi 
    LEFT JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
    LEFT JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
    LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
    JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
    GROUP BY id_transaksi ORDER BY tanggal DESC");
    if (!$gete) {
        die("Query failed: " . mysqli_error($con));
    }
    $n=1;
    while($p = mysqli_fetch_array($gete)){
    $res[] = $p;
    }
}

$select = mysqli_query($con,"SELECT idpegawai,namapegawai FROM pegawai ");
if (!$select) {
    die("Query failed: " . mysqli_error($con));
}
?>
<style>
.bayar {
    border-radius: 7px;
    padding: 4px;
    font-weight: 400i;
    background-color: green;
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

.container {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
}

.col {
    font-family: Arial, sans-serif;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    align-items: center;
}

.col label {
    display: flex;
    margin-bottom: -1rem;
    margin-left: 1.2rem;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}

input[type="date"] {
    padding: 8px;
    margin: 1rem;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 7px;
    outline: none;
}

input[type="date"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    margin-top: 0.7rem;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="button"] {
    background-color: transparent;
    color: #fff;
    margin-top: 0.7rem;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

@media (max-width: 360px) {
    .container {
        padding: 6px;
    }

    .sd {
        display: none;
    }

    input[type="date"] {
        margin-left: -4rem;
        font-size: 14px;
        padding: 6px;
    }

    input[type="submit"] {
        font-size: 16px;
    }
}
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class=" align-items-center justify-content-center mb-4">
        <h1 class="h3 mt-4 text-gray-800">Laporan Transaksi</h1>
        <button class="btn btn-primary" value="cetak" target="_blank"
            onclick="window.open('cetakexel.php?tanggalawal=<?=$awal ?>&tanggalakhir=<?=$akhir ?>')"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer"
                viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
            </svg> Cetak</button>
    </div>

    <!-- Content Row -->
    <div class="container">
        <form method="post">
            <div class="col">
                <div>
                    <label for="datepicker">Pilih tanggal awal</label>
                    <input type="date" id="datepicker" name="tanggalawal" value="<?=$awal?>">
                </div>
                <input type="button" value="S/D">
                <div>
                    <label for="datepicker">Pilih tanggal akhir</label>
                    <input type="date" id="datepicker" name="tanggalakhir" value="<?=$akhir?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Cari">
            </div>
        </form>
    </div>

    <?php
      if(empty($res)){
        echo "<center><h5 style='margin:1rem;'>Data Transaksi Tidak ada</h5></center>";
    }else {
        $total =0;
    ?>
    <div class="table-responsive">
        <table id="example" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode order</th>
                    <th>Waktu Order</th>
                    <th>Waktu Bayar</th>
                    <th>Pelanggan</th>
                    <th>Kasir</th>
                    <th>Total harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($res as $row){?>
                <tr>
                    <td><?= $n++; ?></td>
                    <td><?=$row['id_transaksi']?></td>
                    <td><?=date("d-M-Y H:s:i", strtotime($row['tanggal']))?></td>
                    <td><?=date("d-M-Y H:s:i", strtotime($row['waktu_bayar']))?></td>
                    <td><?=$row['nama_pelanggan']?></td>
                    <td><?=$row['namapegawai']?></td>
                    <td>Rp. <?=number_format($row['harganya'],0,'.','.')?></td>
                    <td>
                        <a href="detail.php?&order=<?=$row['id_transaksi']?>&pelanggan=<?=$row['nama_pelanggan']?>"
                            class="btn btn-info btn-sm m-1"><i class="fas fa-fw fa-regular fa-eye"></i></a>
                    </td>
                </tr>
                <?php
                $total += $row['harganya'];
                }?>
            </tbody>
        </table>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="6" class="fw-bold">
                        <b>Jumlah penghasilan</b>
                    </th>
                    <th colspan="1" class="fw-bold">Rp.<?=number_format($total,0,',','.')?>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <?php }?>
    <!-- Content Row -->

</div>
<!-- end edit -->