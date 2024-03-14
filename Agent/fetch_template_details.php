<?php
header('Content-Type: application/json');

// Include your database connection here
include "../logindbase.php";

$templateName = $_POST['templateName'] ?? '';

// Placeholder for the response
$response = ['success' => false, 'templateName' => $templateName, 'processes' => []];

// Query to get the template ID from its name
$templateIdQuery = "SELECT template_id FROM tbl_templatelist WHERE template_name = ?";
$stmt = $conn->prepare($templateIdQuery);
$stmt->bind_param("s", $templateName);
$stmt->execute();
$result = $stmt->get_result();
$templateIdRow = $result->fetch_assoc();

if ($templateIdRow) {
    $templateId = $templateIdRow['template_id'];

    // Now, get the processes associated with this template
    $processQuery = "SELECT * FROM tbl_template_processes WHERE template_id = ? ORDER BY process_id ASC";
    $stmt = $conn->prepare($processQuery);
    $stmt->bind_param("i", $templateId);
    $stmt->execute();
    $processesResult = $stmt->get_result();

    $processes = [];
    while ($row = $processesResult->fetch_assoc()) {
        $processes[] = $row;
    }

    if (!empty($processes)) {
        $response['success'] = true;
        $response['processes'] = $processes;
    }
}

echo json_encode($response);
?>
