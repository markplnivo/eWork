<?php
error_log(print_r($_POST, true));
error_log(print_r($_FILES, true));
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include your database configuration
include "../logindbase.php";
include "../session_handler.php";

if (!isset($_POST['job_id'])) {
    error_log('job_id is missing');
    http_response_code(400); // Bad Request
    echo 'job_id is required';
    exit;
}

$jobId = $_POST['job_id'];
$allowedTypes = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
$maxFileSize = 5 * 1024 * 1024; // 5 MB

// Validate 'progressImage' field is uploaded
if (!isset($_FILES['progressImage'])) {
    error_log("progressImage upload field is missing");
    die("Error: No files uploaded or invalid file data.");
}

// Iterate over each file
foreach ($_FILES['progressImage']['name'] as $index => $fileName) {
    if ($_FILES['progressImage']['error'][$index] == 0) {
        $fileType = $_FILES['progressImage']['type'][$index];
        $fileTmpName = $_FILES['progressImage']['tmp_name'][$index];
        $fileSize = $_FILES['progressImage']['size'][$index];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type
        if (!array_key_exists($fileExt, $allowedTypes)) {
            die("Error: Please select a valid file format for file $fileName.");
        }

        // Validate file size
        if ($fileSize > $maxFileSize) {
            die("Error: File size is larger than the allowed limit for file $fileName.");
        }

        // Generate new file name and define upload path
        $newFileName = uniqid("progress_", true) . "." . $fileExt;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/eWork_collab/upload/progress_img/" . $newFileName;

        // Move uploaded file to the designated path and update database
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $sql = "INSERT INTO tbl_progress_images (job_id, filepath_progress_image) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $jobId, $uploadPath);
            if ($stmt->execute()) {
                echo "File $fileName uploaded successfully.";
            } else {
                echo "Failed to update database for file $fileName.";
            }
        } else {
            echo "Failed to upload file $fileName.";
        }
    }
}

$conn->close();
?>
