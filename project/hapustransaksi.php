<?php
require 'assets/includes/config.php';

$id = $_GET["id"];


if(hapustransaksi($id) > 0  ){
    echo "<script>alert('Waktu pembayaran telah habis'); window.location.href='datatransaksi.php'</script>";
    // header("location : datatransaksi.php");
}else{
    echo mysqli_error($koneksi);

}


?>