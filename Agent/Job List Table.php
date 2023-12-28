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
        .header {
            background-color: #007BFF;
            color: #fff;
            text-align: right;
            padding: 10px;
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
        .joblist-table {
            border-collapse: collapse;
            width: 100%;
        }
        .joblist-table th, .joblist-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Replace 'Name' with the actual user's name -->
        Hello Name
    </div>
<div class="sidebar">
  <h3>Menu</h3>
    <ul class="menu">
        <li>In Progress</li>
        <li>History</li>
        <li>JobList</li>
    </ul>
  </div>
    <div class="content">
        <h2>JobList Table</h2>
        <table class="joblist-table">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Time Created</th>
                    <th>Job Description</th>
                    <th>Estimated Time</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the JobList table with data dynamically -->
            </tbody>
        </table>
    </div>
</body>
</html>

