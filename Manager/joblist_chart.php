<?php
// Database configuration
// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

// Get the time frame from the query parameter or default to 'day'
$timeFrame = isset($_GET['timeFrame']) ? $_GET['timeFrame'] : 'day';

// SQL query template
$sqlTemplate = "SELECT job_status, COUNT(*) as count FROM tbl_jobs WHERE job_status IN ('open', 'pending') AND time_created >= DATE_SUB(NOW(), INTERVAL 1 %s) GROUP BY job_status";

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
        $sql = sprintf($sqlTemplate, 'DAY'); // Default to day if the time frame is not recognized
}

$result = $conn->query($sql);

$jobsData = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jobsData[] = $row;
    }
} else {
    echo "0 results";
}

echo json_encode($jobsData);

$conn->close();
?>
