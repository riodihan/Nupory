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
                                    <li class="dropdown unity-menu">
                                        <a href="#pricing">Transaksi<i class="fas fa-caret-down"></i></a>
                                        <ul class="dropdown-menu dropdown-unity">

                                            <li>
                                                <a class="unity-link" href="keranjang.php">
                                                    <div class="unity-box">
                                                        <div class="unity-icon">
                                                            <img src="images/pemesanan.png" alt="">
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
                                    <li><a href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data=">Hubungi Kami</a></li>
                                    <li class="support-button-holder support-dropdown">
                                        <a class="support-button" href="#">Idris</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
                                            <li><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></li>
                                            <li><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a></li>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Krisan Bulan</td>
                        <td>20</td>
                        <td>10.000</td>
                        <td>200.000</td>
                        <td><a href="#" class="badge badge-danger">Hapus</a></td>
                    </tr>
                    <tr>
                        <td colspan="4">Jumlah Total</td>
                        <td>200.000</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Bayar</a>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Data Pembeli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nama</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Pembeli/Penerima">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">No Handphone</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Nomor Handphone">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Pengiriman</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Pembeli/Penerima"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
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