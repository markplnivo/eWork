<?php
// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artistName = $_POST['artistName'];
    $artistStatus = $_POST['artistStatus'];

    // Create a prepared statement to avoid SQL injection.
    $stmt = $conn->prepare("UPDATE tbl_artist_status SET artist_status = ? WHERE artist_name = ?");
    $stmt->bind_param("ss", $artistStatus, $artistName);

    // Execute the statement and check for success.
    if ($stmt->execute()) {
        echo "Artist status updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
