<?php
require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$name =     filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$email =    filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$formMessage =  filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
$mail             = new PHPMailer();
$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smpt.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SetFrom($email, $name);
$mail->Subject    = "Conact from your website.";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
//Recieving email here
$address = "alfredo.i.urdaneta@gmail.com";
//Add Your Name
$mail->AddAddress($address, "Alfredo Urdaneta");
if(!$mail->Send()) {
    $data['fail']['title'] = 'Error';
    echo json_encode($data);
} else {
    $data['success']['title'] = 'Message has been sent';
    echo json_encode($data);
}
?>