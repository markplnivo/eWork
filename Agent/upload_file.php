<?php
// Database configuration
include "../logindbase.php";
include "../session_handler.php";


$jobId = $_POST['job_id']; // The job_id to associate the uploaded file with
$allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
$maxsize = 5 * 1024 * 1024; // 5MB maximum


if (!isset($_FILES['referenceImage']) || !is_array($_FILES['referenceImage']['name'])) {
    die("Error: No files uploaded or invalid file data.");
}

$files = $_FILES['referenceImage'];

if (!is_array($files['name'])) {
    $files = [
        'name' => [$files['name']],
        'type' => [$files['type']],
        'tmp_name' => [$files['tmp_name']],
        'error' => [$files['error']],
        'size' => [$files['size']],
    ];
}

foreach ($files['name'] as $key => $name) {
    $filename = $files['name'][$key];
    $filetype = $files['type'][$key];
    $filesize = $files['size'][$key];
    $tmp_name = $files['tmp_name'][$key];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) {
        die("Error: Please select a valid file format for file $filename.");
    }

    if ($filesize > $maxsize) {
        die("Error: File size is larger than the allowed limit for file $filename.");
    }

    $newFileName = uniqid("reference_", true) . "." . $ext;
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/eWork_collab/upload/reference_img/" . $newFileName;

    if (in_array($filetype, $allowed)) {
        if (move_uploaded_file($tmp_name, $uploadPath)) {
            $sql = "INSERT INTO tbl_reference_images (job_id, filepath_reference_image) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $jobId, $uploadPath);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "Reference image $filename uploaded successfully.";
            } else {
                echo "Error updating reference image for file $filename.";
            }
        } else {
            echo "There was a problem uploading your file $filename.";
        }
    } else {
        echo "Error: There was a problem with the file format for file $filename. Please try again.";
    }
}

$conn->close();
?>