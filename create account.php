<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="job_description">Job Description:</label>
        <input type="text" name="job_description" id="job_description" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="contact_number">Contact Number:</label>
        <input name="contact_number" type="text" required id="contact_number" placeholder="+63">

        <input type="submit" value="Create Account">
    </form>
</body>
</html>
