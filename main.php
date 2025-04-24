<?php 
if (empty($_SESSION['user_nama'])){
    header('location:login');
}
    $ceck = mysqli_query($con,"SELECT * FROM user WHERE username ='$_SESSION[user_nama]' ");
    $h = mysqli_fetch_array($ceck);
    echo $_SESSION['user_nama'];
include ('proses/function.php');
// session_start();
// Fungsi untuk mengonversi nama bulan ke bahasa Indonesia
function indoMonth($monthNumber) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    return $bulan[$monthNumber];
}

$bulanSekarang = date('n'); // Mendapatkan nomor bulan saat ini (1-12)

// echo indoMonth($bulanSekarang); Menampilkan nama bulan dalam bahasa Indonesia

$result = mysqli_query($con,"SELECT MONTH(tanggal) AS bulan, SUM(harga*qty) AS total FROM transaksi
INNER JOIN pegawai ON transaksi.id_pegawai = pegawai.idpegawai
INNER JOIN pesan_makan ON transaksi.id_transaksi = pesan_makan.kode_pesanan
INNER JOIN menu_makanan ON menu_makanan.idmenumakanan = pesan_makan.id_makanan
INNER JOIN menu_minuman ON menu_minuman.id_bayar = transaksi.id_transaksi
GROUP BY bulan ");

while($m = mysqli_fetch_array($result)){
    
        $bulan[] = indoMonth($m['bulan']);
        $total =  $m['total'] ." <br>";
        // echo $total;
    }
    if(!$result){
    
    }else {
        
    


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>aplikasi kasir</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- CDN exl -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>

<body style="margin-top:4.6rem;" id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("sidebar.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("navbar.php");?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php 
                    include $page;
                ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span style="color: black;font-size:1rem;">Copyright &copy;| by:Tedi setiadi Website
                            <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-body">Apakah anda ingin keluar dari akun ini ?</div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/chart.js/Chart.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <?php } ?>
</body>
<script>
new DataTable('#example');
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
<script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}


// Area Chart Example
var ctx = document.getElementById('chart');
var myLineChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            <?php
            mysqli_data_seek($result, 0); // Mengatur kembali pointer hasil ke awal
            while($m = mysqli_fetch_assoc($result)){
                echo '"'.indoMonth($m['bulan']).'",';
            }
            ?>
        ],
        datasets: [{
            label: "penghasilan ",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: [
                <?php
                mysqli_data_seek($result, 0); // Mengatur kembali pointer hasil ke awal
                while($m = mysqli_fetch_assoc($result)){
                    echo '"'.$m['total'].'",';
                }
                ?>
            ],
        }, ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0,
            },
        },
        scales: {
            xAxes: [{
                time: {
                    unit: "date",
                },
                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    maxTicksLimit: 7,
                },
            }, ],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return "Rp." + number_format(value);
                    },
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2],
                },
            }, ],
        },
        legend: {
            display: false,
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel + "Rp." + number_format(tooltipItem.yLabel);
                },
            },
        },
    },
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito',
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
</script>
<script type="text/javascript">
var ctx = document.getElementById("Chartpie");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php
            mysqli_data_seek($result, 0); // Mengatur kembali pointer hasil ke awal
            while($m = mysqli_fetch_assoc($result)){
                echo '"'.indoMonth($m['bulan']).'",';
            }
            ?>],
        datasets: [{
            data: [<?php
                mysqli_data_seek($result, 0); // Mengatur kembali pointer hasil ke awal
                while($m = mysqli_fetch_assoc($result)){
                    echo '"'.$m['total'].'",';
                }
                ?>],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#FF0000', '#FFFF00', '#A52A2A'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});
</script>

</html>