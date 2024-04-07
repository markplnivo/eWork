<?php
include "../logindbase.php"; // Adjust the path as necessary
include "../session_handler.php";

$jobId = isset($_POST['jobId']) ? $_POST['jobId'] : '';
$response = [];
if ($jobId) {
    $query = "SELECT job_id, creator_name, job_brief, jobstart_datetime, jobend_datetime FROM tbl_jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    $stmt->close();
}

echo json_encode($response);
?>
