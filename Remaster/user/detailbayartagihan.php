<?php
session_start();
require 'assets/config.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi
                        inner join detail_transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
                        inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                        WHERE transaksi.ID_STATUS_TRANSAKSI = 02 && transaksi.ID_TRANSAKSI = '$id'
                            
                        ");
    $total = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI = 02 && transaksi.ID_TRANSAKSI = '$id'");

     ?>

        <?php foreach ($total as $data) { ?>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    Silahkan Melakukan Pembayaran sebesar Rp. <?= $data["TOTAL_AKHIR"] ?> ke rekening 201050851 BCA atas nama Idris.
                    Lalu unggah foto pembayaran anda dibawah sebagai bukti.
                </div>
            </div>

            <form action='' method="POST" enctype="multipart/form-data">
                <div class="form-group container">
                    <label for="exampleFormControlFile">Unggah foto pembayaran disini</label>
                    <input name="idtransaksi" value="<?= $data["ID_TRANSAKSI"] ?>" type="hidden" class="form-control-file" id="exampleFormControlFile1">
                    <input name="bukti" type="file" class="form-control-file" id="exampleFormControlFile1" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        <?php } ?>



<?php

    }

?>