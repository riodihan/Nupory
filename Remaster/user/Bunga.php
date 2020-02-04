<?php
require 'assets/config.php';
session_start();

//cek session
if ($_SESSION["id_status"] != 03) {
    header("location: ../admin/index.php");
}

//id bunga
$idbunga = $_GET["id"];

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

$bunga = mysqli_query($koneksi, "SELECT * FROM bunga where id_bunga = '$idbunga'");


//username
$username = $_SESSION["username"];

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi where username = '$username' && ID_STATUS_TRANSAKSI = 01");
$cek = mysqli_fetch_array($transaksi);
//auto increment id transaksi

$carikode = mysqli_query($koneksi, "select max(ID_TRANSAKSI)from transaksi") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 1);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "T" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "T001";
}



//keranjang

if (!isset($cek["ID_TRANSAKSI"])) {
    if (isset($_POST["keranjang"])) {

        if (keranjang($_POST) == 1) {
            echo "window.location.href='keranjang.php'</script>";
        } else {
            echo mysqli_error($koneksi);
        }
    }
}

//detail
if (isset($_POST["keranjang"])) {

    if (detail_keranjang($_POST) == 1) {
        echo "<script>window.location.href='keranjang.php'</script>";
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
    <title>Bunga</title>
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
                                    <li class="dropdown unity-menu">
                                        <a href="#pricing">Fasilitas <i class="fas fa-caret-down"></i></a>
                                        <ul class="dropdown-menu dropdown-unity">
                                            <li>
                                                <a class="unity-link" href="caraperawatan.php">
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
                                                <a class="unity-link" href="temukankami.php">
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
                                            <?php if (isset($_SESSION["login"])) { ?>
                                                <li>
                                                    <a class="unity-link" href="kritikdansaran.php">
                                                        <div class="unity-box">
                                                            <div class="unity-icon">
                                                                <img src="images/kritik.png" alt="">
                                                            </div>
                                                            <div class="unity-title">
                                                                Kritik dan saran
                                                            </div>
                                                            <div class="unity-details">
                                                                Berikan Kritik dan saran
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a class="unity-link" href="faq.php">
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

        <?php foreach ($bunga as $data) { ?>
            <div id="page-head" class="container-fluid inner-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="page-title">Bunga <?= $data["NAMA_BUNGA"] ?></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <br><br>
    <div class="container-fluid">
        <div class="alert alert-dark" role="alert">
            <div class="row">
                <div class="col-md-5">
                    <img src="../admin/img/<?= $data["FOTO_BUNGA"] ?>" alt="" class="img-responsive">
                </div>

                <?php if (isset($cek)) { ?>
                    <div class="col-md-6">
                        <h3>Rp.<?= $data["HARGA"] ?></h3>
                        <p>Stok : <?= $data["STOK"] ?></p><br>
                        <form method="POST">
                            <input type="hidden" name="idtransaksi" value="<?= $cek["ID_TRANSAKSI"] ?>" class="form-control" id="exampleFormControlInput1" placeholder="">

                            <input type="hidden" name="idbunga" value="<?= $data["ID_BUNGA"] ?>" class="form-control" id="exampleFormControlInput1" placeholder="">

                            <input type="hidden" name="idstatustransaksi" value="01" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jumlah Beli</label>
                                <input required id="jumlah" onkeyup="sum();" type="text" name="jumlah" class="form-control" placeholder="">
                                <input id="harga" onkeyup="sum();" value="<?= $data["HARGA"] ?>" type="hidden" name="harga" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Total Harga</label>
                                <input id="total" onkeyup="sum();" type="number" name="totalharga" class="form-control" placeholder="" readonly>
                            </div>
                            <div class="form-group">
                                <p>Deskripsi Bunga :</p>
                                <p><?= $data["DESKRIPSI"] ?></p>
                            </div>

                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                masukan Keranjang
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin Ingin Membeli Produk Ini ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="keranjang" class="btn btn-primary">Masukan keranjang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>



                <?php if (!isset($cek)) { ?>
                    <div class="col-md-6">
                        <h3>Rp.<?= $data["HARGA"] ?></h3>
                        <p>Stok : <?= $data["STOK"] ?></p><br>

                        <form method="POST">
                            <input type="hidden" name="idtransaksi" value="<?= $hasilkode ?>" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <input type="hidden" name="username" value="<?= $username ?>" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <input type="hidden" name="idbunga" value="<?= $data["ID_BUNGA"] ?>" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <input type="hidden" name="idstatustransaksi" value="01" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <input type="hidden" name="statusdetailtransaksi" value="keranjang" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <input type="hidden" name="idpembayaran" value="03" class="form-control" id="exampleFormControlInput1" placeholder="">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jumlah Beli</label>
                                <input required id="jumlah" onkeyup="sum();" type="text" name="jumlah" class="form-control" placeholder="">
                                <input id="harga" onkeyup="sum();" value="<?= $data["HARGA"] ?>" type="hidden" name="harga" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Total Harga</label>
                                <input id="total" onkeyup="sum();" type="number" name="totalharga" class="form-control" placeholder="" readonly>
                            </div>
                            <div class="form-group">
                                <p>Deskripsi Bunga :</p>
                                <p><?= $data["DESKRIPSI"] ?></p>
                            </div>
                            <!-- <button type="submit" name="keranjang" class="btn btn-success">Masukan keranjang</button> -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1">
                                masukan Keranjang
                            </button>
                            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin Ingin Membeli Produk Ini ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="keranjang" class="btn btn-primary">Masukan keranjang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    </div>
<?php } ?>
<br><br><br><br>


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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function sum() {
        var txtFirstNumberValue = document.getElementById('harga').value;
        var txtSecondNumberValue = document.getElementById('jumlah').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(txtSecondNumberValue)) {
            document.getElementById('total').value = result;
        }

    }
</script>
</body>

</html>