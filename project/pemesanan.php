<?php
session_start();
require 'assets/includes/config.php';

//menampilkan transaksi saya
$keranjang = query4("SELECT * FROM keranjang
                    -- inner join detail_transaksi on keranjang.id_transaksi = detail_transaksi.id_transaksi
                    inner join bunga on keranjang.id_bunga = bunga.id_bunga
                    inner join pembayaran on keranjang.id_pembayaran = pembayaran.id_pembayaran
                    inner join user on keranjang.id_user = user.id_user
                    ");

// //menyetujui pemesanan
if(isset($_POST["setujui"])){

    if(setujuipesanan($_POST) == 1){
        echo "<script>alert('Pemesanan berhasil di setujui'); window.location.href='transaksisaya.php'</script>";
    }else{
        echo mysqli_error($koneksi);
    }
  }

//cek karyawan atau bukan
if($_SESSION["id_status"] !== '02'){
    header("location: index.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan</title>
    <link rel="stylesheet" href="css/styletransaksisaya.css">
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
                <li><a href="transaksisaya.php">Transaksi Saya</a></li>
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
                <li><a href="index.php">Beranda</a></li>
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
                <li><a href="pemesanan.php">Pemesanan</a></li>
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
        
    <!-- <a href="tambahadmin.php"><button>Tambah Admin</button></a> -->

    <h2>Pemesanan</h2><br>
    <div >
    <form action="POST">
        <table class="tabel" border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>NO</th>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Pembayaran</th>
                <th>Nama Pembeli</th>
                <th>Nama Bunga</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
                
            </tr>

            <?php $i = 1?>
        
            <?php 
            foreach($keranjang as $row4)
        
            {?>
            <tr>
                <td><?= $i?></td>
                <td><?= $row4["ID_TRANSAKSI"]; ?></td>
                <td><?= $row4["TGL_TRANSAKSI"]; ?></td>
                <td><?= $row4["JENIS_PEMBAYARAN"]; ?></td>
                <td><?= $row4["NAMA_USER"]; ?></td>
                <td><?= $row4["NAMA_BUNGA"];?></td>
                <td><?= $row4["HARGA"];?></td>
                <td><?= $row4["JUMLAH"];?></td>
                <td><?= $row4["DETAIL_ALAMAT"]; ?></td>
                <td><?= $row4["TOTAL_AKHIR"]; ?></td>
                <td><img name="bukti" src="bukti/<?= $row4["BUKTI_PEMBAYARAN"];?>" width="40"></td>
                <!-- <td><a name="setujui" href="setujui.php?id=<?=$row4["ID_TRANSAKSI"];?>">Setujui</a></td> -->
                <td><a href="setujui.php?id=<?=$row4["ID_TRANSAKSI"];?>">Lihat</a></td>
                
            </tr>
    
            <?php $i++; ?>
            <?php }?>
        </table>
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