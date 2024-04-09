<?php
include "../logindbase.php";
include "../session_handler.php";
include "../action_logger.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_log("log_activity.php: start");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));


    $logAction = $_POST['actionType'] ?? 'undefined action';
    $logSubjectId = $_POST['subjectId'] ?? 0;
    $logSubjectType = $_POST['subjectType'] ?? 'Job';
    $logDetails = $_POST['logDetails'] ?? '';

    logAction($logAction, $logSubjectId, $logSubjectType, $logDetails);

    echo json_encode(['status' => 'success', 'message' => 'Action logged successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
