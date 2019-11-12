<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <link rel="stylesheet" href="css/styleberanda.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
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
            <li><a href="index.php">Beranda</a></li>
            <li><a href="semuaproduk.php">Semua Produk</a></li>
            <li><a href="caraperawatan.php">Cara Perawatan</a></li>
            <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
            <li><a href="temukankami.php">Temukan Kami</a></li>
            <li><a href="#">FAQ</a></li>
        </ul>
        
    </div>
    <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
    </div>
    <h1 class="h1">Nursery<br>Polije
        
        <?php
        if(!isset($_SESSION["login"])) {?>
            <button><a href="login.php">Login</a></button>
        <?php }?>

        <?php  
        if (isset($_SESSION["login"])) {?> 
            <button><a href="logout.php">Logout</a></button>
        <?php }?>
    </h1>
    </header>
    <section>
        <p class="judul">Kebun Nursery <br> Polije</p>
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
                Agrowisata
                15 Km dari pusat kota Jember pada ketinggian tempat
                Rembangan berada
                di
                Hortikultura
                Kawasan
                Rembangan
                500 m dpl. <br> <br>
                Unit Produksi Hortikultura Rembangan mempunyai
                fasilitas antara lain Kantor Pemasaran, Ruang Pasca Panen, Green
                House tanaman hias anggrek dan pot, Rumah Produksi Krisan
                seluas 1000 m2, Rumah Produksi Bunga Daun seluas 1000 m,
                Lahan Produksi Gerbera seluas 500 m, lahan produksi sayuran
                seluas 10.000 m dan unit Instalasi Riset and Development.</p>
            <!-- <ul>
                <li><h3>Unit Produksi</h3>
                <p>
                    Unit Produksi Hortikultura Rembangan merupakan
                    salah satu unit produksi yang yang dimiliki oleh Politeknik Negeri
                    Jember, merupakan hasil kerjasama antara Politeknik Negeri Jember
                    dengan Pemerintah Kabupaten Jember yang didirikan pada tahun
                    2004. Unit ini didirikan dengan tujuan untuk meningkatkan proses
                    pembelajaran mahasiswa Politeknik Negeri Jember khususnya
                    bidang kewirausahaan hortikultura. Selain itu juga memiliki fungsi
                    sebagai unit produksi yang dapat memenuhi kebutuhan masyarakat
                    kususnya di bidang Hortikultura. Adapun lokasi Unit Produksi
                    Agrowisata
                    15 Km dari pusat kota Jember pada ketinggian tempat
                    Rembangan berada
                    di
                    Hortikultura
                    Kawasan
                    Rembangan
                    500 m dpl.
                </p>
            </li><br>
            <li><h3>fasilitas</h3> 
                <p>
                        Unit Produksi Hortikultura Rembangan mempunyai
                        fasilitas antara lain Kantor Pemasaran, Ruang Pasca Panen, Green
                        House tanaman hias anggrek dan pot, Rumah Produksi Krisan
                        seluas 1000 m2, Rumah Produksi Bunga Daun seluas 1000 m,
                        Lahan Produksi Gerbera seluas 500 m, lahan produksi sayuran
                        seluas 10.000 m dan unit Instalasi Riset and Development.
                </p>
            </li>
            </ul> -->
        <a href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data="><input type="image" src="img/WA.png" width="50px" height="50px"></a>
    </section>
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