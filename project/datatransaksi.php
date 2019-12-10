<?php
session_start();
require 'assets/includes/config.php';

$datatransaksi = query("SELECT transaksi.*, detail_transaksi.ID_BUNGA FROM transaksi right join detail_transaksi on transaksi.ID_TRANSAKSI=detail_transaksi.ID_TRANSAKSI group by transaksi.ID_TRANSAKSI ");

//cek admin atau bukan
if($_SESSION["id_status"] == '03'){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="css/styledatatransaksi.css">
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
                <li><a href="transaksi.php">Transaksi Saya</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
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
                
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
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
    <table class="bungkus" border="1" cellpadding="10" cellspacing="0">

       
        <tr >
            <th>NO</th>
            <th>ID Transaksi</th>
            <th>ID Pembayaran</th>
            <th>ID BUNGA</th>
            <th>ID User</th>
            <th>Tanggal Transaksi</th>
            <th>Alamat</th>
            <th>Total Pembayaran</th>
            <th>Bukti Pembayaran</th>
            <th>Aksi</th>
        </tr>
            <?php $i=1?>
            <?php foreach($datatransaksi as $row) {?>
        <tr >
            <td><?= $i?></td>
            <td><?= $row["ID_TRANSAKSI"];?></td>
            <td><?= $row["ID_PEMBAYARAN"];?></td>
            <td><?= $row["ID_BUNGA"];?></td>
            <td><?= $row["ID_USER"];?></td>
            <td><?= $row["TGL_TRANSAKSI"];?></td>
            <td><?= $row["DETAIL_ALAMAT"];?></td>
            <td><?= $row["TOTAL_AKHIR"];?></td>
            <td><?= $row["FOTO_VERIFIKASI"];?></td>
            <td><a href = "hapustransaksi.php?id=<?= $row["ID_TRANSAKSI"]; ?>" id="autoKlik" ><img src="img/x.png" alt="" width="20" height="20"></a></a></td>

        </tr>
       
            <?php $i++;?>
            <?php }?>
            
    </table>
    </section>

    <footer>
        <p class="footer">&copy; Powered 2019 by Nupory Team</p>
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

    

    // var url = "hapustransaksi.php"; // url tujuan
    // var count = 100; // dalam detik
    //         function countDown("autoKlik") {
    //             if (count > 0) {
    //                 count--;
    //                 var waktu = count + 1;
    //                 $('#pesan').html('Pesanan ini akan' + url + ' dalam ' + waktu + ' detik.');
    //                 button.click();
    //                 setTimeout("countDown()", 100);
    //             } else {
    //                 // window.location.href = url;
    //             }
    //         }
    //         countDown();

    
    // var button = document.getElementById("autoKlik");
    // setInterval(function(){ 
    //     button.click();
    //  }, 10000);

    </script>
</body>
</html>