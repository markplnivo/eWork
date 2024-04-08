<?php
include "../../logindbase.php"; // Adjust the path as necessary
include "../../session_handler.php";

$jobId = isset($_POST['jobId']) ? $_POST['jobId'] : '';
$response = [];
if ($jobId) {
    // Adjusted to include only jobs that are 'pending'
    $query = "SELECT job_id, creator_name, job_brief, jobstart_datetime, jobend_datetime, manual_deadline_date, manual_deadline_time, deadline_futuredatetime, assigned_artist FROM tbl_jobs WHERE job_id = ? AND job_status = 'pending'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $jobDetails = $result->fetch_assoc();
        
        // Logic for determining the deadline remains the same
        if ($jobDetails['manual_deadline_date'] !== null && $jobDetails['manual_deadline_time'] !== null) {
            $deadline = $jobDetails['manual_deadline_date'] . ' ' . $jobDetails['manual_deadline_time'];
        } elseif ($jobDetails['deadline_futuredatetime'] !== null) {
            $deadline = $jobDetails['deadline_futuredatetime'];
        } else {
            $artistQuery = "SELECT completion_percentage FROM tbl_artist_status WHERE artist_name = ?";
            $artistStmt = $conn->prepare($artistQuery);
            $artistStmt->bind_param("s", $jobDetails['assigned_artist']);
            $artistStmt->execute();
            $artistResult = $artistStmt->get_result();
            if ($artistResult->num_rows > 0) {
                $artistDetails = $artistResult->fetch_assoc();
                $deadline = $artistDetails['completion_percentage'];
            } else {
                $deadline = null;
            }
            $artistStmt->close();
        }

        $response = [
            'job_id' => $jobDetails['job_id'],
            'creator_name' => $jobDetails['creator_name'],
            'job_brief' => $jobDetails['job_brief'],
            'jobstart_datetime' => $jobDetails['jobstart_datetime'],
            'deadline' => $deadline
        ];
    }
    $stmt->close();
}

echo json_encode($response);
?>
