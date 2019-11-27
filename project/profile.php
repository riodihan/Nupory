<?php
session_start();
require 'assets/includes/config.php';

$id = $_SESSION["id_user"];

// Menampilkan data user
$profil = profil("SELECT * FROM user WHERE ID_USER = '$id'");

// upload foto
if(isset($_POST["upload"])){
    if(upload1($_POST) == 1){
        echo "<script>alert('Upload Sukses.'); window.location.href='profile.php'</script>";
    }
    else{
        //  echo "<script>alert('Upload Gagal.');  window.location.href='profile.php'</script>";
        mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="css/styleprofile.css">
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
                
                <li><a href="datauser.php">Data User</a></li>
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
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
        <!-- Up Foto -->
        <form action="" method="POST">
        <tr>
            <td>Upload Foto</td>
            <td><input class="upfoto" type="file" name="foto_user"></td>
        </tr>
        
        <button type="submit" class="tombol" name="upload"> Upload</button>
        </form>
        <?php
        foreach($profil as $row5) 
        
        {?>
        <table>
            <tr>
                <td>Nama</td>
                <td><?= $row5["NAMA_USER"]; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $row5["ALAMAT"]; ?></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td><?= $row5["NO_TELEPON"]; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $row5["EMAIL"]; ?></td>
            </tr>
        </table>
        <?php }?>


        <a style="display:scroll;position:fixed;bottom:0;right:0;" href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data=" target="_blank"><input type="image" src="img/WA.png" width="50px" height="50px"></a>
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
    </script>
</body>
</html>