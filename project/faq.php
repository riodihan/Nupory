<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FAQ</title>
    <script src="js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".as1").hide();
        $(".as2").hide();
        $(".as3").hide();
        $(".qs1").click(function () {
            $(".as1").slideToggle(); 
        });
        $(".qs2").click(function(){
            $(".as2").slideToggle();
        });
        $(".qs3").click(function () {
            $(".as3").slideToggle();
        });
    });
    </script>
    <link rel="stylesheet" href="css/stylefaq.css">
    <link rel="stylesheet" href="css/faq.css">
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
            <?php 
                $user = @$_SESSION['id_status'] == '03';
                $karyawan = @$_SESSION['id_status'] =='02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));
                
                if($user){
            ?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="transaksi.php">Transaksi Saya</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
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
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Pertanyaan Anda</h1>
        <div id="wrapper" class="bg">
                <div class="qs1">Gimana sih cara buat akun?</div>
                <div class="as1">
                    <ol class="ol">
                        <p>Gampang banget caranya! Coba ikutin langkah-langkah di bawah ini ya:</p>
                        <li>masukkan nama anda </li>
                        <li>masukkan alamat anda</li>
                        <li>masukkan no telepon anda</li>
                        <li>masukkan email anda. pastikan email yang aktif</li>
                        <li>masukkan username yang anda inginkan</li>
                        <li>masukkan password. buatlah seunik mungkin agar orang lain tidak bisa mengatahuinya</li>
                        <li>konfirmasi password anda</li>
                        <li>pastikan semuanaya terisi Ya!</li>
                        <li>selesai!</li>
                        <br>
                        <p>Butuh bantuan lebih lanjut?</p>   
                        <a style=" text-align: underlined;" href="https://api.whatsapp.com/send?phone=6285335490201&text=&source=&data=">chat kami</a> 
                    </ol>
                </div>
                <br>
                <div class="qs2">Kok saya gak bisa LogIn? kira-kira kenapa?</div>
                <div class="as2 ol">
                    <p>jangan stres dulu...</p>
                    <p>jadi gini... kemungkinan kamu gak bisa login karena kamu salah memasukkan username dan password.</p>
                    <p>kalo udah yakin username dan passwordmu benar tapi tetep gak bisa, hubungi kami aja ya via whatsapp</p>
                    <br>
                    <p>Butuh Bantuan lebih lanjut?</p> 
                    <a style=" text-align: underlined;" href="https://api.whatsapp.com/send?phone=6285335490201&text=&source=&data=">chat kami</a>

                </div>
                <br>
                <div class="qs3">Gimana sih cara beli bunga?</div>
                <div class="as3 ol">
                    <ol>
                        <li>Login. jika sudah punya akun maka langsung login</li>
                        <li>jika belum punya akun maka regestrasi dulu</li>
                        <li>masuk ke halaman semua produk yang berada di menu side bar</li>
                        <li>scroll kebawah untuk melihat semua produk</li>
                        <li>klik produk bunga yang ada inginkan maka akan langsung masuk ke halaman transaksi </li>
                        <li>silakan masukkan jumlah bunga yang anda inginkan</li>
                        <li>selesai</li>
                        <br>
                        <p>Butuh bantuan lebih lanjut?</p>
                        <a style=" text-align: underlined;" href="https://api.whatsapp.com/send?phone=6285335490201&text=&source=&data=">chat kami</a>
                    </ol>
                </div>
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