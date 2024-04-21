<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Verification Token</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<style>
   body {
            font-family: Arial, sans-serif;
            background-color: #919191;
            margin: 0;
            padding: 0;
            display:flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height: 50vh;
            
        
        }
        
        h2 {
            text-align: center;
            margin-top: 50px;
        }
        
        .inviteForm {
            max-width: 400px;
            margin: 0 auto;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .inviteButton {
            background-color: darkslategray;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .inviteButton:hover {
            background-color: navy;
        }
        
        #backButton {
        margin-top:50px;
        }

        .form-icon {
            margin-right: 8px;
        }
</style>
<body>
    <h2>Send eWork System Invitation</h2>
    <h1 style="font-size: 20px; color: red;">Administrator Use Only</h1>
    <?php include "superadmin_menu.php"; ?>
    <form class="inviteForm" action="send_invite.php" method="post">
        <label for="emailAddress"><i class="fas fa-envelope form-icon"></i>Enter Email Address:</label>
        <input type="email" id="emailAddress" name="emailAddress" required>
        <button class="inviteButton" type="submit" name="sendInvitation"><i class="fas fa-paper-plane form-icon"></i>Send Invitation</button>
    </form>
    <button class= "inviteButton" type="button" id="backButton" onclick="history.back()"><i class="fas fa-arrow-left form-icon"></i>Go Back</button>
</body>
</html>
<?php ob_end_flush(); ?>