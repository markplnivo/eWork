<?php
include "logindbase.php";

if (isset($_POST["createAccButton"])) {


    // Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $job_description = $_POST["job_description"];
    $email = $_POST["email"];
    $contact_number = $_POST["contact_number"];
    $password = $_POST["user_password"];

    // Hash the password (using bcrypt or another secure hashing method)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the table
    $sql = "INSERT INTO tbl_account_request (`firstname`, `lastname`, `job_description`, `email`, `contact_number`, `user_password`, `request_time`)
    VALUES (?, ?, ?, ?, ?, ?, NOW())";

    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssss", $firstname, $lastname, $job_description, $email, $contact_number, $hashed_password);
        if ($stmt->execute()) {
            // Data inserted successfully
            echo '<script>alert("Account created successfully.");</script>';
            echo '<script>window.location.href = "../ework_collab/login_page.php";</script>';
        } else {
            // Error inserting data
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }
        

        $stmt->close();
    } else {
        // Error in SQL statement
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <style>
        body {
            background-image:url("images/lucas-marcou-AAWlI2Wx9CI-unsplash.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            font-family: Arial, sans-serif;
            background-color: rgba(150, 40, 32, .9);
            text-align: center;
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

        #heading_form{
            grid-area: 1 / 2 / 2 / 3;
        }
        .formLayout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 25px;
            justify-content: center;
            align-content: center;
            text-align: center;
            row-gap: .5em;
        }

        .formLayout>label {
            font-size: 1.1rem;
        }

        #employee_info {
            display:grid;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            place-self: left;

        }

        #imprint_logo_form{
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            place-self: start center;
            }

        
            #imprint_logo_form img{
            margin-top: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            }



        #password_input {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
            width: 75%;
            place-self:  end center;
        }


        form {
            grid-area: 1 / 2 / 2 / 3;
            background-color: burlywood;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            width: 50vw;
            height: 60vh;
            place-self: center;
            place-items: center;
        }

        label {
            width:15em;
            margin: 5px 0;

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
            grid-area: 3 / 1 / -1 / -1;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="heading_form">
    <h2>Create an account for eWork</h2>
    <form action="/ework_collab/register.php" method="post" class=formLayout onsubmit="return validateForm()">
        <div id="employee_info">
            <label>Enter first name:</label>
            <input type="text" name="firstname" id="firstname" required>
            <label>Enter last name:</label>
            <input type="text" name="lastname" id="lastname" required>
            <label>Enter your job role:</label>
            <input type="text" name="job_description" id="job_description">
            <label>Enter your email:</label>
            <input type="text" name="email" id="email">
            <label>Enter your contact number:</label>
            <input name="contact_number" type="text" id="contact_number">
        </div>
        <div id="imprint_logo_form">
            <img src="images/imprint customs logo 2.png" alt="Imprint Customs Logo" width="200" height="200">
        </div>
        <div id="password_input">
            <input type="password" name="user_password" id="u_password" placeholder="Enter your password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
            <span id="password_error" style="color: red; padding:10px auto;"></span>
            <script>
                function validateForm() {
                    var password = document.getElementById("u_password").value;
                    var confirm_password = document.getElementById("confirm_password").value;
                    var password_error = document.getElementById("password_error");

                    if (password !== confirm_password) {
                        password_error.innerHTML = "Passwords do not match!";
                        return false; // Prevent form submission
                    } else {
                        password_error.innerHTML = ""; // Clear any previous error message
                        return true; // Allow form submission
                    }
                }
            </script>

        </div>
        <input type="submit" value="Create Account" id="formbutton" name="createAccButton">
        </div>
    </form>
</body>

</html>