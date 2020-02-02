<?php
session_start();
require 'assets/config.php';

if(isset($_POST["update"])){

  //apakah data berhasil diubah
  if(updateTransaksi03($_POST) > 0){
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
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi 
                                    WHERE ID_STATUS_TRANSAKSI = 02 && ID_TRANSAKSI = '$id'");

    foreach ($sql as $row) { ?>
        <form action="" method="POST" class="card-body">
                  <input type="hidden" name="idTransaksi" id="idTransaksi" value="<?= $row["ID_TRANSAKSI"]; ?>" class="form-control">
                  <input type="hidden" name="idPembayaran" id="idPembayaran" value="<?= $row["ID_PEMBAYARAN"]; ?>"class="form-control">
                  <input type="hidden" name="tglTransaksi" id="tglTransaksi" value="<?= $row["TGL_TRANSAKSI"]; ?>" class="form-control">
                  <input type="hidden" name="username" id="username" value="<?= $row["USERNAME"]; ?>" class="form-control">
                  <input type="hidden" name="detailAlamat" id="detailAlamat" value="<?= $row["DETAIL_ALAMAT"]; ?>" class="form-control">
                  <input type="hidden" name="totalAkhir" id="totalAkhir" value="<?= $row["TOTAL_AKHIR"]; ?>" class="form-control">
                  <input type="hidden" name="buktiPembayaran" id="buktiPembayaran" value="<?= $row["BUKTI_PEMBAYARAN"]; ?>"class="form-control">
                
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="buktiPembayaran">Bukti Pembayaran</label> <br>
                      <img src="../user/images/<?= $row["BUKTI_PEMBAYARAN"]?>" alt="Masih Blm Upload" width="400px">
                    </div>
                  </div>

                  <div class="col">
                    <div class="form-group text-center">
                      <label for="idStatusTransaksi">Ubah Status Transaksi</label>
                        <select name="idStatusTransaksi" id="idStatusTransaksi" class="form-control" required>
                        <option value="">-- Pilih Aksi --</option>    
                        <option value="02">Abaikan</option>
                        <option value="03">Setujui</option>
                        </select>
                    </div>
                  </div>
                <div class="col text-center">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                </div>
        </form>
<?php

    }
}
?>