<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .center-button {
            text-align: center;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name "password" id="password" required>

            <div class="center-button">
                <button type="submit">Login</button>
            </div>
        </form>

        <div>
            <a href="forgot_password.php">Forgot Password?</a>
        </div>

        <div>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</body>
</html>

