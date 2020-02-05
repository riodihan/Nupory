<?php
session_start();
require 'assets/config.php';

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
//cek session
if ($_SESSION["id_status"] != 03) {
    header("location: ../admin/index.php");
}

//username
$username = $_SESSION["username"];


//tagihan
$tagihan = mysqli_query($koneksi, "SELECT * FROM transaksi
                        
                        WHERE username = '$username' && ID_STATUS_TRANSAKSI = 02 && ID_PEMBAYARAN = 01
                            
                            ");
$cek = mysqli_fetch_array($tagihan);


$tagihan1 = mysqli_query($koneksi, "SELECT * FROM transaksi
                        
                        WHERE username = '$username' && ID_STATUS_TRANSAKSI = 02 && ID_PEMBAYARAN = 02
                            
                            ");
$cek1 = mysqli_fetch_array($tagihan1);

$cek2 = mysqli_query($koneksi, "SELECT * FROM transaksi
                        
                        WHERE username = '$username' && ID_STATUS_TRANSAKSI = 02
                            
                            ");
$cek3 = mysqli_fetch_array($cek2);


//detail tagihan
$detail = mysqli_query($koneksi, "SELECT * FROM transaksi
                        inner join detail_transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
                        inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                        WHERE username = '$username' && transaksi.ID_STATUS_TRANSAKSI = 02 && ID_PEMBAYARAN = 01
                            
                            ");


//upload

if (isset($_POST["simpan"])) {

    if (upload($_POST) == 1) {
        echo "<script>window.location.href='tagihan.php'</script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>Tagihan</title>
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

    <div id="header-holder" class="bg">
        <div class=""></div>
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
                            </div>
                            <div style="height: 1px;" role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="index.php">Beranda</a></li>
                                    
                                    <?php if (isset($_SESSION["login"])) { ?>
                                        <li class="dropdown unity-menu">
                                            <a href="#pricing">Transaksi<i class="fas fa-caret-down"></i></a>
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
                        <div class="page-title">Tagihan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="page-content" class="container-fluid">
        <div class="container">
            <div id="services" class="container-fluid">
                <div class="container">



                    <?php foreach ($tagihan as $data) { ?>

                        <div class="row">
                            <div class="col-sm-12 col-md-9">
                                <div class="service-box">
                                    <div class="service-icon">
                                        <img src="images/anggrek bulan.jpg" alt="">
                                    </div>
                                    <div class="service-title"><a href="">Tagihan Anda</a></div>
                                    <div class="service-details">
                                        <p>Jumlah yang harus Di bayar : Rp. <?= $data["TOTAL_AKHIR"] ?></p>
                                        <?php echo "<td><a href='#myModal' class='btn btn-info btn-small' id='custId' data-toggle='modal' data-id=" . $data['ID_TRANSAKSI'] . ">Detail</a></td>"; ?>
                                        <?php echo "<td><a href='#myModal1' class='btn btn-info btn-small' id='custId' data-toggle='modal' data-id=" . $data['ID_TRANSAKSI'] . ">Bayar</a></td>"; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>






                    <?php foreach ($tagihan1 as $data1) { ?>

                        <div class="row">
                            <div class="col-sm-12 col-md-9">
                                <div class="service-box">
                                    <div class="service-icon">
                                        <img src="images/anggrek bulan.jpg" alt="">
                                    </div>
                                    <div class="service-title"><a href="">Bukti Pemesanan Anda</a></div>
                                    <div class="service-details">
                                        <!-- <p>Jumlah yang harus Di bayar : Rp. <?= $data1["TOTAL_AKHIR"] ?></p> -->
                                        <div class="alert alert-success" role="alert">
                                            Tunjukan Bukti Pemesanan ini kepada karyawan saat transaksi di tempat.
                                        </div>
                                        <?php echo "<td><a href='#myModal' class='btn btn-info btn-small' id='custId' data-toggle='modal' data-id=" . $data1['ID_TRANSAKSI'] . ">Detail</a></td>"; ?>

                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php } ?>


                    <?php if (!isset($cek3)) { ?>
                        <div class="alert alert-info" role="alert" style="text-align: center;">
                            Anda tidak memiliki tagihan belanja.
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tagihan Anda</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal  detail -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'detailtagihan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal1').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'detailbayartagihan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>