<?php
    session_start();
    require '../config.php';


    // jika sudah ada session akan dimasukan ke index secara otomatis

    // if(isset($_SESSION["login"])){
    //     header("location: index.php");
    // }

    /*Proses Login*/

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password ='$password'");
        // $row = mysqli_fetch_array($login);
        $cek = mysqli_num_rows($login);
        if($cek === 1) {
            $row = mysql_fetch_assoc($login);
            // $user = $row ['USERNAME'];
            // $pass = $row ['password'];
            $id_status = $row ['ID_STATUS'];
            $id_user = $row ['ID_USER'];
            $_SESSION["id_status"]= $id_status;
            $_SESSION["id_user"]= $id_user;
            $_SESSION["USERNAME"]= $user;
            $_SESSION["login"]= true;

                if($_SESSION['ID_STATUS'] == '03'){
                    header("location: index.php");
                } else {
                    header("location: ../admin/index.php");
                }
        }else{
            header("location: login.php?gagal");
        }
                
    }
?>