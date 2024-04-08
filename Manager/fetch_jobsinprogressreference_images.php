<?php
include "../logindbase.php"; // Adjust the path as necessary
include "../session_handler.php";

$jobId = isset($_POST['jobId']) ? $_POST['jobId'] : '';
$imageUrls = [];

if ($jobId) {
    $query = "SELECT filepath_progress_image FROM tbl_progress_images WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    $baseDir = "C:/xampp/htdocs"; // Adjust this path
    $baseUrl = "http://localhost"; // Adjust this URL

    while ($row = $result->fetch_assoc()) {
        // Convert file system path to web-accessible URL
        $relativePath = str_replace($baseDir, "", $row['filepath_progress_image']);
        $relativePath = str_replace("\\", "/", $relativePath); // Ensure correct slashes
        $webPath = $baseUrl . $relativePath;

        $imageUrls[] = $webPath;
    }
    $stmt->close();
}

echo json_encode($imageUrls);
?>
