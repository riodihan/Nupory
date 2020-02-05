<?php
session_start();
require 'assets/config.php';

if(!isset($_SESSION["login"])){
  header("location: ../login.php");
}


if($_SESSION["id_status"] == 03){
  header("location: ../index.php");
}

//cek session
if (!isset($_SESSION["login"])) {
  header("location: index.php");
}

if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

//ubah foto
if (isset($_POST["ubahfoto"])) {
  if (uploadfoto($_POST) == 1) {
    echo "<script>alert('Foto berhasil diubah');  window.location.href='profil.php'</script>";
  } else {
    echo "<script>alert('Foto Gagal diubah');</script>";
  }
}

$username = $_SESSION["username"];

//menampilkan data user
// $profile = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
$profile = mysqli_query($koneksi, "SELECT user.USERNAME, NAMA_USER, NAMA_STATUS, ALAMAT, NO_TELEPON, EMAIL, PASSWORD 
FROM user, status
WHERE user.ID_STATUS = status.ID_STATUS AND username = '$username'");

$kritik = mysqli_query($koneksi, "SELECT * FROM kritik WHERE ID_STATUS_KRITIK = '01' ");

$tagihan = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI = '02' ");
$user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' ");

//ubah biodata
if (isset($_POST["ubah"])) {
  if (ubahprofile($_POST) == 1) {
    echo "<script>alert('Biodata berhasil diubah');  window.location.href='profil.php'</script>";
  } else {
    echo "<script>alert('Biodata Gagal diubah');</script>";
  }
}

//ubah password
if (isset($_POST["ubah1"])) {
  if (ubahpassword($_POST) == 1) {
    echo "<script>alert('password berhasil diubah');  window.location.href='profil.php'</script>";
  } else {
    echo "<script>alert('password Gagal diubah');</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title> Profile </title>
  <link rel="icon" href="Karyawan.png" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
        <div class="sidebar-brand-text mx-3"><?php if ($_SESSION['id_status'] == "01") {
                                                echo "Admin";
                                              } elseif ($_SESSION['id_status'] == "02") {
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
          <i class="fas fa-fw fa-server"></i>
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
              <i class="fas fa-fw fa-list text-primary"></i>
              <span class="text-primary">Kategori</span>
            </a>
            <a class="collapse-item" href="datakritik.php">
              <i class="fas fa-fw fa-comments text-primary"></i>
              <span class="text-primary">Kritik</span>
            </a>
          </div>
        </div>
      </li>

      <!-- Transaksi -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse" aria-labelledby="collapseTransaksi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="tagihan.php">
              <i class="fas fa-fw fa-sticky-note text-primary"></i>
              <span class="text-primary">Tagihan</span>
            </a>
            <a class="collapse-item" href="dikemas.php">
              <i class="fas fa-fw fa-cube text-primary"></i>
              <span class="text-primary">Dikemas</span>
            </a>
            <a class="collapse-item" href="dikirim.php">
              <i class="fas fa-fw fa-truck-pickup text-primary"></i>
              <span class="text-primary">Dikirim</span>
            </a>

            <a class="collapse-item" href="transaksiselesai.php">
              <i class="fas fa-fw fa-dollar-sign text-primary"></i>
              <span class="text-primary">Selesai</span>
            </a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <?php if ($_SESSION['id_status'] == "01") { ?>
        <hr class="sidebar-divider">
      <?php } ?>


      <!-- Heading -->
      <div class="sidebar-heading">
        <?php if ($_SESSION['id_status'] == "01") {
          echo "Tambah / Edit";
        } ?>
      </div>

      <!-- Nav Item - Tambah / Edit Bunga Collapse Menu -->
      <li class="nav-item">
        <?php if ($_SESSION['id_status'] == "01") { ?>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebunga" aria-expanded="true" aria-controls="collapsebunga">
            <i class="fas fa-fw fa-snowflake"></i>
            <span>Bunga
            </span>
          </a>
          <div id="collapsebunga" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="editbunga.php">
                <i class="fas fa-fw fa-edit text-primary"></i>
                <span class="text-primary">Edit </span>
              </a>
              <a class="collapse-item" href="tambahbunga.php">
                <i class="fas fa-fw fa-plus text-primary"></i>
                <span class="text-primary">Tambah Bunga</span>
              </a>
            </div>
          </div>
        <? } else { ?>
        <?php } ?>
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
            <a class="collapse-item" href="editkategori.php">
              <i class="fas fa-fw fa-edit text-primary"></i>
              <span class="text-primary">Edit</span>
            </a>
            <a class="collapse-item" href="tambahkategori.php">
              <i class="fas fa-fw fa-plus text-primary"></i>
              <span class="text-primary">Tambah Kategori</span>
            </a>
          </div>
        <? } else { ?>
        <?php } ?>
      </li>

      <!-- Nav Item - Tambah / Edit Karyawan Collapse Menu -->
      <li class="nav-item">
        <?php if ($_SESSION['id_status'] == "01") { ?>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekaryawan" aria-expanded="true" aria-controls="collapsekaryawan">
            <i class="fas fa-fw fa-user"></i>
            <span>Karyawan
            </span>
          </a>
          <div id="collapsekaryawan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="datakaryawan.php">
                <i class="fas fa-fw fa-user-cog text-primary"></i>
                <span class="text-primary">Data Karyawan</span>
              </a>
              <a class="collapse-item" href="tambahkaryawan.php">
                <i class="fas fa-fw fa-plus text-primary"></i>
                <span class="text-primary">Tambah Karyawan</span>
              </a>
            </div>
          </div>
        <? } else { ?>
        <?php } ?>
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
                <?php while ($row = mysqli_fetch_assoc($tagihan)) : ?>
                  <a class="dropdown-item d-flex align-items-center" href="datatransaksi.php">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500"><?php echo $row["TOTAL_AKHIR"] ?></div>
                      <span class="font-weight-bold"><?php echo "tagihan ";
                                                      echo $row["USERNAME"] ?></span>
                    </div>
                  </a>
                  </a>
                <?php endwhile; ?>
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
                <?php while ($row = mysqli_fetch_assoc($kritik)) : ?>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="font-weight-bold">
                      <div class="text-truncate"><?php echo $row["ISI_KRITIK"] ?></div>
                      <div class="small text-gray-500">Dari <?php echo $row["USERNAME"] ?></div>
                    </div>
                  </a>
                <?php endwhile; ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if ($_SESSION['id_status'] == "01") {
                                                                            echo "Admin, ";
                                                                            echo $_SESSION['nama_user'];
                                                                          } elseif ($_SESSION['id_status'] == "02") {
                                                                            echo "Karyawan, ";
                                                                            echo $_SESSION['nama_user'];
                                                                          } ?></span>

                <!-- <img class="img-profile rounded-circle" src="img/admin.png"> -->
                <?php if ($_SESSION['id_status'] == "01") { ?>
                  <?php foreach ($user as $data) { ?>
                    <img class="img-profile rounded-circle" src="img/<?= $data["FOTO_USER"] ?>">
                  <?php } ?>
                <?php } elseif ($_SESSION['id_status'] == "02") { ?>
                  <?php foreach ($user as $data) { ?>
                  <img class="img-profile rounded-circle" src="img/<?= $data["FOTO_USER"] ?>">
                <?php } ?>
                <?php } ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profil.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <a class="dropdown-item" href="../user/login.php" data-toggle="modal" data-target="#logoutModal">
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
            <h1 class="h3 mb-0 text-gray-800">Selamat Datang, <?php if ($_SESSION['id_status'] == "01") {
                                                                echo "Admin, ";
                                                                echo $_SESSION['nama_user'];
                                                              } elseif ($_SESSION['id_status'] == "02") {
                                                                echo "Karyawan, ";
                                                                echo $_SESSION['nama_user'];
                                                              } ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Card Profil -->
          <div class="card mb-5" style="max-width: 1080px;">
            <div class="row no-gutters">
              <div class="col-md-4">

                <?php if ($_SESSION['id_status'] == "01") { ?>
                  <?php foreach ($user as $data) { ?>
                    <img class="img-profile " src="img/<?= $data["FOTO_USER"] ?>" width="400px">
                  <?php } ?>
                <?php } elseif ($_SESSION['id_status'] == "02") { ?>
                  <?php foreach ($user as $data) { ?>
                  <img class="img-profile " src="img/<?= $data["FOTO_USER"] ?>" width="400px">
                <?php } ?>
                <?php } ?>
                <!-- <img src="img/admin.png" class="card-img" alt="..."> -->

              </div>

              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-center">Profil <?php if ($_SESSION['id_status'] == "01") {
                                                              echo "Admin";
                                                            } elseif ($_SESSION['id_status'] == "02") {
                                                              echo "Karyawan";
                                                            } ?></h5>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <th>
                          <p class="font-weight-bold text-right">Username</p>
                          <p class="font-weight-bold text-right">Nama</p>
                          <p class="font-weight-bold text-right">Status</p>
                          <p class="font-weight-bold text-right">Alamat</p>
                          <p class="font-weight-bold text-right">No. Telpon</p>
                          <p class="font-weight-bold text-right">Email</p>
                        </th>
                      </div>
                      <?php foreach ($profile as $data) { ?>
                        <div class="col-md-6">
                          <td>
                            <p><?php echo $data["USERNAME"]; ?></p>
                            <p><?php echo $data["NAMA_USER"]; ?></p>
                            <p><?php echo $data["NAMA_STATUS"]; ?></p>
                            <p><?php echo $data["ALAMAT"]; ?></p>
                            <p><?php echo $data["NO_TELEPON"]; ?></p>
                            <p><?php echo $data["EMAIL"]; ?></p>
                          </td>
                        </div>


                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                  </div>
                  <div class="col">
                    <a href="#" data-toggle="modal" data-target="#exampleModalFoto">
                      <button class="btn btn-primary"> Edit Foto</button>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#exampleModal">
                      <button class="btn btn-primary">Edit Profil</button>
                      <!-- <a href="#" class="btn btn-primary">Edit Profil</a> -->
                    </a>
                    <a href="#" data-toggle="modal" data-target="#exampleModal1">
                      <button class="btn btn-primary">Ganti Password</button>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Modal Edit Profil -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="formGroupExampleInput2">NAMA</label>
                    <input type="text" name="nama" class="form-control" id="formGroupExampleInput2" placeholder="Nama Lengkap Anda" value="<?php echo $data["NAMA_USER"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Email</label>
                    <input type="hidden" name="username" class="form-control" id="formGroupExampleInput2" value="<?php echo $username ?>">
                    <input type="email" name="email" class="form-control" id="formGroupExampleInput2" placeholder="Email@email.com" value="<?php echo $data["EMAIL"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="formGroupExampleInput2" placeholder="Alamat" value="<?php echo $data["ALAMAT"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">No Telephone</label>
                    <input type="text" name="nohp" class="form-control" id="formGroupExampleInput2" placeholder="Nomor Telephone" value="<?php echo $data["NO_TELEPON"]; ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal edit Password -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post">
                  <div class="form-group">
                    <label for="formGroupExampleInput">Password Lama</label>
                    <input type="hidden" name="username" class="form-control" id="formGroupExampleInput" value="<?php echo $username ?>">
                    <input type="password" name="passwordlama" class="form-control" id="formGroupExampleInput" placeholder="Masukan Password Lama">
                    <input type="hidden" name="passwordlama1" class="form-control" id="formGroupExampleInput" value="<?php echo $data["PASSWORD"]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Password Baru</label>
                    <input type="password" name="passwordbaru" class="form-control" id="formGroupExampleInput2" placeholder="Masukan Password Baru">
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Konfirmasi Password</label>
                    <input type="password" name="passwordbaru1" class="form-control" id="formGroupExampleInput2" placeholder="Konfirmasi Password Baru">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah1" class="btn btn-primary">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- modal edit foto -->
      <div class="modal fade" id="exampleModalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalFoto" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalFoto">Ubah Foto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="formGroupExampleInput">Pilih Foto</label>
                <input type="file" name="foto" class="form-control" id="formGroupExampleInput">
                <input type="hidden" name="username" class="form-control" id="formGroupExampleInput" value="<?php echo $username ?>">
              </div>
              <div class="alert alert-success" role="alert">
                Upload Foto yang bertipe .JPG .JPEG .PNG
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" name="ubahfoto" class="btn btn-primary">Ubah</button>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>


      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Nursery Polije 2020</span>
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
          <div class="modal-body">Klik "Logout" Jika Anda Ingin Keluar Dari Halaman Ini.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../logout.php">Logout</a>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
      function loadDoc() {
        setInterval(function() {

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("counterkr").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "counterkritik.php", true);
          xhttp.send();

        }, 1000);

      }
      loadDoc();
    </script>


    <!-- Counter Tagihan AJAX -->
    <script type="text/javascript">
      function loadDoc() {
        setInterval(function() {

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("counterth").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "countertagihan.php", true);
          xhttp.send();

        }, 1000);

      }
      loadDoc();
    </script>

</body>

</html>