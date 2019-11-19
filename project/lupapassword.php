<?php
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "", "poltek_nursery");
		
		$condition = "";
		if(!empty($_POST["user-login-name"])) 
			$condition = " member_name = '" . $_POST["user-login-name"] . "'";
		if(!empty($_POST["user-email"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " member_email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from user " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("lupapassword.php");
		} else {
			$error_message = 'No User Found';
		}
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="css/stylelupapassword.css">
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
        <?php 
                $user = @$_SESSION['id_status'] == '03';
                $karyawan = @$_SESSION['id_status'] =='02';
                $admin = @$_SESSION['id_status'] == '01';
                $guest = (!isset($_SESSION['login']));
                if($user){
            ?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="kritikdansaran.php">Kritik dan Saran</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }if($admin){?>
                
                <li><a href="#">Data Admin</a></li>
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
                <li><a href="#">Report</a></li>
            <?php }if($karyawan){?>
                
                <li><a href="#">Data Transaksi</a></li>
                <li><a href="#">Data Bunga</a></li>
            <?php }if($guest){?>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="caraperawatan.php">Cara Perawatan</a></li>
                <li><a href="temukankami.php">Temukan Kami</a></li>
                <li><a href="faq.php">FAQ</a></li>
            <?php }?>
        </ul>
        
    </div>
    <div id="menu">
            <span style="font-size: 30px; cursor: pointer;" onclick="show()">&#9776;</span>
    </div>
    <h1 class="h1">Nursery<br>Polije</h1>
    </header>
    <section class="posisi">
    <h1>Lupa Password</h1>
    <form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
            
                <?php if(!empty($success_message)) { ?>
                <div class="success_message"><?php echo $success_message; ?></div>
                <?php } ?>

                <div id="validation-message">
                    <?php if(!empty($error_message)) { ?>
                <?php echo $error_message; ?>
                <?php } ?>
                </div>

                <div class="field-group">
                    <div><label for="username">Username</label></div>
                    <div><input type="text" name="user-login-name" id="user-login-name" class=""> </div>
                </div>
                
                <div class="field-group">
                    <div><label for="email">Email</label></div>
                    <div><input type="text" name="user-email" id="user-email" class=""></div>
                </div>
                
                <div class="field-group">
                    <div><input type="submit" name="forgot-password" id="forgot-password" value="Submit" class="form-submit-button"></div>
                </div>	
            </form>
        
        <br>
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
    function showpassword() {
        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>

</body>
</html>

