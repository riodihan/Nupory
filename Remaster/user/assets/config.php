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

    $qu = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('$idtransaksi', '$idpembayaran', '$idstatustransaksi', '$username', now(), '', '')");

    return $qu;
}

//detail keranjang
function detail_keranjang($detail)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($detail["idtransaksi"]);
    $idbunga = htmlspecialchars($detail["idbunga"]);
    $statusdetailtransaksi = htmlspecialchars($detail["statusdetailtransaksi"]);
    $jumlah = htmlspecialchars($detail["jumlah"]);
    $totalharga = htmlspecialchars($detail["totalharga"]);

    $qu = mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES ('', '$idtransaksi', '$idbunga', '$statusdetailtransaksi  ', '$jumlah', '$totalharga')");

    return $qu;
}


?>