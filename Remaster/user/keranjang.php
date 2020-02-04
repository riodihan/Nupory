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


//keranjang
$keranjang = mysqli_query($koneksi, "SELECT * FROM transaksi
                        WHERE username = '$username' && ID_STATUS_TRANSAKSI = 01
                            
                            ");


//detail keranjang
$detail = mysqli_query($koneksi, "SELECT * FROM detail_transaksi
                        inner join transaksi on detail_transaksi.id_transaksi = transaksi.id_transaksi
                        inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                        WHERE username = '$username' && transaksi.ID_STATUS_TRANSAKSI = 01
                            
                            ");
$cek = mysqli_fetch_array($detail);


//tagihan

if (isset($_POST["simpan"])) {

    if (tagihan($_POST) == 1) {
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
    <title>Keranjang</title>
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
        <div id="page-head" class="container-fluid inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="page-title">Keranjang</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-content" class="container-fluid">
        <div class="container">
            <?php if (isset($cek)) { ?>
                <table class="table">
                    <caption>Keranjang</caption>
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($detail as $data) { ?>
                            <form action="">
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $data["NAMA_BUNGA"] ?></td>
                                    <td><?= $data["JUMLAH"] ?></td>
                                    <td><?= $data["HARGA"] ?></td>
                                    <td><?= $data["TOTAL_HARGA"] ?></td>
                                    <td><a type="button" class="badge badge-danger" data-toggle="modal" data-target="#staticBackdrop">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Peringatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda Yakin Ingin Menghapus Produk Ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <a href="hapus.php?id=<?= $data["ID_DETAIL_TRANSAKSI"] ?>" class="btn btn-primary">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php $i++ ?>
                        <?php } ?>
                        <?php foreach ($keranjang as $data1) { ?>
                            <tr>
                                <td colspan="4">Jumlah Total</td>
                                <td><?= $data1["TOTAL_AKHIR"] ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Bayar</a>
            <?php } ?>



            <?php if (!isset($cek)) { ?>
                <div class="alert alert-info" role="alert" style="text-align: center;">
                    Tidak ada produk yang di tambahkan kedalam keranjang, silahkan pilih Produk untuk melakukan transaksi.
                </div>
            <?php } ?>


        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Metode Pembayaran</label>
                            <select name="idpembayaran" class="form-control" id="exampleFormControlSelect1" required>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="01">Transfer</option>
                                <option value="02">Bayar Di Tempat</option>
                            </select>
                        </div>
                        <?php foreach ($keranjang as $data) { ?>
                            <div class="form-group">
                                <input value="<?= $data["ID_TRANSAKSI"] ?>" name="idtransaksi" type="hidden" class="form-control" id="formGroupExampleInput" placeholder="Nama Pembeli/Penerima">
                                <input value="02" name="idstatustransaksi" type="hidden" class="form-control" id="formGroupExampleInput" placeholder="Nama Pembeli/Penerima">
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Pembeli</label>
                            <textarea name="detailalamat" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Pembeli"></textarea>
                        </div>
                        <div class="alert alert-success" role="alert">
                            Alamat Pembeli harus diisi dengan benar
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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