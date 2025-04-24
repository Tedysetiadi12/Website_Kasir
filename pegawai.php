<?php 
require'proses/function.php';
$get = mysqli_query($con,"SELECT * FROM pegawai");
while($p=mysqli_fetch_array($get)){
    $res[] = $p;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
</head>

<body>



    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mt-4 text-gray-800">Data pegawai</h1>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col">
                <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal"
                    data-target="#myModal">Tambah
                    Pegawai</button>
            </div>
        </div>
        <!-- Content tables -->
        <div class="table-responsive">

            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama pegawai</th>
                        <th>Nomor handphone</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $n=1;
                        foreach($res as $row){
                            ?>
                    <tr>
                        <td><?= $n++; ?></td>
                        <td><?=$row['namapegawai']?></td>
                        <td><?=$row['nohp']?></td>
                        <td><?=$row['alamat']?></td>
                        <td><button class="btn btn-warning btn-sm m-1" data-toggle="modal"
                                data-target="#Modaledit<?=$row['idpegawai']?>">
                                <i class="fas fa-fw fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-sm m-1" data-toggle="modal"
                                data-target="#Modalhapus<?=$row['idpegawai']?>">
                                <i class="fas fa-fw fa-regular fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- Content Row -->

    </div>
    <!-- modal tambah -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">From Tambah Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="user" method="post">
                        <div class="form-group">
                            <input type="text" name="namapegawai" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Nama Pegawai" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="nohp" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Nomor handphone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamatpegawai" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Alamat Pegawai" required>
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
    <!-- end modal tambah -->
    <!-- modal edit -->
    <?php
foreach($result as $row){
?>
    <div class="modal fade" id="Modaledit<?=$row['idpegawai']?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">From Edit pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="user" action="proses/edit_pegawai.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$row['idpegawai'] ?>">
                            <input type="text" name="namapegawai" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Nama Pegawai"
                                value="<?=$row['namapegawai']?>">
                        </div>
                        <div class="form-group">
                            <input type="number" name="nohp" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Nomor handphone"
                                value="<?=$row['nohp']?>"">
                    </div>
                    <div class=" form-group">
                            <input type="text" name="alamatpegawai" class="form-control" id="exampleInputEmail"
                                aria-describedby="username" placeholder="Masukan Alamat Pegawai"
                                value="<?=$row['alamat']?>">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="editpegawai" class="btn btn-primary btn ">Edit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
foreach($result as $row){
?>
    <div class="modal fade" id="Modalhapus<?=$row['idpegawai']?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="user" action="proses/hapus_pegawai.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$row['idpegawai'] ?>">
                        </div>
                        Apakah ingin menghapus pegawai <b><?=$row['namapegawai']?></b> ?
                        <div class="modal-footer">
                            <button type="submit" name="hapuspegawai" class="btn btn-danger btn ">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- end modal edit -->
    <script type="text/javascript">
    $(document).ready(
        function() {
            $('#example').DataTable();
        });
    </script>
    <script>
    new DataTable('#example')
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</body>

</html>