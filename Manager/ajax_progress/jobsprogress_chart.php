<?php
// Include database configuration and session handling logic
include "../../logindbase.php";
include "../../session_handler.php";

// Get the time frame from the query parameter or default to 'day'
$timeFrame = isset($_GET['timeFrame']) ? $_GET['timeFrame'] : 'day';

// SQL query template for jobs in progress
$sqlTemplate = "SELECT DATE(jobstart_datetime) as jobDate, COUNT(*) as jobCount 
                FROM tbl_jobs 
                WHERE job_status = 'pending' AND jobstart_datetime >= DATE_SUB(NOW(), INTERVAL 1 %s) 
                GROUP BY jobDate";

// Determine the SQL query based on the time frame
switch($timeFrame) {
    case 'day':
        $sql = sprintf($sqlTemplate, 'DAY');
        break;
    case 'week':
        $sql = sprintf($sqlTemplate, 'WEEK');
        break;
    case 'month':
        $sql = sprintf($sqlTemplate, 'MONTH');
        break;
    case 'year':
        $sql = sprintf($sqlTemplate, 'YEAR');
        break;
    default:
        $sql = sprintf($sqlTemplate, 'DAY'); // Default to 'day' if the time frame is not recognized
}

$result = $conn->query($sql);

$jobsInProgressData = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jobsInProgressData[] = array(
            "date" => $row["jobDate"],
            "count" => $row["jobCount"]
        );
    }
    echo json_encode($jobsInProgressData);
} else {
    echo json_encode(array("error" => "No jobs in progress found."));
}

$conn->close();
?>
