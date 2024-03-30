<?php

// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

// Sanitize and retrieve details sent via POST
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

// Only attempt to retrieve the template_id if 'use-template' is not set to "Manually"
if ($useTemplate !== "Manually") {
    // Retrieve the template_id using the selected template name
    $templateIdQuery = "SELECT template_id FROM tbl_templatelist WHERE template_name = ?";
    if ($stmtTemplateId = $conn->prepare($templateIdQuery)) {
        $stmtTemplateId->bind_param("s", $selectedTemplateName);
        $stmtTemplateId->execute();
        $templateIdResult = $stmtTemplateId->get_result();
        $templateIdRow = $templateIdResult->fetch_assoc();
        $stmtTemplateId->close();
        
        if (!$templateIdRow) {
            echo json_encode(['error' => 'Template name not found.']);
            exit;
        }
        $templateId = $templateIdRow['template_id'];
    } else {
        echo json_encode(['error' => 'Failed to prepare statement for template ID retrieval. Error: ' . $conn->error]);
        exit;
    }
} else {
    // Handle the case when 'use-template' is set to "Manually"
    // You might want to set $templateId to a default value or handle it accordingly
    $templateId = NULL; // Or any default/fallback value you see fit
}

// Convert default or invalid values to NULL
$futureDateTime = ($futureDateTime === '0000-00-00 00:00:00' || !$futureDateTime) ? NULL : $futureDateTime;
$deadlineDate = ($deadlineDate === '0000-00-00' || !$deadlineDate) ? NULL : $deadlineDate;
$deadlineTime = ($deadlineTime === '00:00:00' || !$deadlineTime) ? NULL : $deadlineTime;


// Prepare the SQL statement for job insertion with placeholders
$insertSql = "INSERT INTO tbl_jobs (
    deadline_futureDateTime,
    job_tracking_method,
    template_method,
    assigning_method,
    creator_name, 
    time_created,
    job_status, 
    job_subject, 
    job_brief, 
    assigned_artist,
    template_id,
    manual_deadline_date, 
    manual_deadline_time
) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, 'open', ?, ?, ?, ?, ?, ?)";

if ($stmtInsert = $conn->prepare($insertSql)) {
    // Bind parameters to the prepared statement
    $stmtInsert->bind_param("ssssssssiss", $futureDateTime, $jobTracking, $useTemplate, $assignTo, $creatorName, $jobSubject, $jobBrief, $selectedArtistName, $templateId, $deadlineDate, $deadlineTime);

    
    // Execute the statement and check for successful execution
    if ($stmtInsert->execute()) {
        $jobId = $stmtInsert->insert_id;
        
        // Process additional job details if provided
        $processDetails = $_POST['processes'] ?? [];
        $insertProcessSql = "INSERT INTO tbl_jobs_processes (job_id, process_id, duration, assigned_person) VALUES (?, ?, ?, ?)";
        
        foreach ($processDetails as $process) {
            if ($stmtProcess = $conn->prepare($insertProcessSql)) {
                $stmtProcess->bind_param("iiis", $jobId, $process['id'], $process['duration'], $process['option']);
                
                if (!$stmtProcess->execute()) {
                    // Log or handle error for process detail insertion
                    error_log("Error inserting process detail: " . $stmtProcess->error);
                }
                $stmtProcess->close();
            } else {
                // Log failure to prepare the statement for inserting process details
                error_log("Failed to prepare the statement for inserting process details: " . $conn->error);
            }
        }
        
        // Respond with the job ID on successful insertion
        echo json_encode(['job_id' => $jobId]);
    } else {
        // Log and respond with error details on failure
        error_log("Failed to create job. Error: " . $stmtInsert->error);
        echo json_encode(['error' => 'Failed to create job. Error: ' . $stmtInsert->error]);
    }
    $stmtInsert->close();
} else {
    echo json_encode(['error' => 'Failed to prepare statement for job insertion. Error: ' . $conn->error]);
}

// Close the database connection
$conn->close();

?>
