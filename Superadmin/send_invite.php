<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require_once '../config.php';

// Database connection
require '../logindbase.php'; // Adjust the path as necessary

if(isset($_POST['sendInvitation'])){
    $email = $_POST['emailAddress'];

    // Generate a unique token
    $token = bin2hex(random_bytes(16));

    // Save token and email in the database
    $stmt = $conn->prepare("INSERT INTO tbl_invitations (email, token) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    // Setup PHPMailer
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'mail.portfoliomjp.com'; // Your SMTP server
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'eworksupport@portfoliomjp.com'; // SMTP username
        $mail->Password   = EWORK_PASS; // SMTP password, ensure to fill this
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption
        $mail->Port       = 465; // TCP port to connect to

        //Recipients
        $mail->setFrom('eworksupport@portfoliomjp.com', 'eWork Support');
        $mail->addAddress($email); // Add a recipient

        // Content
        $verificationLink = "localhost/ework_collab/register.php?token=$token"; // Adjust the link
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Complete Your Registration';
        $mail->Body    = "Please click on the following link to complete your registration: <a href='$verificationLink'>$verificationLink</a>";

        $mail->send();
        //redirect to the previous page with a success message
        header("Location: {$_SERVER['HTTP_REFERER']}?success=1");
    } catch (Exception $e) {
        echo "Invitation could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    return;
}
?>
