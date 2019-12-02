<?php
require 'assets/includes/config.php';

$id = $_GET["id"];

if(upload($id) > 0  ){
    echo "<script>alert('Selesai'); window.location.href='profile.php'</script>";

}else{
    echo mysqli_error($koneksi);

}

?>