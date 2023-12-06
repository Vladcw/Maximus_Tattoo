<?php

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

$mail->setForm('info@fls.guru','Я');
$mail->addAddress('code@fls.guru');
$mail->Subject = "Hi!"

$body = '<h1>Letter!</h1>';

if(trim(!empty($_POST['name']))){
  $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))){
  $body.='<p><strong>E-Mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['message']))){
  $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
}
if(!empty($_FILES['image']['tmp_name'])){
   $filePath = __DIR__ . "/files/" . $_FILES['image']['tmp_name'];
  if(copy($_FILES['image']['tmp_name'], $filePath)){	
  $fileAttach = $filePath;
  $body.='<p><strong>Photo:</strong></p>';
  $mail -> addAttachment($fileAttach);
 }
}

$mail->Body = $body;

if(!$mail->send()){
  $message = 'Error';
}else {
  $message = 'Send!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

?>


