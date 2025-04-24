<?php 
include'proses/function.php';
date_default_timezone_set('Asia/Jakarta');
?>
<?php

  $awal = isset($_GET["tanggalawal"]) ? $_GET["tanggalawal"] : "";
  $akhir = isset($_GET["tanggalakhir"]) ? $_GET["tanggalakhir"] : "";
  
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
if(empty($res)){
echo "<center>
    <h5 style='margin:1rem;'>Data Transaksi Tidak ada</h5>
</center>";
}else {
$total =0;


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan$awal-$akhir.xls"); 

?>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

th,
td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>

<body>
    <table border="1" align="center">
        <h5>Laporan penghasilan dari tanggal <?=date("d M Y", strtotime($awal))?> sampai
            <?=date("d M Y ", strtotime($akhir))?></h5>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode order</th>
                <th>Waktu Order</th>
                <th>Waktu Bayar</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th>Total harga</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach($res as $row){?>
            <tr>
                <td><?= $n++; ?></td>
                <td><?=$row['id_transaksi']?></td>
                <td><?=date("d F Y H:s:i", strtotime($row['tanggal']))?></td>
                <td><?=date("d F Y H:s:i", strtotime($row['waktu_bayar']))?></td>
                <td><?=$row['nama_pelanggan']?></td>
                <td><?=$row['namapegawai']?></td>
                <td>Rp. <?=number_format($row['harganya'],0,'.','.')?></td>
            </tr>
            <?php
                $total += $row['harganya'];
                }?>
        </tbody>
        <tr>
            <th colspan="6" class="fw-bold">
                <b>Jumlah penghasilan</b>
            </th>
            <th colspan="1" class="fw-bold">Rp.<?=number_format($total,0,',','.')?>
            </th>
        </tr>
        <?php }?>

</body>