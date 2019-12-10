
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
    $mail->Username   = 'idulidul36@gmail.com';                     
    $mail->Password   = '@saidul9';                               
    $mail->SMTPSecure =  'tls';         
    $mail->Port       =  587;                                    

   
    $mail->setFrom('idulidul36@gmail.com', 'sayyid');
    $mail->addAddress($row["EMAIL"], 'sayyid');     



    $mail->isHTML(true);                                 
    $mail->Subject = 'Here is the subject';
    $mail->Body    =  $row["PASSWORD"];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody = 'passwornya adalah = '.$row.';

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