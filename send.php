<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once 'config.php';

if(isset($_POST['submitThis'])){
    $email = $_POST['email'];
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'mail.portfoliomjp.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'eworksupport@portfoliomjp.com'; // SMTP username
        $mail->Password   = EWORK_PASS; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465; // TCP port to connect to

        //Recipients
        $mail->setFrom('eworksupport@portfoliomjp.com', 'eWork Support');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Hello';
        $mail->Body    = 'Hello, this is a test email'; // This is where the error was
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Optionally, specify plain text body

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If the form wasn't submitted, you might want to do something here, like:
    echo "The form was not submitted correctly.";
}
?>
