<?php

// Database configuration
include "../logindbase.php";
include "../session_handler.php";


// Assume these details are sent via POST (ensure you validate and sanitize appropriately)
$creatorName = $conn->real_escape_string($_SESSION['username']);
$jobSubject = $conn->real_escape_string($_POST['job-subject']);
$jobBrief = $conn->real_escape_string($_POST['job-brief']);
//$selectedArtistName = $conn->real_escape_string($_POST['selected-artist-name']);

// Assuming `estimated_completion` is an integer representing time in minutes
$estimatedCompletion = isset($_POST['estimatedCompletion']) ? (int)$_POST['estimatedCompletion'] : 0;

// Prepare the SQL statement with placeholders
$insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief, estimated_completion) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?, ?)";

$stmtInsert = $conn->prepare($insertSql);

if ($stmtInsert) {
    // Bind the parameters to the SQL statement
    $stmtInsert->bind_param("sssi", $creatorName, $jobSubject, $jobBrief, $estimatedCompletion);
    
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
