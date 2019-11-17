<?php
    
    $koneksi= mysqli_connect("localhost", "root", "", "poltek_nursery");


    //proses register
    
    function pendaftaran($data) {
        global $koneksi;
        $id_user = $data["id_user"];
        $id_status = $data["id_status"];
        $nama = $data["nama"];
        $alamat = $data["alamat"];
        $nohp = $data["nohp"];
        $email = $data["email"];
        $username = strtolower (stripslashes($data["username"]));
        $password =  mysqli_real_escape_string($koneksi, $data["password"]);
        $konfirmasi = mysqli_real_escape_string($koneksi, $data["konfirmasi"]);

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
        $qu = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id_user', '$id_status', '$nama', '$alamat', '$nohp', '$email', '$username', '$password')");

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
        $id = $tambah["id_user"];
        $id_s = $tambah["id_status"];
        $nama_u = $tambah["nama_user"];
        $alamat_u = $tambah["alamat"];
        $no_telepon = $tambah["no_telepon"];
        $email_u = $tambah["email"];
        $u_name = strtolower (stripslashes($tambah["username"]));
        $password_u =  mysqli_real_escape_string($koneksi, $tambah["password"]);
        $konfirmasipassword = mysqli_real_escape_string($koneksi, $tambah["konfirmasipassword"]);

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
        
        $qu = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id', '$id_s', '$nama_u', '$alamat_u', '$no_telepon', '$email_u', '$u_name', '$password_u')");

        return $qu;
    }


    //proses tambah bunga
    
    function tambahbunga($tambah1) {
        global $koneksi;
        $id_b= $tambah1["id_bunga"];
        $nama_b = $tambah1["nama_bunga"];
        $harga_b = $tambah1["harga"];
        $stok_b = $tambah1["stok"];
         
         
         //menambahkan bunga ke database
        
        $qu = mysqli_query($koneksi, "INSERT INTO bunga VALUES ('$id_b', '$nama_b', '$harga_b', '$stok_b')");

        return $qu;
    }


?>
