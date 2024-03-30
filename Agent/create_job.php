<?php
// Database configuration
include "../logindbase.php";
include "../session_handler.php";


// Assume these details are sent via POST (ensure you validate and sanitize appropriately)
$creatorName = $conn->real_escape_string($_SESSION['username']);
$jobSubject = $conn->real_escape_string($_POST['job-subject']);
$jobBrief = $conn->real_escape_string($_POST['job-brief']);
$assignTo = $conn->real_escape_string($_POST['assign-to']);
$selectedArtistName = $conn->real_escape_string($_POST['selected-artist-name']);
$useTemplate = $conn->real_escape_string($_POST['use-template']);
$selectedTemplateName = $conn->real_escape_string($_POST['selectedTemplateName']);
$jobTracking = $conn->real_escape_string($_POST['job-tracking']);
$deadlineDate = $conn->real_escape_string($_POST['deadline_date']);
$deadlineTime = $conn->real_escape_string($_POST['deadline_time']);
$futureDateTime = $conn->real_escape_string($_POST['futureDateTime']);


// Prepare the SQL statement with placeholders
$insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?)";

$stmtInsert = $conn->prepare($insertSql);

if ($stmtInsert) {
    // Bind the parameters to the SQL statement
    $stmtInsert->bind_param("sss", $creatorName, $jobSubject, $jobBrief);
    
    // Execute the statement
    $stmtInsert->execute();
    if ($stmtInsert->affected_rows > 0) {
        $jobId = $stmtInsert->insert_id; // Get the ID of the inserted job
        // Return the job_id to the client
        echo json_encode(['job_id' => $jobId]);
    } else {
        echo json_encode(['error' => 'Failed to create job']);
    }

    // Close the prepared statement
    $stmtInsert->close();
} else {
    echo json_encode(['error' => 'Failed to prepare statement']);
}

// Close the database connection
$conn->close();
?>

