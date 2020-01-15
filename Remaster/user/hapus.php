<?php
require 'assets/config.php';

$id = $_GET["id"];

if(hapuskeranjang($id) > 0  ){
    echo "<script>alert('Data Berhasil dihapus'); window.location.href='keranjang.php'</script>";

}else{
    echo "<script>alert('Data Gagal dihapus'); window.location.href='keranjang.php'</script>";

}

?>