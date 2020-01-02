<?php
session_start();
require 'assets/includes/config.php';

//cek session
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

//ambil data
$id = $_SESSION["id_user"];

// Menampilkan data user
$profil = profil("SELECT * FROM user WHERE ID_USER = '$id'");

// ubah password
if (isset($_POST["ubah"])) {
    if (ubahpassword($_POST) == 1) {
        echo "<script>alert('password berhasil diubah'); window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('password Gagal diubah');  window.location.href='ubahpassword.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="css/styleprofile.css">
    <link rel="stylesheet" href="css/stylelogin.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
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
    <section class="posisi">
        <!-- <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="passwordlama">Password lama</label><br>
            <input type="text" name="passwordlama" required><br>

            <label for="passwordlama">Password baru</label><br>
            <input type="text" name="passwordbaru" required><br>

            <label for="passwordlama">Konfirmasi Password baru</label><br>
            <input type="text" name="passwordbaru1" required><br><br>

            <button type="submit" name="ubah">Ubah Password</button>
        </form> -->
        <?php foreach ($profil as $row5) { ?>
        <form class="kotaklogin" style="margin-right: -200px; " method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="passwordlama1" value="<?= $row5["PASSWORD"];?>">
            <!-- <p class="tulisankotak">Password Lama</p> -->
            <label for="passwordlama">Password Lama</label>
            <input type="text" name="passwordlama" class="kotaktext" id="passwordlama" placeholder="Password Lama" required>
            <!-- <p class="tulisankotak">Password Baru</p> -->
            <label for="passwordbaru">Password Baru</label>
            <input type="password" name="passwordbaru" class="kotaktext" value="" id="Passwordbaru" placeholder="Password Baru" required>
            <!-- <p class="tulisankotak">Konfirmasi</p> -->
            <label for="passwordbaru1">Konfirmasi Password</label>
            <input type="password" name="passwordbaru1" class="kotaktext" value="" id="Passwordbaru1" placeholder="Konfirmasi" required><br>
            <br><button type="submit" name="ubah">Ubah</button>
        <?php }?>
        </form>
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

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }
    </script>
</body>

</html>