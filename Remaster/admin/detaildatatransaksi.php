<?php
session_start();
require 'assets/config.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id 
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi 
                                    WHERE ID_STATUS_TRANSAKSI = 02 && ID_TRANSAKSI = '$id'");

    foreach ($sql as $row) { ?>
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
                      <img src="../user/images/<?= $row["BUKTI_PEMBAYARAN"]?>" alt="Masih Blm Upload">
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
                    <button type="submit" name="updateTransaksi" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                </div>
        </form>
<?php

    }
}
?>