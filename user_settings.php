<html>
<?php
include "./session_handler.php";
include "./logindbase.php";

/*
if (!isLoggedIn()) {
    header("Location: ../login_page.php");
    exit();
}*/

$user_id = $_SESSION['user_id']; // Assuming there's a session variable holding the user's ID

if (isset($_POST["updateSettingsButton"])) {
    // Handle profile picture upload
    if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == 0) {
        // Similar file validation and upload logic as before
        // Adjust the database table and column names as necessary
    }

    // Handle password change
    if (!empty($_POST["newPassword"])) {
        $newPassword = $_POST["newPassword"];
        $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);
        // Update the user's password in the database
    }
}
?>


<head>
    <title>User Settings</title>
    <style>
        body {
            background-image: url("images/lucas-marcou-AAWlI2Wx9CI-unsplash.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            font-family: Arial, sans-serif;
            background-color: rgba(150, 40, 32, .9);
            text-align: center;
            margin: 0;
        }

        h2 {
            place-self: start stretch;
            font-size: 3rem;
            z-index: 0;
            color: white;
            text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 20px;
        }

        #heading_form {
            grid-area: 1 / 2 / 2 / 3;
        }

        .formLayout {
            display: grid;
            grid-template-columns: auto auto;
            grid-template-rows: auto;
            justify-content: center;
            align-content: center;
            text-align: center;
            row-gap: .5em;
            column-gap: 25px;
        }

        .formLayout label {
            font-size: 1.1rem;
            font-weight: bold;
        }

        #employee_info {
            display: grid;
            grid-template-rows: repeat(6, auto);
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            place-items: start;
        }

        #imprint_logo_form {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            place-self: start center;
        }


        #imprint_logo_form img {
            margin-top: 35px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        #userSettingsContainer {
            width: 100%;
            height: 60%;
            display: grid;
            grid-template-rows: auto auto;
            grid-area: 1 / 2 / 2 / 3;
        }

        #userSettingsContainer>h2:nth-child(1) {
            grid-area: 1 / 1 / 2 / -1;
        }

        #userSettingsContainer>form:nth-child(2) {
            grid-area: 2 / 1 / 3 / -1;
        }

        #password_input {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            width: auto;
            place-self: end center;
        }


        form {
            grid-area: 1 / 2 / 2 / 3;
            background-color: burlywood;
            padding: 10px 100px 10px 100px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            width: auto;
            height: auto;
            place-self: center;
            place-items: center;
        }

        input {
            grid-column: span 2;
            padding: 12px;
            margin: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        input::placeholder {
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        // JavaScript for image preview
        document.getElementById('profileImage').addEventListener('change', function(event) {
            // Similar logic for previewing image as before
        });
    </script>
</head>

<?php
if (isset($_POST['updateProfilePicture'])) {
    if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["profileImage"]["name"];
        $filetype = $_FILES["profileImage"]["type"];
        $filesize = $_FILES["profileImage"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Generate a unique file name
        $newFileName = uniqid("profile_", true) . "." . $ext; // Prefix with "profile_" and ensure uniqueness with uniqid()
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/ework_collab/upload/profile_images/" . $newFileName;


        // Verify MIME type of the file
        if (in_array($filetype, $allowed)) {
            // Move the uploaded file to the new path
            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $uploadPath)) {
                // Here, update the user's profile image path in the database
                $sql = "UPDATE tbl_user_profileimage SET filepath_profileimage = ? WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $uploadPath, $user_id); // Use $uploadPath which contains the new file name
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo "Profile image updated successfully.";
                } else {
                    echo "Error updating profile image.";
                }
            } else {
                echo "There was a problem uploading your profile picture.";
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again."; // Not a valid file
        }
    }
}

if (isset($_POST['updatePassword'])) {
    // Assuming the old password field is named 'oldPassword'
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Fetch the current password hash from the database for the user
    $sql = "SELECT user_password FROM tbl_userlist WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentPasswordHash = $row['user_password'];

        // Verify the old password with the hash in the database
        if (password_verify($oldPassword, $currentPasswordHash)) {
            // Old password is correct, proceed with updating to the new password
            // $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT); commented out because there is no hash yet
            $updateSql = "UPDATE tbl_userlist SET user_password = ? WHERE user_id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $newPassword, $user_id);
            $updateStmt->execute();

            if ($updateStmt->affected_rows > 0) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password.";
            }
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();
}
?>

<body>
    <div id="userSettingsContainer">
        <h2>User Settings</h2>
        <form action="/ework_collab/user_settings.php" method="post" enctype="multipart/form-data">
            <button id="backButton">Go Back</button>
            <div class="formLayout">
                <!-- Profile Image Upload Section -->
                <div>
                    <label for="profileImage">Upload a Profile Image:</label>
                    <input type="file" id="profileImage" name="profileImage" accept="image/*">
                    <img id="imagePreview" src="./upload/default_template.jpg" alt="Profile Preview" style="width: 200px; height: auto; margin-top: 10px;">
                    <!-- Update Profile Picture Button -->
                    <input type="submit" value="Update Profile Picture" name="updateProfilePicture">
                </div>

                <!-- Old Password Input -->
                <div>
                    <label for="oldPassword">Old Password:</label>
                    <input type="password" name="oldPassword" id="oldPassword">
                    <!-- Password Update Section -->
                    <label for="newPassword">New Password:</label>
                    <input type="password" name="newPassword" id="newPassword">
                    <!-- Update Password Button -->
                    <input type="submit" value="Update Password" name="updatePassword">
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {

            // JavaScript for image preview
            document.getElementById('profileImage').addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });//end of profileImage change event

            // JavaScript for back button
            document.getElementById('backButton').addEventListener('click', function() {
                window.history.back();
            });//end of back button click event

            
        }); //end of DOMContentLoaded
    </script>
</body>

</html>