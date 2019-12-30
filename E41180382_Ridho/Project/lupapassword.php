<?php
session_start();
require 'assets/includes/config.php';


// jika sudah ada session akan dimasukan ke index secara otomatis

if (isset($_SESSION["login"])) {
    header("location: index.php");
}

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





if ($_POST) {
    $email = $_POST['email'];

    $selectquery = mysqli_query($koneksi, "SELECT * FROM user WHERE EMAIL = '$email'");
    $count = mysqli_num_rows($selectquery);
    $row = mysqli_fetch_array($selectquery);

    // echo $count;

    if ($count > 0) {
        // echo $row['PASSWORD'];

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            $mail->Username   = 'gumball4869@gmail.com';
            $mail->Password   = 'dimas2019';

            $mail->SMTPSecure =  'tls';
            $mail->Port       =  587;

            $mail->setFrom('gumball4869@gmail.com', 'Nursery Polije');
            $mail->addAddress($row["EMAIL"], 'Joe User');




            $mail->isHTML(true);

            $mail->Subject = 'Nursery Polije';
            $mail->Body    = $row["PASSWORD"];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


            $mail->send();
            // echo 'Message has been sent';
            echo "<script>alert('Password Anda telah dikirim ke Email, harap check pesan masuk di Email Anda'); window.location.href='lupapassword.php'</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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
                    <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                    <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                    <li><a href="temukankami.php">Temukan Kami</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                <?php }
                if ($admin) { ?>

                    <li><a href="#">Data Admin</a></li>
                    <li><a href="#">Data Transaksi</a></li>
                    <li><a href="#">Data Bunga</a></li>
                    <li><a href="#">Report</a></li>
                <?php }
                if ($karyawan) { ?>

                    <li><a href="#">Data Transaksi</a></li>
                    <li><a href="#">Data Bunga</a></li>
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
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
        </div>
        <h1 class="h1">Nursery<br>Polije</h1>
    </header>
    <section class="posisi">
        <h2>Lupa Password</h2>
        <?php
                if (isset($_GET["gagal"])) { ?>
            <h3 style="color: red;">Maaf, username atau password salah.</h3>
        <?php } ?>


        <br>
        <form class="kotaklogin" method="post"><br>

            <p class="tulisankotak">Email</p>
            <input type="email" name="email" class="kotaktext" id="username" placeholder="Masukan Email Akun Anda" required><br><br>
            <!-- <p class="tulisankotak">Password</p>
            <input type="password" name="password" class="kotaktext" value="" id="Password" placeholder="Password" required><br>
            <input type="checkbox" onclick="showpassword()">Show Password <br> -->
            <button type="submit" name="login">MASUK</button>
            <h5>Login Disini <a href="login.php">Login</a></h5>
            <h5>Belum Punya Akun? Daftar <a href="register.php">disini</a></h5>

        </form>


    </section>


    <script>
        function show() {
            document.getElementById("hidesidebar").style.width = "240px";
            document.getElementById("menu").style.marginLeft = "0%";
        }

        function hide() {
            document.getElementById("hidesidebar").style.width = "0";
            document.getElementById("menu").style.marginLeft = "0";
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