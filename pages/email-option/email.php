<?php
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/src/Exception.php'; 
require 'PHPMailer/src/PHPMailer.php'; 
require 'PHPMailer/src/SMTP.php'; 

//SQL here
require_once '../database&config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
$sql="SELECT e_option_id, username, password, status FROM tbl_email_option";
$qry=$cn->prepare($sql);
$qry->execute();
$qry->bind_result($e_option_id, $username, $password, $status);
$qry->store_result();
$qry->fetch();

if ($status == 1){
    require_once '../database&config/config.php';
    $brgy_id = $_POST['message_intended_to'];
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT email FROM `tbl_user` where brgy_id=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s",$brgy_id);
    $qry->execute();
    $qry->bind_result($email);
    $qry->store_result();
    while ($qry->fetch()){
        
        $mail = new PHPMailer; 
        
//        echo !extension_loaded('openssl')?"Not Available":"Available,<br>";

        $mail->isSMTP();                      // Set mailer to use SMTP 
        $mail->Host = "ssl://smtp.gmail.com";        // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;               // Enable SMTP authentication 
        $mail->Username = "$username";   // SMTP username 
        $mail->Password = "$password";   // SMTP password 
        $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
        $mail->SMTPAutoTLS = false;
        $mail->Port = 465;                    // TCP port to connect to 


        // Sender info 
        $mail->setFrom("$username", 'PWD Information System'); 
        $mail->addReplyTo("$username", 'PWD Information System'); 

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
    }//
}


?>