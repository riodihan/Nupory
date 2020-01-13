<?php 
require 'assets/config.php';


//ambil data id yang dikirim
$id = $_GET['id'];
//query untuk menampilkan data kategori berdasarkan id yang dikirim
$query = "SELECT * FROM kategori WHERE ID_KATEGORI='".$id."'";
$sql = mysqli_query($koneksi, $query);

$data = mysqli_fetch_array($sql);


if (is_file("img".$data['GAMBAR_KATEGORI'])) 
	unlink("img".$data['GAMBAR_KATEGORI']);

$query2 = "DELETE FROM kategori WHERE ID_KATEGORI='".$id."'";
$sql2 = mysqli_query($koneksi, $query2);


if ($sql2) {
	echo "<script>alert ('Data Berhasil Dihapus');
	document.location.href='datakategori.php'</script>\n";
}else{
	echo "<script>alert ('Data Gagal Dihapus');
	document.location.href='datakategori.php'</script>\n";
}

 ?>