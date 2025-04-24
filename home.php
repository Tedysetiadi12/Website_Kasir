<?php include('proses/function.php'); 
date_default_timezone_set('Asia/Jakarta');
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Orderan (Monthly)</div>
                            <?php 
                            
                                                $date = date("Y-m-d");
                                                // echo $date;
                                                $sql = mysqli_query($con,"SELECT COUNT(*) as jumlah_order
                                                        FROM transaksi
                                                        WHERE DATE(tanggal) ='$date' ");
                                                        while($p = mysqli_fetch_array($sql)){
                                                          
                                                            
                                                         ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$p['jumlah_order']?></div>
                            <?php }?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                penghasilan (Hariini)</div>
                            <?php 
                                                $date = date("Y-m-d");
                                                // echo $date;
                                                $gete = mysqli_query($con,"SELECT transaksi.*,menu_minuman.*,nama_pelanggan,namapegawai,SUM(harga*qty) AS total FROM transaksi 
                                                INNER JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
                                                INNER JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
                                                INNER JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
                                                INNER JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
                                                    WHERE DATE(tanggal)='$date'");
                                                while($p = mysqli_fetch_array($gete)){
                                                         ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                <?=number_format($p['total'],0,',','.')?></div>
                            <?php }?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Makanan terjual</div>
                            <?php 
                                                $date = date("Y-m-d");
                                                // echo $date;
                                                $gete = mysqli_query($con,"SELECT SUM(qty) AS jumlah FROM pesan_makan 
                                                INNER JOIN transaksi ON pesan_makan.kode_pesanan = transaksi.id_transaksi
                                                INNER JOIN menu_makanan ON  menu_makanan.idmenumakanan = pesan_makan.id_makanan
                                                INNER JOIN menu_minuman ON  menu_minuman.id_bayar = transaksi.id_transaksi
                                                    WHERE DATE(tanggal)='$date'");
                                                while($p = mysqli_fetch_array($gete)){
                                                         ?>

                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$p['jumlah']?></div>
                            <?php }?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Chart lingkaran</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="Chartpie"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php $result = mysqli_query($con,"SELECT MONTH(tanggal) AS bulan, SUM(harga*qty) AS total FROM transaksi
                            INNER JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
                            INNER JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
                            INNER JOIN menu_makanan ON menu_makanan.idmenumakanan = pesan_makan.id_makanan
                            INNER JOIN menu_minuman ON menu_minuman.id_bayar = transaksi.id_transaksi
                            GROUP BY bulan ");
                             $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info','text-secondary'];

                             $index = 0;
                            while($m = mysqli_fetch_array($result)){

                            $bulan = indoMonth($m['bulan']);
                            $total =  $m['total'] ." <br>";
                            // echo $total;
                           ?>
                        <span class="mr-2">
                            <i class="fas fa-circle <?php echo $colors[$index]; ?>"></i> <?=  $bulan;?>
                        </span>
                        <?php
                     $index = ($index + 1) % count($colors);
                    } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik penghasilan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>