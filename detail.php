<?php 
include("proses/function.php");
$query = mysqli_query($con,"SELECT *,menu_minuman.* ,id_transaksi, SUM(harga*qty) AS harganya FROM pesan_makan 
LEFT JOIN transaksi ON transaksi.id_transaksi = pesan_makan.kode_pesanan
LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
LEFT JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
GROUP BY id_pesanan
HAVING pesan_makan.kode_pesanan = $_GET[order]");

$kode_pesanan = $_GET['order'];
$pelanggan = $_GET['pelanggan'];

if (!$query) {
    die("Query failed: " . mysqli_error($con));
}
$n=1;   
while ($p=mysqli_fetch_array($query)){
$res[] = $p;
// $dibayar = $p['bayar'];

// $kode_pesanan = $p['kode_pesanan'];
}
$bayar = mysqli_query($con,"SELECT * FROM menu_minuman WHERE id_bayar = $_GET[order]");

while($set=mysqli_fetch_array($bayar)){
    $dibayar = $set['bayar'];
    $kembalian = $set['kembalian'];
    $tanggal = $set['waktu_bayar'];
}
// SELECT employees.employee_name
// FROM employees
// JOIN transactions ON employees.employee_id = transactions.employee_id
// WHERE transactions.transaction_code = 123;

$gete = mysqli_query($con,"SELECT pegawai.namapegawai FROM pegawai
 JOIN transaksi ON pegawai.idpegawai = transaksi.id_pegawai 
 WHERE transaksi.id_transaksi = $_GET[order]");
while($esul=mysqli_fetch_array($gete)){
    $kasir = $esul['namapegawai'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>
<style>
.col h4 {
    font-size: 1rem;
}

.col h5 {
    font-size: 1rem;
}
</style>

<body>
    <a href="laporan" class="btn btn-info m-3 d-flex-end">
        <ion-icon style="font-size: 2rem;" name="arrow-back-circle-outline"></ion-icon>
    </a>
    <div class="row p-5">
        <div class="col">
            <form action="proses/input_pesanan.php" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input disabled type="number" class="form-control" id="kodepesanan"
                                value="<?=$kode_pesanan?>">
                            <label for="kodepesanan">Kode pesanan</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input disabled type="text" class="form-control" id="namapelanggan" value="<?=$pelanggan?>">
                            <label for="namapelanggan">Nama pelanggan</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input disabled type="text" class="form-control" id="namapelanggan" value="<?=$kasir?>">
                            <label for="namapelanggan">Kasir </label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input disabled type="text" class="form-control" id="namapelanggan" value="<?=$tanggal?>">
                            <label for="namapelanggan">Tanggal</label>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if(empty($res)==1){
                    echo "<center><h5 style='margin-top:5rem;margin-botton:2rem;'>Data Orderan Tidak ada</h5></center>";
                }else {
                ?>
            <div class="row">
                <div class="table-reponsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="taxt-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        $total=0;
                        $n=1;
                        foreach($res as $row){?>
                            <tr>
                                <td><?=$n++?></td>
                                <td><?=$row['nm_menu_mkn']?></td>
                                <td>Rp. <?=number_format($row['harga'],0,'.','.')?></td>
                                <td><?=$row['qty']?></td>
                                <td>Rp. <?=number_format($row['harganya'],0,',','.')?></td>
                            </tr>

                            <?php 
                            $total += $row['harganya'];
                        }
                        ?>
                            <tr>
                                <td class="fw-bold" colspan="3">

                                </td>
                                <td class="fw-bold" colspan="1">
                                    Total Harga
                                </td>
                                <td colspan="2" class="fw-bold">Rp.<?=number_format($total,0,',','.')?></td>
                            </tr>
                            <?php
                            $bayar = mysqli_query($con,"SELECT * FROM menu_minuman WHERE id_bayar = '$_GET[order]'");

                            while($set=mysqli_fetch_array($bayar)){
                                $dibayar = $set['bayar'];
                                $kembalian = $set['kembalian'];
                                ?>
                            <tr>
                                <td class="fw-bold" colspan="3">
                                </td>
                                <td class="fw-bold" colspan="1">
                                    Dibayar
                                </td>
                                <td colspan="2" class="fw-bold">Rp.<?=number_format($dibayar,0,',','.')?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" colspan="3">

                                </td>
                                <td class="fw-bold" colspan="1">
                                    kembalian
                                </td>
                                <td colspan="2" class="fw-bold">Rp.<?=number_format($kembalian,0,',','.')?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <div class="col d-none" style="text-align: center;font-size:4rem;">
                    <h4>Terima kasih sudah Melakukan pembayaran</h4>
                    <h5>Jangan lupa Mampir sini lagi ya</h5>
                </div>
            </div>
            <?php }
            ?>
        </div>
    </div>

    <!-- end modal bayar -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>