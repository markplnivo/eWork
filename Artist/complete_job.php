<?php
include "../logindbase.php"; // Adjust the path as necessary
include "../session_handler.php";

// Assuming $artistUsername and $currentJobId are always set when this script is called
$artistUsername = $_SESSION['username'];
$currentJobId = $_SESSION['artist_currentJob'];



// First, update the artist's status
$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'open', completion_percentage = 0, current_jobID = null WHERE artist_name = ?";
$stmt = $conn->prepare($updateStatusSql);
$stmt->bind_param("s", $artistUsername);
$stmt->execute();
$stmt->close();

// Then, mark the current job as completed
$updateJobStatusSql = "UPDATE tbl_jobs SET job_status = 'completed', jobend_datetime = NOW() WHERE job_id = ? AND job_status <> 'completed'";
$stmt = $conn->prepare($updateJobStatusSql);
$stmt->bind_param("i", $currentJobId);
$stmt->execute();
$stmt->close();

$_SESSION['artist_currentJob'] = null;
$_SESSION['busy'] = 'open';

echo json_encode(['success' => true, 'message' => 'Job has been completed.']);
