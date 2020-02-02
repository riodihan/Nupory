<?php
//koneksi
session_start();
require 'assets/config.php';

if(isset($_SESSION["login"])){
	header("location: index.php");
	exit;
}

//proses daftar
if (isset($_POST["daftar"])) {

    if (pendaftaran($_POST) == 1) {
        echo "<script>alert('user berhasil terdaftar'); window.location.href='login.php'</script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(images/Nursery.jpg);">
                    <span class="login100-form-title-1">
                        Pendaftaran
                    </span>
                </div>

                <form class="login100-form validate-form" method="POST">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nama Harus Diisi">
                        <span class="label-input100">Nama</span>
                        <input class="input100" type="text" name="nama" placeholder="Masukan Nama Lengkap Anda">
                        <input class="input100" type="hidden" name="idstatus" placeholder="Masukan Nama Lengkap Anda" value="03">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Alamat Harus Diisi">
                        <span class="label-input100">Alamat</span>
                        <input class="input100" type="text" name="alamat" placeholder="Masukan Alamat Lengkap Anda">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="No HP Harus Diisi">
                        <span class="label-input100">No HP</span>
                        <input class="input100" type="number" name="nohp" placeholder="Masukan Nomor HP Anda">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Email Harus Diisi">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Masukan Email Anda">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Username Harus Diisi">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="iduser" placeholder="Masukan Username">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password Harus Diisi">
                        <span class="label-input100">Password</span>
                        <input class="input100" id="Password" type="password" name="password" placeholder="Masukan Password">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="Konfirmasi Password Harus Diisi">
                        <span class="label-input100">Konfirmasi Password</span>
                        <input class="input100" id="Password1" type="password" name="konfirmasi" placeholder="Konfirmasi Password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" onclick="lihatpassword()" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Lihat Password
                            </label>
                        </div>

                        <div>
                            <a href="Login.php" class="txt1">
                                Sudah Punya Akun? Login Disini
                            </a><br>
                        </div>

                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" name="daftar" class="login100-form-btn">
                            Daftar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script>
        function lihatpassword() {
            var x = document.getElementById("Password");
            var y = document.getElementById("Password1");

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
    </script>

</body>

</html>