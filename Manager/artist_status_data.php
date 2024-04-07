<?php
include "../logindbase.php";
include "../session_handler.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// No need for a timeFrame since you're getting the current status counts
$sql = "SELECT artist_status, COUNT(*) AS artist_status_count
        FROM tbl_artist_status
        WHERE artist_status IN ('busy', 'open', 'on_break')
        GROUP BY artist_status
        ORDER BY artist_status;";

$result = $conn->query($sql);
$artist_status_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artist_status_data[] = $row;
    }
}

echo json_encode($artist_status_data);
$conn->close();
?>
