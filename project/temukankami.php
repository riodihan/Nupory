<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temukan Kami</title>
    <link rel="stylesheet" href="css/styleberanda.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
    body{
        background-image: url('img/Nursery.jpg');
        background: 
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.2145447082958!2d113.68843621415776!3d-8.079588883005215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6ebacada7576b%3A0x6c0a7d5c0bad1a23!2sKebun%20Pengembangan%20holtikultura!5e0!3m2!1sid!2sid!4v1573313599587!5m2!1sid!2sid" width="1200" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            <!-- <script src="http://maps.googleapis.com/maps/api/js"></script> -->
        
            <script>
                // fungsi initialize untuk mempersiapkan peta
                function initialize() {
                var propertiPeta = {
                    center:new google.maps.LatLng(-8.5830695,116.3202515),
                    zoom:9,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                };
                
                var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
                }
        
                // event jendela di-load  
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            <!-- Elemen yang akan menjadi kontainer peta -->
            <div id="googleMap" style="width:100%;"></div>
          
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
