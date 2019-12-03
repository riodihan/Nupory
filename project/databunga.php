<?php
session_start();
require 'assets/includes/config.php';

//menampilkan tabel
$bunga = query1("SELECT * FROM bunga");

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
    <title>Data Bunga</title>
    <link rel="stylesheet" href="css/styledatabunga.css">
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
    <a href="tambahbunga.php">Tambah Bunga</a><br><br>
    

    <table class="tabel" border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>NO</th>
            <th>ID Bunga</th>
            <th>Nama Bunga</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <!-- <th>Video</th>
            <th>Cara Perawatan</th> -->
            <th>Aksi</th>
        </tr>

        <?php $i = 1?>
        
        <?php 
        foreach($bunga as $row1){?>
        <tr>
            <td><?= $i?></td>
            <td class="item" ><?= $row1["ID_BUNGA"]; ?></td>
            <td class="item" ><?= $row1["NAMA_BUNGA"]; ?></td>
            <td class="item" ><?= $row1["HARGA"]; ?></td>
            <td class="item" ><?= $row1["STOK"]; ?></td>
            <td><img src="img/<?= $row1["FOTO_BUNGA"];?>" width="80"></td>
            <!-- <td><video width="350px" controls>
                        <source src="video/<?=$row1["VIDEO_BUNGA"];?>" type="video/mp4">
                    </video></td>
            <td><?= $row1["CARA_PERAWATAN"];?></td> -->
            <td  >
                <a href="hapusbunga.php?id=<?= $row1["ID_BUNGA"]; ?>" onclick = "return confirm('Apakah Anda Yakin ingin Mengahapus Data Ini?');"><img src="img/x.png" alt="hapus" width="20" height="20"></a>
                <a href="editbunga.php?id=<?= $row1["ID_BUNGA"]; ?>"><img src="img/edit.png" alt="edit" width="20" height="20"></a>
            </td>
        </tr>

        <?php $i++; ?>
        <?php }?>
    </table>


        <a style="display:scroll;position:fixed;bottom:0;right:0;" href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data=" target="_blank"><input type="image" src="img/WA.png" width="50px" height="50px"></a>
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