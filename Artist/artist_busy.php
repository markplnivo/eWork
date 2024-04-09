<?php
ob_start();
date_default_timezone_set('Asia/Taipei');
?>

<!DOCTYPE html>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="jobDetails.css">
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
			grid-template-rows: minmax(auto, 11vh) 3fr 1fr;
			grid-template-columns: repeat(3, minmax(20%, 35%));
		}

		.upload_container {
			grid-template-rows: minmax(auto, 11vh) 2fr 1fr;
			grid-template-columns: repeat(3, minmax(20%, 35%));
		}

		.table_container,
		.upload_container {
			display: grid;
			background-color: #919191;
			grid-area: 3 / 2 / -1 / -1;
			width: 100%;
			height: 100%;
		}

		table {
			border-collapse: collapse;
		}

		th {
			background-color: #ffc400;
			color: #000000;
			text-align: left;
			font-weight: bold;
		}

		td,
		th {
			padding: 12px 25px;
		}

		tr {
			border-bottom: 1px solid #525252;
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

		.jobInfo_color {
			grid-area: 2 / 1 / 3 / 2;
			grid-row: 2 / 3;
			grid-column: 1 / span 2;
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
			border-radius: 5px;
		}

		.jobInfo {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			display: grid;
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 5vh auto;
			flex: 1 0 100%;
		}

		.jobInfo h3 {
			grid-area: 1 / 1 / 2 / 3;
			text-align: center;
			font-size: 1.5vw;
			height: auto;
		}

		.jobDetailFull {
			min-height: 35vh;
			grid-area: 2 / 1 / 3 / 2;
			background-color: #cfcfcf;
		}

		.jobBrief {
			min-height: 35vh;
			grid-area: 2 / 2 / 3 / 3;
		}

		.likertContainer {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-row: 3 / 4;
			grid-column: 1 / span 2;
			text-align: center;
			flex: 1 0 6vh;
			overflow-y: hidden;
			font-size: 0.8vw;
		}


		.likert_scale {
			display: grid;
			grid-template-columns: auto auto;
			grid-template-rows: 30px 30px;
			height: 100%;
		}

		#likertTitle {
			grid-area: 1 / 1 / 2 / 2;
			align-self: center;
			justify-self: end;
		}

		#likertSpan {
			grid-area: 1 / 2 / 2 / 3;
			align-self: center;
			justify-self: start;
		}

		#likertScale {
			grid-row: 2 / 3;
			grid-column: 1/ span 2;
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

		.progressImages {
			grid-area: 1 / 4 / 2 / 4;
			grid-row: 1 / span 3;
			grid-column: 3 / 4;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			text-align: center;
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
			height: 80%;
		}

		.deadlineContainer {
			border: 1px solid #ccc;
			padding: 10px;
			max-width: 400px;
			margin: 0 auto;
			background-color: #cfcfcf;
			grid-area: 1 / 1 / 2 / 4;
		}

		.timeContainer {
			grid-area: 1 / 1 / 2 / 2;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			text-align: center;
			overflow-y: hidden;
			display: flex;
			flex-direction: column;
			justify-content: center;
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
		}

		#goToUploadPage:disabled {
			background-color: #ccc;
			color: #666;
			cursor: not-allowed;
		}

		#goToUploadPage {
			grid-area: 1 / 2 / 2 / 3;
			padding: 10px;
			margin: 30px;
			border-radius: 8px;
			text-align: center;
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
		}


		#goToMainPage {
			grid-area: 1 / 2 / 2 / 3;
			padding: 10px;
			margin: 30px;
			border-radius: 8px;
			text-align: center;
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
			font-size: 0.8vw;
		}

		.ArtistOnlyDeadline {
			grid-template-rows: auto auto;
			height: 100%;
			align-content: center;
			font-size: 0.8vw;
		}

		.uploadButton {
			grid-row: 3 / 4;
			grid-column: 2 / 3;
			height: 30%;
			width: 50%;
			justify-self: end;
			margin: 10px;
			cursor: pointer;
		}

		.uploadButton:disabled {
			color: #000000;
			cursor: not-allowed;
		}

		.time-leftTitle {
			grid-column: 1 / span 3;
		}

		.tooltip {
			display: none;
			position: absolute;
			background-color: #333;
			color: white;
			padding: 5px 10px;
			border-radius: 5px;
			pointer-events: none;
		}

		.tooltip-button[disabled]:hover::after {
			content: attr(data-tooltip);
			/* This attribute will hold the tooltip text */
			position: relative;
			white-space: nowrap;
			bottom: 100%;
			left: 50%;
			transform: translateX(-50%);
			background-color: black;
			color: white;
			padding: 5px 10px;
			border-radius: 6px;
			z-index: 1;
		}

		/* Tooltip arrow */
		.tooltip-button[disabled]:hover::before {
			content: "";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: black transparent transparent transparent;
		}

		#on_breakAlert {
			display: none;
			background-color: #ff0000;
			color: #ffffff;
			padding: 10px;
			border-radius: 5px;
			text-align: center;
			font-size: 0.8vw;
		}

		.jobInfo_Likert {
			margin-left: 10px;
			display: flex;
			grid-row: 2 / 3;
			grid-column: 1 / span 2;
			flex-direction: column;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
			background-color: #f0eee9;
			border-radius: 5px;
		}

		.templateDeadline_table {
			font-size: 0.6vw;
		}

		.templatePicture {
			height: 150px;
		}

		#jobImages {
			background-color: #f0eee9;
			box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
		}
	</style>
</head>

<body>
	<div class="main">

		<?php
		include "artist_menu.php";
		require_once "../action_logger.php";
		$artistName = $_SESSION['username'];
		if ($_SESSION['busy'] == 'online') {
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
			$artistUsername = $_SESSION['username'];
			$sql = "SELECT current_jobID FROM tbl_artist_status WHERE artist_name = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $artistUsername);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($row = $result->fetch_assoc()) {
				if ($row['current_jobID'] !== NULL) {
					// If current_jobID is not null, set the session variable to its value
					$_SESSION['artist_currentJob'] = $row['current_jobID'];
					$_SESSION['busy'] = 'busy';
				} else {
					// If current_jobID is null, set $_SESSION['busy'] to 'online'
					$_SESSION['busy'] = 'online';
					header("Location: artist_home.php");
					exit();
				}
			}
			$stmt->close();

			$artistValue = "Artist";
			$sql = "SELECT jp.process_id, tp.process_name, jp.duration, jp.assigned_person
        	FROM tbl_jobs_processes jp
        	INNER JOIN tbl_template_processes tp ON jp.process_id = tp.process_id
       	 	WHERE jp.job_id = ?
        	ORDER BY assigned_person ASC";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $_SESSION['artist_currentJob']);
			$stmt->execute();
			$result = $stmt->get_result();

			$processes = [];
			while ($row = $result->fetch_assoc()) {
				$processes[] = $row; // Append each row to the processes array
			}

			$stmt->close();


			// Your SQL query
			$sql = "SELECT job_id, 
			creator_name, 
			time_created, 
			job_brief, 
			job_subject, 
			manual_deadline_date, 
			manual_deadline_time, 
			deadline_futureDateTime, 
			template_id,
			job_tracking_method,
			jobstart_datetime
        	FROM tbl_jobs
        	WHERE job_id = ? AND assigned_artist = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $_SESSION['artist_currentJob'], $_SESSION['username']);
			if (!$stmt->execute()) {
				echo "Error executing query: " . $stmt->error;
			}
			$stmt->bind_result(
				$jobId,
				$createdByAgent,
				$timeCreated,
				$jobBrief,
				$jobSubject,
				$manualDeadlineDate,
				$manualDeadlineTime,
				$deadlineFutureDateTime,
				$templateId,
				$jobTrackingMethod,
				$jobstart_datetime
			);
			// Fetch the results
			$stmt->fetch();
			$stmt->close();

			// Prepare the SQL statement
			$sql = "SELECT tl.template_name, tl.filepath_templateimage
			FROM tbl_templatelist tl
			INNER JOIN tbl_jobs j ON tl.template_id = j.template_id
			WHERE j.job_id = ?
			LIMIT 1";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $jobId);
			$stmt->execute();
			$result = $stmt->get_result();

			$templateName = ''; // Initialize the variable to hold the template name
			$filepathTemplateImage = ''; // Initialize the variable to hold the filepath of the template image

			if ($row = $result->fetch_assoc()) {
				// Assign the values to variables
				$templateName = $row['template_name'];
				$filepathTemplateImage = $row['filepath_templateimage'];
			}

			// Initialize the deadline variable
			$deadline = '';
			// Initialize total duration in hours
			$totalDuration = 0;
			$timeLeft = null;
			// Convert the job start datetime to a DateTime object
			// Ensure $jobstart_datetime is not null or empty before creating a DateTime object
			if (!empty($jobstart_datetime)) {
				$jobStart = new DateTime($jobstart_datetime);
			} else {
				// Handle the case where $jobstart_datetime is null or empty
				// For example, set $jobStart to the current time or another default
				$jobStart = new DateTime(); // Defaults to the current time
			}

			// Loop through each process to sum up duration for processes assigned to 'Artist'
			foreach ($processes as $process) {
				if ($process['assigned_person'] === 'Artist') {
					$totalDuration += $process['duration'];
				}
			}

			// Determine if there's a manual deadline, else use the future deadline
			if (!empty($manualDeadlineDate) && !empty($manualDeadlineTime)) {
				$deadline = $manualDeadlineDate . ' ' . $manualDeadlineTime;
			} elseif (!empty($deadlineFutureDateTime)) {
				$deadline = $deadlineFutureDateTime; // Ensure this is not null or empty
			} else {
				// Handle cases where both deadline indicators are null or empty
				$deadline = null; // Or set a default value if applicable
			}

			// Adjust the deadline based on the total duration if greater than 0
			if ($totalDuration > 0 && isset($jobStart)) {
				$jobStart->add(new DateInterval('PT' . $totalDuration . 'M'));
				$deadline = $jobStart->format('Y-m-d H:i:s');
			}

			// Ensure $deadline is not null or empty before attempting to use it
			if (!empty($deadline)) {
				$deadlineDateTime = new DateTime($deadline);
				// Current datetime
				$now = new DateTime();
				// Time left
				$timeLeft = $deadlineDateTime->diff($now);
			} else {
				// Handle case where $deadline is still null or empty
				echo "<script>
						var timeLeftElements = document.querySelectorAll('.time-left');
						timeLeftElements.forEach(function(element) {
							element.style.display = 'none';
						});
					</script>";
			}
			// Assuming $timeCreated is fetched from the database and not null or empty
			if (!empty($timeCreated)) {
				$time_created_datetime = new DateTime($timeCreated);
				$formatted_time_created = $time_created_datetime->format('F j, Y g:i A');

				// Ensure $jobstart_datetime is converted to a DateTime object before formatting
				if (!empty($jobstart_datetime)) {
					$jobStartDateTimeObj = new DateTime($jobstart_datetime);
					$formatted_jobstart_datetime = $jobStartDateTimeObj->format('F j, Y g:i A');
				} else {
					// Handle case where $jobstart_datetime is null or empty
					$formatted_jobstart_datetime = "Job Start Date not available";
				}
			} else {
				// Handle case where $timeCreated is null or empty
				// For example, by setting default values or displaying an error/message
				$formatted_time_created = "Time Created not available";

				// Similar handling for $jobstart_datetime as above
				if (!empty($jobstart_datetime)) {
					$jobStartDateTimeObj = new DateTime($jobstart_datetime);
					$formatted_jobstart_datetime = $jobStartDateTimeObj->format('F j, Y g:i A');
				} else {
					$formatted_jobstart_datetime = "Job Start Date not available";
				}
			}



			// Check if the form is submitted
			/*
			if (isset($_POST["submit_CompleteJob"])) {
				$artistUsername = $_SESSION['username'];
				$currentJobId = $_SESSION['artist_currentJob']; // Ensure this session variable is set when the job is assigned


				// First, update the artist's status
				$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'open', completion_percentage = 0, current_jobID = null WHERE artist_name = ?";
				$stmt = $conn->prepare($updateStatusSql);
				$stmt->bind_param("s", $artistUsername);
				$stmt->execute();
				$stmt->close();

				// Then, mark the current job as completed
				$updateJobStatusSql = "UPDATE tbl_jobs SET job_status = 'completed' WHERE job_id = ? AND job_status <> 'completed'";
				$stmt = $conn->prepare($updateJobStatusSql);
				$stmt->bind_param("i", $currentJobId);
				$stmt->execute();
				$stmt->close();

				$_SESSION['artist_currentJob'] = null; // Reset the current job ID
				$_SESSION['busy'] = 'open'; // Set the artist status to 'open'
				echo "<script>console.log('Job has completed');</script>";
				//header("Location: ./artist_home.php");

			}
			*/

			if (isset($_POST["setOpen"])) {
				$artistUsername = $_SESSION['username'];
				$_SESSION['busy'] = 'online';
				// Update artist_status to "open" and completion_percentage to 0


				$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'online', completion_percentage = 0, current_jobID = null WHERE artist_name = ?";
				$stmt = $conn->prepare($updateStatusSql);
				$stmt->bind_param("s", $artistUsername);
				$stmt->execute();
				$stmt->close();
				header("Location: ./artist_home.php");
				exit();
			}

			?>

			<div class="view-buttons">
				<button id="statusBtn">Start Break</button>
				<span id="on_breakAlert">You are on break. Work orders cannot be processed while on break.</span>
			</div>
		</div>

		<div class="upload_container">

			<button id="goToMainPage">Go to Job Page</button>
			<!-- Upload Time Container-->
			<div class="timeContainer">
				<div class="ArtistOnlyDeadline">
					<b>This job is being tracked by input from Artist.</b>
					<b>Use the progress slider below to update the completion percentage.</b>
				</div>
				<?php
				// Display total duration and the chosen deadline
				if ($timeLeft !== null) {
					echo '<div class="time-left">
							<b class="time-leftTitle">Time Left Until Deadline:</b>
							<div class="days">' . $timeLeft->format('%a') . ' day(s)</div>
							<div class="hours">' . $timeLeft->format('%h') . ' hours</div>
							<div class="minutes">' . $timeLeft->format('%i') . ' minutes</div>
						  </div>';
				} else {
					echo "<script>
						var timeLeftElements = document.querySelectorAll('.time-left');
						timeLeftElements.forEach(function(element) {
							element.style.display = 'none';
						});
					</script>";
				}
				?>
			</div><!-- End of upload_timeContainer div -->

			<div class="jobInfo_color">
				<div class="jobInfo">
					<h3>Current Job Information</h3>
					<div class="jobDetailFull">
						<ul>
							<li><strong>Job ID:</strong> <?php echo $jobId; ?></li>
							<li><strong>Created by Agent:</strong> <?php echo $createdByAgent; ?></li>
							<li><strong>Time Created:</strong> <?php echo $formatted_time_created; ?></li>
							<li><strong>Job Start Time:</strong> <?php echo $formatted_jobstart_datetime; ?></li>
							<div class="templateDeadline">
								<?php if (!empty($processes)) : ?>
									<?php if (!empty($templateName) && !empty($filepathTemplateImage)) : ?>
										<img class="templatePicture" src="<?php echo htmlspecialchars($filepathTemplateImage); ?>" alt="Template Image">
									<?php endif; ?>
									<table class="templateDeadline_table">
										<thead>
											<tr>
												<th>Process Name</th>
												<th>Duration</th>
												<th>Assigned To</th>
												<!-- Add more headers based on the columns in tbl_jobs_processes you wish to display -->
											</tr>
										</thead>
										<tbody>
											<?php foreach ($processes as $process) : ?>
												<tr>
													<td><?php echo htmlspecialchars($process['process_name']); ?></td>
													<td><?php echo htmlspecialchars($process['duration']); ?></td>
													<td><?php echo htmlspecialchars($process['assigned_person']); ?></td>
													<!-- Add more data cells as needed -->
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php endif; ?>
							</div>
							<div id="DEBUG BUTTON">
								<form action="artist_busy.php" method="post" id="debugOpen">
									<input type="submit" name="setOpen" value="debugOpen">
								</form>
							</div>
						</ul>
					</div>



					<div class="jobBrief">
						<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
						<br>
						<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
					</div>
				</div>
			</div>

			<!-- Progress images container -->
			<div class="progressImages">
				<form id="progressImageUploadForm" action="artist_busy.php" method="post" enctype="multipart/form-data">
					<div class="progressImageContainer">
						<label for="progressImage">Upload Your Work Below:</label>

						<img id="defaultProgressImagePreview" src="../upload/default_reference.jpg" alt="Design Reference Preview" />
						<div id="progressImagePreviewContainer"></div>
						<input type="file" id="progressImage" name="progressImage[]" accept="image/*" multiple>
						<label for="progressImage">Max size of each image must not exceed 5MB</label>
						<label for="progressImage">Allowed filetypes: .jpeg/.png/.gif</label>
					</div>
				</form>
			</div>


			<input type="submit" form="progressImageUploadForm" name="submit_CompleteJob" value="Upload & Complete" class="uploadButton" disabled>



		</div>



		<div class="table_container">
			<button id="goToUploadPage" class="tooltip-button" disabled>Go to Upload Page</button>
			<div id="tooltip" style="display: none; position: absolute; background-color: black; color: white; padding: 5px 10px; border-radius: 6px; z-index: 100;">Completion percentage must be 100% before going to upload page.</div>

			<div class="timeContainer">
				<div class="ArtistOnlyDeadline">
					<b>This job is being tracked by input from Artist.</b>
					<b>Use the progress slider below to update the completion percentage.</b>
				</div>

				<?php
				// Display total duration and the chosen deadline
				if ($timeLeft !== null) {
					echo '<div class="time-left">
							<b class="time-leftTitle">Time Left Until Deadline:</b>
							<div class="days">' . $timeLeft->format('%a') . ' day(s)</div>
							<div class="hours">' . $timeLeft->format('%h') . ' hours</div>
							<div class="minutes">' . $timeLeft->format('%i') . ' minutes</div>
						  </div>';
				} else {
					echo "<script>
						var timeLeftElements = document.querySelectorAll('.time-left');
						timeLeftElements.forEach(function(element) {
							element.style.display = 'none';
						});
					</script>";
				}
				?>
			</div>

			<div class=jobInfo_Likert>
				<?php //PHP for likert scale
				// Prepare the SQL query
				$query = "SELECT completion_percentage FROM tbl_artist_status WHERE artist_name = ?";
				if ($stmt = $conn->prepare($query)) {
					$stmt->bind_param("s", $artistUsername);
					$stmt->execute();
					$stmt->bind_result($completionPercentage);
					if ($stmt->fetch()) {
						// $completionPercentage now has the value from the database
					} else {
						$completionPercentage = 0; // Default to 0 if not found
					}
					$stmt->close();
				} else {
					// Handle error
					$completionPercentage = 0; // Default to 0 in case of an error
				}
				//End of PHP for likert scale
				?>

				<!-- Likert scale form -->
				<?php if ($jobTrackingMethod != "deadline") : ?>
					<div class="likertContainer">
						<form action="artist_busy.php" method="post" id="likert_container">
							<div class="likert_scale">
								<p id="likertTitle"><strong>Completion Percentage:</strong></p>
								<span id="likertSpan">0%</span>
								<input id="likertScale" type="range" min="0" max="100" step="25" value="<?php echo $completionPercentage; ?>" name="completionPercentage" />
							</div>
						</form>
					</div>
				<?php else : ?>
					<button id="goToUploadPage">Go to Upload Page</button>
				<?php endif; ?>

				<div class="jobInfo">
					<h3>Current Job Information</h3>
					<div class="jobDetailFull">
						<ul>
							<li><strong>Job ID:</strong> <?php echo $jobId; ?></li>
							<li><strong>Created by Agent:</strong> <?php echo $createdByAgent; ?></li>
							<li><strong>Time Created:</strong> <?php echo $formatted_time_created; ?></li>
							<li><strong>Job Start Time:</strong> <?php echo $formatted_jobstart_datetime; ?></li>
							<div class="templateDeadline">
								<?php if (!empty($processes)) : ?>
									<?php if (!empty($templateName) && !empty($filepathTemplateImage)) : ?>
										<img class="templatePicture" src="<?php echo htmlspecialchars($filepathTemplateImage); ?>" alt="Template Image">
									<?php endif; ?>

									<table class="templateDeadline_table">
										<thead>
											<tr>
												<th>Process Name</th>
												<th>Duration</th>
												<th>Assigned To</th>
												<!-- Add more headers based on the columns in tbl_jobs_processes you wish to display -->
											</tr>
										</thead>
										<tbody>
											<?php foreach ($processes as $process) : ?>
												<tr>

													<td><?php echo htmlspecialchars($process['process_name']); ?></td>
													<td><?php echo htmlspecialchars($process['duration']); ?></td>
													<td><?php echo htmlspecialchars($process['assigned_person']); ?></td>
													<!-- Add more data cells as needed -->
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php endif; ?>
							</div>
							<div id="DEBUG BUTTON">
								<form action="artist_busy.php" method="post" id="debugOpen">
									<input type="submit" name="setOpen" value="debugOpen">
								</form>
							</div>
						</ul>
					</div>



					<div class="jobBrief">
						<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
						<br>
						<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
					</div>
				</div>
			</div>


			<!-- Reference images container -->
			<div id="jobImages">
			</div>



		</div> <!-- End of table_container div -->

	</div> <!-- End of main div -->


</body>



<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {

		// Directly use PHP variable by echoing it into the JavaScript variable
		var jobId = <?php echo json_encode($jobId); ?>; // Ensure $jobId is defined and accessible
		// var jobTrackingMethod = "<?php echo htmlspecialchars($jobTrackingMethod, ENT_QUOTES, 'UTF-8'); ?>";
		var jobTrackingMethod = "<?php echo $jobTrackingMethod; ?>"; // Assuming $jobTrackingMethod is available in PHP
		var deadline = "<?php echo $deadline; ?>"; // Assuming $deadline is available in PHP
		var goToUploadPage = document.getElementById('goToUploadPage');
		var goToMainPage = document.getElementById('goToMainPage');
		var fileInput = document.getElementById('progressImage');
		var submitButton = document.querySelector('.uploadButton');
		var slider = document.getElementById('likertScale');
		var disable_UploadButton = document.getElementById('goToUploadPage');


		const tooltip = document.createElement('div');
		tooltip.id = 'tooltip';
		tooltip.style.cssText = 'display: none; position: absolute; background-color: black; color: white; padding: 5px 10px; border-radius: 6px; z-index: 100; pointer-events: none;';
		tooltip.textContent = 'Completion percentage must be 100% before going to upload page.';
		document.body.appendChild(tooltip);

		const goToUploadButton = document.getElementById('goToUploadPage');
		goToUploadButton.addEventListener('mousemove', function(e) {
			if (goToUploadButton.disabled) {
				tooltip.style.display = 'block';
				tooltip.style.left = `${e.pageX + 10}px`; // Offset the tooltip slightly to avoid flicker
				tooltip.style.top = `${e.pageY + 10}px`;
			}
		});

		goToUploadButton.addEventListener('mouseout', function() {
			tooltip.style.display = 'none';
		});

		var artistName = "<?php echo htmlspecialchars($artistName, ENT_QUOTES, 'UTF-8'); ?>"; // Get the artist name from PHP and sanitize it

		checkArtistStatus();

		// Event handler for the break status toggle button
		$("#statusBtn").click(function() {
			var currentText = $(this).text();
			var newStatus = currentText === "Start Break" ? "on_break" : "busy"; // Use "busy" for the active status

			$.ajax({
				type: "POST",
				url: "update_artist_status.php",
				data: {
					artistName: artistName,
					artistStatus: newStatus
				},
				success: function(response) {
					// Toggle the button text based on the new status
					var buttonText = newStatus === "on_break" ? "End Break" : "Start Break";
					$("#statusBtn").text(buttonText);

					// Check the newStatus and adjust the "Start Selected Job" button accordingly
					if (newStatus === "busy") { // Use "busy" to check if the artist is available to work
						//$("#submitButton").prop('disabled', false).css('background-color', ''); // Re-enable and reset color
						$("#on_breakAlert").hide();
					} else {
						//$("#submitButton").prop('disabled', true).css('background-color', 'grey'); // Disable and grey out
						$("#on_breakAlert").show();
					}
				}
			});
		});

		// Initial check in case the slider's initial value is 100
		updateButtonState();

		// Add event listener for slider changes
		//slider.addEventListener('input', updateButtonState);

		// Check if the file input has any files selected
		fileInput.addEventListener('change', function() {
			submitButton.disabled = this.files.length === 0; // Disable if no files, enable if files are selected
		}); // End of file input change event


		// Add confirmation message on submit button click
		submitButton.addEventListener('click', function(e) {
			var confirmSubmission = confirm("Are you sure you want to upload the images and mark the job as completed?");
			if (!confirmSubmission) {
				e.preventDefault(); // Prevent form submission if the user cancels
			}
		});

		applyVisibility(); // Call the function on page load
		// Add event listener to the submit button and hide table container
		goToUploadPage.addEventListener('click', function() {
			// Toggle state
			var isUploadVisible = localStorage.getItem('isUploadVisible') === 'true';
			// Save the new state
			localStorage.setItem('isUploadVisible', !isUploadVisible);
			// Apply the new state to the elements
			applyVisibility();
		});
		// Add event listener to the main page button and show table container
		goToMainPage.addEventListener('click', function() {
			// Show table container, hide upload container
			localStorage.setItem('isUploadVisible', 'false');
			applyVisibility();
		}); // End of event listener for main page button and show table container


		// Check the job tracking method and hide the likert scale if it's "Deadline" and vice versa
		if (jobTrackingMethod === "Deadline") {
			document.querySelector('.likertContainer').style.display = 'none';
		} else {
			document.querySelector('.likertContainer').style.display = 'block';
		}


		fetchReferenceImages(jobId); // Call the function with jobId on page load
		function fetchReferenceImages(jobId) {
			$.ajax({
				url: 'fetch_reference_images.php', // Endpoint that returns the image URLs
				type: 'POST',
				data: {
					jobId: jobId
				},
				success: function(data) {
					var images = JSON.parse(data);
					var imagesHtml = '<div class="image-gallery"><strong id="image-gallery-title">Reference Images:</strong>';


					// Check if the images array is empty and set a default image
					if (images.length === 0) {
						images.push('http://localhost/eWork_collab/upload/default_reference.jpg'); // Replace with the path to your default image
					}

					images.forEach((url, index) => {
						// Delay the animation start time for each image
						var animationDelay = index * 150; // Adjust delay increment for each image
						imagesHtml += `<img src="${url}" alt="Image" class="gallery-image" style="animation-delay: ${animationDelay}ms;">`;
					});

					imagesHtml += '</div>';
					$("#jobImages").html(imagesHtml);
				},
				error: function(xhr, status, error) {
					console.error("Error fetching images: " + error);
				}
			});
		} // End of fetchReferenceImages function

		// Handle file input change event for progress images
		document.getElementById('progressImage').addEventListener('change', function(event) {
			const progressImagePreviewContainer = document.getElementById('progressImagePreviewContainer');
			const defaultProgressImagePreview = document.getElementById('defaultProgressImagePreview');

			// Clear out any existing dynamic previews
			progressImagePreviewContainer.innerHTML = '';

			const files = event.target.files;
			if (files.length > 0) {
				// Hide the default preview image
				defaultProgressImagePreview.style.display = 'none';

				Array.from(files).forEach(file => {
					if (file.type.startsWith('image/')) {
						const img = document.createElement('img');
						img.classList.add('progressImagePreview'); // Adjust class for styling
						img.src = URL.createObjectURL(file);
						img.onload = function() {
							URL.revokeObjectURL(img.src); // Clean up memory
						};

						// Append the dynamically created img element
						progressImagePreviewContainer.appendChild(img);
					}
				});
			} else {
				// If no files are selected, revert to the default image
				defaultProgressImagePreview.style.display = 'block';
			}
		}); // End of file input change event

		$('#progressImageUploadForm').on('submit', function(e) {
			e.preventDefault();

			var jobId = <?php echo json_encode($jobId); ?>; // Ensure $jobId is defined and accessible
			var files = $('#progressImage')[0].files;
			var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
			var invalidFiles = [];
			var oversizedFiles = [];
			const MAX_SIZE = 5 * 1024 * 1024; // 5 MB in bytes

			// Validate file types and sizes before upload
			for (let i = 0; i < files.length; i++) {
				if (!allowedTypes.includes(files[i].type)) {
					invalidFiles.push(files[i].name);
				}
				if (files[i].size > MAX_SIZE) {
					oversizedFiles.push(files[i].name);
				}
			}

			// If any invalid files are found, alert the user and halt the process
			if (invalidFiles.length > 0) {
				alert("Invalid file type detected: " + invalidFiles.join(", ") + ". Please select only images with .jpeg, .png, or .gif extensions.");
				return; // Stop the submission process
			}

			// If any oversized files are found, alert the user and halt the process
			if (oversizedFiles.length > 0) {
				alert("Oversized file(s) detected: " + oversizedFiles.join(", ") + ". Each file must be no larger than 5MB.");
				return; // Stop the submission process
			}

			if (files.length > 0) {
				var uploadPromises = Array.from(files).map(function(file) {
					var fileData = new FormData();
					fileData.append("progressImage[]", file);
					fileData.append("job_id", jobId);
					console.log("Uploading file:", file.name);
					return $.ajax({
						url: 'upload_progress_file.php',
						type: 'POST',
						data: fileData,
						processData: false,
						contentType: false,
						success: function(data) {
							console.log(data); // Log server response
						},
						error: function(xhr, status, error) {
							console.error("Error uploading file:", error);
						}
					});
				});

				Promise.all(uploadPromises).then(function() {
					console.log("All files uploaded successfully.");
					resetUploadVisibility(); // Call function to reset upload visibility
					logActivity(); // Call function to log the activity
					// Complete the job via Ajax after all files have been successfully uploaded
					$.ajax({
						url: 'complete_job.php',
						type: 'POST',
						data: {}, // Add data if needed
						success: function(response) {
							var res = JSON.parse(response);
							if (res.success) {
								console.log(res.message);
								window.location.href = './artist_home.php'; // Redirect to the artist home page
							} else {
								console.error("Failed to complete the job:", res.message);
							}
						},
						error: function(xhr, status, error) {
							console.error("Error completing the job:", error);
						}
					});
				}).catch(function(error) {
					console.error("Error during file upload:", error);
					alert("An error occurred during the file upload.");
				});
			} else {
				alert("Please select files to upload.");
			}
		}); // End of form submission for file uploading




		// Submit the form when the range value changes
		$('#likertScale').on('input change', function() {
			var completionPercentage = $(this).val();
			$('#likertSpan').text(completionPercentage + '%'); // Update the display

			// Send AJAX request
			$.ajax({
				url: 'update_completion_percentage.php', // Path to your PHP script
				type: 'POST',
				data: {
					completionPercentage: completionPercentage,
					artistUsername: '<?php echo $_SESSION['username']; ?>', // Assuming the username is stored in session
					// artist_currentJob: '<?php echo $_SESSION['artist_currentJob']; ?>' // If you also need to pass the current job ID
				},
				success: function(response) {
					// Handle successful update
					console.log("Update successful: ", response);
					// Optionally, display a success message or update the UI accordingly
				},
				error: function(xhr, status, error) {
					// Handle error
					console.error("Update failed: ", error);
					// Optionally, display an error message
				}
			});
		}); // End of range input event

		// Click event to enlarge the image
		$(document).on('click', '.gallery-image', function(e) {
			if ($(this).hasClass('enlarged')) {
				$(this).removeClass('enlarged');
			} else {
				$('.gallery-image').removeClass('enlarged');
				$(this).addClass('enlarged');
			}
			e.stopPropagation();
		}); // End of click event to enlarge the image

		// Click anywhere on the page to minimize the enlarged image
		$(document).click(function(e) {
			if (!$(e.target).is('.gallery-image')) {
				$('.gallery-image.enlarged').removeClass('enlarged');
			}
		});

		// Check if the job tracking method is "Artist" and the deadline is empty or NULL

		if (jobTrackingMethod === 'Artist' && (deadline === 'NULL' || deadline === '')) {
			// Hide the timer and show the ArtistOnlyDeadline message in all instances
			document.querySelectorAll('.time-left').forEach(function(element) {
				element.style.display = 'none';
			});
			document.querySelectorAll('.ArtistOnlyDeadline').forEach(function(element) {
				element.style.display = 'grid'; // or "flex", "grid" etc.
			});
		} else {
			// If not artist method or deadline is not null, hide ArtistOnlyDeadline message
			document.querySelectorAll('.ArtistOnlyDeadline').forEach(function(element) {
				element.style.display = 'none';
			});
		}

		// Function to update the button state based on the slider value
		function updateButtonState() {
			// If jobTrackingMethod is not 'Artist', enable the button
			// Otherwise, disable or enable based on the slider value
			if (jobTrackingMethod !== 'Artist') {
				goToUploadPage.disabled = false;
			} else {
				// Assuming the slider value indicates completion (100%)
				goToUploadPage.disabled = slider.value != 100;
			}
		} // End of updateButtonState function

		// Add event listener for the slider input event
		if (slider) { // Check if slider exists to avoid errors
			slider.addEventListener('input', updateButtonState);
		} // End of slider input event

	}); // End of DOMContentLoaded

	// Function to show the range value
	$(function() {
		$('.likert_scale input').on('mousemove', function() {
			var getValRange = $(this).val();
			$('.likert_scale span').text(getValRange + '%');
		});
	}); // End of range value function

	function resetUploadVisibility() {
		localStorage.setItem("isUploadVisible", "false");
	}

	// Function to apply visibility based on the state
	function applyVisibility() {
		var isUploadVisible = localStorage.getItem('isUploadVisible') === 'true'; // Retrieve state
		document.querySelector('.upload_container').style.display = isUploadVisible ? 'grid' : 'none';
		document.querySelector('.table_container').style.display = isUploadVisible ? 'none' : 'grid';
	} // End of applyVisibility function

	// Function to check the artist status and disable/enable the submit button
	function checkArtistStatus() {
		var artistName = "<?php echo htmlspecialchars($artistName, ENT_QUOTES, 'UTF-8'); ?>";
		$.ajax({
			type: "POST",
			url: "check_artist_status.php",
			data: {
				artistName: artistName
			},
			success: function(response) {
				if (response.trim() === "on_break") {
					//$("#submitButton").prop('disabled', true).css('background-color', 'grey');
					$("#statusBtn").text("End Break"); // Assume the artist is on a break initially
					$("#on_breakAlert").show();
				} else if (response.trim() === "busy") {
					//$("#submitButton").prop('disabled', false).css('background-color', ''); // Re-enable if status is "open"
					$("#statusBtn").text("Start Break");
					$("#on_breakAlert").hide();
				}
			},
			error: function(xhr, status, error) {
				console.error("An error occurred: " + status + ", " + error);
			}
		});
	} // End of checkArtistStatus function

	// Function to log activity with AJAX
	function logActivity(attempt) {
		attempt = attempt || 1; // Default to first attempt
		$.ajax({
			url: 'log_activity.php',
			type: 'POST',
			data: {
				actionType: 'Job Order Ended',
				subjectId: <?php echo json_encode($jobId); ?>,
				subjectType: 'Job',
				logDetails: 'Job order ended.'
			},
			success: function(logResponse) {
				console.log("Activity logged successfully.", logResponse);
			},
			error: function(logError) {
				console.error("Error logging activity:", logError);
				if (attempt < 3) { // Retry up to 3 times
					console.log(`Retrying... Attempt ${attempt + 1}`);
					logActivity(attempt + 1);
				}
			}
		});
	}// End of logActivity function
</script>


</html>
<?php $conn->close(); ?>
<?php ob_end_flush(); ?>