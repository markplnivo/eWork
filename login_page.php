<?php
	include "logindbase.php";
	include "session_handler.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-image:url("bg1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: rgba(15, 30, 52, 1.00);
            display:grid;
            margin:0px;
            grid-template-columns: 100vw;
            grid-template-rows: 100vh;
            font-size: 16px;
        }

        img {
            border-radius: 5px;
        }


        .container {
            display:grid;
            grid-template-columns: 1fr;
            grid-template-rows: 100px auto;
            place-self: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(94, 94, 94, 1.00);
            width: auto;
            text-align: center;
            place-items:center; 
        }

        .container img{
            max-width:100%;
            max-height:100px;
        }

        .container h2 {
            text-align: center;
            width:250px;
            border-radius: 5px;
            padding:10px;
        }

        .userandpass {
            display: grid;
            grid-template-columns: auto0;
            grid-template-rows: auto;
            grid-column: 1;
            grid-row: 2/3;
            place-items: left;
        }

        .userandpass input{
            grid-column:1;
            border-radius:5px;
            width:80%;
            margin:5px auto;
            
        }

        label {
            
            border-radius:3px;
        }

        a {
            color: lightgray;

        }

        .center-button {
            text-align: center;
        }

        button {
            background-color: orangered;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px 30px;
            margin: 10px;
            cursor: pointer;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/imprint customs logo 3.jpg">
        <h2>eWork Login</h2>
        <form action="login_page.php" method="post">
            <div class="userandpass">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <label for "password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="center-button">
                <button type="submit" name="loginButton">Login</button>
            </div>
        </form>

        <div>
            <p><a href="register.php">Click here to create an eWork account!</a></p>
        </div>

        
        <div>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </div>
<?php        if(isset($_POST['loginButton'])){
		if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
			
        // Create a prepared statement
        $stmt = $conn->prepare("SELECT username, job_position, user_id FROM tbl_userlist WHERE BINARY username = ? AND BINARY user_password = ?");
        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("ss", $username, $password);

            // Execute the statement
            $stmt->execute();

            // Bind the result to variables
            $stmt->bind_result($result1, $result2, $result3); 

            // Fetch the result
            $stmt->fetch();

          // Check if a row was returned
                if ($result1 !== null) {
						$username = $result1;
						$position = $result2;
                        $user_id = $result3;
						loginUser($username, $position, $user_id);
                    // Successful login
                    switch ($result2) {
                        case 'Artist':
                            header("Location: ./Artist/artist_home.php");
                            break;
                        case 'Agent':
                            header("Location: ./Agent/agent_home.php");
                            break;
						case 'Manager':
                            header("Location: ./Manager/m-jobs-in-progress.php");
                            break;
                        case 'Superadmin':
                            header("Location: ./Superadmin/superadmin_home.php");
                            break;
                        default:
                            echo "Unknown role.";
                    }
                } else {
                    // Failed login, display an error message to the user
                    echo '<div style="color: red;">Invalid username or password.</div>';
                }

                // Close the statement
                $stmt->close();
            } else {
                // Error preparing the statement
                echo "Statement preparation error.";
            }
        }
    } // if(isset($_POST['loginButton'])
?>
    </div>
</body>

</html>
