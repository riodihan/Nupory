<?php
    session_start();
    require 'assets/includes/config.php';


    // jika sudah ada session akan dimasukan ke index secara otomatis

    if(isset($_SESSION["login"])){
        header("location: index.php");
    }

    /*Proses Login*/

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password ='$password'");
        $row = mysqli_fetch_array($login);
        $user = $row ['USERNAME'];
        $pass = $row ['password'];
        $id_status = $row ['ID_STATUS'];
        $id_user = $row ['ID_USER'];
        if(mysqli_num_rows($login) === 1) {
            $_SESSION["id_status"]= $id_status;
            $_SESSION["id_user"]= $id_user;
            $_SESSION["USERNAME"]= $user;
            $_SESSION["login"]= true;
            header("location: index.php");}
            
            else{
                header("location: login.php?gagal");
            }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylelogin.css">
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
                <li><a href="cara.php">Cara Perawatan</a></li>
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
    <section class="posisi">
        <h2>Login</h2>
        <?php
        if(isset($_GET["gagal"])) {?>
            <h3 style="color: red;">Maaf, username atau password salah.</h3>
        <?php }?>
        

        <br>
        <form class="kotaklogin" method="post">
            
            <p class="tulisankotak">Username</p>
                <input type="text" name="username" class="kotaktext" id="username" placeholder="Username/Email" required>
            <p class="tulisankotak">Password</p>
                <input type="password" name="password" class="kotaktext" value="" id="Password" placeholder="Password" required><br>
                <input type="checkbox" onclick="showpassword()">Show Password <br>
            <button type="submit" name="login">MASUK</button>
            <h5>belum punya akun? <a href="register.php">daftar disini</a></h5>
            <h5>lupa password? <a href="lupapassword.php">klik disini</a></h5>

        </form>
        
      
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
    function showpassword() {
        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    
    </script>

</body>
</html>

