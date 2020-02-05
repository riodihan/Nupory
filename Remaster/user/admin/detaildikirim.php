<?php
session_start();
require 'assets/config.php';

if(isset($_POST["update"])){

  //apakah data berhasil diubah
  if(updateTransaksi05($_POST) > 0){
    echo "<script>
            alert('Data berhasil diedit!');
            document.location.href = 'tagihan.php';
          </script> ";
  } else {
    echo "<script>
            alert('Data gagal diedit!');
            document.location.href = 'tagihan.php';
          </script>";
  }
}

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id 
    $hasil = mysqli_query($koneksi, "SELECT * FROM transaksi, detail_transaksi, bunga
                                    WHERE ID_STATUS_TRANSAKSI = 04
                                    && transaksi.ID_TRANSAKSI = '$id'
                                    && detail_transaksi.ID_TRANSAKSI = '$id'
                                    && bunga.ID_BUNGA = detail_transaksi.ID_BUNGA");
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi
                                    WHERE ID_STATUS_TRANSAKSI = 04
                                    && transaksi.ID_TRANSAKSI = '$id'");
    $total = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI = 04 && transaksi.ID_TRANSAKSI = '$id'");

    ?>
    <?php foreach ($sql as $data) { ?>
    <div class="row">
        <div class="col-md-6">
            <p>Id Transaksi : <?= $data["ID_TRANSAKSI"]; ?></p>
        </div>
        <div class="col-md-6">
            <p>Tgl Transaksi : <?= $data["TGL_TRANSAKSI"]; ?></p>
        </div>
    </div>
    <?php } ?>
    
    <table class="table table-bordered" id="dataTable" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Beli</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($hasil as $data) { ?>
                    <tr>
                        <td><?= $data["NAMA_BUNGA"] ?></td>
                        <td><?= $data["JUMLAH"] ?></td>
                        <td>Rp. <?= $data["TOTAL_HARGA"] ?></td>
                    </tr>
                <?php } ?>
                <?php foreach ($total as $data) { ?>
                    <tr>
                        <td colspan="2">Jumlah Total</td>
                        <td>Rp. <?= $data["TOTAL_AKHIR"] ?></td>
                    </tr>
                <?php } ?>
        </tbody>
        </table>
    <?php foreach ($sql as $row) { ?>
        <form action="" method="POST" class="card-body">
                  <input type="hidden" name="idTransaksi" id="idTransaksi" value="<?= $row["ID_TRANSAKSI"]; ?>" class="form-control">
                  <input type="hidden" name="idPembayaran" id="idPembayaran" value="<?= $row["ID_PEMBAYARAN"]; ?>"class="form-control">
                  <input type="hidden" name="tglTransaksi" id="tglTransaksi" value="<?= $row["TGL_TRANSAKSI"]; ?>" class="form-control">
                  <input type="hidden" name="username" id="username" value="<?= $row["USERNAME"]; ?>" class="form-control">
                  <input type="hidden" name="detailAlamat" id="detailAlamat" value="<?= $row["DETAIL_ALAMAT"]; ?>" class="form-control">
                  <input type="hidden" name="totalAkhir" id="totalAkhir" value="<?= $row["TOTAL_AKHIR"]; ?>" class="form-control">
                  <input type="hidden" name="buktiPembayaran" id="buktiPembayaran" value="<?= $row["BUKTI_PEMBAYARAN"]; ?>" class="form-control">

                  <div class="col">
                    <div class="form-group text-center">
                      <label for="idStatusTransaksi">Ubah Status Transaksi</label>
                        <select name="idStatusTransaksi" id="idStatusTransaksi" class="form-control" required>
                        <option value="">-- Pilih Aksi --</option>    
                        <option value="04">Abaikan</option>
                        <option value="05">Terkirim</option>
                        </select>
                    </div>
                  </div>
                <div class="col text-center">
                    <button type="submit" name="update" class="btn btn-primary">Konfirmasi</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                </div>
        </form>

<?php

    }
}
?>