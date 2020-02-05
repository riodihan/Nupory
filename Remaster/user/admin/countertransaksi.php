<?php
require 'assets/config.php';

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

$sql = "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI= 05 ";
$result = $koneksi->query($sql);

echo $result->num_rows;

$koneksi->close();
?>