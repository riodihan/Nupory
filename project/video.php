<?php 
include ('assets/includes/config.php');

$sql = "select id_bunga, video_bunga from bunga";
$res =mysqli_query($koneksi,$sql);

echo "myvideo <br> <br>"; 

while ($row = mysqli_fetch_assoc($res)) {
	$id = $row['id_bunga'];
	$video = $row['video_bunga'];


	echo  " <a href='play.php?id=$id'>.$video.</a> ";

 ?>
  <?php } ?>
 