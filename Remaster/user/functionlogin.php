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
            $_SESSION["username"]= $username;
            $_SESSION["id_status"]= $id_status;
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