<?php
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);
$subject = 'Message from your website. '.trim($_POST['subject']);

$emailTo = 'info@trackatoo.net'; //Put your own email address here

$body = "Name: $name \n\nEmail: $email \n\nMessage:\n$message";
$headers = 'From: '.$email."\r\n" .
    'Reply-To: '.$email."\r\n";

mail($emailTo, $subject, $body, $headers);

$emailSent['result'] = true;
echo json_encode($emailSent);
?>