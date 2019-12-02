<?php
session_start();
require 'assets/includes/config.php';


// Ambil data di url
$id = $_GET["id"];

// query data bunga berdasar id
$bunga = query("SELECT * FROM bunga WHERE ID_BUNGA = '$id'")[0];



if(isset($_POST["edit"])) {

    if(editbunga($_POST) == 1 ){
        echo "<script>alert('bunga berhasil diedit'); window.location.href='databunga.php'</script>";
         
    }else{
        echo "<script>alert('bunga gagal diedit'); window.location.href='editbunga.php'</script>";
    }
}


//cek admin atau bukan
if($_SESSION["id_status"] !== '01'){
    header("location: index.php");
    exit;
}

//id user otomatis
$carikode = mysqli_query($koneksi, "select max(ID_BUNGA)from bunga") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 1 );
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "B" .str_pad($kode, 3, "0", STR_PAD_LEFT);
}else{
    $hasilkode = "B001";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Bunga</title>
    <link rel="stylesheet" href="css/styleeditbunga.css">
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
<div class="bunga">
        <form class="tabel" action="" method="POST">
        <input  type="text" name="id_bunga" id="id_bunga" value="<?= $bunga["ID_BUNGA"]; ?>">
    <ul class="ini">
        <li>
            <label class="label" for="nama_bunga">Nama Bunga</label><br>
            <input class="ubah" type="text" name="nama_bunga" id="nama_bunga" required value="<?= $bunga["NAMA_BUNGA"]; ?>">
        </li>
        <li>
            <label class="label" for="harga">Harga</label><br>
            <input class="ubah" type="text" name="harga" id="harga" value="<?= $bunga["HARGA"]; ?>" required>
        </li>
        <li>
            <label class="label" for="stok">Stok</label><br>
            <input class="ubah" type="number" name="stok" id="stok" value="<?= $bunga["STOK"]; ?>" required>
        </li>
        <li>
            <label class="label" for="gambar" value="<?= $bunga["FOTO_BUNGA"]; ?>">Gambar bunga</label><br>
            <input class="ubah" type="file" name="gambar" id="gambar">
        </li>
        <li>
            <label class="label" for="video" value="<?= $bunga["VIDEO_BUNGA"]; ?>">Video Cara Perawatan</label><br>
            <input class="ubah" type="file" name="video" id="video">
        </li>
        <li>
            <label class="label" for="perawatan"value="<?= $bunga["CARA_PERAWATAN"]; ?>">Perawatan</label><br>
            <input class="ubah" type="text" name="perawatan" id="perawatan">
        </li>
    </ul>
    <br>
        <button type="submit" name="edit" class="tomboltambah">Submit</button>
        <button class="tomboltambah"> <a href="databunga.php">Kembali</a></button>
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