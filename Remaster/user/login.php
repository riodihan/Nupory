<?php
session_start();
require 'assets/config.php';

// jika sudah ada session akan dimasukan ke index secara otomatis

if(isset($_SESSION["login"])){
	header("location: index.php");
}


if (isset($_POST["login"])) {
	$iduser = $_POST["iduser"];
	$password = $_POST["password"];
	$login = mysqli_query($koneksi, "SELECT * FROM user WHERE USERNAME = '$iduser' AND password ='$password'");
	$row = mysqli_fetch_array($login);
	$username = $row['USERNAME'];
	$pass = $row['PASSWORD'];
	$idstatus = $row['ID_STATUS'];
	if (mysqli_num_rows($login) === 1) {
		$_SESSION["idstatus"] = $idstatus;
		$_SESSION["username"] = $username;
		$_SESSION["login"] = true;
		header("location: index.php");
	} else {
		header("location: login.php?gagal");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
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
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" type="text/css" href="css/slick.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.min.css">
	<link rel="stylesheet" type="text/css" href="css/style-rtl.css"> -->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/Nursery.jpg);">
					<span class="login100-form-title-1">
						LogIn
					</span>
				</div>

				<form method="POST" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username Harus Diisi">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="iduser" placeholder="Masukan username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password Harus Diisi">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" value="" id="Password" placeholder="Masukan password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">

							<label class="input"> <input type="checkbox" onclick="lihatpassword()"> Lihat Password </label>
							<!-- <label class="label-checkbox100" click="lihatpassword()"for="ckb1">
								Lihat Password
							</label> -->
						</div>
					</div>
					<div class="">
						<button class="btn btn-primary" type="submit" name="login">
							Login
						</button>

						<?php if(isset($_GET["gagal"])){?>
						<h5 style="color: red;">Username atau password salah</h5>
						<?php }?>

					</div>
					<div class="flex-sb-m w-full p-b-30">
						<div>
							<a href="lupapassword.php" class="txt1">
								Lupa Password?
							</a><br>
							<a href="daftar.php" class="txt1">
								Belum Punya Akun?
							</a>
						</div>
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

	<script >
		function lihatpassword(){
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