<?php
include "../../logindbase.php"; // Adjust the path as necessary
include "../../session_handler.php";

// Retrieve the jobId from POST data
$jobId = isset($_POST['jobId']) ? $_POST['jobId'] : '';

// Initialize an array to hold the web-accessible image URLs
$imageUrls = [];

if ($jobId) {
    // Prepare a query to select the filepath_progress_image fields from tbl_progress_images where the job_id matches
    $query = "SELECT filepath_progress_image FROM tbl_progress_images WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    // Bind the jobId to the prepared statement
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Base directory path
    $baseDir = "C:/xampp/htdocs"; // Adjust this path as necessary
    $baseUrl = "http://localhost"; // Adjust if your local server uses a different base URL

    // Fetch each row and add the converted image URL to the array
    while ($row = $result->fetch_assoc()) {
        // Convert file system path to web-accessible URL
        $relativePath = str_replace($baseDir, "", $row['filepath_progress_image']);
        $relativePath = str_replace("\\", "/", $relativePath); // Convert backslashes to forward slashes
        $webPath = $baseUrl . $relativePath;

        $imageUrls[] = $webPath;
    }
    // Close the statement
    $stmt->close();
}

// Encode the $imageUrls array to JSON and output it
echo json_encode($imageUrls);
?>
