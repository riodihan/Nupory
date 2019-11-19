<?php
require 'assets/includes/config.php';
session_start();


$id = $_GET["id"];
$bunga = mysqli_query($koneksi, "SELECT * FROM bunga WHERE ID_BUNGA='$id'");
$row_bunga = mysqli_fetch_array($bunga);

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
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }if($admin){?>
                
                <li><a href="#">Data Admin</a></li>
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
                <li><a href="#">Report</a></li>
            <?php }if($karyawan){?>
                
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
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
        
    <!-- <div class="slidershow middle">

      <div class="slides">
        <input type="radio" name="r" id="r1" checked>
        <input type="radio" name="r" id="r2">
        <input type="radio" name="r" id="r3">
        <input type="radio" name="r" id="r4">
        <input type="radio" name="r" id="r5">
        <div class="slide s1">
          <img src="img/2.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/1.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/3.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/4.jpg" alt="">
        </div>
        <div class="slide">
          <img src="img/5.jpg" alt="">
        </div>
      </div> -->
      

      <!-- <div class="navigation">
        <label for="r1" class="bar"></label>
        <label for="r2" class="bar"></label>
        <label for="r3" class="bar"></label>
        <label for="r4" class="bar"></label>
        <label for="r5" class="bar"></label>
      </div>
    </div> -->
    
    <!--bagian tulisan-->
      
      
      <h3><?php echo $row_bunga["NAMA_BUNGA"];?></h3>
      <div class="p">
      
      <input type="hidden" name="id_transaksi" value="<?php echo $hasilkode?>" >
      <input type="hidden" name="id_user" value="<?php echo $iduser?>">

      <label for="harga"> Harga
        <input id="harga" type="text" value="<?php echo $row_bunga["HARGA"];?>" onkeyup="sum();" readonly>
      </label><br>

      <label for="stok">Stok
        <input id="stok" type="text" value="<?php echo $row_bunga["STOK"];?>" readonly> <br>
      </label>

        <input type="hidden" name="tanggal" id="tanggal" value="<?php
        $tanggal= mktime(date("m"),date("d"),date("Y"));
        echo " ".date("d-M-Y", $tanggal)." ";
        date_default_timezone_set('Asia/Jakarta');?>" readonly>
      
      <label for="jumlah">Jumlah Beli
        <input type="number" name="jumlah" id="jumlah" onkeyup="sum();">
      </label><br>

      <label for="total">Total  
          <input type="number" name="total" id="total" readonly>
      </label><br>

      <label for="opsi">Ambil di tempat atau dikirim
          <br><button>kirim</button>
          <button>Ambil</button>
      </label><br>

      <label for="alamat">Alamat <br>
        <input class="alamat" id="alamat" type="text" placeholder="Alamat Pengiriman" required><br>
      </label>
      
      <button>Beli</button>
      </div>
    
    


        <!-- <br>
          <textarea name="alamat" id="" rows="10" placeholder="Alamat Pengiriman"></textarea>
          <br>
          <button>Beli</button> -->

    


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
      // if(result.value=NaN){
      //   document.getElementById('total').value = null;
      // }
    }
    </script>


</script>
</body>
</html>

