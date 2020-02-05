<?php 
session_start();
require 'assets/config.php';
// $idBunga = $_GET["edit"];

// //query data bunga berdasarkan id
// $dataBunga = query("SELECT * FROM bunga WHERE ID_BUNGA='$idBunga'")[0];
$username = $_SESSION["username"];
$user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' ");
$hasil = mysqli_query($koneksi, "SELECT * FROM kategori");
$hasil1 = mysqli_query($koneksi, "SELECT * FROM kategori");
$kritik = mysqli_query($koneksi, "SELECT * FROM kritik WHERE ID_STATUS_KRITIK = '01' ");
$tagihan = mysqli_query($koneksi, "SELECT * FROM Transaksi WHERE ID_STATUS_TRANSAKSI = '02' ");

//cek sudah ditekan apa blm
if (isset($_POST["submit"])) {

  //apakah data berhasil diubah
  if (editkategori($_POST) > 0) {
    echo "<script>
              alert('Data berhasil diedit!');
              document.location.href = 'editkategori.php';
            </script> ";
  } else {
    echo "<script>
              alert('Data gagal diedit!');
              document.location.href = 'editkategori.php';
            </script>";
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

  <title>Edit Kategori Bunga</title>
  <link rel="icon" href="bunga.png" type="image/x-icon">

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
        <div class="sidebar-brand-text mx-3"><?php if ($_SESSION['id_status'] == "01") {
                                                echo "Admin";
                                              } elseif ($_SESSION['id_status'] == "02") {
                                                echo "Karyawan";
                                              } ?><br> Nursery Polije</div>
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

            <a class="collapse-item" href="tagihan.php">
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
              <a class="collapse-item" href="editkaryawan.php">
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

          <!-- DataTales Example -->
          <div class="row">
            <div class="col-md-8">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kategori Bunga Nursery Polije</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Tindakan</th>
                          <th>Nama kategori</th>
                          <th>Deskripsi Kategori</th>
                          <th>Foto Deskripsi</th>
                          <!-- <th>Deskripsi</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = mysqli_fetch_assoc($hasil)) : ?>
                          <tr>
                            <td>
                              <a href="editkategori.php?edit=<?php echo $row["ID_KATEGORI"]; ?>" class="btn btn-primary" style="width: 40px;"><i class="fas fa-edit"></i></a>
                              <a href="hapuskategori.php?id=<?= $row["ID_KATEGORI"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                            <td><?php echo $row["NAMA_KATEGORI"] ?></td>
                            <td><?php echo $row["DESKRIPSI"] ?></td>
                            <td><?php echo $row["GAMBAR_KATEGORI"] ?></td>
                          </tr>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div> <!-- col -->


            <?php
            if(isset($_GET["edit"])){
              $idKategori = $_GET["edit"];
              //query data bunga berdasarkan id
              $dataKategori = query("SELECT * FROM kategori WHERE ID_KATEGORI='$idKategori'")[0];
            }

            if (isset($idKategori)) { ?>
              <div class="col-md-4">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Edit Data</h6>
                  </div>

                  <form action="" method="POST" class="card-body">
                    <input type="hidden" name="idKategori" id="idKategori" value="<?php echo $dataKategori["ID_KATEGORI"]; ?>">
                      <div class="form-group">
                        <label for="namaKategori">Nama Kategori </label>
                        <input type="text" name="namaKategori" id="namaKategori" class="form-control" value="<?php echo $dataKategori["NAMA_KATEGORI"]; ?>">
                      </div>
                    <div class="form-group">
                      <label for="deskripsiKategori">Deskripsi Kategori</label>
                      <input type="text" name="deskripsiKategori" id="deskripsiKategori" class="form-control" value="<?php echo $dataKategori["DESKRIPSI"]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="fotoKategori">Foto Bunga</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="fotoKategori" class="custom-file-input" id="inputGroupFile01" aria-describedby="fotoKategori" value="<?php echo $dataKategori["GAMBAR_KATEGORI"]; ?>">
                          <label class="custom-file-label" for="fotoKategori">Pilih foto</label>
                        </div>
                      </div>
                    </div>
                    <div class="col text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Edit Kategori</button>
                    </div>
                  </form>
                </div>
              </div> <!-- col -->
            <?php } ?>









          </div> <!-- Row -->

        </div>

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
  
  <!-- Nama Muncul -->
  <script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

  <!-- Counter Kritik AJAX -->
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