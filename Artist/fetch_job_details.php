<?php
// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

if (isset($_POST['jobId'])) {
    $jobId = $_POST['jobId'];
    
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT job_id, creator_name, time_created, job_brief FROM tbl_jobs WHERE job_id = ?");
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($jobDetails = $result->fetch_assoc()) {
        echo json_encode($jobDetails); // Send job details back as JSON
    } else {
        echo json_encode(array('error' => 'No details found for job ID ' . $jobId));
    }

    $stmt->close();
} else {
    echo json_encode(array('error' => 'Job ID not provided.'));
}

$conn->close();

?>