<?php
include "../../logindbase.php"; // Adjust the path as necessary
include "../../session_handler.php";


$timeFrame = isset($_GET['timeFrame']) ? $_GET['timeFrame'] : 'day';

// Adjust the SQL query as needed to match your database schema
$sqlTemplate = "SELECT DATE(jobend_datetime) AS jobDate, COUNT(*) AS jobCount
                FROM tbl_jobs
                WHERE job_status = 'completed' AND jobend_datetime >= DATE_SUB(CURDATE(), INTERVAL 1 %s)
                GROUP BY jobDate
                ORDER BY jobDate ASC;";

switch ($timeFrame) {
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
        $sql = sprintf($sqlTemplate, 'DAY');
}

$result = $conn->query($sql);
$jobsData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobsData[] = $row;
    }
}

echo json_encode($jobsData);
$conn->close();
?>
