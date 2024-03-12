<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Job List</title>
    <link rel="stylesheet" href="path/to/your/stylesheet.css"> <!-- Link to your CSS file -->
</head>
<style>
    *,
    body,
    html {
        overflow-y: auto;
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .main {
        height: 100vh;
        display: grid;
        grid-template-rows: 100px auto 1fr;
        grid-template-columns: 210px 1fr;
    }

    .header-banner {
        grid-area: 1 / 2 / -4 / 3;
    }

    .banner-logo {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .main-title {
        grid-area: 1 / 2 / -4 / 3;
        font-family: 'Oswald', sans-serif;
        color: hsla(0, 0%, 100%, 0.74);
        z-index: 1;
        font-size: 5rem;
        place-self: center center;
        -webkit-text-stroke: 4px black;
        letter-spacing: calc(1em / 9);
    }

    .content-header {
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: auto auto;
        background-color: #292929;
        border-top-style: solid;
        border-bottom-style: solid;
    }

    .content-title {
        background-color: #292929;
        color: #ffffff;
        -webkit-text-stroke: 2px black;
        letter-spacing: calc(4em / 15);
        font-weight: bold;
        font-size: 30px;
        place-self: center center;
    }

    .view-buttons {
        grid-area: 1 / 1 / 2 / 2;
        display: flex;
        place-self: start;
        padding: 10px 0;
    }

    .view-buttons button {
        margin: 0 10px;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #ffc400;
        color: #000000;
    }

    .view-buttons button:hover {
        background-color: #dbaf00;
    }

    .table_container {
        background: Radial-gradient(rgba(71, 71, 71, 0.8), rgba(71, 71, 71, 0)), Radial-gradient(at 0 0, #474747, #070707);

    }

    .table_container,
    .card_container {
        background-color: #919191;
        grid-area: 3 / 2 / -1 / -1;
        width: 100%;
        height: 100%;
    }

    .table_container table {
        border-collapse: collapse;
        margin: 25px 90px;
        font-size: 0.9em;
        min-width: 70vw;
        min-height: 100px;
        border-radius: 12px 12px 0px 0px;
    }

    .table_container th {
        background-color: #ffc400;
        color: #000000;
        text-align: left;
        font-weight: bold;
    }

    .table_container td,
    .table_container th {
        padding: 12px 25px;
    }

    .table_container tr {
        border-bottom: 1px solid #525252;
    }

    .table_container tr:nth-of-type(even) {
        background-color: #cfcfcf;
    }

    .table_container tr:last-of-type {
        border-bottom: 4px solid #dbaf00;
    }

    .pagination-container {
        grid-area: 2 / 1 / 3 / -1;
        place-self: center end;
        background-color: rgba(82, 82, 82, 0.9);
        height: 30px;
        width: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 5%;
    }

    .pagination-container a,
    label {
        margin: 0 10px;
        color: black;
        font-weight: bold;
        text-decoration: none;
    }

    .card {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        display: inline-block;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        background-color: rgba(64, 64, 64, 0.4);
    }
</style>

<body>
    <div class="main">
        <?php
        include "agent_menu.php";
        include "../logindbase.php";
        ?>

        <h1 class="main-title">Agent Job Creation</h1>
        <div class="header-banner">
            <img src="../images/holden-baxter-oxQ0egaQMfU-unsplash.jpg" class="banner-logo">
        </div>
        <!-- Content Section -->
        <div class="content-header">
            <h2 class="content-title"></h2>
            <div class="view-buttons">
                <!--
                <button id="tableViewBtn">Table View</button>
                <button id="cardViewBtn">Card View</button> 
                -->
            </div>
        </div>

        <?php
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

        <div class="table_container" id="tableView">
            <table>
            <tbody>
                    <tr>
                        <th>Job ID</th>
                        <th>Time Created</th>
                        <th>Job Subject</th>
                        <th>Job Brief</th>
                        <th>Estimated Completion</th>
                    </tr>
             
                    <?php while ($row = $result->fetch_assoc()) : ?>
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
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>


<?php ob_end_flush(); ?>