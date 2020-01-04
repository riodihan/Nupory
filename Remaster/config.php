<?php

$koneksi = mysqli_connect("localhost", "root", "", "poltek_nursery");


//proses register

function pendaftaran($data)
{
    global $koneksi;
    $id_user = htmlspecialchars($data["id_user"]);
    $id_status = htmlspecialchars($data["id_status"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nohp = htmlspecialchars($data["nohp"]);
    $email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars(strtolower(stripslashes($data["username"])));
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
    //mysqli_query($koneksi, "INSERT INTO pelanggan VALUES ('', '$nama', '$alamat', '$nohp', '$email', '$username', '$password')");
    $qu = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id_user', '$id_status', '$nama', '$alamat', '$nohp', '$email', '$username', '$password', '')");

    return $qu;
}

// menampilkan data user

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// menampilkan data bunga

function query1($query1)
{
    global $koneksi;
    $result1 = mysqli_query($koneksi, $query1);
    $rows1 = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $rows1[] = $row1;
    }
    return $rows1;
}

//menampilkan data transaksi

function query2($query2)
{
    global $koneksi;
    $result2 = mysqli_query($koneksi, $query2);
    $rows2 = [];
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $rows2[] = $row2;
    }
    return $rows2;
}


//menampilkan transaksi saya(pada user)

function query4($query4)
{
    global $koneksi;
    $result4 = mysqli_query($koneksi, $query4);
    $rows4 = [];
    while ($row4 = mysqli_fetch_assoc($result4)) {
        $rows4[] = $row4;
    }
    return $rows4;
}

//menampilkan kritik

function query3($query3)
{
    global $koneksi;
    $result3 = mysqli_query($koneksi, $query3);
    $rows3 = [];
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $rows3[] = $row3;
    }
    return $rows3;
}

// menampilkan data user

function report($query5)
{
    global $koneksi;
    $result5 = mysqli_query($koneksi, $query5);
    $rows5 = [];
    while ($row5 = mysqli_fetch_assoc($result5)) {
        $rows5[] = $row5;
    }
    return $rows5;
}

//proses tambah karyawan

function tambahkaryawan($tambah)
{
    global $koneksi;
    $id = htmlspecialchars($tambah["id_user"]);
    $id_s = htmlspecialchars($tambah["id_status"]);
    $nama_u = htmlspecialchars($tambah["nama_user"]);
    $alamat_u = htmlspecialchars($tambah["alamat"]);
    $no_telepon = htmlspecialchars($tambah["no_telepon"]);
    $email_u = htmlspecialchars($tambah["email"]);
    $foto_u = htmlspecialchars($tambah["foto"]);
    $u_name = htmlspecialchars(strtolower(stripslashes($tambah["username"])));
    $password_u =  htmlspecialchars(mysqli_real_escape_string($koneksi, $tambah["password"]));
    $konfirmasipassword = htmlspecialchars(mysqli_real_escape_string($koneksi, $tambah["konfirmasipassword"]));

    //cek konfirmasi password
    if ($password_u !== $konfirmasipassword) {
        echo "<script>
                    alert('konfirmasi password salah');
                </script>";

        return false;
    }

    //enkripsi password
    //$password = password_hash($password, PASSWORD_DEFAULT);



    //mendaftarkan akun ke database

    $qu = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id', '$id_s', '$nama_u', '$alamat_u', '$no_telepon', '$email_u', '$u_name', '$password_u', '$foto_u')");

    return $qu;
}


//proses tambah bunga

function tambahbunga($tambah1)
{
    global $koneksi;
    $id_b = htmlspecialchars($tambah1["id_bunga"]);
    $nama_b = htmlspecialchars($tambah1["nama_bunga"]);
    $harga_b = htmlspecialchars($tambah1["harga"]);
    $stok_b = htmlspecialchars($tambah1["stok"]);
    $gambar_b = htmlspecialchars($tambah1["gambar"]);
    $video_b = htmlspecialchars($tambah1["video"]);
    $perawatan_b = htmlspecialchars($tambah1["perawatan"]);


    //menambahkan bunga ke database

    $qu = mysqli_query($koneksi, "INSERT INTO bunga VALUES ('$id_b', '$nama_b', '$harga_b', '$stok_b', '$gambar_b', '$video_b', '$perawatan_b')");

    return $qu;
}


// hapus data user

function hapus($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE FROM user WHERE ID_USER = '$id'");
    return $qu;
}


// hapus data bunga

function hapusbunga($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE FROM bunga WHERE ID_BUNGA = '$id'");
    return $qu;
}

//hapus data transaksi
function hapustransaksi($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE a,b FROM detail_transaksi AS a
    LEFT JOIN transaksi AS b ON b.ID_TRANSAKSI = a.ID_TRANSAKSI
    WHERE a.ID_TRANSAKSI = '$id'");
    return $qu;
}

// menambahkan kritik

function kritik($kr)
{
    global $koneksi;
    $kdkritik = htmlspecialchars($kr["kd_kritik"]);
    $iduser = htmlspecialchars($kr["id_user"]);
    $isikritik = htmlspecialchars($kr["kritik"]);

    $qu = mysqli_query($koneksi, "INSERT INTO kritik VALUES ('$kdkritik', '$iduser', '$isikritik')");
    return $qu;
}


// transaksi

function transaksi($tr)
{
    global $koneksi;
    $id_transaksi = htmlspecialchars($tr["id_transaksi"]);
    $id_pembayaran = htmlspecialchars($tr["metode"]);
    $id_user = htmlspecialchars($tr["id_user"]);
    $id_bunga = htmlspecialchars($tr["id_bunga"]);
    $jumlah = htmlspecialchars($tr["jumlah"]);
    // $tanggal = htmlspecialchars($tr["tanggal"]);
    $alamat = htmlspecialchars($tr["alamat"]);
    $total = htmlspecialchars($tr["total"]);

    $trs = mysqli_query($koneksi, "INSERT INTO keranjang VALUES ('$id_transaksi', '$id_pembayaran', '$id_user', '$id_bunga', '$jumlah', now(), '$alamat', '$total', '')");


    return $trs;
}

// menampilkan data user

function profil($profil)
{
    global $koneksi;
    $pr = mysqli_query($koneksi, $profil);
    $rows5 = [];
    while ($row5 = mysqli_fetch_assoc($pr)) {
        $rows5[] = $row5;
    }
    return $rows5;
}

// // ubah Profile 

function ubahprofile($ubah)
{
    global $koneksi;
    $id = ($ubah["id"]);
    $nama = htmlspecialchars($ubah["nama"]);
    $alamat = htmlspecialchars($ubah["alamat"]);
    $no = htmlspecialchars($ubah["NO_TELEPON"]);
    $email = htmlspecialchars($ubah["EMAIL"]);
    // $foto = htmlspecialchars($ubah["foto"]);

    $qu = mysqli_query($koneksi, "UPDATE user SET 
                NAMA_USER = '$nama', 
                ALAMAT = '$alamat', 
                NO_TELEPON = '$no', 
                EMAIL = '$email'
         
                WHERE ID_USER = '$id'");
    return $qu;
}

//proses edit bunga

function editbunga($editbunga)
{
    global $koneksi;

    $id_bunga = ($editbunga["id_bunga"]);
    $nama_bunga = htmlspecialchars($editbunga["nama_bunga"]);
    $harga = htmlspecialchars($editbunga["harga"]);
    $stok = htmlspecialchars($editbunga["stok"]);
    $gambar = htmlspecialchars($editbunga["gambar"]);
    $video = htmlspecialchars($editbunga["video"]);
    $perawatan = htmlspecialchars($editbunga["perawatan"]);


    $qu = mysqli_query($koneksi, "UPDATE bunga SET
                    ID_BUNGA = '$id_bunga',
                    NAMA_BUNGA = '$nama_bunga',
                    HARGA = '$harga',
                    STOK = '$stok',
                    FOTO_BUNGA = '$gambar',
                    VIDEO_BUNGA = '$video',
                    CARA_PERAWATAN = '$perawatan'
                  WHERE id_bunga = '$id_bunga'");

    return $qu;
}

//proses edit bunga

function uploadpembayaran($up)
{
    global $koneksi;

    $idtransaksi = ($up["idtransaksi"]);
    $idpembayaran = htmlspecialchars($up["idpembayaran"]);
    $iduser = htmlspecialchars($up["iduser"]);
    $idbunga = htmlspecialchars($up["idbunga"]);
    $jumlah = htmlspecialchars($up["jumlah"]);
    $tanggal = htmlspecialchars($up["tanggal"]);
    $alamat = htmlspecialchars($up["alamat"]);
    $total = htmlspecialchars($up["total"]);
    $Bukti = htmlspecialchars($up["Bukti"]);


    $qu = mysqli_query($koneksi, "UPDATE keranjang SET
                    ID_TRANSAKSI = '$idtransaksi',
                    ID_PEMBAYARAN = '$idpembayaran',
                    ID_USER = '$iduser',
                    ID_BUNGA = '$idbunga',
                    JUMLAH = '$jumlah',
                    TGL_TRANSAKSI = '$tanggal',
                    DETAIL_ALAMAT = '$alamat',
                    TOTAL_AKHIR = '$total',
                    BUKTI_PEMBAYARAN = '$Bukti'
                WHERE ID_TRANSAKSI = '$idtransaksi'");

    return $qu;
}

//karyawan menyetujui
function setujuipesanan($tr)
{
    global $koneksi;
    $idtransaksi = htmlspecialchars($tr["idtransaksi"]);
    $idpembayaran = htmlspecialchars($tr["idpembayaran"]);
    $iduser = htmlspecialchars($tr["iduser"]);
    $tanggal = htmlspecialchars($tr["tanggal"]);
    $alamat = htmlspecialchars($tr["alamat"]);
    $total = htmlspecialchars($tr["total"]);
    $status = htmlspecialchars($tr["status"]);

    $trs = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('$idtransaksi', '$idpembayaran', '$iduser', '$tanggal', '$alamat', '$total', '$status')");


    return $trs;
}

//detail transaksi 

function detail($detail)
{
    global $koneksi;
    $id_bunga = htmlspecialchars($detail["idbunga"]);
    $id_transaksi = htmlspecialchars($detail["idtransaksi"]);
    $jumlah = htmlspecialchars($detail["jumlah"]);


    $de = mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES('$id_transaksi', '$id_bunga', '$jumlah')");
    return $de;
}

// hapus data pemesanan

function hapuspemesanan($id)
{
    global $koneksi;
    $qu = mysqli_query($koneksi, "DELETE FROM keranjang WHERE ID_TRANSAKSI = '$id'");
    return $qu;
}

//report

function tanggal($keyword)
{
    $query = "SELECT * FROM TRANSAKSI 
                    inner join detail_transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
                    inner join user on transaksi.id_user = user.id_user
                    inner join bunga on detail_transaksi.id_bunga = bunga.id_bunga
                WHERE 
                TGL_TRANSAKSI LIKE '%$keyword%'
    
                
                ";
    return query($query);
}

// // ubah password 

function ubahpassword($ubahpass)
{
    global $koneksi;
    $id = ($ubahpass["id"]);
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
                WHERE ID_USER = '$id'");
    return $qu;
}
