<?php 
// mengaktifkan session pada php
session_start();

//menghubungkan php dengan koneksi database
include 'config.php';


//menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


//menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
//menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

//cek apakah username dan password di temukan pada database
if ($cek === 1) {
	$data = mysqli_fetch_assoc($login);


	//cek jika user login sebagai admin
	if ($data['id_status'] == '01') {
		//buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['id_status'] = '01';
		//alihkan ke halaman admin
		header("location: ../admin/index.php");
	}else if ($data['id_status'] == '02') {
		//buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['id_status'] = '02';
		//alihkan ke halaman karyawan
		header("location:../admin/index.php");
	}else if ($data['id_status'] == '03') {
		//buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['id_status'] = '03';
		//alihkan ke halaman user
		header("location:index.php");
	}else{
		//alihkan kehalaman login kembali
		header("location:index.php?pesan=gagal");
	}
}else {

	header("location:index.php?pesan=gagal");
}

 ?>