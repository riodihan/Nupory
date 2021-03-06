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

// ubah Profile
if (isset($_POST["submit"])) {
    if (ubahprofile($_POST) == 1) {
        echo "<script>alert('Profile berhasil diubah'); window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('Profile Gagal diubah');  window.location.href='profile.php'</script>";
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
        <!-- Up Foto -->
        <div class="tabel">
            <form action="" method="POST">

                <?php
                foreach ($profil as $row5) { ?>

                    <table class="">
                        <input type="hidden" name="id" id="" value="<?= $row5["ID_USER"]; ?>">
                        <!-- <tr>
                <td><input class="" type="file" name="foto" value="hallo"></td>
            </tr> -->
                        <tr>
                            <td class=""><label for="nama">NAMA</label></td>
                            <td class=""><input class="inputan" type="text" name="nama" id="nama" value="<?= $row5["NAMA_USER"]; ?>"></td>
                        </tr>
                        <tr>
                            <td class=""><label for="alamat">ALAMAT</label></td>
                            <td class=""><input class="inputan" type="text" name="alamat" id="alamat" value="<?= $row5["ALAMAT"]; ?>"></td>
                        </tr>
                        <tr>
                            <td class=""><label for="NO_TELEPON">NO TELEPON</label></td>
                            <td class=""><input class="inputan" type="text" onkeypress="return hanyaAngka(event)" maxlength="13" name="NO_TELEPON" id="NO_TELEPON" value="<?= $row5["NO_TELEPON"]; ?>"></td>
                        </tr>
                        <tr>
                            <td class=""><label for="EMAIL">EMAIL</label></td>
                            <td class=""><input class="inputan" type="text" name="EMAIL" id="EMAIL" value="<?= $row5["EMAIL"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><br><button class="tombol" type="submit" name="submit">Ubah Profile</button></td>
                        </tr>
                    </table>

                <?php } ?>
            </form>
            <a href="ubahpassword.php"><button class="tombol">Ubah Password</button></a>
        </div>
        <!-- <a style="display:scroll;position:fixed;bottom:0;right:0;" href="https://api.whatsapp.com/send?phone=6281359652164&text=&source=&data=" target="_blank"><input type="image" src="img/WA.png" width="50px" height="50px"></a> -->
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