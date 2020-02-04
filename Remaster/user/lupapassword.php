<?php  
session_start();
require 'assets/config.php';

if(isset($_SESSION["login"])){
	header("location: index.php");
	exit;
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
            $mail->Body    = 'Password Anda Adalah= '.$row["PASSWORD"];
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
	<title>Lupa Password</title>
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
                        Lupa Password
					</span>
				</div>

				<form method="post" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email Harus Diisi">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" id="username" name="email" placeholder="Masukan Email Akun Anda">
						<span class="focus-input100"></span>
					</div>

					<!-- <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Masukan password">
						<span class="focus-input100"></span>
					</div> -->

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<!-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Lihat Password
							</label> -->
                        </div>
                        <div>
                            <a href="Login.php" class="txt1">
                                Kembali Ke Halaman Login
                            </a><br>
                        </div>
					</div>
					<div class="container-login100-form-btn">
						<button class="btn btn-primary">
							Kirim Password
                        </button>
                        
                        

					</div>
					<!-- <div class="flex-sb-m w-full p-b-30">
						<div>
							<a href="#" class="txt1">
								Lupa Password?
							</a><br>
							<a href="daftar.php" class="txt1">
								Belum Punya Akun?
							</a>
						</div>
					</div> -->
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

</body>

</html>