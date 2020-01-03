<?php  
  session_start();
  require '../config.php';

?>
<!DOCTYPE html>
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="css/style-rtl.css">
</head>
<style>
    .bg {
        background-image: url("images/Nursery.jpg");
    background-repeat: no-repeat;
        /* background-color: black; */
    }
</style>

<body>
    <div id="header-holder" class="main-header bg" >

        <nav id="nav" class="navbar navbar-default navbar-full">
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
                                <!-- <a class="logo-holder" href="index.html">
                                <div class="logo" style="width:62px;height:18px"></div>
                            </a> -->

                                <!-- <a class="logo-holder" href="index.html">Idris
                                </a> -->
                                <a href="signup.html" class="ybtn ybtn-header-color">Login</a>
                            </div>
                            <div style="height: 1px;" role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="index.html">Beranda</a></li>
                                    <li class="dropdown unity-menu">
                                        <a href="">Fasilitas <i class="fas fa-caret-down"></i></a>
                                        <ul class="dropdown-menu dropdown-unity">
                                            <li>
                                                <a class="unity-link" href="webhosting.html">
                                                    <div class="unity-box">
                                                        <div class="unity-icon">
                                                            <img src="images/cara.png" alt="">
                                                        </div>
                                                        <div class="unity-title">
                                                            Cara Perawatan
                                                        </div>
                                                        <div class="unity-details">
                                                            Perawatan Bunga berdasarkan jenis
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="unity-link" href="resellershosting.html">
                                                    <div class="unity-box">
                                                        <div class="unity-icon">
                                                            <img src="images/lokasi.png" alt="">
                                                        </div>
                                                        <div class="unity-title">
                                                            Temukan Kami
                                                        </div>
                                                        <div class="unity-details">
                                                            Lokasi pada google maps
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="unity-link" href="cloudhosting.html">
                                                    <div class="unity-box">
                                                        <div class="unity-icon">
                                                            <img src="images/faq.png" alt="">
                                                        </div>
                                                        <div class="unity-title">
                                                            FAQ
                                                        </div>
                                                        <div class="unity-details">
                                                            Pertanyaan yang sering ditanyakan
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown unity-menu">
                                        <a href="#pricing">Transaksi <i class="fas fa-caret-down"></i></a>
                                        <ul class="dropdown-menu dropdown-unity">
                                            <li>
                                                <a class="unity-link" href="webhosting.html">
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
                                            <li>
                                                <a class="unity-link" href="resellershosting.html">
                                                    <div class="unity-box">
                                                        <div class="unity-icon">
                                                            <img src="images/pemesanan.png" alt="">
                                                        </div>
                                                        <div class="unity-title">
                                                            Pemesanan saya
                                                        </div>
                                                        <div class="unity-details">
                                                            Produk Yang masih dalam tahap pemesanan
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <li><a href="contact.html">Hubungi Kami</a></li>

                                    <!-- <li class="support-button-holder support-dropdown">
                                        <a class="support-button" href="login.php">Login</a>

                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="top-content" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div id="main-slider">
                            <div class="slide">
                                <div class="big-title" style="color: black;">Kebun Nursery<br>Polije</div>
                                <p class="" style="color: black;">Unit Produksi Hortikultura Rembangan merupakan salah satu unit produksi yang yang dimiliki oleh Politeknik Negeri Jember,
                                    merupakan hasil kerjasama antara Politeknik Negeri Jember dengan Pemerintah Kabupaten Jember yang didirikan pada tahun 2004.
                                    Unit ini didirikan dengan tujuan untuk meningkatkan proses pembelajaran mahasiswa Politeknik Negeri Jember khususnya bidang kewirausahaan hortikultura.
                                    Adapun lokasi Unit Produksi Agrowisata 15 Km dari pusat kota Jember pada ketinggian tempat Rembangan berada di Hortikultura Kawasan Rembangan 500 mdpl.

                                    Unit Produksi Hortikultura Rembangan mempunyai fasilitas antara lain Kantor Pemasaran, Ruang Pasca Panen, Green House tanaman hias anggrek dan pot, Rumah Produksi Krisan seluas 1000 m2, Rumah Produksi Bunga Daun seluas 1000 m, Lahan Produksi Gerbera seluas 500 m.</p c>
                                <div class="btn-holder">
                                    <a href="signup.html" class="ybtn ybtn-header-color">Daftar Akun</a><a href="contact.html" class="ybtn ybtn-white ybtn-shadow">Hubungi Kami</a>
                                </div>
                            </div>
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
                    <div class="row-title">Produk Kami</div>
                    <div class="row-subtitle">Aneka Tanaman Hias</div>
                </div>
            </div>
            <div id="articles" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <a href="">
                            <div class="col-sm-6 col-md-4">
                                <div class="article-summary">
                                    <div class="article-img"><img src="images/anggrek bulan.jpg" alt="" /></div>
                                    <div class="article-details">
                                        <div class="article-title"><a href="">anggrek bulan</a></div>
                                        <div class="article-title"><a href="">Rp. 15.000</a></div>
                                        <div class="article-text">
                                            Anggrek bulan dapat tumbuh di dataran rendah sampai pegunungan dan umumnya hidup pada ketinggian 50-600 mdpl, juga dapat berkembang dengan baik pada ketinggian 700-1.100 mdpl.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="footer" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <div class="address-holder">
                                <div class="phone"><i class="fas fa-phone"></i>02178888</div>
                                <div class="email"><i class="fas fa-envelope"></i>Nurserypolije@gmail.com</div>
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
                                    <li><a href="about.html">Tentang Kami</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-2 col-md-3">
                            <div class="footer-menu-holder">
                                <h4>Layanan Kami</h4>
                                <ul class="footer-menu">
                                    <li><a href="webhosting.html">Transaksi Bunga</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-3">
                            <div class="footer-menu-holder">
                                <h4>Fasilitas</h4>
                                <ul class="footer-menu">
                                    <li><a href="portal.html">Cara Perawatan</a></li>
                                    <li><a href="#">Peta Lokasi</a></li>
                                    <li><a href="#">FAQ</a></li>
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