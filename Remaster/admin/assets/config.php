<?php
$koneksi = mysqli_connect("localhost","root","","poltek_nursery");


function query($query)
{
    global $koneksi;
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) )
        {
            $rows[] = $row;
        }
        return $rows;
}

function tambahbunga($data){
    global $koneksi;
    $idBunga = htmlspecialchars($data["idBunga"]);
    $namaBunga = htmlspecialchars($data["namaBunga"]);
    $kategoriBunga = htmlspecialchars($data["kategoriBunga"]);
    $hargaBunga = htmlspecialchars($data["hargaBunga"]);
    $stokBunga = htmlspecialchars($data["stokBunga"]);
    $fotoBunga = htmlspecialchars($data["fotoBunga"]);
    $videoBunga = htmlspecialchars($data["videoBunga"]);
    $caraPerawatan = htmlspecialchars($data["caraPerawatan"]);
    $deskripsiBunga = htmlspecialchars($data["deskripsiBunga"]);

    
    $q_bung = mysqli_query($koneksi, "INSERT INTO bunga VALUES ('$idBunga', '$kategoriBunga', '$namaBunga', '$hargaBunga', '$stokBunga', '$fotoBunga', '$videoBunga', '$caraPerawatan', '$deskripsiBunga')") or die(mysqli_error($koneksi));
    // echo "INSERT INTO bunga VALUES ('$idbunga', '$namabunga', '$harga', '$stok', 'FOTO_BUNGA', '$videobunga', '$caraperawatan', '$deskripsibunga')";
    return $q_bung;
}

function tambahkategori($data){
    global $koneksi;
    $idKategori = htmlspecialchars($data["idKategori"]);
    $namaKategori = htmlspecialchars($data["namaKategori"]);
    $deskripsiKategori = htmlspecialchars($data["deskripsiKategori"]);
    $fotoKategori = htmlspecialchars($data["fotoKategori"]);

    $q_kat = mysqli_query ($koneksi, "INSERT INTO kategori VALUES ('$idKategori', '$namaKategori', '$deskripsiKategori', '$fotoKategori')") or die(mysqli_error($koneksi));
    return $q_kat;
}

function tambahkaryawan($data){
    global $koneksi;
    $usernameKaryawan = htmlspecialchars($data["usernameKaryawan"]);
    $namaKaryawan = htmlspecialchars($data["namaKaryawan"]);
    $alamatKaryawan = htmlspecialchars($data["alamatKaryawan"]);
    $nomorTelponKaryawan = htmlspecialchars($data["nomorTelponKaryawan"]);
    $emailKaryawan = htmlspecialchars($data["emailKaryawan"]);
    $passwordKaryawan = htmlspecialchars($data["passwordKaryawan"]);

    $q_kar = mysqli_query ($koneksi, "INSERT INTO user VALUES ('$usernameKaryawan', 'SU02', '$namaKaryawan', '$alamatKaryawan', '$nomorTelponKaryawan', '$emailKaryawan', '$passwordKaryawan', '')") or die(mysqli_error($koneksi));
    return $q_kar;
}
?>