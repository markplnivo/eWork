<!DOCTYPE html>
<html>
<head>
    <title>Manager Page</title>
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
            float: left;
        }
        .content {
            width: 80%;
            padding: 20px;
            float: left;
        }
        .menu {
            list-style: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
        .remove-jobs-table {
            border-collapse: collapse;
            width: 100%;
        }
        .remove-jobs-table th, .remove-jobs-table td {
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
            <li>In Progress</li>
            <li>History</li>
            <li>Job List</li>
            <li>Logs</li>
            <li>Audit</li>
            <li>Summary</li>
        </ul>
    </div>
    <div class="content">
        <h2>Remove Jobs</h2>
        <table class="remove-jobs-table">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Time Created</th>
                    <th>Job Description</th>
                    <th>Estimated Time</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the "Remove Jobs" table with data dynamically -->
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
