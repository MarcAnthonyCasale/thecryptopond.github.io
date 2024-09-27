<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

header("Access-Control-Allow-Origin: https://cryptopond.net");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $twitter = $_POST['question1'];
    $telegram = $_POST['question2'];
    $crypto_experience = $_POST['question3'];
    $meme_experience = $_POST['question4'];
    $goal = $_POST['question5'];
    $why_chosen = $_POST['question6'];
    $groups = $_POST['question7'];
    $referrals = $_POST['question8'];

    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'thecryptopond02@gmail.com'; // Your Gmail address
        $mail->Password = 'bemc zjjr vnuy bftk'; // Use your App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('thecryptopond02@gmail.com', 'The Crypto Pond');
        $mail->addAddress('marcanthonycasale1@gmail.com', 'Crypto Pond'); // Recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body = "
            Twitter Username: $twitter<br>
            Telegram Username: $telegram<br>
            Crypto Experience: $crypto_experience<br>
            Memecoins Experience: $meme_experience<br>
            Goal: $goal<br>
            Why Chosen: $why_chosen<br>
            Groups: $groups<br>
            Referrals: $referrals
        ";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
