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

/// Prepare the SQL statement with placeholders for job insertion
$insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?)";
$stmtInsert = $conn->prepare($insertSql);

if ($stmtInsert && $stmtInsert->bind_param("sss", $creatorName, $jobSubject, $jobBrief) && $stmtInsert->execute()) {
    $jobId = $stmtInsert->insert_id;

    $processDetails = $_POST['processes'] ?? []; // Direct access to structured process details

    $insertProcessSql = "INSERT INTO tbl_jobs_processes (job_id, process_id, duration, assigned_person) VALUES (?, ?, ?, ?)";

    foreach ($processDetails as $process) {
        if ($stmtProcess = $conn->prepare($insertProcessSql)) {
            $stmtProcess->bind_param("iiis", $jobId, $process['id'], $process['duration'], $process['option']);

            if (!$stmtProcess->execute()) {
                // Log or handle error
                error_log("Error inserting process detail: " . $stmtProcess->error);
            }
            $stmtProcess->close();
        } else {
            error_log("Failed to prepare the statement for inserting process details: " . $conn->error);
        }
    }

    echo json_encode(['job_id' => $jobId]);
} else {
    echo json_encode(['error' => $stmtInsert ? 'Failed to create job. Error: ' . $stmtInsert->error : 'Failed to prepare statement for job insertion. Error: ' . $conn->error]);
}

$conn->close();
?>