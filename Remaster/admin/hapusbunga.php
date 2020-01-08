<?php 
require 'assets/config.php';

//ambil data id yang dikirim databunga.php melalui url
$id = $_GET['id'];
//query untuk menampilkan data bunga berdasarkan id yang dikirim
$query = "SELECT * FROM bunga WHERE ID_BUNGA='".$id."'";
$sql = mysqli_query($koneksi, $query); //jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); //ambil data dari hasil eksekusi $sql
// cek apakah file fotonya ada di folder image
if (is_file("img".$data['FOTO_BUNGA'])) // jika foto ada
	unlink("img".$data['FOTO_BUNGA']); //hapus foto yang telah diupload dari folder image
//query untuk menghapus data bunga
	$query2= "DELETE FROM bunga WHERE ID_BUNGA='".$id."'"; 
	$sql2 = mysqli_query($koneksi, $query2); //jalankan query dari variabel $query2
if ($sql2) {
	echo "<script>alert ('Data Berhasil Dihapus'); document.location.href='databunga.php'</script>\n";

}else {
	//jika gagal, jalankan
	echo "<script>alert ('Data Gagal Dihapus'); document.location.href='databunga.php'</script>\n";
}

 ?>