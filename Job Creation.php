<!DOCTYPE html>
<html>
<head>
    <title>Agent Job Creation</title>
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
        .job-creation-form {
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
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
        <h2>Job Creation</h2>
        <form class="job-creation-form" method="post" action="process_job_creation.php">
            <label for="job-subject">Job Subject:</label>
            <input type="text" id="job-subject" name="job-subject" required>
            <br>
            <label for="job-brief">Job Brief:</label>
            <textarea id="job-brief" name="job-brief" rows="4" required></textarea>
            <br>
            <label for="estimated-time">Estimated Time:</label>
            <input type="text" id="estimated-time" name="estimated-time" required>
            <br>
            <input type="submit" value="Create Job">
        </form>
    </div>
</body>
</html>
