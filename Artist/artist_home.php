<?php ob_start();?>
	<aside>
        <?php include "artist_menu.php"; ?>
    </aside>
<?php

        if ($_SESSION['busy'] == 'busy') {
            header("Location: ./artist_busy.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Home Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f42b03;
			background-image: linear-gradient(316deg, #f42b03 0%, #ffbe0b 74%);
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-rows: 10vh 1fr 10vh;
            grid-template-columns: .5fr 2fr .5fr; /* Added grid columns */
            height:100vh;
        }

        header {
			background-image: url("images/artist_home_header.jpg");
			background-repeat: no-repeat;
            background-color: #333;
            color: #fff;
			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
            padding: 10px;
            text-align: center;
            grid-row: 1 / 2;
            grid-column: span 3; /* Header spans both columns */
        }

        aside {
			background-color: transparent;
            color: #fff;
            padding: 10px;
            grid-row: 2;
            grid-column: 1 / 2;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            grid-row: 2;
            grid-column: 2;
            padding: 2px;
			background-color: transparent;
        }

        h2 {
			font-size: 30px;
            color: #333;
            margin: 30px 0 20px 250px;
        }

        table {
			background-color: lightgray;
            border-collapse: collapse;
            width: 100%;
			font-size: 20px;
        }

        table, th, td {
			color: black;
			margin-left: 150px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #767676;
            color: #fff;
        }
		
		tr {
			border: 1px solid black;
		}
		
		.trHover:hover {
			background-color: white;
		}


        form {
            margin-top: 20px;
        }
		
		input[type="radio"] {
			cursor: pointer;
			transform: scale(2.5);
  			margin-left: 32px;
		}
		
		input[type="radio"]:checked {
			accent-color: #39ff14;
			transform: scale(2.8);
		}
		
		
		input[type="radio"]:active {
			transform: scale(3);
		}

        input[type="submit"] {
    		background-color: green;
    		color: white;
    		padding: 10px 15px;
    		border: 2px solid green;
			border-radius: 15px;
			margin: 8px 0 0 450px;
    		cursor: pointer;
    		font-size: 16px;
		}
		
		input[type="submit"]:hover {
			border: 2px solid white;
		}
		
		input[type="submit"]:active {
			background-color: yellowgreen;
		}

        .pagination {
            margin-top: 150px;
        }

        .pagination a {
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            background-color: #ddd;
            margin: 150px;
        }

        .pagination a.active {
            background-color: #4caf50;
            color: #fff;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            grid-row: 3;
            grid-column: span 3; /* Footer spans both columns */
        }
    </style>
</head>
	
<body>
	
	
    <header>
        <h1>D A S H B O A R D</h1>
    </header>

    <main>
        <h2>Open Jobs</h2>
		
        <?php
        // Pagination
        $results_per_page = 10;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $start_from = ($page - 1) * $results_per_page;

        // Retrieve data from the database for open jobs
        $sql_jobs = "SELECT job_id, creator_name, time_created, job_brief FROM tbl_jobs WHERE job_status = 'open' LIMIT $start_from, $results_per_page";
        $result_jobs = $conn->query($sql_jobs);

        // Display the open jobs table with radio buttons
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

        // Close the database connection
        $conn->close();
        ?>
    </main>

    <footer>
        <!-- Footer content here -->
    </footer>
</body>
</html>
<?php ob_end_flush();?>