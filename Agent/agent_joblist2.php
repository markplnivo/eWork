<!DOCTYPE html>
<html>
<head>
    <title>Agent Job List</title>
    <style>

  
    </style>
</head>
<body>
<?php
include "agent_menu.php";
include "../logindbase.php";

// Pagination settings
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting point for the current page
$offset = ($currentPage - 1) * $itemsPerPage;

// Retrieve data from the database
$sql = "SELECT * FROM tbl_jobs where job_status = 'open' LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

// Total number of records
$totalRecords = $conn->query("SELECT COUNT(*) as total FROM tbl_jobs")->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $itemsPerPage);
?>

<div class="content">
    <h2>Agent Job List</h2>
    <table>
        <thead>
            <tr>
            <th>Job ID</th>
            <th>Time Created</th>
            <th>Job Subject</th>
            <th>Job Brief</th>
            <th>Estimated Completion</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['time_created']; ?></td>
                    <td><?php echo $row['job_subject']; ?></td>
					<td><?php echo $row['job_brief']; ?></td>
					<td><?php echo $row['estimated_completion']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</div>

</body>
</html>
