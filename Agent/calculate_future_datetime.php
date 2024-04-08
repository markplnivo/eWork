<?php
// Database configuration
include "../logindbase.php";
include "../session_handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['totalDuration']) && is_numeric($_POST['totalDuration'])) {
    $totalDuration = intval($_POST['totalDuration']); // Ensure it's an integer

    // Execute query to fetch current time from the database
    $query = "SELECT NOW() as currentTime";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row && isset($row['currentTime'])) {
            $currentTime = new DateTime($row['currentTime']);
            $currentTime->modify("+{$totalDuration} minutes");
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'futureDateTime' => $currentTime->format('Y-m-d H:i:s')
            ]);
        } else {
            // Failed to fetch current time
            echo json_encode(['success' => false, 'error' => 'Failed to fetch current time']);
        }
    } else {
        // Query execution failed
        echo json_encode(['success' => false, 'error' => 'Query failed']);
    }
    // Optionally, close the connection if no longer needed
    // $conn->close();
} else {
    // Not a POST request or totalDuration not provided/invalid
    echo json_encode(['success' => false, 'error' => 'Invalid request or missing duration']);
}
?>
