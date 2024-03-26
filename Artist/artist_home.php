<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>
<meta charset="UTF-8">
<title>Artists' Status</title>
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
        grid-area: 2 / 1 / 3 / -1;
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

    .table_container,
    .card_container {
        display: grid;
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
        include "artist_menu.php";
        include "../logindbase.php";

        $artistName = $_SESSION['username']; // Example: getting the artist name from the session

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT artist_status FROM tbl_artist_status WHERE artist_name = ?");

        // Bind the parameter (s for string)
        $stmt->bind_param("s", $artistName);

        // Execute the query
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($artistStatus);

        // Fetch the result. No need for a loop since we expect only one row
        if ($stmt->fetch()) {
            // Assign the result to the session variable
            $_SESSION['busy'] = $artistStatus;
        } else {
            // Handle the case where the artist does not exist in the table
            echo "Artist not found or other error.";
        }

        // Close the statement
        $stmt->close();

        if ($_SESSION['busy'] == 'busy') {
            header("Location: ./artist_busy.php");
            exit();
        }
        ?>

        <h1 class="main-title">Job List</h1>
        <div class="header-banner">
            <img src="../images/duo motorbike.jpg" class="banner-logo">
        </div>
        <div class="content-header">
            <h2 class="content-title"></h2>

            <?php
            // Pagination
            $results_per_page = 15;
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $start_from = ($page - 1) * $results_per_page;
            // Pagination links
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);

            ?>

            <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="cardViewBtn">Card View</button>
            </div>

            <?php
            echo "<div class='pagination-container'>";
            echo "<label>Page</label>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='$current_page?page=$i' class='page-link'>" . $i . "</a> ";
            }
            echo "<input type='text' id='searchInput' placeholder='Search for names...'>";
            echo "</div>";
            ?>

        </div>

        <?php

        // Retrieve data from the database for open jobs
        $sql_jobs = "SELECT job_id, creator_name, time_created, job_brief FROM tbl_jobs WHERE job_status = 'open' LIMIT $start_from, $results_per_page";
        $result_jobs = $conn->query($sql_jobs);

        echo '<div class="table_container" id="tableView">';
        // Display the table
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<table>";
        echo "<tr><th id='th1'>Select</th><th>Job ID</th><th>Creator Name</th><th>Time Created</th><th>Job Brief</th></tr>";


        while ($row_jobs = $result_jobs->fetch_assoc()) {
            echo "<tr class='trHover'>";
            echo "<td><input type='radio' name='selected_job' value='" . $row_jobs['job_id'] . "'> </label></td>";
            echo "<td>" . $row_jobs['job_id'] . "</td>";
            echo "<td>" . $row_jobs['creator_name'] . "</td>";
            echo "<td>" . $row_jobs['time_created'] . "</td>";
            echo "<td>" . $row_jobs['job_brief'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<input type='submit' name='press_selectJob' value='Start Selected Job'>";
        echo "</form>";
        echo '</div>';


        // Check if the form is submitted
        if (isset($_POST['press_selectJob']) && isset($_POST['selected_job'])) {
            // Get the selected job_id and update tbl_jobs
            $selectedJobId = $_POST['selected_job'];
            $assignedArtist = $_SESSION['username'];
            $_SESSION['artist_currentJob'] = $selectedJobId;

            $updateSql = "UPDATE tbl_jobs SET job_status = 'ongoing', assigned_artist = ? WHERE job_id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("si", $assignedArtist, $selectedJobId);
            $stmt->execute();
            $stmt->close();

            // Set session variable 'busy'
            $_SESSION['busy'] = 'busy';

            // Update tbl_artist_status
            $updateArtistStatusSql = "UPDATE tbl_artist_status SET artist_status = 'busy' WHERE artist_name = ?";
            $stmtArtistStatus = $conn->prepare($updateArtistStatusSql);
            $stmtArtistStatus->bind_param("s", $assignedArtist);
            $stmtArtistStatus->execute();
            $stmtArtistStatus->close();
            header("Refresh:0");
        }

        // Check tbl_userlist for new usernames with job_position 'Artist'
        $sqlCheckNewArtists = "SELECT username FROM tbl_userlist WHERE job_position = 'Artist' AND username NOT IN (SELECT artist_name FROM tbl_artist_status)";
        $resultCheckNewArtists = $conn->query($sqlCheckNewArtists);

        // Insert new artists into tbl_artist_status
        if ($resultCheckNewArtists->num_rows > 0) {
            $insertSql = "INSERT INTO tbl_artist_status (artist_name, artist_status) VALUES (?, 'open')";
            $stmtInsert = $conn->prepare($insertSql);

            while ($row = $resultCheckNewArtists->fetch_assoc()) {
                $newArtistName = $row['username'];
                $stmtInsert->bind_param("s", $newArtistName);
                $stmtInsert->execute();
            }

            $stmtInsert->close();
        }

        // Pagination links for open jobs
        $sql_jobs_total = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE job_status = 'open'";
        $result_jobs_total = $conn->query($sql_jobs_total);
        $row_jobs_total = $result_jobs_total->fetch_assoc();
        $total_pages_jobs = ceil($row_jobs_total['total'] / $results_per_page);

        $current_page_jobs = basename($_SERVER['PHP_SELF']);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages_jobs; $i++) {
            echo "<a href='$current_page_jobs?page=" . $i . "'>" . $i . "</a> ";
        }
        echo "</div>";


        echo '<div class="card_container" id="cardView" style="display: none;">';
        foreach ($result as $row) {
            echo "<div class='card' style='width: 250px; height: 250px;'>";
            echo "<p>Job ID: " . $row['job_id'] . "</p>";
            echo "<p>Creator Name: " . $row['creator_name'] . "</p>";
            echo "<p>Time Created: " . $row['time_created'] . "</p>";
            echo "<p>Job Brief: " . $row['job_brief'] . "</p>";
            // Add more data as needed
            echo "</div>";
        }
        echo '</div>';


        // Close the database connection
        $conn->close();
        echo "</div>";
        echo "</div>";
        ?>
    </div>
</body>
<?php ob_end_flush(); ?>