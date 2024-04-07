<?php
include "manager_menu.php";
include "../logindbase.php";


$results_per_page = 15;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start_from = ($page - 1) * $results_per_page;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'job_id';
$sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'DESC' : 'ASC';
$searchTermSql = "%" . $conn->real_escape_string($searchTerm) . "%";

$sqlCount = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE job_status = 'completed' AND (creator_name LIKE ? OR assigned_artist LIKE ? OR job_brief LIKE ?)";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bind_param('sss', $searchTermSql, $searchTermSql, $searchTermSql);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$rowCount = $resultCount->fetch_assoc();
$total_pages = ceil($rowCount['total'] / $results_per_page);

$sql = "SELECT job_id, creator_name, assigned_artist, job_brief, jobstart_datetime, jobend_datetime FROM tbl_jobs WHERE job_status = 'completed' AND (creator_name LIKE ? OR assigned_artist LIKE ? OR job_brief LIKE ?) ORDER BY $sortBy $sortOrder LIMIT $start_from, $results_per_page";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $searchTermSql, $searchTermSql, $searchTermSql);
$stmt->execute();
$result = $stmt->get_result();

$tableRows = '';
while ($row = $result->fetch_assoc()) {
    $tableRows .= '<tr>
        <td>'.htmlspecialchars($row['job_id']).'</td>
        <td>'.htmlspecialchars($row['creator_name']).'</td>
        <td>'.htmlspecialchars($row['assigned_artist']).'</td>
        <td>'.htmlspecialchars($row['job_brief']).'</td>
        <td>'.htmlspecialchars(date('M d, h:i A', strtotime($row['jobstart_datetime']))).'</td>
        <td>'.htmlspecialchars(date('M d, h:i A', strtotime($row['jobend_datetime']))).'</td>
    </tr>';
}

$paginationLinks = '';
for ($i = 1; $i <= $total_pages; $i++) {
    $paginationLinks .= "<a href='#' class='pagination-link' data-page='$i'>$i</a> ";
}

echo json_encode([
    'tableRows' => $tableRows,
    'paginationLinks' => $paginationLinks
]);

$conn->close();
?>
