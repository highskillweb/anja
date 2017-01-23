<?php
require 'PHPMailer/PHPMailerAutoload.php';

$host = 'premium9.web-hosting.com';

$username = 'info@trackatoo.net';

$password = 'Visitenkarte456';

$subject = 'Request from website: ' . addslashes(strip_tags($_POST['subject']));

$name = addslashes(strip_tags($_POST['name']));

$email = addslashes(strip_tags($_POST['email']));

$message = addslashes(strip_tags($_POST['message']));

$htmlmessage = <<<MESSAGE
    <html>
    	<head>
            <title>$subject</title>
    	</head>
        
        <body>
            <p><strong>Name: </strong>$name</p>
            <p><strong>Email: </strong>$email</p>
            <p><strong>Message: </strong>$message</p>
        </body>
    </html>
MESSAGE;

$mail = new PHPMailer();
        
$mail->isSMTP();
$mail->SMTPAuth = TRUE;
$mail->Host = $host;
$mail->Username = $username;
$mail->Password = $password;

$mail->From = $email;
$mail->FromName = $name;

// Add receive email address
$mail->addAddress($username);

$mail->isHTML(true);

$mail->Subject = $subject;

$mail->Body    = $htmlmessage;

//send the message, check for errors
if ( $mail->send()) 
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