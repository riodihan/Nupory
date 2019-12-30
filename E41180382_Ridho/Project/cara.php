<?php
session_start();
require 'assets/includes/config.php';

$karyawan = @$_SESSION['id_status'] =='02';
$admin = @$_SESSION['id_status'] == '01';

//cek user,guest atau bukan
if($admin){
    header("location: index.php");
    exit;
}
if($karyawan){
    header("location: index.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cara Perawatan</title>
    <link rel="stylesheet" href="css/stylecara.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
    body{
        background-image: url('img/Nursery.jpg');
        background-color: ; 
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
                
                <li><a href="#">Data Admin</a></li>
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
                <li><a href="#">Report</a></li>
            <?php }if($karyawan){?>
                
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
            <?php }if($guest){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }?>
        </ul>
        
    </div>
    <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
    </div>
    <h1 class="h1">Nursery<br>Polije</h1>
        
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
    <div class="bawahan">
            <ul class="gambar">

                <?php $ambil=$koneksi->query("SELECT * FROM bunga");?>
                <?php while($perproduk=$ambil->fetch_assoc()){?>
                    <li class="gproduk">
                        <a href="caraperawatan.php?id=<?php echo $perproduk["ID_BUNGA"];?>"><img class="imgproduk" src="img/<?php echo $perproduk["FOTO_BUNGA"];?>">
                        <p class="p1">Cara Perawatan<br>Bunga <?php echo $perproduk['NAMA_BUNGA'];?></p></a>
                    </li>
                <?php }?>
            </ul>
        </div>

       <a href="https://api.whatsapp.com/send?phone=6285335490201&text=&source=&data="><input type="image" src="img/WA.png" width="50px" height="50px"></a>
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
