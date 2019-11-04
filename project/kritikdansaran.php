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
    <link rel="stylesheet" href="css/stylekritik.css">
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
            <li><a href="#">Semua Produk</a></li>
            <li><a href="#">Cara Perawatan</a></li>
            <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
            <li><a href="#">Temukan Kamu</a></li>
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
        <h2>Kritik Dan Saran</h2><br><br>
        <div class="background">
            
            <div class="tulisan">
            <p>Bagaimana Pelayanan Service Kami?</p>
               <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
                <br>
            <p>Bagaimana Hasil Produk Pemesanan Kami?</p>
                
            <p>Bagaimana Ketepatan Waktu Pengiriman?</p>
            
            <p>Apakah Anda Akan Membeli Bunga Kepada kami Lagi?</p>
            
            </div>
        </div>
        <div class="kritikdansaran">
            <h4>Kritik Dan Saran</h4><br>
            <div>
                <textarea name="komentar" rows="10" placeholder="   Tulis Kritik atau Saran Anda disini   "></textarea>
            </div>
            <button class="tombolkirim"><a href="#" class="warnakirim">Kirim</a></button>
            <h4>Terima kasih atas masukan anda,<br>sangat berguna bagi perkembangan kami.</h4>
        </div>
        <input type="image" src="img/WA.png" height="50px" width="50px">
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

