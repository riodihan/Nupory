<?php
    //error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));


    //$koneksi= mysqli_connect("localhost", "root", "", "nupory");
    session_start();
    require 'assets/includes/config.php';

    /*Proses Login*/

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password ='$password'");
        $row = mysqli_fetch_array($login);
        $user = $row ['username'];
        $pass = $row ['username'];
        $id_status = $row ['ID_STATUS'];
        if(mysqli_num_rows($login) === 1) {
            $_SESSION["id_status"]= $id_status;
            $_SESSION["login"]= true;
            header("location: index.php");}
            
            else{
                header("location: login.php?gagal");
            }
                
            
        
        
        //$error = true;
        
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
                <input type="password" name="password" class="kotaktext" value="" id="Password" placeholder="Password" required><br><br>
                <input type="checkbox" onclick="myFunction()">Show Password <br>
            <button type="submit" name="login">MASUK</button>
            <h5>belum punya akun? <a href="register.php">daftar disini</a></h5>
            <h5>lupa password? <a href="lupapassword.php">lupa password</a></h5>

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
    function myFunction() {
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

