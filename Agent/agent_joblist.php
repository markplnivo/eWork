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

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agent Job List</title>

<style>
    /* Global styles */

    body {
        display: grid;
        gap: 30px 30px;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 0.5fr 1fr 0.25fr;
        background-color: #1a1a1a;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    /* Content container */
    .content {
        grid-area: 2/ 1/ 3 / -1;
        display: grid;
        place-self:center stretch;
        animation: chaseColors 4s linear infinite;
        margin:5%;
        padding:20px;
        max-width: 100%;
        height: 100%;
        background-color: black;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    /* Keyframes animation */
    @keyframes chaseColors {
        0%,
        100% {
            border: 3px solid red;
        }

        50% {
            border: 3px solid blue;
        }
    }

    /* Header styles */
    .header {
        grid-area: 1 / 1 / 2 / -1;
        place-self: center stretch;
        position:relative;
        max-width: 100%;
        max-height: 100%;
        background-color: #333;
        padding: 15vh;
        text-align: center;   
        overflow: hidden;

    }

    .header img {
        width: 100%;
        height: 100%;
        animation: slideshow 30s infinite;
        position: absolute;
        left: 50%;
        top: 0%;
        transform: translateX(-50%);
        object-fit: none; /* Preserves the image's aspect ratio */
        display: block; /* Removes any extra space below the image */
        margin: auto; /* For centering the image */
    }

    @keyframes slideshow {

        0%,
        100% {
            opacity: 1;
        }

        33.33% {
            opacity: 0;
        }

        66.66% {
            opacity: 0;
        }
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #696969;
    }

    th,
    td {
        border: 1px solid white;
        padding: 12px;
        text-align: left;
        font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
        font-size: large;
    }

    th {
        background-color: #ffc40c;
        color: #333;
    }

    tbody tr:nth-child(even) {
        background-color: black;
    }

    /* Pagination styles */
    .pagination {
        margin-top: 20px;
    }

    .pagination a {
        color: #333;
        padding: 8px;
        text-decoration: none;
        background-color: #f2f2f2;
        border-radius: 3px;
        margin-right: 5px;
    }

    .pagination a.active {
        background-color: #333;
        color: #ffc40c;
    }



</style>

<body>
        <div class ="header">
            <img src="g7.jpg">
            <img src="g2.jpg">
            <img src="g3.jpg">
        </div>
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