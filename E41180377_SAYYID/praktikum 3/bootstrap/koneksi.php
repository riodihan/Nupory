<?php
$koneksi = mysql_connect ("localhost", "root", "", "nupory");


if (mysql_connect_errno()){
    echo "koneksi database gagal :" . mysql_connect_error();
}
?>