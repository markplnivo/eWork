<?php
header('Content-Type: application/json');
include "../logindbase.php"; // Assume this file establishes a database connection `$conn`

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['username'])) {
    $username = $conn->real_escape_string($data['username']);
    $query = "SELECT * FROM tbl_userlist WHERE username = '$username' LIMIT 1";
    
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo json_encode(['error' => 'Username not provided']);
}
?>
