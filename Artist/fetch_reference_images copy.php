<?php

// Include database configuration and session handling logic
include "../logindbase.php";
include "../session_handler.php";

// Assume jobId is sent via POST
$jobId = isset($_POST['jobId']) ? intval($_POST['jobId']) : 0;

// Initialize an array to hold the image paths
$imagePaths = [];

// Ensure jobId is a valid integer
if ($jobId > 0) {
    // Prepare the SQL statement to fetch image paths
    $stmt = $conn->prepare("SELECT filepath_reference_image FROM tbl_reference_images WHERE job_id = ?");
    $stmt->bind_param("i", $jobId);
    $stmt->execute();

    // Bind the result variable
    $result = $stmt->get_result();

    // Base directory path
    $baseDir = "C:/xampp/htdocs"; // Adjust this path as necessary
    $baseUrl = "http://localhost"; // Adjust if your local server uses a different base URL

    // Fetch each row and add the converted image path to the array
    while ($row = $result->fetch_assoc()) {
        // Convert file system path to web-accessible URL
        $relativePath = str_replace($baseDir, "", $row['filepath_reference_image']);
        $relativePath = str_replace("\\", "/", $relativePath); // Convert backslashes to forward slashes
        $webPath = $baseUrl . $relativePath;

        $imagePaths[] = $webPath;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

// Return the image paths as a JSON-encoded array
echo json_encode($imagePaths);
?>
