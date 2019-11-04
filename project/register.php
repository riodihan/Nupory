<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Akun</title>
    <link rel="stylesheet" href="css/styleregister.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
    body{
        background-image: url('img/Nursery.jpg');
    }
    </style>
</head>
<body>
        <header>
                <div id="hidesidebar" class="hidesidebar">
                    <p class="tombol"> <a href="javascript:void(0)" class="close" onclick="hide()">&#9776;</a></p>
                    <ul>
                        <li><a href="beranda.html">Beranda</a></li>
                        <li><a href="#">Semua Produk</a></li>
                        <li><a href="#">Cara Perawatan</a></li>
                        <li><a href="Kritik Dan Saran.html">Kritik dan Saran</a></li>
                        <li><a href="#">Temukan Kamu</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                    
                </div>
                <div id="menu">
                        <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
                </div>
                <h1 class="h1">Nursery<br>Polije</h1>
        </header>
        <section class="posisi">
                <h2>Buat Akun</h2><br>
                <form >
                    <div class="akun">
                        <label for="nama">Nama :</label>
                            <input type="text" name="nama" maxlength="30" placeholder="Nama lengkap">
                        <label for="email">Email :</label>
                            <input type="text" name="email" maxlength="75" placeholder="Example@email.com">
                        <label for="telepon">No HP :</label>
                            <input type="number" name="telepon" maxlength="13" placeholder="08xxxxxxxx">
                        <label for="username">Username :</label>
                            <input type="text" name="username" maxlength="15" placeholder="Username">
                        <label for="password">Password :</label>
                            <input type="password" name="password" maxlength="15" placeholder="Password">
                        <label for="konfirmasi">Konfirmasi Password :</label>
                            <input type="password" name="konfirmasi" maxlength="15" placeholder="Konfirmasi Password">
                        <br> <br>
                        <div class="button">
                        <button> <a href="login.php">Kembali</a></button>
                        <button type="submit" name="daftar"><a href="#">Daftar</a></button></div>
                    </div> 
                </form><br>
        </section>
        <script>
            function show() {
            document.getElementById("hidesidebar").style.width = "240px";
            document.getElementById("menu").style.marginLeft = "0%";
        }
        
            function hide() {
            document.getElementById("hidesidebar").style.width = "0";
            document.getElementById("menu").style.marginLeft= "0";
        }
            </script>
</body>
</html>