<?php
// Import PHPMailer classes into the global namespace 
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 

  //  require 'PHPMailer/src/Exception.php'; 
  //  require 'PHPMailer/src/PHPMailer.php'; 
   // require 'PHPMailer/src/SMTP.php'; 

$username = "demositemagpapatubig@gmail.com";
$password = "Password123..";
$email = "christiandian0416@gmail.com";
$company_name = "Samahan ng Magpapatubig";
$subject = "Test Email";
$message = "Hello World";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer; 

            //echo !extension_loaded('openssl')?"Not Available":"Available,<br>";

        $mail->isSMTP();                      // Set mailer to use SMTP 
        $mail->Host = "ssl://smtp.gmail.com";        // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;               // Enable SMTP authentication 
        $mail->Username = "$username";   // SMTP username 
        $mail->Password = "$password";   // SMTP password 
        $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
        $mail->SMTPAutoTLS = false;
        $mail->Port = 465;                    // TCP port to connect to can be 587 or 465
		$mail->SMTPDebug  = 2;


        // Sender info 
        $mail->setFrom("$username", "$company_name"); 
        $mail->addReplyTo("$username", "$company_name"); 

        // Add a recipient 
        $mail->addAddress("$email"); 

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 

        // Set email format to HTML 
        $mail->isHTML(true); 

        // Mail subject 
        $mail->Subject = "$subject"; 

        // Mail body content 
        $bodyContent =  "$message"; 
        $mail->Body    = $bodyContent; 

        // Send email 
        if(!$mail->send()) { 
            echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
        } else { 
//            echo 'Message has been sent.'; 
        }

?>