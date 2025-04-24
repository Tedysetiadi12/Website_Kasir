<?php 
include("proses/function.php");
$query = mysqli_query($con,"SELECT *, id_transaksi, SUM(harga*qty) AS harganya FROM pesan_makan 
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
// $kode_pesanan = $p['kode_pesanan'];
// $pelanggan = $p['nama_pelanggan'];
}
$bayar = mysqli_query($con,"SELECT * FROM menu_minuman");

while(!$bayar){
    $result[] =$bayar;
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

<body>
    <a href="transaksi" class="btn btn-info m-3 d-flex-end">
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
                                <th scope="col">Nama menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
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
                                <td>
                                    <button type="button"
                                        class="
                                <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm m-1" : "btn btn-warning btn-sm m-1" ;?>"
                                        data-bs-toggle="modal" data-bs-target="#Modaledit<?=$row['id_pesanan']?>">
                                        <ion-icon class="small" name="create-outline"></ion-icon>
                                    </button>
                                    <button type="button"
                                        class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled btn-sm m-1" : "btn btn-danger btn-sm m-1" ;?>"
                                        data-bs-toggle="modal" data-bs-target="#Modalhapus<?=$row['id_pesanan']?>">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </td>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }
            ?>
            <div>
                <a style="text-align: center;"
                    href="./?x=tambahpesanan&order=<?= $kode_pesanan ?>&pelanggan=<?=$pelanggan?>" type="button"
                    class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled p-1" : "btn btn-primary p-1" ;?>">
                    <ion-icon style="font-size: 1.5rem;" name="add-circle"></ion-icon> Tambah Menu
                </a>
                <?php echo (!empty($row['id_bayar'])) ? "<a class='btn btn-primary p-1' href='./?x=cetak&order=".$kode_pesanan."&pelanggan=".$pelanggan."'><ion-icon style='font-size: 1.5rem;' name='cash-outline'></ion-icon> Print</a>" : " " ;?>
                <button style="text-align: center; color:white;" type="button"
                    class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled p-1 m-2" : "btn btn-success p-1" ;?>"
                    data-bs-toggle="modal" data-bs-target="#Modalbayar<?=$row['id_transaksi']?>">
                    <ion-icon style='font-size: 1.5rem;' name='cash-outline'></ion-icon> Bayar
                </button>
            </div>
        </div>

    </div>
    <?php 

    if(empty($res)){
      }else {
                    ?>
    <!-- modal edit -->
    <?php 
    foreach( $res as $a) { 
        ?>
    <div class="modal fade" id="Modaledit<?=$a['id_pesanan']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jumlah Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="proses/edit_menu.php" method="POST">
                            <div class="col">
                                <input type="hidden" name="pelanggan" class="form-control"
                                    value="<?=$_GET['pelanggan']?>" id="floatingInput">
                                <input type="hidden" name="id_pesanan" class="form-control"
                                    value="<?=$a['id_pesanan'] ?>" id="floatingInput">
                                <input type="hidden" name="id_makanan" class="form-control"
                                    value="<?=$a['id_makanan'] ?>" id="floatingInput">
                                <input type="hidden" name="kode_pesanan" class="form-control"
                                    value="<?=$a['kode_pesanan'] ?>" id="floatingInput">
                                <div class="form-floating mb-3">
                                    <input type="text" name="namamenu" class="form-control" id="floatingInput"
                                        placeholder="nama menu" value="<?=$a['nm_menu_mkn'] ?>" disabled>
                                    <label for="floatingInput">Masukan Menu</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" name="qty" class="form-control" id="floatingInput"
                                        placeholder="qty" value="<?= $a['qty'] ?>">
                                    <label for="floatingInput">Masukan Qty</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="ediordertmenu" class="btn btn-warning">
                                    Edit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tambah menu -->
    <?php
 }
 ?>
    <!-- end modal edit -->
    <!-- modal hapus -->
    <?php 
    foreach( $res as $a) { 
        ?>
    <div class="modal fade" id="Modalhapus<?=$a['id_pesanan']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="proses/hapus_menu_order.php" method="POST">
                            <div class="col">
                                <input type="hidden" name="pelanggan" class="form-control"
                                    value="<?=$_GET['pelanggan']?>" id="floatingInput">
                                <input type="hidden" name="kode_pesanan" class="form-control"
                                    value="<?=$a['kode_pesanan'] ?>" id="floatingInput">
                                <input type="hidden" name="id_pesanan" class="form-control"
                                    value="<?=$a['id_pesanan']?>" id="floatingInput">
                                Apakah Anda ingin menghapus Order menu
                                <b>
                                    <?= $a['nm_menu_mkn']?>
                                </b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="hapusordertmenu" class="btn btn-danger">
                                    Hapus </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tambah menu -->
    <?php
 }
 ?>
    <!-- end modal hapus -->
    <!-- modal bayar -->
    <?php 
    foreach( $res as $row) { 
        ?>
    <div class="modal fade" id="Modalbayar<?=$row['id_transaksi']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                if(empty($res)==1){
                    echo "<center><h5 style='margin-top:5rem;margin-botton:2rem;'>Data Orderan Tidak ada</h5></center>";
                }else {
                ?>
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="taxt-nowrap">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama menu</th>
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
                                </tbody>
                            </table>
                        </div>
                        <?php }?>
                    </div>
                    <div class="row">
                        <form class="needs-validation" action="proses/bayar.php" method="POST">
                            <div class="col">
                                <input type="hidden" name="pelanggan" class="form-control"
                                    value="<?=$_GET['pelanggan']?>" id="floatingInput">
                                <input type="hidden" name="total" class="form-control" value="<?=$total ?>"
                                    id="floatingInput">
                                <input type="hidden" name="kode_pesanan" class="form-control"
                                    value="<?=$row['kode_pesanan'] ?>" id="floatingInput">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="bayar" class="form-control" id="floatingInput"
                                    placeholder="Bayar" required>
                                <label for="floatingInput">Masukan Uang Pembayaran</label>
                                <div class="invalid-feedback">
                                    Masukan Uang Pembayaran.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="bayarorder" class="btn btn-success">
                                    Bayar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal tambah menu -->
    <?php
 }
 ?>
    <?php }?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
    // $(document).ready(function() {
    //     $('#bayar').mask('#.##0', {
    //         reverse: true
    //     });
    // })
    </script>
</body>

</html>