<?php
require 'assets/includes/config.php';

$id = $_GET["id"];

if(hapuspemesanan($id) > 0  ){
    echo "<script>alert('Data Berhasil dihapus'); window.location.href='pemesanan.php'</script>";

}else{
    echo "<script>alert('Data Gagal dihapus'); window.location.href='setujui.php'</script>";

}

?>