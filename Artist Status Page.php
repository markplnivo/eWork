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
            <li>Artist</li>
            <li>Hello, <!-- Artist Name from the database --></li>
            <li>Home</li>
            <li>Jobs Open</li>
        </ul>
    </div>
    <div class="content">
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

        <h2>Open Job Orders</h2>
        <?php
        // Sample PHP logic to fetch and display open job orders based on a condition
        $openJobOrders = array(); // Fetch and populate this array from the database
        if (!empty($openJobOrders)) {
            echo "<ul>";
            foreach ($openJobOrders as $job) {
                echo "<li>$job</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No open job orders.</p>";
        }
        ?>
    </div>
</body>
</html>

