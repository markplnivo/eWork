<?php ob_start(); ?>
<?php
include "logindbase.php";

$validToken = false; // Flag to determine if the token is valid

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tbl_invitations WHERE token = ? AND used = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $validToken = true; // The token is valid
    } else {
        echo "Invalid or expired token.";
        // Here, instead of just echoing, you can redirect the user or handle the error as you see fit.
        // exit; // Uncomment this if you echo an error message and wish to stop script execution here
    }
}

if (!$validToken) {
    // Handle cases where there's no token or an invalid token
    // Redirect or inform the user accordingly
    header('Location: login_page.php'); // Redirect to an error page or home page
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: darkslategray;
        }

        /* Form container */
        #registrationForm {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form labels */
        label {
            display: block;
            margin-bottom: 5px;
        }

        /* Form inputs */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Form button */
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: orange;
            color: white;
            cursor: pointer;
        }

        /* Form icons */
        .form-icon {
            margin-right: 8px;
        }

        /* Response container */
        #response {
            margin-top: 20px;
        }
    </style>
</head>

<?php
if (isset($_POST['submitForm'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $user_password = $_POST['user_password'];
    $username = $_POST['username'];

    // Check if email or username already exists
    $checkEmail = $conn->prepare("SELECT email FROM tbl_account_request WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmailResult = $checkEmail->get_result();

    $checkUsername = $conn->prepare("SELECT username FROM tbl_account_request WHERE username = ?");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $checkUsernameResult = $checkUsername->get_result();

    if ($checkEmailResult->num_rows > 0) {
        echo "<script>alert('Email already in use.');</script>";
    } else if ($checkUsernameResult->num_rows > 0) {
        echo "<script>alert('Username already in use.');</script>";
    } else {
        // Email and username are available, proceed with registration
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO tbl_account_request (firstname, lastname, email, contact_number, user_password, username) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $contact_number, $hashed_password, $username);

        if ($stmt->execute()) {
            // Passing the token as a hidden field:
            $token = isset($_POST['token']) ? $_POST['token'] : '';
            
            $updateTokenStmt = $conn->prepare("UPDATE tbl_invitations SET used = 1 WHERE token = ?");
            $updateTokenStmt->bind_param("s", $token);
            $updateTokenStmt->execute();
        
            if ($updateTokenStmt->affected_rows > 0) {
                echo "<script>alert('Account requested successfully!');</script>";
            } else {
                // Handle the case where the token wasn't found or couldn't be marked as used
                echo "<script>alert('Account request token update failed.');</script>";
            }
        } else {
            echo "Error registering user: " . $conn->error;
        }
    }
}
?>

<body>
    <form id="registrationForm" method="post" action="register.php" onsubmit="return validateForm()">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <label for="firstname"><i class="fas fa-user form-icon"></i>First Name:</label>
        <input type="text" id="firstname" name="firstname" placeholder="First Name" required>

        <label for="lastname"><i class="fas fa-user form-icon"></i>Last Name:</label>
        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>

        <label for="email"><i class="fas fa-envelope form-icon"></i>Email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="contact_number"><i class="fas fa-phone form-icon"></i>Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" placeholder="Contact Number" required>

        <label for="user_password"><i class="fas fa-lock form-icon"></i>Password:</label>
        <input type="password" id="user_password" name="user_password" placeholder="Password" required>

        <label for="confirm_password"><i class="fas fa-lock form-icon"></i>Confirm Password:</label>
        <input type="password" id="confirm_password" placeholder="Confirm Password" required>

        <label for="username"><i class="fas fa-user-circle form-icon"></i>Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required>

        <button type="submit" name="submitForm"><i class="fas fa-paper-plane form-icon"></i>Register</button>
        <div id="emailResponse"></div>
        <div id="usernameResponse"></div>
    </form>
</body>



<script src="./reg_validation/validation.js"></script> <!-- This script will handle live validation for email and username -->
<script>
    function validateForm() {
        var password = document.getElementById("user_password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if (password !== confirm_password) {
            alert("Passwords do not match!");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>


</html>
<?php ob_end_flush(); ?>