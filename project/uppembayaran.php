<?php
session_start();
require 'assets/includes/config.php';


// Ambil data di url
$id = $_GET["id"];

//id user dari session
$iduser = $_SESSION["id_user"];

//ambil nama pembeli
$nama = $_SESSION["USERNAME"];

// query data bunga berdasar id
$keranjang = query("SELECT * FROM keranjang
                        -- inner join user on keranjang.ID_USER = user.ID_USER
                     WHERE ID_TRANSAKSI = '$id' && ID_USER = '$iduser'")[0];

if (mysqli_info($koneksi) == 1) {
    header("location: transaksisaya.php");
    exit;
}



if (isset($_POST["upload"])) {

    if (uploadpembayaran($_POST) == 1) {
        echo "<script>alert('Bukti Pembayaran Berhasil Diupload, Mohon menunggu proses Konfirmasi'); window.location.href='transaksisaya.php'</script>";
    } else {
        // echo "<script>alert('Bukti Pembayaran Gagal Diupload'); window.location.href='editbunga.php'</script>";
        echo mysqli_error($koneksi);
    }
}

//cek ada id transaksi atau tidak
if (!isset($id)) {
    header("location: transaksisaya.php");
    exit;
}

//cek ada parameter atau tidak
if($_GET["id"]==''){
    header("location: transaksisaya.php");
    exit;
    }

//cek user atau bukan
if ($_SESSION["id_status"] !== '03') {
    header("location: index.php");
    exit;
}

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
        body {
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

                    <li><a href="datatransaksi.php">Data Transaksi</a></li>
                    <li><a href="databunga.php">Data Bunga</a></li>
                <?php }
                if ($guest) { ?>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                    <li><a href="temukankami.php">Temukan Kami</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                <?php } ?>
            </ul>

        </div>
        <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
        </div>
        <h1 class="h1">Nursery<br>Polije</h1>

        <?php
        if (!isset($_SESSION["login"])) { ?>
            <a class="login" href="login.php">Login</a>
        <?php } ?>

        <?php
        if (isset($_SESSION["login"])) { ?>
            <nav class="dropdown">
                <ul> <?php echo $_SESSION["USERNAME"]; ?>
                    <li><a href="Profile.php">Profil</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>

        <?php } ?>
    </header>
    <section>
        <div class="bunga">
            <form class="tabel" action="" method="POST">
                <?php if ($keranjang["ID_PEMBAYARAN"] == '02') { ?>
                    <label class="label" for="idtransaksi">ID PEMESANAN</label>
                    <input class="ubah" type="text" name="idtransaksi" id="idtransaksi" value="<?= $keranjang["ID_TRANSAKSI"]; ?>">
                <?php } ?>
                <ul class="ini">
                    <li>
                        <!-- <label class="label" for="nama_bunga">ID Pembayaran</label><br> -->
                        <input class="ubah" type="hidden" name="idpembayaran" id="idpembayaran" required value="<?= $keranjang["ID_PEMBAYARAN"]; ?>">
                    </li>
                    <li>
                        <?php if ($keranjang["ID_PEMBAYARAN"] == '02') { ?>
                            <label class="label" for="harga">Nama Pemesan</label><br>
                            <input class="ubah" type="text" name="iduser" id="iduser" value="<?= $nama ?>" readonly>
                        <?php } ?>
                        <input class="ubah" type="hidden" name="iduser" id="iduser" value="<?= $keranjang["ID_USER"]; ?>" required>
                    </li>
                    <li>
                        <!-- <label class="label" for="stok">ID_bunga</label><br> -->
                        <input class="ubah" type="hidden" name="idbunga" id="stok" value="<?= $keranjang["ID_BUNGA"]; ?>" required>
                    </li>
                    <li>
                        <label class="label" for="gambar">jumlah beli</label><br>
                        <input class="ubah" type="text" name="jumlah" id="jumlah" value="<?= $keranjang["JUMLAH"]; ?>" readonly>
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
                    <?php if ($keranjang["ID_PEMBAYARAN"] == '02') { ?>
                        <label class="label" for="">Note</label>
                        <p style="color: red;">Tunjukan halaman ini kepada karyawan saat melakukan transaksi di tempat</p>
                    <?php } ?>
                    <li>
                        <?php if ($keranjang["ID_PEMBAYARAN"] == '01') { ?>
                            <label class="label" for="total">Nomor Rekening</label><br>
                            <input style="background-color: transparent; color: rgb(228, 114, 114); border-color:transparent;" class="ubah" type="text" name="total" id="total" value="20108027799 AN idris" readonly>
                        <?php } ?>
                    </li>
                    <li>
                        <?php if ($keranjang["ID_PEMBAYARAN"] == '01') { ?>
                            <label class="label" for="Bukti">Bukti Pembayaran</label><br>
                            <input class="ubah" type="file" name="Bukti" id="Bukti">
                        <?php } ?>
                    </li>
                </ul>
                <br>
                <?php if ($keranjang["ID_PEMBAYARAN"] == '01') { ?>
                    <button type="submit" name="upload" class="tomboltambah">Upload</button>
                <?php } ?>
                <button class="tomboltambah"> <a href="transaksisaya.php">Kembali</a></button>
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
            document.getElementById("menu").style.marginLeft = "0";
        }
    </script>
</body>

</html>