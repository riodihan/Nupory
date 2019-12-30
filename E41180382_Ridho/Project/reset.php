
		<?php
require 'assets/includes/config.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





if($_POST)
{
    $email = $_POST['email'];

        $selectquery = mysqli_query($koneksi, "SELECT * FROM user WHERE EMAIL = '$email'");
        $count = mysqli_num_rows($selectquery);
        $row = mysqli_fetch_array($selectquery);

        // echo $count;

        if($count > 0 )
        {
            // echo $row['PASSWORD'];
            
    $mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   

    $mail->Username   = 'gumball4869@gmail.com';                     
    $mail->Password   = 'dimas2019';                               

    $mail->SMTPSecure =  'tls';         
    $mail->Port       =  587;                                    

    $mail->setFrom('gumball4869@gmail.com', 'Nursery Polije');
    $mail->addAddress($row["EMAIL"], 'Joe User');     




    $mail->isHTML(true);                                 

    $mail->Subject = 'Nursery Polije';
    $mail->Body    = $row["PASSWORD"];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
        }

}   



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		email: <input type="text" name="email" placeholder="">
		<input type="submit">
	</form>

</body>
</html>