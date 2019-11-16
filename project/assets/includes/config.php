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

    // menampilkan data user data user
    
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result) ){
            $rows[]=$row;
        }
        return $rows;

    }



?>
