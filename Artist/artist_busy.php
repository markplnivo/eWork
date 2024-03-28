<?php
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Artist Home Page</title>
	<style>
		@import "compass/css3";

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

		.table_container {
			grid-template-rows: auto auto auto;
			grid-template-columns: auto;
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

		.jobInfo {
			background-color: #919191;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 1 / 1 / 2 / 2;
		}

		.jobBrief {
			background-color: #919191;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 2 / 1 / 3 / 2;

		}

		.likertContainer {
			background-color: #919191;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 3 / 1 / 4 / 2;
			text-align: center;
			margin: 20px;
		}

		.likert-scale #cubeRange {
			
		}

		
	</style>
</head>

<body>
	<div class="main">

		<?php
		include "artist_menu.php";

		if ($_SESSION['busy'] == 'open') {
			header("Location: ./artist_home.php");
			exit();
		}
		?>

		<h1 class="main-title">Artist Dashboard</h1>
		<div class="header-banner">
			<img src="../images/duo motorbike.jpg" class="banner-logo">
		</div>

		<div class="content-header">
			<h2 class="content-title"></h2>
			<?php


			// Your SQL query
			$sql = "SELECT job_id, creator_name, time_created, job_brief, job_subject
        FROM tbl_jobs
        WHERE job_id = ? AND assigned_artist = ?";

			// Create a prepared statement
			$stmt = $conn->prepare($sql);

			// Bind the parameters
			$stmt->bind_param("ss", $_SESSION['artist_currentJob'], $_SESSION['username']);

			// Execute the statement
			$stmt->execute();

			// Bind the result to variables
			$stmt->bind_result($jobId, $createdByAgent, $timeCreated, $jobBrief, $jobSubject);

			// Fetch the result
			$stmt->fetch();

			if (!$stmt->execute()) {
				echo "Error executing query: " . $stmt->error;
			}
			// Close the statement
			$stmt->close();

			// Check if the form is submitted
			if (isset($_POST["submitLikert"])) {
				$artistUsername = $_SESSION['username'];
				$completionPercentage = $_POST["completionPercentage"];

				// Update the completion_percentage in tbl_artist_status
				$updateSql = "UPDATE tbl_artist_status SET completion_percentage = ? WHERE artist_name = ?";
				$stmt = $conn->prepare($updateSql);
				$stmt->bind_param("ss", $completionPercentage, $artistUsername);
				$stmt->execute();
				$stmt->close();
				header("Refresh:0");
			}

			if (isset($_POST["setOpen"])) {
				$artistUsername = $_SESSION['username'];
				$_SESSION['busy'] = 'open';
				// Update artist_status to "open" and completion_percentage to 0
				$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'open', completion_percentage = 0 WHERE artist_name = ?";
				$stmt = $conn->prepare($updateStatusSql);
				$stmt->bind_param("s", $artistUsername);
				$stmt->execute();
				$stmt->close();
				header("Location: ./artist_home.php");
				exit();
			}
			// Close the database connection here to avoid issues
			$conn->close();
			?>

			<div class="view-buttons">
				<button id="tableViewBtn">Table View</button>
				<button id="cardViewBtn">Card View</button>
			</div>
		</div>

		<div class="table_container">
			<div class="jobInfo">
				<h3>Current Job Information</h3>
				<ul>
					<li><strong>Job ID:</strong> <?php echo $jobId; ?></li>
					<li><strong>Created by Agent:</strong> <?php echo $createdByAgent; ?></li>
					<li><strong>Time Created:</strong> <?php echo $timeCreated; ?></li>
				</ul>
			</div>


			<div class="jobBrief">
				<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
				<br>
				<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
			</div>


			<!-- Likert scale form -->
			<div class="likertContainer">
				<form action="artist_busy.php" method="post" id="likert_container">
					<div class="likert-scale">
						<p><strong>Completion Percentage:</strong></p>
						<input type='range' min='1' max='7' step='1' value='4' id="cubeRange"/>
					</div>
					<input type="submit" name="submitLikert" value="Submit" class="submitButton">
				</form>
			</div>
		</div>

	</div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var rangeInput = document.getElementById('cubeRange');

    // Update cube visualization based on the slider value
    function updateCubes(value) {
        // This is a placeholder for any logic you need to update the visual representation
        // of the cubes based on the slider's value. You might need to dynamically adjust
        // the CSS or trigger a re-render of the cubes if using a web component or canvas.
    }

    rangeInput.addEventListener('input', function() {
        updateCubes(this.value);
    });
});
</script>


</html>
<?php ob_end_flush(); ?>