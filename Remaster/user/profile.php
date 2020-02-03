<?php
session_start();
require 'assets/config.php';

//cek session
if(!isset($_SESSION["login"])){
	header("location: index.php");
}

if(!isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}

//
$username = $_SESSION["username"];

//menampilkan data user
$profile = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");


//ubah password
if (isset($_POST["ubah"])) {
	if (ubahpassword($_POST) == 1) {
		echo "<script>alert('password berhasil diubah');  window.location.href='profile.php'</script>";
	} else {
		echo "<script>alert('password Gagal diubah');</script>";
	}
}

//ubah biodata
if (isset($_POST["ubah1"])) {
	if (ubahbiodata($_POST) == 1) {
		echo "<script>alert('Biodata berhasil diubah');  window.location.href='profile.php'</script>";
	} else {
		echo "<script>alert('Biodata Gagal diubah');</script>";
	}
}


?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Profile</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">

	<!-- Stylesheets -->

	<link href="common-css/bootstrap.css" rel="stylesheet">

	<link href="common-css/ionicons.css" rel="stylesheet">

	<link href="common-css/fluidbox.min.css" rel="stylesheet">

	<link href="01-cv-portfolio/css/styles.css" rel="stylesheet">

	<link href="01-cv-portfolio/css/responsive.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" type="text/css" href="css/slick.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<!-- <style>
        .bg {
            background-image: url("images/Nursery.png");
            background-repeat: no-repeat;
        }
    </style> -->
</head>

<body>





	<?php foreach ($profile as $data) { ?>
		<section class="intro-section">



			<div class="container">
				<div class="row">
					<div class="col-md-1 col-lg-2"></div>
					<div class="col-md-10 col-lg-8">
						<div class="intro">
							<div class="profile-img"><img src="images/<?= $data["FOTO_USER"]?>" alt=""></div>
							<h2><b><?php echo $data["NAMA_USER"]; ?></b></h2>
							<!-- <h4 class="font-yellow">Key Account Manager</h4> -->
							<ul class="information margin-tb-30">
								<!-- <li><b>Lahir : </b>16 Februari 2001</li> -->
								<li><b>EMAIL : </b><?php echo $data["EMAIL"]; ?></li>
								<li><b>Alamat : </b><?php echo $data["ALAMAT"]; ?></li>
								<li><b>No Handphone : </b><?php echo $data["NO_TELEPON"]; ?></li>
							</ul>
							<a href="index.php" class="btn btn-primary">Kembali</a>
							<ul class="social-icons">
								<a href="#" data-toggle="modal" data-target="#exampleModal">
									<ion-icon name="create"></ion-icon>Edit Biodata
								</a>
								<a href="#" data-toggle="modal" data-target="#exampleModal1">
									<ion-icon name="settings"></ion-icon>Ubah Password
								</a>
								<!-- <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram"></i></a></li>
							<li><a href="#"><i class="ion-social-facebook"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter"></i></a></li> -->
							</ul>
						</div><!-- intro -->
					</div><!-- col-sm-8 -->
				</div><!-- row -->
			</div><!-- container -->


		</section><!-- intro-section -->
		<!-- Button trigger modal -->
		<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ubah Biodata</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST">
							<div class="form-group">
								<label for="formGroupExampleInput2">NAMA</label>
								<input type="text" name="nama" class="form-control" id="formGroupExampleInput2" placeholder="Nama Lengkap Anda" value="<?php echo $data["NAMA_USER"]; ?>">
							</div>
							<div class="form-group">
								<label for="formGroupExampleInput2">Email</label>
								<input type="hidden" name="username" class="form-control" id="formGroupExampleInput2" value="<?php echo $username ?>">
								<input type="email" name="email" class="form-control" id="formGroupExampleInput2" placeholder="Email@email.com" value="<?php echo $data["EMAIL"]; ?>">
							</div>
							<div class="form-group">
								<label for="formGroupExampleInput2">Alamat</label>
								<input type="text" name="alamat" class="form-control" id="formGroupExampleInput2" placeholder="Alamat" value="<?php echo $data["ALAMAT"]; ?>">
							</div>
							<div class="form-group">
								<label for="formGroupExampleInput2">No Handphone</label>
								<input type="text" name="nohp" class="form-control" id="formGroupExampleInput2" placeholder="Nomor Handphone" value="<?php echo $data["NO_TELEPON"]; ?>">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								<button type="submit" name="ubah1" class="btn btn-primary">Ubah</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post">
							<div class="form-group">
								<label for="formGroupExampleInput">Password Lama</label>
								<input type="hidden" name="username" class="form-control" id="formGroupExampleInput" value="<?php echo $username ?>">
								<input type="password" name="passwordlama" class="form-control" id="formGroupExampleInput" placeholder="Masukan Password Lama">
								<input type="hidden" name="passwordlama1" class="form-control" id="formGroupExampleInput" value="<?php echo $data["PASSWORD"]; ?>">
							</div>
							<div class="form-group">
								<label for="formGroupExampleInput2">Password Baru</label>
								<input type="password" name="passwordbaru" class="form-control" id="formGroupExampleInput2" placeholder="Masukan Password Baru">
							</div>
							<div class="form-group">
								<label for="formGroupExampleInput2">Konfirmasi Password</label>
								<input type="password" name="passwordbaru1" class="form-control" id="formGroupExampleInput2" placeholder="Konfirmasi Password Baru">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
								<button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
							</div>
						</form>


					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<div id="footer" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-4 col-md-3">
					<div class="address-holder">
						<div class="phone"><i class="fas fa-phone"></i>02178888</div>
						<div class="email"><i class="fas fa-envelope"></i>Nurserypolije@gmail.com</div>
						<div class="address">
							<i class="fas fa-map-marker"></i>
							<div>puncak rembangan, darungan, Darungan, Kemuninglor, Arjasa, Jember Regency, Jawa Timur 68191</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-2">
					<div class="footer-menu-holder">
						<h4>Lembaga</h4>
						<ul class="footer-menu">
							<li><a href="about.html">Tentang Kami</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-3">
					<div class="footer-menu-holder">
						<h4>Layanan Kami</h4>
						<ul class="footer-menu">
							<li><a href="webhosting.html">Transaksi Bunga</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3">
					<div class="footer-menu-holder">
						<h4>Fasilitas</h4>
						<ul class="footer-menu">
							<li><a href="portal.html">Cara Perawatan</a></li>
							<li><a href="#">Peta Lokasi</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1 col-md-1">
					<div class="social-menu-holder">
						<ul class="social-menu">
							<li><a href="#"><i class="fab fa-facebook"></i></a></li>
							<li><a href="#"><i class="fab fa-youtube"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>



	</section><!-- portfolio-section -->





	<!-- SCIPTS -->

	<script src="common-js/jquery-3.2.1.min.js"></script>

	<script src="common-js/tether.min.js"></script>

	<script src="common-js/bootstrap.js"></script>

	<script src="common-js/isotope.pkgd.min.js"></script>

	<script src="common-js/jquery.waypoints.min.js"></script>

	<script src="common-js/progressbar.min.js"></script>

	<script src="common-js/jquery.fluidbox.min.js"></script>

	<script src="common-js/scripts.js"></script>
	<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-slider.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>