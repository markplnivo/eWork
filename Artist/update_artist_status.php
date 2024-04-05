<?php
include "../logindbase.php";
include "../session_handler.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the required fields are in the POST data
    if (isset($_POST['artistName']) && isset($_POST['artistStatus'])) {
        $artistName = $_POST['artistName'];
        $artistStatus = $_POST['artistStatus'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE tbl_artist_status SET artist_status = ? WHERE artist_name = ?");
        $stmt->bind_param("ss", $artistStatus, $artistName);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Artist status updated successfully.";
        } else {
            // If execute() fails, show an error
            echo "Error updating record: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // If required POST values are not set, return an error
        echo "Error: Missing artistName or artistStatus";
    }
} else {
    // If not a POST request, return an error
    echo "Error: Invalid request method.";
}
?>
