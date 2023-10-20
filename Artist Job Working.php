<!DOCTYPE html>
<html>
<head>
    <title>Artist Page</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 20%;
            background-color: #f2f2f2;
            padding: 20px;
            float: left; /* Float the sidebar to the left */
        }
        .content {
            width: 80%;
            padding: 20px;
            float: left; /* Float the content to the left */
        }
        .menu {
            list-style: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul class="menu">
            <li>Home</li>
            <li>Jobs Open</li>
            <li>Hello, <!-- Artist Name from the database --></li>
        </ul>
    </div>
    <div class="content">
        <h2>You are working on a job</h2>
        <?php
        // Sample PHP logic to check the artist's working status based on a database condition
        $isWorking = true; // Set this based on your database condition
        if ($isWorking) {
            echo "<p>You are currently working on a job.</p>";
        } else {
            echo "<p>You are not working on a job.</p>";
        }
        ?>

        <h2>Job Brief</h2>
        <?php
        // Sample PHP logic to fetch and display the job brief from the database
        $jobBrief = "Sample job brief"; // Fetch this from the database
        echo "<p>$jobBrief</p>";
        ?>
    </div>
</body>
</html>
