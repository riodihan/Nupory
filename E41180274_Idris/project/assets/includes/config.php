<?php
    
    global $koneksi;

    $nameserver = "localhost:8080";
    $username = "root";
    $password = "";
    $namadb = "nupory";

    $koneksi = mysqli_connect($nameserver,$username,$password,$namadb);

    if(!$koneksi){
        die("koneksi gagal". mysqli_connect_error());
    }
?>