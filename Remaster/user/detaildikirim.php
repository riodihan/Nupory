<?php
session_start();
require 'assets/config.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi
                        inner join detail_transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
                        inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                        WHERE transaksi.ID_STATUS_TRANSAKSI = 04 && transaksi.ID_TRANSAKSI = '$id'
                            
                            ");
    $total = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE ID_STATUS_TRANSAKSI = 04 && transaksi.ID_TRANSAKSI = '$id'");

    foreach ($sql as $data) { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sql as $data) { ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><?= $data["NAMA_BUNGA"] ?></td>
                        <td><?= $data["JUMLAH"] ?></td>
                        <td>Rp. <?= $data["HARGA"] ?></td>
                        <td>Rp. <?= $data["TOTAL_HARGA"] ?></td>
                    </tr>
                <?php } ?>
                <?php foreach ($total as $data) { ?>
                    <tr>
                        <td colspan="4">Jumlah Total</td>
                        <td>Rp. <?= $data["TOTAL_AKHIR"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
<?php

    }
}
?>