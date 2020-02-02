<?php
$koneksi = mysqli_connect("localhost", "root", "", "poltek_nursery");



//registrasi
function pendaftaran($data)
{
    global $koneksi;
    $iduser = htmlspecialchars($data["iduser"]);
    $idstatus = htmlspecialchars($data["idstatus"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nohp = htmlspecialchars($data["nohp"]);
    $email = htmlspecialchars($data["email"]);
    $password =  htmlspecialchars(mysqli_real_escape_string($koneksi, $data["password"]));
    $konfirmasi = htmlspecialchars(mysqli_real_escape_string($koneksi, $data["konfirmasi"]));


    //cek konfirmasi password
    if ($password !== $konfirmasi) {
        echo "<script>
                    alert('konfirmasi password salah');
                </script>";

        return false;
    }

    //enkripsi password
    //$password = password_hash($password, PASSWORD_DEFAULT);

    //mendaftarkan akun ke database
    $qu = mysqli_query($koneksi, "INSERT INTO user VALUES ('$iduser', '$idstatus', '$nama', '$alamat', '$nohp', '$email', '$password', '')");

    return $qu;
}

// // ubah password 

function ubahpassword($ubahpass)
{
    global $koneksi;
    $username = htmlspecialchars($ubahpass["username"]);
    $passwordlama = htmlspecialchars($ubahpass["passwordlama"]);
    $passwordlama1 = htmlspecialchars($ubahpass["passwordlama1"]);
    $password = htmlspecialchars($ubahpass["passwordbaru"]);
    $password1 = htmlspecialchars($ubahpass["passwordbaru1"]);

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


// // ubah biodata 

function ubahbiodata($ubahbio)
{
    global $koneksi;
    $username = htmlspecialchars($ubahbio["username"]);
    $nama = htmlspecialchars($ubahbio["nama"]);
    $email = htmlspecialchars($ubahbio["email"]);
    $alamat = htmlspecialchars($ubahbio["alamat"]);
    $nohp = htmlspecialchars($ubahbio["nohp"]);


    $qu = mysqli_query($koneksi, "UPDATE user SET 
                
                NAMA_USER = '$nama',
                EMAIL = '$email',
                ALAMAT = '$alamat',
                NO_TELEPON = '$nohp'

                WHERE USERNAME = '$username'");
    return $qu;
}

//keranjang
function keranjang($keranjang)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($keranjang["idtransaksi"]);
    $idpembayaran = htmlspecialchars($keranjang["idpembayaran"]);
    $username = htmlspecialchars($keranjang["username"]);
    $idstatustransaksi = htmlspecialchars($keranjang["idstatustransaksi"]);

    $qu = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('$idtransaksi', '$idpembayaran', '$idstatustransaksi', '$username', now(), '', '', '')");

    return $qu;
}

//detail keranjang
function detail_keranjang($detail)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($detail["idtransaksi"]);
    $idbunga = htmlspecialchars($detail["idbunga"]);
    $idstatustransaksi = htmlspecialchars($detail["idstatustransaksi"]);
    $jumlah = htmlspecialchars($detail["jumlah"]);
    $totalharga = htmlspecialchars($detail["totalharga"]);

    $qu = mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES ('', '$idtransaksi', '$idbunga', '$jumlah', '$totalharga')");

    return $qu;
}

//tagihan
function tagihan($tagihan)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($tagihan["idtransaksi"]);
    $idpembayaran = htmlspecialchars($tagihan["idpembayaran"]);
    $idstatustransaksi = htmlspecialchars($tagihan["idstatustransaksi"]);
    $detailalamat = htmlspecialchars($tagihan["detailalamat"]);


    $qu = mysqli_query($koneksi, "UPDATE transaksi SET 
                
                ID_PEMBAYARAN = '$idpembayaran',
                ID_STATUS_TRANSAKSI = '$idstatustransaksi',
                TGL_TRANSAKSI = now(),
                DETAIL_ALAMAT = '$detailalamat'

                WHERE ID_TRANSAKSI = '$idtransaksi'");
    return $qu;
}


//upload bukti
function upload($upload)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($upload["idtransaksi"]);
    $bukti = uploadBukti();
    if (!$bukti) {
        return false;
    }

    // $bukti = htmlspecialchars($upload["bukti"]);

    $qu = mysqli_query($koneksi, "UPDATE transaksi SET 
                BUKTI_PEMBAYARAN = '$bukti'

                WHERE ID_TRANSAKSI = '$idtransaksi'");
    return $qu;
}

function uploadBukti()  {
    $namaFile = $_FILES['bukti']['name'];
    $ukuranFile = $_FILES['bukti']['size'];
    $error = $_FILES['bukti']['error'];
    $tmpName = $_FILES['bukti']['tmp_name'];

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

    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);

    return $namaFileBaru;


}


function hapuskeranjang($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE ID_DETAIL_TRANSAKSI = '$id'");
    return $qu;
}

//detail keranjang
function kritik($kritik)
{
    global $koneksi;
    $idkritik = htmlspecialchars($kritik["idkritik"]);
    $username = htmlspecialchars($kritik["username"]);
    $idstatuskritik = htmlspecialchars($kritik["idstatuskritik"]);
    $isikritik = htmlspecialchars($kritik["isikritik"]);

    $qu = mysqli_query($koneksi, "INSERT INTO kritik VALUES ('$idkritik', '$username', '$idstatuskritik', '$isikritik')");

    return $qu;
}



?>