<!DOCTYPE html>
<html>
<head>
    <title>Agent Page</title>
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
        .artist-available-table {
            border-collapse: collapse;
            width: 100%;
        }
        .artist-available-table th, .artist-available-table td {
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
            <li>Agent</li>
            <li>Home</li>
            <li>Job Creation</li>
            <li>Job List</li>
        </ul>
    </div>
    <div class="content">
        <h2>Artist Available</h2>
        <table class="artist-available-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the "Artist Available" table with data dynamically -->
                <!-- Example: -->
                <tr>
                    <td>Artist 1</td>
                    <td>123-456-7890</td>
                    <td>artist1@email.com</td>
                </tr>
                <tr>
                    <td>Artist 2</td>
                    <td>987-654-3210</td>
                    <td>artist2@email.com</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>
