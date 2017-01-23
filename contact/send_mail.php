<?php
require_once('PHPMailer/class.phpmailer.php');

$email = new PHPMailer();
$email->From      = $_POST['email'];
$email->FromName  = $_POST['name'];
$email->Subject   = $_POST['subject'];
$email->Body      = $_POST['message'];
$email->AddAddress( 'info@trackatoo.net' );

//$file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

//$email->AddAttachment( $file_to_attach , 'NameOfFile.pdf' );

//send the message, check for errors
if ( $email->send()) 
{
    $send['result'] = true;
} else {	
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$message = trim($_POST['message']);
	
	$emailTo = 'knnsbarl@yandex.com'; //Put your own email address here
	if (empty($subject)) {
	    $subject = 'Message from your website.';
	}
	$body = "Name: $name \n\nEmail: $email \n\nMessage:\n$message";
	$headers = 'From: '.$email."\r\n" .
        'Reply-To: '.$email."\r\n";

    $send['emailto'] = $emailTo;
    $send['subject'] = $subject;
    $send['body'] = $body;
    $send['headers'] = $headers;
	mail($emailTo, $subject, $body, $headers);
	$send['result'] = true;
}

echo json_encode($send);

?>