<?php 
include ('assets/includes/config.php');

if (isset($_GET['id'])) {
	$id = $_GET['id'];


$sql = "select video_bunga from bunga where id_bunga='$id'";
$res = mysqli_query($koneksi,$sql);


$row = mysqli_fetch_assoc($res);
$video = $row['video_bunga'];

echo "selamat <br> <br>"



 ?>
 <video width="615" height="315" controls>
	<source src="video/<?php echo $video; ?>" type="video/mp4">
</video>

<?php  
}
?>
