<?php
include "../../logindbase.php";
include "../../session_handler.php";
ini_set('display_errors', 0); // Turn off error displaying
ini_set('log_errors', 1); // Enable error logging
error_reporting(E_ALL);
ini_set('error_log', '/path/to/log/file.log'); // Specify the log file path

// Adjusted SQL to fetch combined status information
$sql = "SELECT 
CASE 
    WHEN u.job_position = 'Artist' AND u.status = 'offline' THEN 'offline'
    WHEN u.job_position = 'Artist' AND u.status = 'online' THEN a.artist_status
    WHEN u.job_position = 'Artist' THEN 'offline'
    ELSE u.status 
END AS employee_status,
COUNT(*) AS status_count
FROM tbl_user_status u
LEFT JOIN tbl_artist_status a ON u.user_id = a.artist_id
GROUP BY employee_status
ORDER BY employee_status;
";

$result = $conn->query($sql);
$employee_status_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employee_status_data[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($employee_status_data);
$conn->close();
