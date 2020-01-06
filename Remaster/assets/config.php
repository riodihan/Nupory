<?php
$koneksi = mysqli_connect("localhost","root","","poltek_nursery");



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
?>