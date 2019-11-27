<?php
session_start();
require 'assets/includes/config.php';


if(isset($_POST["tambah"])) {

    if(tambahkaryawan($_POST) == 1){
        echo "<script>alert('karyawan berhasil ditambahkan'); </script>";
        // header("location: login.php");
    }else{
        echo mysqli_error($koneksi);
    }
}


//cek admin atau bukan
if($_SESSION["id_status"] !== '01'){
    header("location: index.php");
    exit;
}

//iduser otomatis
$carikode = mysqli_query($koneksi, "select max(ID_USER)from user") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 1 );
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "U" .str_pad($kode, 3, "0", STR_PAD_LEFT);
}else{
    $hasilkode = "U001";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="css/styletambahadmin.css">
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
    <h1 class="h1">Nursery<br>Polije
        
        <?php
        if(!isset($_SESSION["login"])) {?>
            <button><a href="login.php">Login</a></button>
        <?php }?>

        <?php  
        if (isset($_SESSION["login"])) {?> 
            <button class="button"><a href="logout.php">Logout</a></button>
        <?php }?>
    </h1>
    </header>
    <section>
<div >
<form  class="bungkus" action="" method="POST">
<ul class="apa">
    <li>
        <input class="edit" type="hidden" name="id_user" id="id_user" value="<?php echo $hasilkode ?>">
    </li>
    <li>
        <input class="edit" type="hidden" name="id_status" id="id_status" value="02">
    </li>
    <li>
        <label class="label" for="nama_user">Nama Karyawan</label><br>
        <input class="edit" type="text" name="nama_user" id="nama_user" required>
    </li>
    <li>
        <label class="label" for="alamat">Alamat</label><br>
        <input class="edit" type="text" name="alamat" id="alamat" required>
    </li>
    <li>
        <label class="label" for="no_telepon">No Telepon</label><br>
        <input class="edit" type="number" name="no_telepon"  id="no_telepon" required  >
    </li>
    <li>
        <label class="label" for="email">Email</label><br>
        <input class="edit" type="text" name="email" id="email" required>
    </li>
    <li>
        <label class="label" for="username">Username</label><br>
        <input class="edit" type="text" name="username" id="username" required>
    </li>
    <li>
        <label class="label" for="password">Password</label><br>
        <input class="edit" type="password" name="password" id="password" required>
    </li>
    <li>
        <label class="label" for="konfirmasipassword">Konfirmasi password</label><br>
        <input class="edit" type="konfirmasipassword" name="konfirmasipassword" id="konfirmasipassword" required>
    </li>
    <li>
        <label class="label" for="foto">Foto</label><br>
        <input class="edit" type="file" name="foto" id="foto">
    </li>
</ul>
<br>
    <button name="tambah" class="tomboltambah">Submit</button>
    <button class="tomboltambah"> <a href="datauser.php">Kembali</a></button>
</form>
</div>

      
    </section>


    <footer>
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