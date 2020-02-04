<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poltek_nursery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI= 05 ";
$result = $conn->query($sql);

echo $result->num_rows;

$conn->close();
?>