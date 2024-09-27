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

$response = ["status" => "error", "message" => "Form submission failed."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $twitter = $_POST['question1'] ?? '';
    $telegram = $_POST['question2'] ?? '';
    $crypto_experience = $_POST['question3'] ?? '';
    $meme_experience = $_POST['question4'] ?? '';
    $goal = $_POST['question5'] ?? '';
    $why_chosen = $_POST['question6'] ?? '';
    $groups = $_POST['question7'] ?? '';
    $referrals = $_POST['question8'] ?? '';

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thecryptopond02@gmail.com';
        $mail->Password = 'bemc zjjr vnuy bftk'; // Use your App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('thecryptopond02@gmail.com', 'The Crypto Pond');
        $mail->addAddress('marcanthonycasale1@gmail.com');

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
        $response = ["status" => "success", "message" => "Message has been sent"];
    } catch (Exception $e) {
        $response["message"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
