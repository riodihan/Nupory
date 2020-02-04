<?php
    session_start();
    require 'assets/config.php';
    
    /*Proses Login*/

    if(isset($_SESSION["login"])){
        header("location: index.php");
    }

    /*Proses Login*/

    if(isset($_POST["login"])){
        $username1 = $_POST["username"];
        $password = $_POST["password"];
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username1' AND password ='$password'");
        $cek = mysqli_num_rows($login);
        if($cek === 1) {
            $row = mysqli_fetch_assoc($login);
            $id_status = $row ['ID_STATUS'];
            $username = $row['USERNAME'];
            $nama_user = $row['NAMA_USER'];
            $foto_user = $row['FOTO_USER'];
            $_SESSION["username"]= $username;
            $_SESSION["id_status"]= $id_status;
            $_SESSION["nama_user"]=$nama_user;
            $_SESSION["foto_user"]=$foto_user;
            $_SESSION["login"]= true;

                if($_SESSION["id_status"] === "03"){
                    header("location: index.php");
                    exit;
                } else if ($_SESSION["id_status"] === "02") {
                    header("location: ../admin/index.php");
                    exit;
                }else if ($_SESSION["id_status"] === "01") {
                    header("location: ../admin/index.php");
                    exit;
                }else{
                    header("location: index.php");
                    exit;
                }
        }else{
            header("location: login.php?gagal");
        }
                
    }
?>