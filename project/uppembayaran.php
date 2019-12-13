<?php
session_start();
require 'assets/includes/config.php';


// Ambil data di url
$id = $_GET["id"];

// query data bunga berdasar id
$keranjang = query("SELECT * FROM keranjang WHERE ID_TRANSAKSI = '$id'")[0];



if(isset($_POST["upload"])) {

    if(uploadpembayaran($_POST) == 1 ){
        echo "<script>alert('Bukti Pembayaran Berhasil Diupload, Mohon menunggu proses Konfirmasi'); window.location.href='databunga.php'</script>";
         
    }else{
        // echo "<script>alert('Bukti Pembayaran Gagal Diupload'); window.location.href='editbunga.php'</script>";
        echo mysqli_error($koneksi);
    }
}

//cek ada id transaksi atau tidak
if(!isset($id)){
    header("location: transaksisaya.php");
    exit;
}

//cek user atau bukan
if($_SESSION["id_status"] !== '03'){
    header("location: index.php");
    exit;
}

//id user otomatis
// $carikode = mysqli_query($koneksi, "select max(ID_BUNGA)from bunga") or die (mysqli_error($koneksi));
// $datakode = mysqli_fetch_array($carikode);
// if($datakode) {
//     $nilaikode = substr($datakode[0], 1 );
//     $kode = (int) $nilaikode;
//     $kode = $kode + 1;
//     $hasilkode = "B" .str_pad($kode, 3, "0", STR_PAD_LEFT);
// }else{
//     $hasilkode = "B001";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload pembayaran</title>
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
                <li><a href="transaksisaya.php">Pemesanan Saya</a></li>
                <li><a href="transaksi.php">Transaksi Saya</a></li>
                <li><a href="cara.php">Cara Perawatan</a></li>
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
        <input  type="hidden" name="idtransaksi" id="idtransaksi" value="<?= $keranjang["ID_TRANSAKSI"]; ?>">
    <ul class="ini">
        <li>
            <!-- <label class="label" for="nama_bunga">ID Pembayaran</label><br> -->
            <input class="ubah" type="hidden" name="idpembayaran" id="idpembayaran" required value="<?= $keranjang["ID_PEMBAYARAN"]; ?>">
        </li>
        <li>
            <!-- <label class="label" for="harga">ID user</label><br> -->
            <input class="ubah" type="hidden" name="iduser" id="iduser" value="<?= $keranjang["ID_USER"]; ?>" required>
        </li>
        <li>
            <!-- <label class="label" for="stok">ID_bunga</label><br> -->
            <input class="ubah" type="hidden" name="idbunga" id="stok" value="<?= $keranjang["ID_BUNGA"]; ?>" required>
        </li>
        <li>
            <label class="label" for="gambar">jumlah beli</label><br>
            <input class="ubah" type="text" name="jumlah" id="jumlah" value="<?= $keranjang["JUMLAH"]; ?>"readonly>
        </li>
        <li>
            <label class="label" for="video">Tanggal transaksi</label><br>
            <input class="ubah" type="text" name="tanggal" id="tanggal" value="<?= $keranjang["TGL_TRANSAKSI"]; ?>" readonly> 
        </li>
        <li>
            <label class="label" for="perawatan">Alamat</label><br>
            <input class="ubah" type="text" name="alamat" id="alamat" value="<?= $keranjang["DETAIL_ALAMAT"]; ?>" readonly>
        </li>
        <li>
            <label class="label" for="total">total</label><br>
            <input class="ubah" type="text" name="total" id="total" value="<?= $keranjang["TOTAL_AKHIR"]; ?>" readonly>
        </li>
        <li>
            <label class="label" for="Bukti">Bukti Pembayaran</label><br>
            <input class="ubah" type="file" name="Bukti" id="Bukti">
        </li>
    </ul>
    <br>
        <button type="submit" name="upload" class="tomboltambah">Upload</button>
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