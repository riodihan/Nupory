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
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
            </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 2500000) {
        echo "<script>
              alert('ukuran gambar terlalu besar!');
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
    $fotoKategori = uploadKategori();
    if (!$fotoKategori) {
        return false;
    }
    
    // $fotoKategori = htmlspecialchars($data["fotoKategori"]);

    $q_kat = mysqli_query ($koneksi, "INSERT INTO kategori VALUES ('$idKategori', '$namaKategori', '$deskripsiKategori', '$fotoKategori')") or die(mysqli_error($koneksi));
    return $q_kat;
}

function uploadKategori()  {
    $namaFileKategori = $_FILES['fotoKategori']['name'];
    $ukuranFileKategori = $_FILES['fotoKategori']['size'];
    $errorKategori = $_FILES['fotoKategori']['error'];
    $tmpNameKategori = $_FILES['fotoKategori']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload

    if ($errorKategori === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarKategoriValid = ['jpg','jpeg','png'];
    $ekstensiGambarKategori = explode('.', $namaFileKategori);
    $ekstensiGambarKategori = strtolower(end($ekstensiGambarKategori));
    if (!in_array($ekstensiGambarKategori, $ekstensiGambarKategoriValid)) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
            </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFileKategori > 10000000) {
        echo "<script>
              alert('ukuran gambar terlalu besar!');
            </script>";
        return false; 
    }
    //gambar siap diupload
    //generate nama baru
    $namaFileBaruKategori = uniqid();
    $namaFileBaruKategori .= '.';
    $namaFileBaruKategori .= $ekstensiGambarKategori;

    move_uploaded_file($tmpNameKategori, 'img/' . $namaFileBaruKategori);

    return $namaFileBaruKategori;


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

// function editbunga($data){
//     global $koneksi;
//     $idBunga = $data["idBunga"];
//     $namaBunga = htmlspecialchars($data["namaBunga"]);
//     $kategoriBunga = htmlspecialchars($data["kategoriBunga"]);
//     $hargaBunga = htmlspecialchars($data["hargaBunga"]);
//     $stokBunga = htmlspecialchars($data["stokBunga"]);
//     $fotoBunga = htmlspecialchars($data["fotoBunga"]);
//     $videoBunga = htmlspecialchars($data["videoBunga"]);
//     $caraPerawatan = htmlspecialchars($data["caraPerawatan"]);
//     $deskripsiBunga = htmlspecialchars($data["deskripsiBunga"]);

//     $query = "UPDATE bunga SET
//                 ID_KATEGORI = '$kategoriBunga',
//                 NAMA_BUNGA = '$namaBunga',
//                 HARGA = '$hargaBunga',
//                 STOK = '$stokBunga',
//                 FOTO_BUNGA = '$fotoBunga',
//                 VIDEO_BUNGA = '$videoBunga',
//                 CARA_PERAWATAN = '$caraPerawatan',
//                 DESKRIPSI = '$deskripsiBunga'
//             WHERE ID_BUNGA = '$idBunga'
//                 ";
//     $q_bung = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
//     return $q_bung;
// }

function kirimBunga($data){
    global $koneksi;
    $idTransaksi= $data["id1"];

    $query = "UPDATE transaksi SET ID_STATUS_TRANSAKSI='04' WHERE ID_TRANSAKSI='$idTransaksi'";
    $kirim = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return $kirim;
}

function editbunga1($data){
    global $koneksi;
    $idBunga = htmlspecialchars($data["idBunga"]);
    $namaBunga = htmlspecialchars($data["namaBunga"]);
    $kategoriBunga = htmlspecialchars($data["kategoriBunga"]);
    $hargaBunga = htmlspecialchars($data["hargaBunga"]);
    $stokBunga = htmlspecialchars($data["stokBunga"]);
    $fotoBunga = uploadBunga();
    if (!$fotoBunga) {
        return false;
    }
    // $fotoBunga = htmlspecialchars($data["fotoBunga1"]);
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
            WHERE ID_BUNGA = '$idBunga' ";
    $q_bung = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return $q_bung;
}
function uploadBunga()  {
    $namaFile1 = $_FILES['fotoBunga']['name'];
    $ukuranFile1 = $_FILES['fotoBunga']['size'];
    $error1 = $_FILES['fotoBunga']['error'];
    $tmpName1 = $_FILES['fotoBunga']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload

    if ($error1 === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
              document.location.href = '';
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid1 = ['jpg','jpeg','png'];
    $ekstensiGambar1 = explode('.', $namaFile1);
    $ekstensiGambar1 = strtolower(end($ekstensiGambar1));
    if (!in_array($ekstensiGambar1, $ekstensiGambarValid1)) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
              document.location.href = '';
            </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile1 > 10000000) {
        echo "<script>
              alert('ukuran gambar terlalu besar!');
              document.location.href = '';
            </script>";
        return false; 
    }
    //gambar siap diupload
    //generate nama baru
    $namaFileBaru1 = uniqid();
    $namaFileBaru1 .= '.';
    $namaFileBaru1 .= $ekstensiGambar1;

    move_uploaded_file($tmpName1, 'img/' . $namaFileBaru1);

    return $namaFileBaru1;


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

function updateTransaksi05($data){
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
//ubah profile
function ubahprofile($data){
    global $koneksi;
    $username = htmlspecialchars($data["username"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nohp = htmlspecialchars($data["nohp"]);


    $qu = mysqli_query($koneksi, "UPDATE user SET 
                
                NAMA_USER = '$nama',
                EMAIL = '$email',
                ALAMAT = '$alamat',
                NO_TELEPON = '$nohp'

                WHERE USERNAME = '$username'");
    return $qu;
}

//ubah password
function ubahpassword($data)
{
    global $koneksi;
    $username = htmlspecialchars($data["username"]);
    $passwordlama = htmlspecialchars($data["passwordlama"]);
    $passwordlama1 = htmlspecialchars($data["passwordlama1"]);
    $password = htmlspecialchars($data["passwordbaru"]);
    $password1 = htmlspecialchars($data["passwordbaru1"]);

    //cek password lama
    if ($passwordlama !== $passwordlama1) {
        echo "<script>
                alert('password Lama salah');
            </script>";

        return false;
    }


    //cek konfirmasi password
    if ($password !== $password1) {
        echo "<script>
                    alert('konfirmasi password salah');
                </script>";

        return false;
    }

    $qu = mysqli_query($koneksi, "UPDATE user SET 
                
                PASSWORD = '$password1' 
                WHERE USERNAME = '$username'");
    return $qu;
}
function editkategori($data){
    global $koneksi;
    $idKategori = $data["idKategori"];
    $namaKategori= htmlspecialchars($data["namaKategori"]);
    $deskripsiKategori = htmlspecialchars($data["deskripsiKategori"]);
    $fotoKategori = uploadfotokategori();
    if (!$fotoKategori) {
        return false;
    }

    $query = mysqli_query($koneksi, "UPDATE kategori SET
                NAMA_KATEGORI = '$namaKategori',
                DESKRIPSI = '$deskripsiKategori',
                GAMBAR_KATEGORI = '$fotoKategori'
            WHERE ID_KATEGORI = '$idKategori'
            ");
            return $query;
    
}

function uploadfotokategori()  {
    $namaFile2 = $_FILES['foto']['name'];
    $ukuranFile2 = $_FILES['foto']['size'];
    $error2 = $_FILES['foto']['error'];
    $tmpName2 = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload

    if ($error2 === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid2 = ['jpg','jpeg','png'];
    $ekstensiGambar2 = explode('.', $namaFile2);
    $ekstensiGambar2 = strtolower(end($ekstensiGambar2));
    if (!in_array($ekstensiGambar2, $ekstensiGambarValid2)) {
        // echo "<script>
        //       alert('yang anda upload bukan gambar!');
        //     </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile2 > 2500000) {
        // echo "<script>
        //       alert('ukuran gambar terlalu besar!');
        //     </script>";
        return false; 
    }
    //gambar siap diupload
    //generate nama baru
    $namaFileBaru2 = uniqid();
    $namaFileBaru2 .= '.';
    $namaFileBaru2 .= $ekstensiGambar2;

    move_uploaded_file($tmpName2, 'img/' . $namaFileBaru2);
    return $namaFileBaru2;


}




//ubah foto
function uploadfoto($data)
{
    global $koneksi;
    $username = htmlspecialchars($data["username"]);
    $foto = uploadfotoadmin();
    if (!$foto) {
        return false;
    }

    // $bukti = htmlspecialchars($upload["bukti"]);

    $qu = mysqli_query($koneksi, "UPDATE user SET 
                FOTO_USER = '$foto'

                WHERE USERNAME = '$username'");
    return $qu;
}
function uploadfotoadmin()  {
    $namaFile2 = $_FILES['foto']['name'];
    $ukuranFile2 = $_FILES['foto']['size'];
    $error2 = $_FILES['foto']['error'];
    $tmpName2 = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload

    if ($error2 === 4) {
        echo "<script>
              alert('Pilih Gambar Terlebih Dahulu');
            </script>";
            return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid2 = ['jpg','jpeg','png'];
    $ekstensiGambar2 = explode('.', $namaFile2);
    $ekstensiGambar2 = strtolower(end($ekstensiGambar2));
    if (!in_array($ekstensiGambar2, $ekstensiGambarValid2)) {
        echo "<script>
              alert('yang anda upload bukan gambar!');
            </script>";
            return false; 
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile2 > 2500000) {
        echo "<script>
              alert('ukuran gambar terlalu besar!');
            </script>";
        return false; 
    }
    //gambar siap diupload
    //generate nama baru
    $namaFileBaru2 = uniqid();
    $namaFileBaru2 .= '.';
    $namaFileBaru2 .= $ekstensiGambar2;

    move_uploaded_file($tmpName2, 'img/' . $namaFileBaru2);
    return $namaFileBaru2;


}




function hapususer($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE FROM user WHERE USERNAME = '$id'");
    return $qu;
}

//bacakritik
function kritikdibaca($data)
{
    global $koneksi;
    $idkritik = htmlspecialchars($data["idkritik"]);
    $idstatuskritik = htmlspecialchars($data["idstatuskritik"]);

    $qu = mysqli_query($koneksi, "UPDATE kritik SET 
                ID_STATUS_KRITIK = '$idstatuskritik'

                WHERE ID_KRITIK = '$idkritik'");
    return $qu;
}
