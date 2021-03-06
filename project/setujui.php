<?php
session_start();
require 'assets/includes/config.php';


// Ambil data di url
$id = $_GET["id"];

// query data bunga berdasar id
$pemesanan = query("SELECT * FROM keranjang WHERE ID_TRANSAKSI = '$id'")[0];


//setujui pemesanan

if (isset($_POST["setujui"])) {
    if (setujuipesanan($_POST) == 1) {
        echo "<script>alert('Pemesanan telah disetujui')</script>";
    } else {
        echo "<script>alert('Pemesanan telah disetujui')</script>";
    }
}

//setujui masuk ke detail transaksi

if (isset($_POST["setujui"])) {
    if (detail($_POST) == 1) {
        // echo "<script>alert('Pemesanan telah disetujui')</script>";
    } else {
        // echo "<script>alert('Pemesanan gagal disetujui')</script>";
        // echo mysqli_error($koneksi);
    }
}


//cek karyawan atau bukan
if ($_SESSION["id_status"] !== '02') {
    header("location: index.php");
    exit;
}

//cek ada id pemesanan atau tidak
if(!isset($id)){
    header("location: pemesanan.php");
    exit;
}


//cek ada parameter atau tidak
if($_GET["id"]==''){
header("location: pemesanan.php");
exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Setujui Pesanan</title>
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
    <script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".perbesar").fancybox();
        });
    </script>
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
                    <li><a href="transaksi.php">Transaksi Saya</a></li>
                    <li><a href="caraperawatan.php">Cara Perawatan</a></li>
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
                <input type="hidden" name="idtransaksi" id="idtransaksi" value="<?= $pemesanan["ID_TRANSAKSI"]; ?>">
                <ul class="ini">
                    <li>
                        <!-- <label class="label" for="nama_bunga">ID Pembayaran</label><br> -->
                        <input class="ubah" type="text" name="idpembayaran" id="idpembayaran" required value="<?= $pemesanan["ID_PEMBAYARAN"]; ?>">
                    </li>
                    <li>
                        <!-- <label class="label" for="harga">ID user</label><br> -->
                        <input class="ubah" type="hidden" name="iduser" id="iduser" value="<?= $pemesanan["ID_USER"]; ?>" required>
                    </li>
                    <li>
                        <!-- <label class="label" for="stok">ID_bunga</label><br> -->
                        <input class="ubah" type="hidden" name="idbunga" id="" value="<?= $pemesanan["ID_BUNGA"]; ?>" required>
                    </li>
                    <li>
                        <label class="label" for="gambar">jumlah beli</label><br>
                        <input class="ubah" type="text" name="jumlah" id="jumlah" value="<?= $pemesanan["JUMLAH"]; ?>" readonly>
                    </li>
                    <li>
                        <label class="label" for="video">Tanggal transaksi</label><br>
                        <input class="ubah" type="text" name="tanggal" id="tanggal" value="<?= $pemesanan["TGL_TRANSAKSI"]; ?>" readonly>
                    </li>
                    <li>
                        <label class="label" for="perawatan">Alamat</label><br>
                        <input class="ubah" type="text" name="alamat" id="alamat" value="<?= $pemesanan["DETAIL_ALAMAT"]; ?>" readonly>
                    </li>
                    <li>
                        <label class="label" for="total">total</label><br>
                        <input class="ubah" type="text" name="total" id="total" value="<?= $pemesanan["TOTAL_AKHIR"]; ?>" readonly>
                    </li>
                    <li>
                        <!-- <label class="label" for="Bukti">Bukti Pembayaran</label><br>
            <input class="ubah" type="file" name="Bukti" id="Bukti"> -->
                        <label for="bukti">Bukti Pembayaran</label><br>
                        <a href="bukti/<?php echo $pemesanan["BUKTI_PEMBAYARAN"]; ?>" class="perbesar">
                            <img id="bukti" src="bukti/<?php echo $pemesanan["BUKTI_PEMBAYARAN"]; ?>" width="100px">
                        </a>

                    </li>
                    <li>
                        <label for="status">Status Pemesanan</label><br>
                        <select style="color: black;" name="status" id="status">
                            <option style="color: black;" value="Lunas">Lunas</option>
                            <option style="color: black;" value="Belum Lunas">Belum Lunas</option>
                        </select>
                    </li>
                </ul>
                <br>
                <button type="submit" name="setujui" class="tomboltambah">Setujui</button>
                <a href="hapuspemesanan.php?id=<?= $pemesanan["ID_TRANSAKSI"]; ?>">Hapus pesanan</a>
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