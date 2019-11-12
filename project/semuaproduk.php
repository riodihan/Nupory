<?php
session_start();
mysqli_connect("localhost", "root", "", "nupory");

if(!isset($_SESSION["login"])){
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylesemuaproduk.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <button class="button"><a href="logout.php">Logout</a></button>
    </h1>
    </header>
    <section>
        <h2>Krisan Putih</h2><br><br>
        <div class="background">
            
        
    <!--bagian gambar-->
        
        
    <div class="slidershow middle">

      <div class="slides">
        <input type="radio" name="r" id="r1" checked>
        <input type="radio" name="r" id="r2">
        <input type="radio" name="r" id="r3">
        <input type="radio" name="r" id="r4">
        <input type="radio" name="r" id="r5">
        <div class="slide s1">
          <img src="img/1.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/2.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/3.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/4.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/5.jpg" alt="">
        </div>
      </div>

      <div class="navigation">
        <label for="r1" class="bar"></label>
        <label for="r2" class="bar"></label>
        <label for="r3" class="bar"></label>
        <label for="r4" class="bar"></label>
        <label for="r5" class="bar"></label>
      </div>
    </div>
    
    <!--bagian tulisan-->

    <h3>Bunga Krisan Putih</h3>
    <p class="p">Harga : Rp. 1500 ~ 2000<br>
    Beli 
        <input type="radio" name="Tangkai" id="Tangkai">Tangkai <input type="radio" name="Ikat" id="Ikat">Ikat
        <br>
    Jumlah beli
        <input type="text" name="jumlahbeli" id="">
        <br>
    Subtotol
        <input type="text" name="subtotal" id="">
        <br>
    Alamat Pengiriman
        <input type="text" name="alamatpengiriman" id="">
        <br>
    <button>Beli</button>
    </p>

    


    


    </div>



        <input class="input" type="image" src="img/WA.png" height="50px" width="50px">
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

