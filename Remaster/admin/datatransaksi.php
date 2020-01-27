<?php 
session_start();
require 'assets/config.php';

$hasil = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI = '03'");

$hasil1 = mysqli_query($koneksi, "SELECT transaksi.ID_TRANSAKSI, TGL_TRANSAKSI, JENIS_PEMBAYARAN, NAMA_USER, DETAIL_ALAMAT, TOTAL_AKHIR
FROM transaksi, user, pembayaran
WHERE transaksi.USERNAME = user.USERNAME
AND transaksi.ID_PEMBAYARAN = pembayaran.ID_PEMBAYARAN
AND transaksi.ID_STATUS_TRANSAKSI='02'
AND user.ID_STATUS='03'");

$gambar = mysqli_query($koneksi, "SELECT BUKTI_PEMBAYARAN FROM transaksi WHERE ID_TRANSAKSI = ");

$hasil2 = mysqli_query ($koneksi, "SELECT * FROM status_transaksi");

$kritik = mysqli_query ($koneksi, "SELECT * FROM kritik WHERE ID_STATUS_KRITIK = '01' ");
$tagihan = mysqli_query($koneksi, "SELECT * FROM Transaksi WHERE ID_STATUS_TRANSAKSI = '02' " );

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Transaksi</title>

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
        }?> <br> Nursery Polije</div>
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
     <? }else{ ?> 
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
      <?php  }else{ ?>
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
      <?php  }else{ ?>
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
                  Message Center
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
                    echo $_SESSION['nama_user'];
                  }elseif ($_SESSION['id_status']=="02") {
                    echo "Karyawan, ";
                    echo $_SESSION['nama_user'];
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
          </div>

        <!-- #############################################################################################
				                              Modal Import (Tambah Bunga)
        ############################################################################################# -->
        <!-- Modal -->
        <div class="modal fade" id="lihatTransaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content col-md-12">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" class="card-body">
                  <input type="hidden" name="idTransaksi" id="idTransaksi" class="form-control">
                  <input type="hidden" name="idPembayaran" id="idPembayaran" class="form-control">
                  <input type="hidden" name="tglTransaksi" id="tglTransaksi" class="form-control">
                  <input type="hidden" name="username" id="username" class="form-control">
                  <input type="hidden" name="detailAlamat" id="detailAlamat" class="form-control">
                  <input type="hidden" name="totalAkhir" id="totalAkhir" class="form-control">
                
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="buktiPembayaran">Bukti Pembayaran</label>
                      <input type="text" name="buktiPembayaran" id="buktiPembayaran" class="form-control" placeholder="Masih Blm Upload">
                      <?php while ($row=mysqli_fetch_assoc($gambar)): ?>
                      <img src="img/<?php echo $row["BUKTI_PEMBAYARAN"];?>" alt="">
                      <?php endwhile;?>
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group text-center">
                      <label for="idStatusTransaksi">Ubah Status Transaksi</label>
                        <select name="idStatusTransaksi" id="idStatusTransaksi" class="form-control" require>
                        <?php while ($row=mysqli_fetch_assoc($hasil2)): ?>
                        <option value="<?php echo $row["ID_STATUS_TRANSAKSI"]?>"><?php echo $row["STATUS_TRANSAKSI"]?></option>
                        <?php endwhile;?>
                        </select>
                    </div>
                  </div>
                <div class="col text-center">
                    <button type="submit" name="updateTransaksi" class="btn btn-primary">Update</button>
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
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Nursery Polije</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal Transaksi</th>
                      <th>Pembayaran</th>
                      <th>Status</th>
                      <th>Nama Pembeli</th>
                      <th>Alamat Pengiriman</th>
                      <th>Total Akhir</th>
                      <th>Bukti Pembayaran</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($_SESSION['id_status']=="01") { ?>
                      <?php while ($row=mysqli_fetch_assoc($hasil)): ?>
                    <tr id="<?php echo $row["ID_TRANSAKSI"];?>">
                      <td data-target="tglTransaksi"><?php echo $row["TGL_TRANSAKSI"]?></td>
                      <td data-target="idPembayaran"><?php echo $row["ID_PEMBAYARAN"]?></td>
                      <td data-target="idStatusTransaksi"><?php echo $row["ID_STATUS_TRANSAKSI"]?></td>
                      <td data-target="username"><?php echo $row["USERNAME"]?></td>
                      <td data-target="detailAlamat"><?php echo $row["DETAIL_ALAMAT"]?></td>
                      <td data-target="totalAkhir"><?php echo $row["TOTAL_AKHIR"]?></td>
                      <td data-target="buktiPembayaran"><?php echo $row["BUKTI_PEMBAYARAN"]?></td>
                      <td>
                      <a class="btn btn-success" href="#" data-role="lihat" data-id=<?php echo $row['ID_TRANSAKSI'];?>>Lihat</i></a>
                      </td>
                    </tr>
                    <?php endwhile;?>
                  <?php  }elseif ($_SESSION['id_status']=="02") { ?>
                    <?php while ($row=mysqli_fetch_assoc($hasil1)): ?>
                    <tr id="<?php echo $row["ID_TRANSAKSI"];?>">
                      <td data-target="tglTransaksi"><?php echo $row["TGL_TRANSAKSI"]?></td>
                      <td data-target="idPembayaran"><?php echo $row["ID_PEMBAYARAN"]?></td>
                      <td data-target="idStatusTransaksi"><?php echo $row["ID_STATUS_TRANSAKSI"]?></td>
                      <td data-target="username"><?php echo $row["USERNAME"]?></td>
                      <td data-target="detailAlamat"><?php echo $row["DETAIL_ALAMAT"]?></td>
                      <td data-target="totalAkhir"><?php echo $row["TOTAL_AKHIR"]?></td>
                      <td data-target="buktiPembayaran"><?php echo $row["BUKTI_PEMBAYARAN"]?></td>
                      <td>
                      <a class="btn btn-success" href="#" data-role="lihat" data-id=<?php echo $row['ID_TRANSAKSI'];?>>Lihat</i></a>
                      </td>
                    </tr>
                    <?php endwhile;?>.
                 <?php } ?>
                     
                  </tbody>
                </table>
                <!-- <a class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print Halaman Ini</a> -->
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
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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

  <!-- Counter Kritik AJAX -->
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
      $(document).on('click', 'a[data-role=lihat]', function(){
        var id = $(this).data('id');
        var idPembayaran = $('#' + id).children('td[data-target=idPembayaran]').text();
        var idStatusTransaksi = $('#' + id).children('td[data-target=idStatusTransaksi]').text();
        var username = $('#' + id).children('td[data-target=username]').text();
        var detailAlamat = $('#' + id).children('td[data-target=detailAlamat]').text();
        var totalAkhir = $('#' + id).children('td[data-target=totalAkhir]').text();
        var buktiPembayaran = $('#' + id).children('td[data-target=buktiPembayaran]').text();

        $('#idTransaksi').val(id);
        $('#idPembayaran').val(idPembayaran);
        $('#idStatusTransaksi').val(idStatusTransaksi);
        $('#tglTransaksi').val(tglTransaksi);
        $('#username').val(username);
        $('#detailAlamat').val(detailAlamat);
        $('#totalAkhir').val(totalAkhir);
        $('#buktiPembayaran').val(buktiPembayaran);
        $('#lihatTransaksi').modal('toggle');
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

</body>

</html>
