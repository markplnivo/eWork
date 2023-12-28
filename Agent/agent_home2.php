<!DOCTYPE html>
<html>
<head>
    <title>Agent Job Creation</title>
    <style>
    </style>
</head>
<body>
<?php
include "agent_menu.php";
?>
    <div class="content">
        <h2>Job Creation</h2>
        <form class="job-creation-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="job-subject">Job Subject:</label>
            <input type="text" id="job-subject" name="job-subject" required>
            <br>
            <label for="job-brief">Job Brief:</label>
            <textarea id="job-brief" name="job-brief" rows="4" required></textarea>
            <br>
            <label for="estimated-hours">Estimated Completion Time:</label>
            <input type="number" id="estimated-hours" name="estimated-hours" placeholder="Hours" required>
            <input type="number" id="estimated-minutes" name="estimated-minutes" placeholder="Minutes" required>
            <br>
            <input type="submit" name="submitJobCreation" value="Create Job">
        </form>
    </div>
<?php
// Check if the form is submitted
if (isset($_POST['submitJobCreation'])) {
    include "../logindbase.php";

    $jobSubject = $_POST['job-subject'];
    $jobBrief = $_POST['job-brief'];
    $hours = intval($_POST['estimated-hours']);
    $minutes = intval($_POST['estimated-minutes']);
    $estimatedCompletion = $hours * 60 + $minutes;
    $creatorName = $_SESSION['username'];

    // Insert a new row into tbl_jobs
    $insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief, estimated_completion) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertSql);
    $stmtInsert->bind_param("sssi", $creatorName, $jobSubject, $jobBrief, $estimatedCompletion);
    $stmtInsert->execute();
    $stmtInsert->close();

    // Redirect to the agent home page or another appropriate page
    header("Refresh:0");
    exit();
}
?>
</body>
</html>
