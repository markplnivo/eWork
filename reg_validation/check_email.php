<?php
header('Content-Type: application/json');
include "../logindbase.php"; // Assume this file establishes a database connection `$conn`

// Read and decode JSON payload
$data = json_decode(file_get_contents('php://input'), true);
// Log JSON payload data

if (isset($data['email'])) {
    $email = $conn->real_escape_string($data['email']);

    $query = $conn->prepare("SELECT * FROM tbl_userlist WHERE user_email = ? LIMIT 1");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo json_encode(['error' => 'Email not provided']);
}
