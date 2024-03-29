<?php
// Database configuration
include "../logindbase.php";
include "../session_handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalDuration = $_POST['totalDuration']; // Total duration in minutes

    // Calculate future date and time
    $futureDateTime = new DateTime(); // Current date and time
    $futureDateTime->modify("+{$totalDuration} minutes");

    // Send back as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'futureDateTime' => $futureDateTime->format('Y-m-d H:i:s')
    ]);
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>