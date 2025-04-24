<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <a style=" text-decoration: none;" class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon ">
            <img style="width:70px; height:70px; border-radius:50%;" src="uploadImage/logo.png" alt="#">
        </div>
        <div class="sidebar-brand-text mx-3"> white.famouse</div>
    </a>

    <!-- Topbar Search -->


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><?= date('d M Y') ?></div>
                        <?php 
                            
                            $date = date("Y-m-d");
                            // echo $date;
                            $sql = mysqli_query($con,"SELECT COUNT(*) as jumlah_order
                                    FROM transaksi
                                    WHERE DATE(tanggal) ='$date' ");
                                    while($p = mysqli_fetch_array($sql)){
                                      
                                        
                                     ?>
                        <span class="font-weight-bold">Jumlah orderan hari ini sebanyak <?=$p['jumlah_order']?>
                            pesanan</span>
                        <?php } ?>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
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
                        <div class="small text-gray-500"><?= date('d M Y') ?></div>
                        Pendapatan Hari dari penjualan menu Hari ini Rp.
                        <?=number_format($p['total'],0,',','.')?>
                        <?php }?>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <?php
                        // Daftar kata pesan untuk setiap hari
                        $pesan_harian = array(
                            "Selamat hari Senin,Hari ini adalah kesempatan baru untuk melakukan hal-hal hebat.Selalu jaga Kesehatan Ya",
                            "Selamat hari Selasa, Jadikan hari ini lebih baik dari kemarin dan besok lebih baik dari hari ini. Selalu jaga Kesehatan Yaa",
                            "Selamat hari Rabu, Keberhasilan dimulai dengan langkah pertama. Lakukan sesuatu hari ini!.Selalu jaga Kesehatan ya",
                            "Selamat hari Kamis, Berikan senyuman kepada dunia, dan dunia akan memberikan senyuman padamu.Selalu Jaga Kesehatan Yaa",
                            "Selamat hari Jumat, Jangan menyerah pada mimpi-mu. Setiap langkah mendekatkanmu pada tujuanmu. Selalu jaga Kesehatan yaa",
                            "Selamat hari Sabtu, Hidup adalah anugerah. Hargai setiap momen dan jadikan setiap hari berarti. 
                            Selalu jaga Kesehatan yaa",
                            "Selamat hari Minggu, Pikirkan positif dan hal-hal positif akan terjadi padamu. Selalu Jaga Kesehatan Ya",
                        );

                        // Mendapatkan indeks hari saat ini (1-7)
                        $indeks_hari = date("N");

                        // Mendapatkan pesan untuk hari ini
                        $pesan_hari_ini = $pesan_harian[$indeks_hari - 1];
                        ?>


                        <div class="small text-gray-500"><?= date('d M Y') ?></div>
                        <p><?= $pesan_hari_ini; ?></p>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
            </a>
            <!-- Dropdown - Messages -->
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $h['username']?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>