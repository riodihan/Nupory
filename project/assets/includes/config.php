<?php
    
    $koneksi= mysqli_connect("localhost", "root", "", "coba");


    //proses register
    
    function pendaftaran($data) {
        global $koneksi;
        $kd_pelanggan = $data["kd_pelanggan"];
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
        $qu = mysqli_query($koneksi, "INSERT INTO pelanggan VALUES ('$kd_pelanggan','$nama', '$alamat', '$nohp', '$email', '$username', '$password')");

         return $qu;
         

    }
?>
