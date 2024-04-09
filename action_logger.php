<?php ob_start(); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function logAction($logAction, $logSubjectId, $logSubjectType, $logDetails = '') {

    global $conn; // Use the global $conn object for the database connection

    if (isset($_SESSION['username'], $_SESSION['user_id'])) {
        $logUsername = $_SESSION['username'];
        $logUserId = $_SESSION['user_id'];

          // Improved IP address detection logic
          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $logIpAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $logIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER["HTTP_X_REAL_IP"])) {
            $logIpAddress = $_SERVER["HTTP_X_REAL_IP"];
        } else {
            $logIpAddress = $_SERVER['REMOTE_ADDR'];
        }

        $logTime = date("Y-m-d H:i:s"); // Current timestamp
        // Prepare the SQL query
        $sql = "INSERT INTO tbl_actionlogs (action, user_id, username, subject_id, subject_type, details, ip_address, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare statement
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Bind parameters and execute
            $stmt->bind_param('sissssss', $logAction, $logUserId, $logUsername, $logSubjectId, $logSubjectType, $logDetails, $logIpAddress, $logTime);
            $stmt->execute();
            $stmt->close();
        } else {
            // Handle error in statement preparation
            error_log("Failed to prepare statement: " . $conn->error);
        }
    }
}
?>
<?php ob_end_flush(); ?>