<?php
    
    $koneksi= mysqli_connect("localhost", "root", "", "poltek_nursery");


    //proses register
    
    function pendaftaran($data) {
        global $koneksi;
        $id_user = htmlspecialchars($data["id_user"]);
        $id_status = htmlspecialchars($data["id_status"]);
        $nama = htmlspecialchars($data["nama"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $nohp = htmlspecialchars($data["nohp"]);
        $email = htmlspecialchars($data["email"]);
        $username = htmlspecialchars(strtolower (stripslashes($data["username"])));
        $password =  htmlspecialchars(mysqli_real_escape_string($koneksi, $data["password"]));
        $konfirmasi = htmlspecialchars(mysqli_real_escape_string($koneksi, $data["konfirmasi"]));


        //cek konfirmasi password
         if($password !== $konfirmasi){
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
    
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result) ){
            $rows[]=$row;
        }
        return $rows;

    }

    // menampilkan data user
    
    function query1($query1){
        global $koneksi;
        $result1 = mysqli_query($koneksi,$query1);
        $rows1 = [];
        while($row1 = mysqli_fetch_assoc($result1) ){
            $rows1[]=$row1;
        }
        return $rows1;

    }



    //proses tambah karyawan
    
    function tambahkaryawan($tambah) {
        global $koneksi;
        $id = htmlspecialchars($tambah["id_user"]);
        $id_s = htmlspecialchars($tambah["id_status"]);
        $nama_u = htmlspecialchars($tambah["nama_user"]);
        $alamat_u = htmlspecialchars($tambah["alamat"]);
        $no_telepon = htmlspecialchars($tambah["no_telepon"]);
        $email_u = htmlspecialchars($tambah["email"]);
        $foto_u = htmlspecialchars($tambah["foto"]);
        $u_name = htmlspecialchars(strtolower (stripslashes($tambah["username"])));
        $password_u =  htmlspecialchars(mysqli_real_escape_string($koneksi, $tambah["password"]));
        $konfirmasipassword = htmlspecialchars(mysqli_real_escape_string($koneksi, $tambah["konfirmasipassword"]));

        //cek konfirmasi password
         if($password_u !== $konfirmasipassword){
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
    
    function tambahbunga($tambah1) {
        global $koneksi;
        $id_b= htmlspecialchars($tambah1["id_bunga"]);
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
     
    function hapus($id){
        global $koneksi;
        $qu = mysqli_query($koneksi, "DELETE FROM user WHERE ID_USER = '$id'");
        return $qu;
    }

    // hapus data bunga
     
    function hapusbunga($id){
        global $koneksi;
        $qu = mysqli_query($koneksi, "DELETE FROM bunga WHERE ID_BUNGA = '$id'");
        return $qu;
    }
    

    // transaksi

    function transaksi($tr){
        global $koneksi;
        $id_transaksi = htmlspecialchars($tr["id_transaksi"]);
        $id_pembayaran = htmlspecialchars($tr["metode"]);
        $id_user = htmlspecialchars($tr["id_user"]);
        $tgl = htmlspecialchars($tr["tanggal"]);
        $alamat = htmlspecialchars($tr["alamat"]);
        $total = htmlspecialchars($tr["total"]);

        $trs = mysqli_query($koneksi, "INSERT INTO transaksi VALUES ('$id_transaksi', '$id_pembayaran', '$id_user', '$tgl', '$alamat', '$total', '')");
        
        return $trs;
    }

    //detail transaksi 

    function detail($detail){
        global $koneksi;
        $id_bunga = htmlspecialchars($detail["id_bunga"]);
        $id_transaksi = htmlspecialchars($detail["id_transaksi"]);
        $jumlah = htmlspecialchars($detail["jumlah"]);

        $de = mysqli_query($koneksi, "INSERT INTO menyediakan VALUES('$id_bunga', '$id_transaksi', '$jumlah')");
        return $de;
    }
?>
