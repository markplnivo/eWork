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
        .open-jobs-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px; /* Add margin to separate the table from the navigation bar */
        }
        .open-jobs-table th, .open-jobs-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul class="menu">
            <li>Artist</li>
            <li>Hello, <!-- Artist Name from the database --></li>
            <li>Home</li>
            <li>Jobs Open</li>
        </ul>
    </div>
    <div class="content">
        <h2>Jobs Open</h2>
        <table class="open-jobs-table">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Time Created</th>
                    <th>Job Description</th>
                    <th>Estimated Time</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the "Jobs Open" table with data dynamically from the database -->
                <!-- Example: -->
                <tr>
                    <td>Job 1</td>
                    <td>2023-10-20</td>
                    <td>Sample job description</td>
                    <td>2 hours</td>
                </tr>
                <tr>
                    <td>Job 2</td>
                    <td>2023-10-21</td>
                    <td>Another job description</td>
                    <td>3 hours</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <h2>Artist Status</h2>
        <?php
        // Sample PHP logic to check artist status (vacant or not) based on a condition
        $isVacant = true; // Set this based on your database condition
        if ($isVacant) {
            echo "<p>You are vacant.</p>";
        } else {
            echo "<p>You are not vacant.</p>";
        }
        ?>
    </div>
</body>
</html>

