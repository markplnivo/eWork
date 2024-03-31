<?php
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Artist Home Page</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

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


		.likert_scale {
			display: grid;
			grid-template-columns: auto;
			grid-template-rows: 30px 30px 30px;
		}


		#likertTitle {
			grid-area: 1 / 1 / 2 / 2;
			align-self: center;
			justify-self: center;
		}

		#likertSpan {
			grid-area: 2 / 1 / 3 / 2;
			align-self: center;
			justify-self: center;
		}

		#likertScale {
			grid-area: 3 / 1 / 4 / 2;
			align-self: center;
			justify-self: center;
		}

		.likert_scale input {
			-webkit-appearance: none;
			width: 400px;
			height: 10px;
			border-radius: 5px;
			background-color: #ba3950;
			outline: none;
		}

		.likert_scale input::-webkit-slider-thumb {
			-webkit-appearance: none;
			width: 30px;
			height: 20px;
			border-radius: 50%;
			background-color: #a83348;
		}

		.likert_scale input[type='range']::-moz-range-thumb {
			width: 30px;
			height: 20px;
			background: #4CAF50;
		}

		.likert_scale span {
			width: 75px;
			height: 30px;
			background-color: #222;
			color: #fff;
			border-radius: 3px;
			text-align: center;
			line-height: 30px;
		}

		.likert_scale span:before {
			content: '';
			border-bottom: 12px solid #222;
			left: -10px;
			top: 50%;
			transform: translateY(-50%) rotate(-90deg);
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

			$sql = "SELECT current_jobID FROM tbl_artist_status WHERE artist_name = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $artistName);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($row = $result->fetch_assoc()) {
				if ($row['current_jobID'] !== NULL) {
					// If current_jobID is not null, set the session variable to its value
					$_SESSION['artist_currentJob'] = $row['current_jobID'];
					$_SESSION['busy'] = 'busy';
				} else {
					// If current_jobID is null, set $_SESSION['busy'] to 'open'
					$_SESSION['busy'] = 'open';
					header("Location: agent_home.php");
					exit();
				}
			}
			$stmt->close();


			// Your SQL query
			$sql = "SELECT job_id, creator_name, time_created, job_brief, job_subject
        	FROM tbl_jobs
        	WHERE job_id = ? AND assigned_artist = ?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $_SESSION['artist_currentJob'], $_SESSION['username']);
			$stmt->execute();
			$stmt->bind_result($jobId, $createdByAgent, $timeCreated, $jobBrief, $jobSubject);
			$stmt->fetch();
			if (!$stmt->execute()) {
				echo "Error executing query: " . $stmt->error;
			}
			$stmt->close();

			// Check if the form is submitted
			if (isset($_POST["submitLikert"])) {
				$artistUsername = $_SESSION['username'];
				$completionPercentage = $_POST["completionPercentage"];
				$artist_currentJob = $_SESSION['artist_currentJob'];

				$sql = "UPDATE tbl_jobs SET job_status = 'completed' WHERE job_id = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("i", $artist_currentJob);
				$stmt->execute();
				// Check for success or handle errors
				if ($stmt->affected_rows > 0) {
					echo "Job status updated successfully.";
				} else {
					echo "No job found with the provided ID.";
				}
				$stmt->close();

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
					<div class="likert_scale">
						<p id="likertTitle"><strong>Completion Percentage:</strong></p>
						<span id="likertSpan">0%</span>
						<input id="likertScale" type="range" min='0' max='100' step='25' value='0' />
					</div>
					<input type="submit" name="submitLikert" value="Submit" class="submitButton">
				</form>
				<div id="DEBUG BUTTON">
					<form action="artist_busy.php" method="post" id="debugOpen">
						<input type="submit" name="setOpen" value="debugOpen">
					</form>
				</div>
			</div>
		</div>

	</div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script type="text/javascript">
	// Function to show the range value
	$(function() {
		$('.likert_scale input').on('mousemove', function() {
			var getValRange = $(this).val();
			$('.likert_scale span').text(getValRange + '%');
		});


	});
</script>


</html>
<?php ob_end_flush(); ?>