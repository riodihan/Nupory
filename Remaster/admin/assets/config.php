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
    //upload foto
    $fotoBunga = upload();
    if (!$fotoBunga) {
        return false;
    }
    // $fotoBunga = htmlspecialchars($data["fotoBunga"]);
    $videoBunga = htmlspecialchars($data["videoBunga"]);
    $caraPerawatan = htmlspecialchars($data["caraPerawatan"]);
    $deskripsiBunga = htmlspecialchars($data["deskripsiBunga"]);

    
    $q_bung = mysqli_query($koneksi, "INSERT INTO bunga VALUES ('$idBunga', '$kategoriBunga', '$namaBunga', '$hargaBunga', '$stokBunga', '$fotoBunga', '$videoBunga', '$caraPerawatan', '$deskripsiBunga')") or die(mysqli_error($koneksi));
    // echo "INSERT INTO bunga VALUES ('$idbunga', '$namabunga', '$harga', '$stok', 'FOTO_BUNGA', '$videobunga', '$caraperawatan', '$deskripsibunga')";
    return $q_bung;
}

function upload()  {
    $namaFile = $_FILES['fotoBunga']['name'];
    $ukuranFile = $_FILES['fotoBunga']['size'];
    $error = $_FILES['fotoBunga']['error'];
    $tmpName = $_FILES['fotoBunga']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload

    if ($error === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
              document.location.href = '';
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
              document.location.href = '';
            </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1500000) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
              document.location.href = '';
            </script>";
        return false; 
    }
    //gambar siap diupload
    //generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;


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

    $q_kar = mysqli_query ($koneksi, "INSERT INTO user VALUES ('$usernameKaryawan', '02', '$namaKaryawan', '$alamatKaryawan', '$nomorTelponKaryawan', '$emailKaryawan', '$passwordKaryawan', '')") or die(mysqli_error($koneksi));
    return $q_kar;
}

function editbunga($data){
    global $koneksi;
    $idBunga = $data["idBunga"];
    $namaBunga = htmlspecialchars($data["namaBunga"]);
    $kategoriBunga = htmlspecialchars($data["kategoriBunga"]);
    $hargaBunga = htmlspecialchars($data["hargaBunga"]);
    $stokBunga = htmlspecialchars($data["stokBunga"]);
    $fotoBunga = htmlspecialchars($data["fotoBunga"]);
    $videoBunga = htmlspecialchars($data["videoBunga"]);
    $caraPerawatan = htmlspecialchars($data["caraPerawatan"]);
    $deskripsiBunga = htmlspecialchars($data["deskripsiBunga"]);

    $query = "UPDATE bunga SET
                ID_KATEGORI = '$kategoriBunga',
                NAMA_BUNGA = '$namaBunga',
                HARGA = '$hargaBunga',
                STOK = '$stokBunga',
                FOTO_BUNGA = '$fotoBunga',
                VIDEO_BUNGA = '$videoBunga',
                CARA_PERAWATAN = '$caraPerawatan',
                DESKRIPSI = '$deskripsiBunga'
            WHERE ID_BUNGA = '$idBunga'
                ";
    $q_bung = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return $q_bung;
}

function kirimBunga($data){
    global $koneksi;
    $idTransaksi= $data["id1"];

    $query = "UPDATE transaksi SET ID_STATUS_TRANSAKSI='04' WHERE ID_TRANSAKSI='$idTransaksi'";
    $kirim = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return $kirim;
}

function editbunga1($data){
    global $koneksi;
    $idBunga = $data["id1"];
    $namaBunga = htmlspecialchars($data["namaBunga1"]);
    $kategoriBunga = htmlspecialchars($data["idKategori1"]);
    $hargaBunga = htmlspecialchars($data["hargaBunga1"]);
    $stokBunga = htmlspecialchars($data["stokBunga1"]);
    $fotoBunga = htmlspecialchars($data["fotoBunga1"]);
    $videoBunga = htmlspecialchars($data["videoBunga1"]);
    $caraPerawatan = htmlspecialchars($data["caraPerawatan1"]);
    $deskripsiBunga = htmlspecialchars($data["deskripsiBunga1"]);

    $query = "UPDATE bunga SET
                ID_KATEGORI = '$kategoriBunga',
                NAMA_BUNGA = '$namaBunga',
                HARGA = '$hargaBunga',
                STOK = '$stokBunga',
                FOTO_BUNGA = '$fotoBunga',
                VIDEO_BUNGA = '$videoBunga',
                CARA_PERAWATAN = '$caraPerawatan',
                DESKRIPSI = '$deskripsiBunga'
            WHERE ID_BUNGA = '$idBunga' ";
    $q_bung = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return $q_bung;
}

function updateTransaksi03($data){
    global $koneksi;
    $idTransaksi = $data["idTransaksi"];
    $idPembayaran = htmlspecialchars($data["idPembayaran"]);
    $tglTransaksi = htmlspecialchars($data["tglTransaksi"]);
    $username = htmlspecialchars($data["username"]);
    $detailAlamat = htmlspecialchars($data["detailAlamat"]);
    $totalAkhir = htmlspecialchars($data["totalAkhir"]);
    $buktiPembayaran = htmlspecialchars($data["buktiPembayaran"]);
    $idStatusTransaksi = htmlspecialchars($data["idStatusTransaksi"]);

    $query = "UPDATE transaksi SET
                ID_PEMBAYARAN = '$idPembayaran',
                TGL_TRANSAKSI = '$tglTransaksi',
                USERNAME = '$username',
                DETAIL_ALAMAT = '$detailAlamat',
                TOTAL_AKHIR = '$totalAkhir',
                BUKTI_PEMBAYARAN = '$buktiPembayaran',
                ID_STATUS_TRANSAKSI = '$idStatusTransaksi'
              WHERE ID_TRANSAKSI = '$idTransaksi' ";

    $u_tr = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
    return $u_tr;
}

?>