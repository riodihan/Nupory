<?php
session_start();
require 'assets/includes/config.php';

if(!isset($_SESSION["login"])){
        header("location: login.php");
        exit;
    }

//auto increment kd kritik  
$carikode = mysqli_query($koneksi, "select max(KD_KRITIK)from kritik") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 1 );
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "K" .str_pad($kode, 3, "0", STR_PAD_LEFT);
}else{
    $hasilkode = "K001";
}

if(isset ($_POST["kirim"])){
    if(kritik($_POST) == 1){
        echo "<script>alert('Terimakasih atas kritik dan masukannya. Semoga bisa membantu kami kedepannya.'); window.location.href='kritikdansaran.php'</script>";
    }
    else{
        echo mysqli_error($koneksi);
    }
}

$iduser = $_SESSION["id_user"];

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
        <?php 
                $user = @$_SESSION['id_status'] == '03';
                $karyawan = @$_SESSION['id_status'] =='02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));
                if($user){
            ?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="transaksisaya.php">Transaksi Saya</a></li>
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
        <button class="button"><a href="logout.php">Logout</a></button>
    </h1>
    </header>
    <section>
        <h2>Kritik Dan Saran</h2><br><br>
        
        <div class="background">
            
            <div class="tulisan">
            <br>
            <p style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ">Bagaimana Pelayanan Service Kami?</p>
               
            <p style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ">Bagaimana Hasil Produk Pemesanan Kami?</p>
                
            <p style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ">Bagaimana Ketepatan Waktu Pengiriman?</p>
            
            <p style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ">Apakah Anda Akan Membeli Bunga Kepada kami Lagi?</p>
                <br>
            </div>
        </div>
        <form action="" method="POST">
            <input type="hidden" name="id_user" value="<?php echo $iduser?>">
            <input type="hidden" name="kd_kritik" value="<?php echo $hasilkode?>">
            <div class="kritikdansaran">
                <h4>Kritik Dan Saran</h4><br>
                <div>
                    <textarea name="kritik" rows="10" placeholder="Tulis Kritik atau Saran Anda disini" required></textarea>
                </div>
                <button name="kirim">Kirim</button>
               <h4>Terima kasih atas masukan anda,<br>sangat berguna bagi perkembangan kami.</h4>
            </div>
        </form>
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

