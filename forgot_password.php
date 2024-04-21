<?php ob_start(); ?>
<?php
include 'logindbase.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require_once 'config.php';

if (isset($_POST['resetSubmit'])) {
    $email = $_POST['email'];
    // Check if the email exists in the database
    $sql = "SELECT user_email FROM tbl_userlist WHERE user_email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Email exists, proceed with token generation
        $token = bin2hex(random_bytes(32));  // Generate a secure random token
        $sql = "UPDATE tbl_userlist SET reset_token=? WHERE user_email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();
        $stmt->close();

        // Setup and send the email
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = 'mail.portfoliomjp.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'eworksupport@portfoliomjp.com';
            $mail->Password   = EWORK_PASS;
            $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465; // TCP port to connect to

            $mail->setFrom('eworksupport@portfoliomjp.com', 'eWork Support');
            $mail->addAddress($email);

            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Reset Password';
            $resetLink = "http://localhost/ework_collab/reset_password.php?token=" . $token;
            $mail->Body = 'Please click on the following link to reset your password: <a href="' . $resetLink . '">Reset Password</a>';

            $mail->send();
            echo '<script>
            if (confirm("Password reset instructions have been sent to your email. Click OK to continue.")) {
                window.location.href = "login_page.php";
            } else {
                // User clicked Cancel
            }
            </script>';

        } catch (Exception $e) {
            echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
        }
    } else {
        echo '<script>alert("No account found with that email address.");</script>';
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: auto;
            margin-top: 10%;
            background-color: darkslategray;
            flex-direction: column;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 20vw;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: whitesmoke;
        }

        label {
            margin-bottom: 5px;
        }

        .form-icon {
            margin-right: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: darksalmon;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: orange;
            color: white;
            cursor: pointer;
        }

        #backButton {
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: darkslategray;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Forgot Password</h2>
    <form action="forgot_password.php" method="post">
        <label for="email"><i class="fas fa-envelope form-icon"></i>Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" value="Reset Password" name="resetSubmit">Reset Password</button>
    </form>
</body>
<button onclick="window.history.back();" type="button" id="backButton">Go Back</button>

</html>
<?php ob_end_flush(); ?>