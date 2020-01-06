<?php
$koneksi = mysqli_connect("localhost","root","","poltek_nursery");

function tambahbunga($data){
    global $koneksi;
    $idbunga = htmlspecialchars($data["ID_BUNGA"]);
    $namabunga = htmlspecialchars($data["NAMA_BUNGA"]);
    $harga = htmlspecialchars($data["HARGA"]);
    $stok = htmlspecialchars($data["STOK"]);
    $fotobunga = htmlspecialchars($data["FOTO_BUNGA"]);
    $videobunga = htmlspecialchars($data["VIDEO_BUNGA"]);
    $caraperawatan = htmlspecialchars($data["CARA_PERAWATAN"]);
    $deskripsibunga = htmlspecialchars($data["DESKRIPSI"]);

    
    $qu = mysqli_query($koneksi, "INSERT INTO bunga VALUES ('$idbunga', '$namabunga', '$harga', '$stok', '$fotobunga', '$videobunga', '$caraperawatan', '$deskripsibunga')");
    // echo "INSERT INTO bunga VALUES ('$idbunga', '$namabunga', '$harga', '$stok', 'FOTO_BUNGA', '$videobunga', '$caraperawatan', '$deskripsibunga')";
    return $qu;

}
?>