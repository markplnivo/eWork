<?php
ob_start();
include "logindbase.php";
include "session_handler.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- Add Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-image: url("3432.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: rgba(15, 30, 52, 1.00);
            display: grid;
            margin: 0;
            grid-template-columns: 100vw;
            grid-template-rows: 100vh;
            font-size: 16px;
        }
        img {
            border-radius: 5px;
            max-width: 100%;
            height: auto;
        }

        .card {
            background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
            border-radius: 10px;
            transition: all 0.3s;
            width: 30vw;
            height: 50vh;
            margin: auto;
            box-shadow: 0 0 10px 1px rgba(0, 255, 117, 0.3);
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 0 30px 1px rgba(0, 255, 117, 0.3);
            transform: scale(1.1);
        }
        
        .container {
            font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 100px auto;
            place-self: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-image: url("4567.jpg");
            background-color: rgba(94, 94, 94, 1.00);
            width: 30vw;
            height: 50vh;
            text-align: center;
            place-items: center;
            margin: 0;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: all 0.3s;
        }
        .container:hover {
            transform: scale(0.95);
        }
        .container .icon-container {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
        }
        .container .icon-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .container h2 {
            text-align: center;
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            color: #FCE205;
            font-size: 2.5em;
        }
        .userandpass {
            position: relative;
            margin-bottom: 20px;
        }
        .userandpass input {
            border-radius: 5px;
            width: 80%;
            margin: 5px auto;
            padding: 10px 30px 10px 10px;
            box-sizing: border-box;
        }
        .userandpass i {
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            color: lightgray;
        }
        .center-button {
            text-align: center;
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: space-between;
        }


        button, .button-link {
            flex-grow: 1;
            padding: 0.5em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            color: white;
            background-color: #007bff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover, .button-link:hover {
            background-color: #0056b3;
            color: #FCE205;
        }
        .button-link.Forgot {
            background-color: transparent;
            font-size: 10px;
        }
        .button-link.Forgot:hover {
            color: #FCE205;
            background-color: black;
        }
        .center-button > button:nth-child(1) {
            font-size: 16px;
        }


    </style>
</head>

<body>
    <div class="card">
        <div class="container">
            <div class="icon-container">
                <img src="./ic.png" alt="Icon">
            </div>
            <h2>eWork Login</h2>
            <form action="login_page.php" method="post">
                <div class="userandpass">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" required placeholder="Username">
                </div>
                <div class="userandpass">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" required placeholder="Password">
                </div>
                <div class="center-button">
                    <button type="submit" name="loginButton">Login</button>
                    <a href="register.php" class="button-link Create">Sign Up</a>
                    <a href="forgot_password.php" class="button-link Forgot">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['loginButton'])) {
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
                    session_regenerate_id(true);
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
</body>

<?php ob_end_flush(); ?>

</html>