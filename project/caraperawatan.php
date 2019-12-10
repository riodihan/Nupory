<?php
session_start();
?>
 <?php include "assets/includes/config.php" ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cara Perawartan</title>
    <link rel="stylesheet" href="css/stylecaraperawatan.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
    body{
        background-image: url('img/Nursery.jpg');
        background-color: ; 
    }
    </style>
    
    <link rel="stylesheet" href="video-js.css">
    <script src="video-js"></script>
    <link rel="stylesheet" href="style.css">

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

    <section >
        <a href="caraperawatan.php"></a>
        <!-- <figure id="video_player">
            <video controls width="700px">
                <source src="video/video1.mp4" type="video/mp4">
                <source src="video1.webm" type="video/webm">
                
            </video>
            <figcaption>
                <ul>
                    <li> <a href="video1.mp4">Play Video 1</a></li>
                    <li> <a href="video2.mp4">Play Video 2</a></li>
                </ul>
            </figcaption>
            
        </figure> -->
        
        <!-- <table>
        
            <td> 
                <li class="ul">Cara perawatan bunga Krisan
                    <video width="350px" controls>
                        <source src="video/ig39.mp4" type="video/mp4">
                    </video>
                    <ol>
                        <li>
                        Mendapatkan sinar matahari cukup
                        </li>
                        <li>
                        Jauhkan dari cahaya lampu pada malam hari
                        </li>
                        <li>
                        Disiram dua kali sekali
                        </li>
                        <li>
                        Bunga di potong setelah layu
                        </li>
                    </ol>
                </li>
            </td>
            <td> 
                <li class="ul">Cara perawatan bunga Anggrek Bulan 
                    <video width="350px" controls>
                        <source src="video/ig33.mp4" type="video/mp4">
                    </video>
                    <ol>
                        <li>
                        Mendapatkan sinar matahari cukup
                        </li>
                        <li>
                        Jauhkan dari cahaya lampu pada malam hari
                        </li>
                        <li>
                        Disiram dua kali sekali
                        </li>
                        <li>
                        Bunga di potong setelah layu
                        </li>
                    </ol>
                </li>
            </td>
        
        </table> -->


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

<?php
$sql = "select id_bunga, video_bunga from bunga";
$res =mysqli_query($koneksi,$sql);

echo "myvideo <br> <br>"; 

while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id_bunga'];
    $video = $row['video_bunga'];


    echo  " <a href='play.php?id=$id'>.$video.</a> ";

 ?>
  <?php } ?>