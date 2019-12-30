<?php
session_start();
require 'assets/includes/config.php';

// $wa = mysqli_query($koneksi, "SELECT * FROM wa" );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    <title>Beranda</title>
    <!-- <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1"> -->
    <link rel="stylesheet" href="css/styleberanda.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">

    <style>
    body{
        background-image: url('img/Nursery.jpg');
    }
    </style>
    
</head>
<body>
    <header>
    <div id="hidesidebar" class="hidesidebar">
        <p class="tombol"> <a href="javascript:void(0)" class="close" onclick="hide()">&#9776;</a></p>
        <ul>
            <?php 
                $user = @$_SESSION['id_status'] == '03';
                $karyawan = @$_SESSION['id_status'] =='02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));
                
                if($user){
            ?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="transaksisaya.php">Pemesanan Saya</a></li>
                <li><a href="transaksi.php">Transaksi Saya</a></li>
                <li><a href="cara.php">Cara Perawatan</a></li>
                <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }if($admin){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="datauser.php">Data User</a></li>
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
                <li><a href="kritikuser.php">Kritik User</a></li>
                <li><a href="report.php">Report</a></li>
            <?php }if($karyawan){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
                <li><a href="pemesanan.php">Pemesanan</a></li>
            <?php }if($guest){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="cara.php">Cara Perawatan</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }?>
        </ul>
        
    </div>
    <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
    </div>
    <div class="container">
   
    <h1 class="h1">Nursery<br>Polije </h1>
        
        <?php
        if(!isset($_SESSION["login"])) {?>
            <a class="login" href="login.php">Login</a>
        <?php }?>

        <?php  
        if (isset($_SESSION["login"])) {?> 
            <nav class="dropdown">
                <ul> <?php echo $_SESSION["USERNAME"];?>
                    <li><a href="Profile.php">Profil</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        <?php }?>
    
    </header>
    <section>
        <p class="judul">Kebun Nursery <br> Polije</p>
        <br>
        <br>
        <!-- <h2>Kebun Nursery</h2> -->
        <!-- <h2>Polije</h2> -->
        <br>
        <p class="p">
                Unit Produksi Hortikultura Rembangan merupakan
                salah satu unit produksi yang yang dimiliki oleh Politeknik Negeri
                Jember, merupakan hasil kerjasama antara Politeknik Negeri Jember
                dengan Pemerintah Kabupaten Jember yang didirikan pada tahun
                2004. Unit ini didirikan dengan tujuan untuk meningkatkan proses
                pembelajaran mahasiswa Politeknik Negeri Jember khususnya
                bidang kewirausahaan hortikultura. Selain itu juga memiliki fungsi
                sebagai unit produksi yang dapat memenuhi kebutuhan masyarakat
                kususnya di bidang Hortikultura. Adapun lokasi Unit Produksi
                Agrowisata 15 Km dari pusat kota Jember pada ketinggian tempat
                Rembangan berada di Hortikultura Kawasan Rembangan 500 mdpl.
                <br><br>
                Unit Produksi Hortikultura Rembangan mempunyai
                fasilitas antara lain Kantor Pemasaran, Ruang Pasca Panen, Green
                House tanaman hias anggrek dan pot, Rumah Produksi Krisan
                seluas 1000 m2, Rumah Produksi Bunga Daun seluas 1000 m,
                Lahan Produksi Gerbera seluas 500 m, lahan produksi sayuran
                seluas 10.000 m dan unit Instalasi Riset and Development.</p>
        <br><br>

        <h3 class="produk">Produk Kami</h3>
        <!-- Item Produk -->
        <div class="bawahan">
            <ul class="gambar">

                <?php $ambil=$koneksi->query("SELECT * FROM bunga");?>
                <?php while($perproduk=$ambil->fetch_assoc()){?>
                    <li class="gproduk">
                        <a href="semuaproduk.php?id=<?php echo $perproduk["ID_BUNGA"];?>"><img class="imgproduk" src="img/<?php echo $perproduk["FOTO_BUNGA"];?>">
                        <p class="p1"><?php echo $perproduk['NAMA_BUNGA'];?></p></a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <a style="display:scroll;position:fixed;bottom:0;right:0;" href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data=" target="_blank"><input type="image" src="img/WA.png" width="50px" height="50px"></a>
    </section>

    <footer>
        <!-- <p class="footer">&copy; Powered 2019 by Nupory Team</p> -->
    </footer>
    
    <script>
    function show() {
    document.getElementById("hidesidebar").style.width = "240px";
    document.getElementById("menu").style.marginLeft = "0%";
}

    function hide() {
    document.getElementById("hidesidebar").style.width = "0";
    document.getElementById("menu").style.marginLeft= "0";
}
    </script>
</body>
</html>