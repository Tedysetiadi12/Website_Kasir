<?php 
require'proses/function.php';
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mt-4 text-gray-800">Data Pelanggan</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
        </div>
    </div>
    <!-- Content Row -->
    <div class="table-responsive">

        <table id="example" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama pelanggan</th>
                    <th>tanggal beli</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $get = mysqli_query($con,"SELECT transaksi.*,pesan_makan.*,menu_minuman.*,nama_pelanggan,namapegawai,SUM(harga*qty) AS harganya FROM transaksi 
                    LEFT JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
                    LEFT JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
                    LEFT JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
                    LEFT JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
                    GROUP BY id_transaksi DESC");
        $n=1;
        while($p=mysqli_fetch_array($get)){
        $namapel = $p["nama_pelanggan"];
        $almatpel = $p["tanggal"];

        ?>
                <tr>
                    <td><?= $n++; ?></td>
                    <td><?=$namapel?></td>
                    <td><?=$almatpel?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <!-- Content Row -->

</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">From Tambah pelanggan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="user" method="post">
                    <div class="form-group">
                        <input type="text" name="namapelanggan" class="form-control" id="exampleInputEmail"
                            aria-describedby="username" placeholder="Masukan Nama Pelanggan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="alamatpelanggan" class="form-control" id="exampleInputEmail"
                            aria-describedby="username" placeholder="Masukan Alamat Pelanggan" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambahpegawai" class="btn btn-primary btn ">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>