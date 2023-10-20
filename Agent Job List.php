<!DOCTYPE html>
<html>
<head>
    <title>Agent Job List</title>
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
        .job-list-table {
            border-collapse: collapse;
            width: 100%;
        }
        .job-list-table th, .job-list-table td {
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
            <li>Job Description</li>
            <li>Job Creation</li>
            <li>Job List</li>
        </ul>
    </div>
    <div class="content">
        <h2>Job List</h2>
        <table class="job-list-table">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Time Created</th>
                    <th>Job Description</th>
                    <th>Estimated Time</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the "Job List" table with data dynamically -->
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
    </div>
</body>
</html>
