<?php
require 'assets/config.php';
session_start();


//menampilkan bunga
$bunga = mysqli_query($koneksi, "SELECT * FROM bunga");

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori where NAMA_KATEGORI IN ('Krisan', 'Anggrek')")

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>Nursery Polije</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <style>
        .bg {
            background-image: url("images/Nursery.png");
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div id="header-holder" class="main-header bg">
        <nav id="nav" class="navbar navbar-default navbar-full ">
            <div class="container-fluid">
                <div class="container container-nav">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-header">
                                <button aria-expanded="false" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                            </div>
                            <div style="height: 1px;" role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="index.php">Beranda</a></li>
                                
                                    <?php if (isset($_SESSION["login"])) { ?>
                                        <li class="dropdown unity-menu">
                                            <a href="">Transaksi<i class="fas fa-caret-down"></i></a>
                                            <ul class="dropdown-menu dropdown-unity">
                                                <li>
                                                    <a class="unity-link" href="keranjang.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/keranjang.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Keranjang saya
                                                            </div>
                                                            <div class="unity-details">
                                                                Produk Yang masih dalam tahap pemesanan
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="unity-link" href="tagihan.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/pemesanan.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Tagihan Saya
                                                            </div>
                                                            <div class="unity-details">
                                                                Produk Yang masih dalam tahap pemesanan
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="unity-link" href="dikemas.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/dikemas.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Dikemas
                                                            </div>
                                                            <div class="unity-details">
                                                                Produk Yang sedang dalam pengemasan
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="unity-link" href="dikirim.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/dikirim.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Dikirim
                                                            </div>
                                                            <div class="unity-details">
                                                                Produk Yang sedang dalam pengiriman
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="unity-link" href="transaksisaya.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/transaksi.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Transaksi Saya
                                                            </div>
                                                            <div class="unity-details">
                                                                Transaksi Yang pernah dilakukan
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <li class="dropdown">
                                        <a href="">Fasilitas<i class="fas fa-caret-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="caraperawatan.php"><i class="fas fa-book"></i> Cara Perawatan</a></li>
                                            <li><a href="temukankami.php"><i class="fas fa-map"></i> Temukan Kami</a></li>
                                            <?php if (isset($_SESSION["login"])) { ?>
                                            <li><a href="kritikdansaran.php"><i class="fas fa-envelope"></i> Kritik Dan Saran</a></li>
                                            <?php }?>
                                            <li><a href="faq.php"> <i class="fas fa-question-circle"></i> FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="https://api.whatsapp.com/send?phone=6285257461375&text=&source=&data=">Hubungi Kami</a></li>
                                    <li class="support-button-holder support-dropdown">
                                        <?php if (isset($_SESSION["login"])) { ?>
                                            <a class="support-button" href=""><?php echo $_SESSION["username"] ?></a>
                                        <?php } ?>
                                        <?php if (!isset($_SESSION["login"])) { ?>
                                            <a class="support-button" href="login.php">Login</a>
                                        <?php } ?>

                                        <?php if (isset($_SESSION["login"])) { ?>
                                            <ul class="dropdown-menu">
                                                <li><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></li>
                                                <li><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a></li>
                                            <?php } ?>
                                            </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="page-head" class="container-fluid inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="page-title">Kebun Nursery Polije</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="domain-quick-pricing" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="domain-box d-color1">
                        <!-- <div class="price">Nursery Polije</div> -->
                        <div class="details">Unit Produksi Hortikultura Rembangan merupakan salah satu unit produksi
                            yang yang dimiliki oleh Politeknik Negeri Jember, merupakan hasil kerjasama antara
                            Politeknik Negeri Jember dengan Pemerintah Kabupaten Jember yang didirikan pada tahun 2004.
                            Unit ini didirikan dengan tujuan untuk meningkatkan proses pembelajaran mahasiswa Politeknik
                            Negeri Jember khususnya bidang kewirausahaan hortikultura.</div>
                        <div class="btn-holder">
                            <a href="tentangkami.php" class="ybtn ybtn-header-color">Baca Selengkapnya</a>
                            <?php if (!isset($_SESSION["login"])) { ?>
                                <a href="daftar.php" class="ybtn ybtn-header-color">Daftar Akun</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="services" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row-title">Kategori Bunga</div>
                    <div class="row-subtitle">Cari dengan mudah.</div>
                </div>
            </div>
        </div>


        <div class="row">
            <?php foreach ($kategori as $data) { ?>
                <div class="col-sm-12 col-md-6">
                    <div class="service-box">
                        <div class="service-icon">
                            <img src="admin/img/<?= $data["GAMBAR_KATEGORI"] ?>" alt="">
                        </div>
                        <div class="service-title"><a href="kategoribunga.php?id=<?= $data["ID_KATEGORI"] ?>"><?= $data["NAMA_KATEGORI"] ?></a></div>
                        <div class="service-details">
                            <p><?= substr($data["DESKRIPSI"], 0, 100);
                                echo '...'; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="col-sm-12 col-md-3" style="float: right;">
        <div class="buttons-holder">
            <a href="kategori.php" class="ybtn ybtn-accent-color">Kategori lainnya</a>
        </div>
    </div>
    </div><br><br><br><br>


    <div id="services" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row-title">Produk Kami</div>
                    <div class="row-subtitle">Aneka Bunga Hias</div>
                </div>
            </div>
        </div>
    </div>


    <div id="articles" class="">
        <div class="container">
            <div class="row">
                <?php foreach ($bunga as $data) { ?>
                    <a href="bunga.php?id=<?php echo $data["ID_BUNGA"]; ?>">
                        <div class="col-sm-6 col-md-3">
                            <div class="article-summary">
                                <div class="article-img"><img style="width: 250px; height: 200px;" class="img-fluid img-thumbnail" src="admin/img/<?php echo $data["FOTO_BUNGA"]; ?>" alt="" /></div>
                                <div class="article-details">
                                    <div class="article-title"><b><?php echo $data["NAMA_BUNGA"]; ?></b></div>
                                    <div class="article-title">Rp. <?php echo $data["HARGA"]; ?></div>
                                    <div class="article-text">
                                        <?= substr($data["DESKRIPSI"], 0, 100);
                                        echo '...'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </a>
            </div>
        </div>
    </div>




    <div id="footer" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="address-holder">
                        <div class="phone"><i class="fas fa-phone"></i>085155173339</div>
                        <div class="email"><i class="fas fa-envelope"></i>idristifa@gmail.com</div>
                        <div class="address">
                            <i class="fas fa-map-marker"></i>
                            <div>puncak rembangan, darungan, Darungan, Kemuninglor, Arjasa, Jember Regency, Jawa Timur 68191</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-2">
                    <div class="footer-menu-holder">
                        <h4>Lembaga</h4>
                        <ul class="footer-menu">
                            <li><a href="tentangkami.php">Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-2 col-md-3">
                    <div class="footer-menu-holder">
                        <h4>Layanan Kami</h4>
                        <ul class="footer-menu">
                            <li><a href="kategori.php">Transaksi Bunga</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="footer-menu-holder">
                        <h4>Fasilitas</h4>
                        <ul class="footer-menu">
                            <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                            <li><a href="temukankami.php">Peta Lokasi</a></li>
                            <li><a href="faq.php">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1 col-md-1">
                    <div class="social-menu-holder">
                        <ul class="social-menu">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>