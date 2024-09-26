<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


  $mail = new PHPMailer(true);

  try {
      // SMTP settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = '';
      $mail->Password = '';     
      $mail->SMTPSecure = 'tls';            
      $mail->Port = 587;                    
  
      // Sender and recipient settings
      $mail->setFrom('', '');
      $mail->addAddress('', ''); 
  
      // Email content
      $mail->isHTML(true);
      $mail->Subject = 'New Form Submission from your website';
      $mail->Body    = '<p>This is the body of the email</p>';
      
      // Send email
      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }


?>
