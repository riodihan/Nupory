<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membuat Login Dengan PHP dan MySQLi Menggunakan MD5</title>
</head>
<body>
    <h2>Login MD5</h2>
    <br/>

    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "Login gagal ! username dan password salah";
        }elseif ($_GET['pesan'] == "logout") {
            echo "Anda telah berhasil logout";
        }elseif ($_GET['pesan'] == "belum_login") {
            echo "Anda harus Login untuk mengakses halaman";        }
    }
    ?>
    <br/>
    <br/>

    <form method="post" action="cek_login.php">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" placeholder="masukkan usernmae"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" placeholder="masukkan password"></td>
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