<?php
//$id_status = mysqli_query($koneksi, "SELECT * FROM status");
require 'assets/includes/config.php';

if(isset($_POST["daftar"])) {

    if(pendaftaran($_POST) == 1){
        echo "<script>alert('user berhasil terdaftar'); window.location.href='login.php'</script>";
        // header("location: login.php");
    }else{
        echo mysqli_error($koneksi);
    }
}


//auto increment id user   
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Akun</title>
    <link rel="stylesheet" href="css/styleregister.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
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
                
                <li><a href="#">Data Admin</a></li>
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
                <li><a href="#">Report</a></li>
            <?php }if($karyawan){?>
                
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
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
        </header>
        <section>
                <h2>Buat Akun</h2>

                <form method="POST" >
                    <div class="akun">

                   

                        <input type="hidden" name="id_user" maxlength="7" value="<?php echo $hasilkode ?>" readonly> 
                        <input type="hidden" name="id_status" maxlength="7" value="03" readonly>       
                        <label for="nama">Nama :</label>  
                            <input type="text" name="nama" maxlength="30" placeholder="Nama lengkap" required>
                        <label for="alamt">Alamat :</label>
                            <input type="text" name="alamat" maxlength="30" placeholder="Alamat" required>
                        <label for="nohp">No HP :</label>
                            <input type="number" name="nohp" maxlength="13" placeholder="08xxxxxxxx" required>
                        <label for="email">Email :</label>
                            <input type="email" name="email" maxlength="75" placeholder="Example@email.com" required>
                        <label for="username">Username :</label>
                            <input type="text" name="username" maxlength="15" placeholder="Username" required>
                        <label for="password">Password :</label>
                            <input type="password" name="password" maxlength="15" placeholder="Password" required>
                        <label for="konfirmasi">Konfirmasi Password :</label>
                            <input type="password" name="konfirmasi" maxlength="15" placeholder="Konfirmasi Password" required>
                        <br> <br>
                        <div class="button">
                            <button> <a href="login.php">Kembali</a></button>
                            <button type="submit" name="daftar" >Daftar</button>
                        </div>
                    </div> 
                </form><br>
        </section>
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