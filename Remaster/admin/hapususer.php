<?php 
require 'assets/config.php';

//ambil data nama yang dikirim
$id = $_GET ['id'];
//query untuk menampilkan data user berdasarkan nama yang dikirim
$query = "SELECT * FROM user WHERE NAMA_USER='".$id."'";
$sql = mysqli_query($koneksi, $query); //jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); //ambil data dari hasil eksekusi $sql
//cek apakah file fotonya ada di folder image
	if (is_file("img".$data['FOTO_USER'])) //jika foto ada
		unlink("img".$data['FOTO_USER']); //hapus foto yang telah diupload
$query2 = "DELETE FROM user WHERE NAMA_USER='".$id."'";
$sql2 = mysqli_query($koneksi, $query2); //jalankan query dari variabel $query2


	if ($sql2) {
		echo "<script>alert ('Data Berhasil Dihapus');
		document.location.href='datauser.php'</script>\n";
	}else {

		echo "<script>alert ('Data Gagal Dihapus')
		document.location.href='datauser.php'</script>\n";
	}


 ?>