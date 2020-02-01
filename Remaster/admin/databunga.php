<?php
  session_start();
  require 'assets/config.php';

  $hasil = mysqli_query ($koneksi, "SELECT * FROM bunga");
  $hasil1 = mysqli_query ($koneksi, "SELECT * FROM kategori");
  $hasil2 = mysqli_query ($koneksi, "SELECT * FROM kategori");
  $kritik = mysqli_query ($koneksi, "SELECT * FROM kritik WHERE ID_STATUS_KRITIK = '01' ");
  $tagihan = mysqli_query($koneksi, "SELECT * FROM Transaksi WHERE ID_STATUS_TRANSAKSI = '02' " );

  if(isset($_POST["tambahkanBunga"]) ){
    if (tambahbunga($_POST) > 0){
      echo "<script>
              alert('Data Berhasil Ditambahkan');
              document.location.href = '';
            </script>";
    }
    else {
      echo "<script> alert('Gagal Menambahkan Data')</script>";
      echo mysqli_error();
    }
  }

  //cek sudah ditekan apa blm
  if(isset($_POST["simpanBunga"])){

    //apakah data berhasil diubah
    if(editbunga1($_POST) > 0){
      echo "<script>
              alert('Data berhasil diedit!');
              document.location.href = 'databunga.php';
            </script> ";
    } else {
      echo "<script>
              alert('Data gagal diedit!');
              document.location.href = 'databunga.php';
            </script>";
    }
  }
  
  //membuat id varchar auto increment
  $cr_id = mysqli_query($koneksi, "SELECT max(ID_BUNGA) AS id FROM bunga");
  $cari = mysqli_fetch_array($cr_id);
  $kode = substr($cari['id'],2,4);
  $id_tbh = $kode+1;


  if ($id_tbh<10) {
    $id="B"."00".$id_tbh;
  }
  elseif ($id_tbh>=10 && $id_tbh<100 ) {
    $id="B"."0".$id_tbh;
  }
  else{
    $id="B".$id_tbh;
  }

  // $idB=$_GET['id'];
  // $sql=$koneksi->query("SELECT * FROM bunga WHERE ID_BUNGA='$idB'");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Bunga</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-snowflake"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
        <?php if ($_SESSION['id_status']=="01") {
          echo "Admin";
        }elseif ($_SESSION['id_status']=="02") {
          echo "Karyawan";
        } ?> <br> Nursery Polije</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Beranda</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Database
      </div>

      <!-- Data -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="datauser.php">
              <i class="fas fa-fw fa-user text-primary"></i>
              <span class="text-primary">User</span>
            </a>
            <a class="collapse-item" href="databunga.php">
              <i class="fas fa-fw fa-snowflake text-primary"></i>
              <span class="text-primary">Bunga</span>
            </a>
            <a class="collapse-item" href="datakategori.php">
              <i class="fas fa-fw fa-cube text-primary"></i>
              <span class="text-primary">Kategori</span>
            </a>
            <a class="collapse-item" href="datatransaksi.php">
              <i class="fas fa-fw fa-dollar-sign text-primary"></i>
              <span class="text-primary">Transaksi</span>
            </a>
            <a class="collapse-item" href="datakritik.php">
              <i class="fas fa-fw fa-comments text-primary"></i>
              <span class="text-primary">Kritik</span>
            </a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <?php if ($_SESSION['id_status']=="01") { ?>
        <hr class="sidebar-divider">
    <?php } ?>
      

      <!-- Heading -->
      <div class="sidebar-heading">
        <?php if ($_SESSION['id_status']=="01") {
          echo "Tambah / Edit";
        }else{

        } ?>
      </div>

      <!-- Nav Item - Tambah / Edit Bunga Collapse Menu -->
      <li class="nav-item">
        <?php if ($_SESSION['id_status']=="01") { ?>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebunga" aria-expanded="true" aria-controls="collapsebunga">
          <i class="fas fa-fw fa-snowflake"></i>
          <span>Bunga
          </span>
        </a>
        <div id="collapsebunga" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">
              <i class="fas fa-fw fa-edit text-primary"></i>
              <span class="text-primary">Edit</span>
            </a>
            <a class="collapse-item" href="tambahbunga.php">
              <i class="fas fa-fw fa-plus text-primary"></i>
              <span class="text-primary">Tambah Bunga</span>
            </a>
          </div>
        </div>
       <?php }else { ?>
      <?php }?>    
      </li>

      <!-- Nav Item - Tambah / Edit Kategori Bunga Collapse Menu -->
      <li class="nav-item">
        <?php if ($_SESSION['id_status']=="01") { ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekategori" aria-expanded="true" aria-controls="collapsekategori">
          <i class="fas fa-fw fa-tag"></i>
          <span>Kategori Bunga
          </span>
        </a>
        <div id="collapsekategori" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">
              <i class="fas fa-fw fa-edit text-primary"></i>
              <span class="text-primary">Edit</span>
            </a>
            <a class="collapse-item" href="tambahkategori.php">
              <i class="fas fa-fw fa-plus text-primary"></i>
              <span class="text-primary">Tambah Kategori</span>
            </a>
          </div>
        </div>  
      <?php }else{ ?>
     <?php } ?> 
      </li>

      <!-- Nav Item - Tambah / Edit Karyawan Collapse Menu -->
      <li class="nav-item">
        <?php if ($_SESSION['id_status']=="01") { ?>
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekaryawan" aria-expanded="true" aria-controls="collapsekaryawan">
          <i class="fas fa-fw fa-user"></i>
          <span>Karyawan
          </span>
        </a>
        <div id="collapsekaryawan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">
              <i class="fas fa-fw fa-edit text-primary"></i>
              <span class="text-primary">Edit</span>
            </a>
            <a class="collapse-item" href="#">
              <i class="fas fa-fw fa-plus text-primary"></i>
              <span class="text-primary">Tambah Karyawan</span>
            </a>
          </div>
        </div>
        <?php }else{ ?>
      <?php  } ?>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><i id="counterth"></i></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Tagihan Baru
                </h6>
                <?php while ($row=mysqli_fetch_assoc($tagihan)): ?>
                <a class="dropdown-item d-flex align-items-center" href="datatransaksi.php">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $row["TOTAL_AKHIR"]?></div>
                    <span class="font-weight-bold"><?php echo "tagihan "; echo $row["USERNAME"] ?></span>
                  </div>
                </a>
                </a>
              <?php endwhile;?>
                <a class="dropdown-item text-center small text-gray-500" href="datatransaksi.php">Baca Selengkapnya</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><i id="counterkr"></i></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Kritik Baru
                </h6>
                <?php while ($row=mysqli_fetch_assoc($kritik)): ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="font-weight-bold">
                    <div class="text-truncate"><?php echo $row["ISI_KRITIK"]?></div>
                    <div class="small text-gray-500">Dari <?php echo $row["USERNAME"]?></div>
                  </div>
                </a>
                <?php endwhile;?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php if ($_SESSION['id_status']=="01") {
                    echo "Admin, ";
                    echo $_SESSION["nama_user"];
                  }else{
                    echo "Karyawan, ";
                    echo $_SESSION["nama_user"];
                  }?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profil.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
              Selamat Datang
              <?php if ($_SESSION['id_status']=="01") {
                echo "Admin ";
                echo $_SESSION["nama_user"];
              }elseif ($_SESSION['id_status']=="02") {
                echo "Karyawan ";
                echo $_SESSION["nama_user"];
              }?>
            </h1>
            <?php if ($_SESSION['id_status']=="01") { ?>
              <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm text-white" data-toggle="modal" data-target="#tambahBunga">Tambah Bunga</a>   
          <?php  }else{ ?>
         <?php } ?>
            
          </div>

        <!-- #############################################################################################
				                              Modal Import (Tambah Bunga)
        ############################################################################################# -->
        <!-- Modal -->
        <div class="modal fade" id="tambahBunga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-md-12">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Bunga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" class="card-body">
                      <input type="hidden" value="<?=$id?>" type="text" name="idBunga" id="idBunga" class="form-control">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="namabunga">Nama Bunga</label>
                      <input type="text" name="namaBunga" id="namaBunga" class="form-control" require>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="kategoribunga">Kategori Bunga</label>
                        <select name="kategoriBunga" id="kategoriBunga" class="form-control" require>
                        <option value="">Pilih Kategori</option>
                        <?php while ($row=mysqli_fetch_assoc($hasil1)): ?>
                        <option value="<?php echo $row["ID_KATEGORI"]?>"><?php echo $row["NAMA_KATEGORI"]?></option>
                        <?php endwhile;?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="deskripsibunga">Deskripsi Bunga</label>
                  <input type="text" name="deskripsiBunga" id="deskripsiBunga" class="form-control">
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="harga">Harga</label>
                      <input type="text" name="hargaBunga" id="hargaBunga" class="form-control text-right" require>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="stok">Stok</label>
                      <input type="text" name="stokBunga" id="stokBunga" class="form-control text-right" require>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="fotobunga">Foto Bunga</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="fotoBunga" class="custom-file-input" id="fotoBunga" aria-describedby="fotobunga" require>
                      <label class="custom-file-label" for="fotobunga">Pilih foto</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="videobunga">Video</label>
                  <input type="text" name="videoBunga" id="videoBunga" class="form-control" placeholder="Copy link video disini.">
                </div>
                <div class="form-group">
                  <label for="caraperawatan">Cara Perawatan</label>
                  <input type="text" name="caraPerawatan" id="caraPerawatan" class="form-control">
                </div>
                <div class="col text-center">
                    <button type="submit" name="tambahkanBunga" class="btn btn-primary">Tambahkan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        

        <!-- #############################################################################################
				                              Modal Edit (Edit Bunga)
        ############################################################################################# -->
        <!-- Modal -->
        <div class="modal fade" id="ubahBunga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-md-12">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bunga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" class="card-body">
                <input type="hidden" name="id1" id="id1" class="form-control">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="namaBunga1">Nama Bunga</label>
                      <input type="text" name="namaBunga1" id="namaBunga1" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="idKategori1">Kategori Bunga</label>
                        <select name="idKategori1" id="idKategori1" class="form-control" require>
                        <?php while ($row=mysqli_fetch_assoc($hasil2)): ?>
                        <option value="<?php echo $row["ID_KATEGORI"]?>"><?php echo $row["NAMA_KATEGORI"]?></option>
                        <?php endwhile;?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="deskripsiBunga1">Deskripsi Bunga</label>
                  <input type="text" name="deskripsiBunga1" id="deskripsiBunga1" class="form-control">
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="hargaBunga1">Harga</label>
                      <input type="text" name="hargaBunga1" id="hargaBunga1" class="form-control text-right" require>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="stokBunga1">Stok</label>
                      <input type="text" name="stokBunga1" id="stokBunga1" class="form-control text-right" require>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="fotoBunga1">Foto Bunga</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="fotoBunga1" class="custom-file-input" id="fotoBunga1" aria-describedby="fotobunga" require>
                      <label class="custom-file-label" for="fotoBunga">Pilih foto</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="videoBunga1">Video</label>
                  <input type="text" name="videoBunga1" id="videoBunga1" class="form-control" placeholder="Copy link video disini.">
                </div>
                <div class="form-group">
                  <label for="caraPerawatan1">Cara Perawatan</label>
                  <input type="text" name="caraPerawatan1" id="caraPerawatan1" class="form-control">
                </div>
                <div class="col text-center">
                    <button type="submit" id="simpanBunga" name="simpanBunga" class="btn btn-primary">Ubah Data</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>



          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Bunga Nursery Polije</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Bunga</th>
                      <th>Nama Kategori</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Deskripsi</th>
                      <th>Foto Bunga</th>
                      <th>Video Bunga</th>
                      <th>Cara Perawatan</th>
                      <?php if ($_SESSION['id_status']=="01") { ?>
                        <th>Tindakan</th>
                     <?php }else{ ?>
                    <?php } ?>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row=mysqli_fetch_assoc($hasil)): ?>
                    <tr id="<?php echo $row["ID_BUNGA"];?>" >
                      <td data-target="nama"><?php echo $row["NAMA_BUNGA"]?></td>
                      <td data-target="idKategori"><?php echo $row["ID_KATEGORI"]?></td>
                      <td data-target="hargaBunga"><?php echo $row["HARGA"]?></td>
                      <td data-target="stokBunga"><?php echo $row["STOK"]?></td>
                      <td data-target="deskripsiBunga"><?php echo $row["DESKRIPSI"]?></td>
                      <td data-target="fotoBunga"><?php echo $row["FOTO_BUNGA"]?></td>
                      <td data-target="videoBunga"><?php echo $row["VIDEO_BUNGA"]?></td>
                      <td data-target="caraPerawatan"><?php echo $row["CARA_PERAWATAN"]?></td>
                      <td>
                        <?php if ($_SESSION['id_status']=="01") { ?>
                            <a class="btn btn-primary" style="width:40px;" href="#" data-role="update" data-id=<?php echo $row['ID_BUNGA'];?>><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" href="hapusbunga.php?id=<?= $row["ID_BUNGA"]; ?>"onclick="return confirm('Anda yakin ingin menghapus data ini ?')" role="button">
                            <i class="fas fa-trash"></i>
                            </a>
                       <?php }else{ ?>
                    <?php  } ?>      
                      </td>
                    </tr>
                    <?php endwhile;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Logout" jika anda ingin keluar dari halaman ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../user/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script type="text/javascript" >
    function loadDoc() {
      setInterval(function(){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("counterkr").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "counterkritik.php", true);
        xhttp.send();

        },1000);

    }
    loadDoc();
  </script>

  <!-- Counter Tagihan AJAX -->
  <script type="text/javascript" >
    function loadDoc() {
      setInterval(function(){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("counterth").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "countertagihan.php", true);
        xhttp.send();

        },1000);

    }
    loadDoc();
  </script>

  <script>
    $(document).ready(function(){

      //menampilkan data pada form modal
      $(document).on('click', 'a[data-role=update]', function(){
        var id = $(this).data('id');
        var namaBunga = $('#' + id).children('td[data-target=nama]').text();
        var idKategori = $('#' + id).children('td[data-target=idKategori]').text();
        var hargaBunga = $('#' + id).children('td[data-target=hargaBunga]').text();
        var stokBunga = $('#' + id).children('td[data-target=stokBunga]').text();
        var deskripsiBunga = $('#' + id).children('td[data-target=deskripsiBunga]').text();
        var fotoBunga = $('#' + id).children('td[data-target=fotoBunga]').text();
        var videoBunga = $('#' + id).children('td[data-target=videoBunga]').text();
        var caraPerawatan = $('#' + id).children('td[data-target=caraPerawatan]').text();

        $('#id1').val(id);
        $('#namaBunga1').val(namaBunga);
        $('#idKategori1').val(idKategori);
        $('#hargaBunga1').val(hargaBunga);
        $('#stokBunga1').val(stokBunga);
        $('#deskripsiBunga1').val(deskripsiBunga);
        $('#fotoBunga1').val(fotoBunga);
        $('#videoBunga1').val(videoBunga);
        $('#caraPerawatan1').val(caraPerawatan);
        $('#ubahBunga').modal('toggle');
      });

      //Menrubah ketika ditekan tombol ubah data
      $('#simpan').click(function(){
        var ID_BUNGA = $('#id1').val();
        var ID_KATEGORI = $('#idKategori1').val();
        var NAMA_BUNGA = $('#namaBunga1').val();
        var HARGA = $('#hargaBunga1').val();
        var STOK = $('#stokBunga1').val();
        var FOTO_BUNGA = $('#fotoBunga1').val();
        var VIDEO_BUNGA = $('#videoBunga1').val();
        var CARA_PERAWATAN = $('#caraPerawatan1').val();
        var DESKRIPSI = $('#deskripsiBunga1').val();
      })
    });
  </script>

</body>

</html>