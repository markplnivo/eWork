<?php
// Include database connection and session handler
include "../../logindbase.php";
include "../../session_handler.php";

header('Content-Type: application/json');

// Check if jobId is provided in the POST request
if (isset($_POST['jobId']) && !empty($_POST['jobId'])) {
    $jobId = $_POST['jobId'];

    // Prepare SQL query to fetch job details including conditional logic for completion_percentage
    $sql = "SELECT j.job_id, 
                j.creator_name, 
                j.time_created, 
                j.job_status, 
                j.assigned_artist, 
                j.job_subject, 
                j.job_brief, 
                j.assigning_method, 
                j.template_method, 
                j.template_id, 
                j.job_tracking_method, 
                CASE 
                    WHEN j.manual_deadline_date IS NOT NULL AND j.manual_deadline_time IS NOT NULL THEN CONCAT(j.manual_deadline_date, ' ', j.manual_deadline_time)
                    WHEN j.deadline_futureDateTime IS NOT NULL THEN j.deadline_futureDateTime
                    ELSE 'Artist Deadline'
                END AS job_deadline,
                j.jobstart_datetime,
                CASE 
                    WHEN j.job_tracking_method = 'Artist Deadline' AND a.current_jobID IS NULL AND a.artist_status = 'busy' THEN a.completion_percentage
                    ELSE NULL
                END AS completion_percentage
            FROM tbl_jobs AS j
            LEFT JOIN tbl_artist_status AS a ON j.assigned_artist = a.artist_name
            WHERE j.job_id = ?";

    // Prepare and execute query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $jobId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the result
        if ($row = $result->fetch_assoc()) {
            // Send the details back as JSON
            echo json_encode([
                'success' => true,
                'details' => $row
            ]);
        } else {
            // Job not found or error
            echo json_encode([
                'success' => false,
                'message' => 'Job not found or error fetching job details.'
            ]);
        }

        $stmt->close();
    } else {
        // Error preparing statement
        echo json_encode([
            'success' => false,
            'message' => 'Error preparing SQL statement.'
        ]);
    }
    $conn->close();
} else {
    // jobId not provided in the request
    echo json_encode([
        'success' => false,
        'message' => 'Job ID not provided.'
    ]);
}
?>
