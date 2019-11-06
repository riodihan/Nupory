<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membuat LogIn Dengan PHP dan MySQLi menggunakan MD5 - www.malasngoding.com</title>
</head>
<body>
    <h2>LogIn MD5 - www.malasngoding.com</h2>
    <br/>

    <?php
    if (isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo "LogIn gagal!"
        }else if($_GET['pesan']=="logOut"){
            echo "Anda harus LogOut";
        }elseif ($_GET['pesan'] == "belum_login") {
            echo "Anda harus LogIn dahulu";
        }
    }
    ?>
    <br/>
    <br/>
    <form method="post" action="cek_login.php">
        <table>
            <tr>
                <td>username</td>
                <td>:</td>
                <td><input type="text" name="username" placeholder="masukkan username"></td>     
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="LOGIN"></td>
            </tr>
        </table>
    </form>
    
</body>
</html>