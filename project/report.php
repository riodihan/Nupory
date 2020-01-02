<?php
session_start();
require 'assets/includes/config.php';


$transaksi = report("SELECT * FROM transaksi 
                    inner join detail_transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
                    inner join user on transaksi.id_user = user.id_user
                    inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                    
                    
                    
                    
                    ");


if(isset($_POST["cari"])){
    $transaksi = tanggal($_POST["keyword"]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    <title>Laporan Penjualan</title>
    <!-- <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1"> -->
    <link rel="stylesheet" href="css/stylereport.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('img/Nursery.jpg');
        }

        @media print{
            .nama, .h1, .huhu, .hi, .idt, .hapus{ 
                display: none;
            }
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
                $karyawan = @$_SESSION['id_status'] == '02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));

                if ($user) {
                ?>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="transaksisaya.php">Pemesanan Saya</a></li>
                    <li><a href="transaksi.php">Transaksi Saya</a></li>
                    <li><a href="cara.php">Cara Perawatan</a></li>
                    <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                    <li><a href="temukankami.php">Temukan Kami</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                <?php }
                if ($admin) { ?>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="datauser.php">Data User</a></li>
                    <li><a href="datatransaksi.php">Data Transaksi</a></li>
                    <li><a href="databunga.php">Data Bunga</a></li>
                    <li><a href="kritikuser.php">Kritik User</a></li>
                    <li><a href="report.php">Report</a></li>
                <?php }
                if ($karyawan) { ?>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="datatransaksi.php">Data Transaksi</a></li>
                    <li><a href="databunga.php">Data Bunga</a></li>
                    <li><a href="pemesanan.php">Pemesanan</a></li>
                <?php }
                if ($guest) { ?>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="cara.php">Cara Perawatan</a></li>
                    <li><a href="temukankami.php">Temukan Kami</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                <?php } ?>
            </ul>

        </div>
        <div id="menu">
            <span class="hi" style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
        </div>
        <div class="container">

            <h1 class="h1">Nursery<br>Polije </h1>

            <?php
            if (!isset($_SESSION["login"])) { ?>
                <a class="login" href="login.php">Login</a>
            <?php } ?>

            <?php
            if (isset($_SESSION["login"])) { ?>
                <nav class="dropdown">
                    <ul class="nama"> <?php echo $_SESSION["USERNAME"]; ?>
                        <li><a href="Profile.php">Profil</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            <?php } ?>

    </header>
    <section>
        <form action="" method="POST">
                <input class="huhu" name="keyword" type="text" autofocus autocomplete="off" placeholder="Masukan bulan Transaksi">
                <button class="huhu" name="cari" type="submit">Cari</button>
        </form><br>
        <table class="tabel" border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>NO</th>
                <th class="idt">ID Transaksi</th>
                <th>Pembeli</th>
                <th>Alamat Pembeli</th>
                <th>Tanggal Transaksi</th>
                <th>Bunga</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th class="hapus">Hapus</th>
            </tr>

            <?php $i = 1 ?>
                <?php
		foreach ($transaksi as $row5) {?>
                <tr>
                    <td><?= $i ?></td>
                    <td class="item idt"><?= $row5["ID_TRANSAKSI"]; ?></td>
                    <td class="item"><?= $row5['NAMA_USER'];?></td>
                    <td class="item"><?= $row5['DETAIL_ALAMAT'];?></td>
                    <td class="item"><?= $row5['TGL_TRANSAKSI'];?></td>
                    <td class="item"><?= $row5['NAMA_BUNGA'];?></td>
                    <td class="item"><?= $row5['HARGA'];?></td>
                    <td id="jumlah" class="item"><?= $row5['JUMLAH'];?></td>
                    <td id="total" class="item"><?= $row5['TOTAL_AKHIR'];?></td>
                    <td class="hapus">
                        <a href="hapusbunga.php?id=<?= $row1["ID_BUNGA"]; ?>" onclick="return confirm('Apakah Anda Yakin ingin Mengahapus Data Ini?');"><img src="img/x.png" alt="hapus" width="20" height="20"></a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php } ?>
            <tfoot>
                    <tr>
                        <td>
                            Jumlah
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
        </table>
    </section>

    <footer>
        <!-- <p class="footer">&copy; Powered 2019 by Nupory Team</p> -->
    </footer>

    <script>
        function show() {
            document.getElementById("hidesidebar").style.width = "240px";
            document.getElementById("menu").style.marginLeft = "0%";
        }

        function hide() {
            document.getElementById("hidesidebar").style.width = "0";
            document.getElementById("menu").style.marginLeft = "0";
        }
    </script>
</body>

</html>