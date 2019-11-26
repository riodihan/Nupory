<?php
require 'assets/includes/config.php';
session_start();

//menampilkan bunga berdasarkan id
$id = $_GET["id"];
$bunga = mysqli_query($koneksi, "SELECT * FROM bunga WHERE ID_BUNGA='$id'");
$row_bunga = mysqli_fetch_array($bunga);

//cek session
if(!isset($_SESSION["login"])){
        header("location: login.php");
        exit;
    }

$jual = mysqli_query($koneksi, "SELECT * FROM bunga ");

//auto increment id transaksi

$carikode = mysqli_query($koneksi, "select max(ID_TRANSAKSI)from transaksi") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 1 );
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "T" .str_pad($kode, 3, "0", STR_PAD_LEFT);
}else{
    $hasilkode = "T001";
}

//ambil id user dari session

$iduser = $_SESSION["id_user"];

//transaksi
if(isset($_POST["beli"])){

  if(transaksi($_POST) == 1){
      echo "<script>alert('pembelian anda sudah diproses, harap bayar tagihan transaksi terlebih dahulu'); window.location.href='transaksisaya.php'</script>";
  }else{
      echo mysqli_error($koneksi);
  }
}

//detail transaksi
if(isset($_POST["beli"])){

  if(detail($_POST) == 1){
    echo "<script>alert('pembelian anda sudah diproses, harap bayar tagihan transaksi terlebih dahulu'); window.location.href='transaksisaya.php'</script>";
  }else{
    echo mysqli_error($koneksi);
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylesemuaproduk.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body{
        background-image: url('img/Nursery.jpg');
        
        
    }
    </style>
</head>
<body>
    <header>
    <div id="hidesidebar" class="hidesidebar">
        <p class="tombol"> <a href="javascript:void(0)" class="close" onclick="hide()">&#9776;</a></p>
        <ul>
        <?php 
                $user = @$_SESSION['id_status'] == '03';
                $karyawan = @$_SESSION['id_status'] =='02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));
                if($user){
            ?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="transaksisaya.php">Transaksi Saya</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }if($admin){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="datauser.php">Data User</a></li>
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
                <li><a href="kritikuser.php">Kritik User</a></li>
                <li><a href="report.php">Report</a></li>
            <?php }if($karyawan){?>
                
                <li><a href="datatransaksi.php">Data Transaksi</a></li>
                <li><a href="databunga.php">Data Bunga</a></li>
            <?php }if($guest){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }?>
        </ul>
        
    </div>
    <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
    </div>
    <h1 class="h1">Nursery<br>Polije
        <button class="button"><a href="logout.php">Logout</a></button>
    </h1>
    </header>
    <section>
        <h2><?php echo $row_bunga["NAMA_BUNGA"];?></h2><br><br>
        <div class="background">
            
        
    <!--bagian gambar-->
    
      <img src="img/<?php echo $row_bunga["FOTO_BUNGA"];?>" alt="">
      
    <form action="" method="POST">
      <h3><?php echo $row_bunga["NAMA_BUNGA"];?></h3>
          <div class="p bg">
            <tr>
              <td>
                    <input type="hidden" name="id_bunga" value="<?php echo $id?>">
                    <input type="hidden" name="id_transaksi" value="<?php echo $hasilkode?>" >
                    <input type="hidden" name="id_user" value="<?php echo $iduser?>">
                  <label for="harga"> Harga
                    <input name="harga" style="background-color: transparent; color: white;" id="harga" type="text" value="<?php echo $row_bunga["HARGA"];?>" onkeyup="sum();" readonly>
                  </label><br>
              </td>
           </tr>

           <tr>
             <td>
                    <label for="stok">Stok
                      <input name="stok" style="background-color: transparent; color: white;" id="stok type="text" value="<?php echo $row_bunga["STOK"];?>" readonly> <br>
                    </label>
             </td>
           </tr>

           <tr>
              <td>
                <input type="hidden" name="tanggal" id="tanggal" value="<?php
                $tanggal= mktime(date("d"),date("m"),date("Y"));
                echo " ".date("d/m/Y", $tanggal)." ";
                date_default_timezone_set('Asia/Jakarta');
                echo date("h:i:sa");
                ?>" readonly>
              </td>
           </tr>
              
           <tr>
             <td>
              <label for="jumlah">Jumlah Beli <br>
                <input type="number" name="jumlah" id="jumlah" onkeyup="sum();" required>
              </label><br>
             </td>
           </tr>

           <tr>
             <td>
              <label for="total">Total <br>
                <input type="number" name="total" id="total" readonly>
              </label><br>
             </td>
           </tr>

           <tr>
             <td>
              <label for="metode">Kirim atau Ambil di tempat?
                <select style="color: black;" name="metode" id="metode">
                  <option style="color: black;" value="01">Kirim</option>
                  <option style="color: black;" value="02">Ambil di tempat</option>
                </select>
                </label><br>
             </td>
           </tr>

           <tr>
             <td>
              <label for="alamat">Alamat <br>
                <textarea name="alamat" id="" rows="5" placeholder="Alamat Pembeli" required></textarea><br>
              </label>
             </td>
           </tr>

           <tr>
             <td>
              <button name="beli">Beli</button>
             </td>
           </tr>
  
          </div>
      </form>
    </div>



        <input class="input" type="image" src="img/WA.png" height="50px" width="50px">
    </section>
    <script>
    function show() {
    document.getElementById("hidesidebar").style.width = "240px";
    document.getElementById("menu").style.marginLeft = "0%";
}

    function hide() {
    document.getElementById("hidesidebar").style.width = "0";
    document.getElementById("menu").style.marginLeft= "0";
}

    function sum() {
    var txtFirstNumberValue = document.getElementById('harga').value;
    var txtSecondNumberValue = document.getElementById('jumlah').value;
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(txtSecondNumberValue)) {
         document.getElementById('total').value = result;
      } 

    }
    </script>



</body>
</html>

