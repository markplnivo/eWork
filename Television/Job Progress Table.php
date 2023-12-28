<!DOCTYPE html>
<html>
<head>
    <title>TV Overview</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        .header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .tv-overview-table {
            border-collapse: collapse;
            width: 100%;
        }
        .tv-overview-table th, .tv-overview-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>TV Overview</h1>
    </div>
    <div class="content">
        <!-- Your TV Overview content goes here -->
        <h2>Job Progress Table</h2>
        <table class="tv-overview-table">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Progress</th>
                    <th>Timer</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populate the table with data from the database -->
                <!-- Example: -->
                <tr>
                    <td>Job 1</td>
                    <td>50%</td>
                    <td>02:30:00</td>
                </tr>
                <tr>
                    <td>Job 2</td>
                    <td>75%</td>
                    <td>01:45:00</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>
