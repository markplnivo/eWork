<?php
ob_start();
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
			grid-template-rows: 10% 55% 35%;
			grid-template-columns: repeat(3, minmax(20%, 35%));
		}

		.upload_container {
			grid-template-rows: 10% 55% 35%;
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
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 2 / 1 / 3 / 2;
			grid-row: 2 / 3;
			grid-column: 1 / span 2;
		}

		.jobBrief {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
		}

		.likertContainer {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-row: 3 / 4;
			grid-column: 1 / span 2;
			text-align: center;
			height: 30%;
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
			background-color: #cfcfcf;
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
			background-color: #cfcfcf;
			overflow-y: hidden;
		}

		#goToUploadPage {
			grid-area: 1 / 2 / 2 / 3;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			text-align: center;
			background-color: #cfcfcf;
		}


		#goToMainPage {
			grid-area: 1 / 2 / 2 / 3;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			text-align: center;
			background-color: #cfcfcf;
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
					// If current_jobID is null, set $_SESSION['busy'] to 'open'
					$_SESSION['busy'] = 'open';
					header("Location: agent_home.php");
					exit();
				}
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
			job_tracking_method
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
				$jobTrackingMethod
			);
			// Fetch the results
			$stmt->fetch();
			$stmt->close();


			// Check if the form is submitted
			if (isset($_POST["submit_CompleteJob"])) {
				$artistUsername = $_SESSION['username'];
				$_SESSION['busy'] = 'open';

				$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'open', completion_percentage = 0, current_jobID = null WHERE artist_name = ?";
				$stmt = $conn->prepare($updateStatusSql);
				$stmt->bind_param("s", $artistUsername);
				$stmt->execute();
				$stmt->close();
				header("Location: ./artist_home.php");
				exit();
			}

			if (isset($_POST["setOpen"])) {
				$artistUsername = $_SESSION['username'];
				$_SESSION['busy'] = 'open';
				// Update artist_status to "open" and completion_percentage to 0


				$updateStatusSql = "UPDATE tbl_artist_status SET artist_status = 'open', completion_percentage = 0, current_jobID = null WHERE artist_name = ?";
				$stmt = $conn->prepare($updateStatusSql);
				$stmt->bind_param("s", $artistUsername);
				$stmt->execute();
				$stmt->close();
				header("Location: ./artist_home.php");
				exit();
			}

			// Countdown timer
			// Determine which deadline to use
			if (!empty($manualDeadlineDate) && !empty($manualDeadlineTime)) {
				$deadline = $manualDeadlineDate . ' ' . $manualDeadlineTime;
			} else {
				$deadline = $deadlineFutureDateTime;
			}
			// Current datetime
			$now = new DateTime();
			// Deadline datetime
			$deadlineDateTime = new DateTime($deadline);
			// Time left
			$timeLeft = $deadlineDateTime->diff($now);
			// Display the countdown
			?>

			<div class="view-buttons">
				<button id="tableViewBtn">Table View</button>
				<button id="cardViewBtn">Card View</button>
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

				<div class="time-left">
					<b class="time-leftTitle">Time Left Until Deadline:</b>
					<div class="days"><?php echo $timeLeft->format('%a') . ' day(s)'; ?></div>
					<div class="hours"><?php echo $timeLeft->format('%h') . ' hours'; ?></div>
					<div class="minutes"><?php echo $timeLeft->format('%i') . ' minutes'; ?></div>
				</div>
			</div><!-- End of upload_timeContainer div -->

			<div class="jobInfo">
				<h3>Current Job Information</h3>
				<ul>
					<li><strong>Job ID:</strong> <?php echo $jobId; ?></li>
					<li><strong>Created by Agent:</strong> <?php echo $createdByAgent; ?></li>
					<li><strong>Time Created:</strong> <?php echo $timeCreated; ?></li>
				</ul>

				<div id="DEBUG BUTTON">
					<form action="artist_busy.php" method="post" id="debugOpen">
						<input type="submit" name="setOpen" value="debugOpen">
					</form>
				</div>

				<div class="jobBrief">
					<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
					<br>
					<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
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
					</div>
				</form>
			</div>


			<input type="submit" form="progressImageUploadForm" name="submit_CompleteJob" value="Upload & Complete" class="uploadButton" disabled>



		</div>



		<div class="table_container">

			<button id="goToUploadPage">Go to Upload Page</button>

			<div class="timeContainer">
				<div class="ArtistOnlyDeadline">
					<b>This job is being tracked by input from Artist.</b>
					<b>Use the progress slider below to update the completion percentage.</b>
				</div>

				<div class="time-left">
					<b class="time-leftTitle">Time Left Until Deadline:</b>
					<div class="days"><?php echo $timeLeft->format('%a') . ' day(s)'; ?></div>
					<div class="hours"><?php echo $timeLeft->format('%h') . ' hours'; ?></div>
					<div class="minutes"><?php echo $timeLeft->format('%i') . ' minutes'; ?></div>
				</div>
			</div>

			<div class="jobInfo">
				<h3>Current Job Information</h3>
				<ul>
					<li><strong>Job ID:</strong> <?php echo $jobId; ?></li>
					<li><strong>Created by Agent:</strong> <?php echo $createdByAgent; ?></li>
					<li><strong>Time Created:</strong> <?php echo $timeCreated; ?></li>
				</ul>

				<div id="DEBUG BUTTON">
					<form action="artist_busy.php" method="post" id="debugOpen">
						<input type="submit" name="setOpen" value="debugOpen">
					</form>
				</div>

				<div class="jobBrief">
					<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
					<br>
					<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
				</div>
			</div>




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
						<!-- <input type="submit" name="submitLikert" value="Submit" class="submitButton"> -->
					</form>
				</div>
			<?php endif; ?>


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

		// Initial check in case the slider's initial value is 100
		//updateButtonState();

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

		// Handling form submission for file uploading
		$('#progressImageUploadForm').on('submit', function(e) {
			e.preventDefault();

			var form = this;
			var jobId = <?php echo json_encode($jobId); ?>; // Ensure $jobId is defined and accessible
			var files = $('#progressImage')[0].files;
			if (files.length > 0) {
				var uploadPromises = Array.from(files).map(function(file) {
					var fileData = new FormData();
					fileData.append("progressImage[]", file); // Add each file under the same name
					fileData.append("job_id", jobId); // Add the job ID for each file
					console.log("Uploading file:", file.name); // Log the file name for debugging
					return $.ajax({
						url: 'upload_progress_file.php', // Endpoint for file upload
						type: 'POST',
						data: fileData,
						processData: false,
						contentType: false
					});
				});

				Promise.all(uploadPromises).then(function() {
					console.log("All files uploaded successfully.");
					var hiddenInput = document.createElement('input');
					hiddenInput.type = 'hidden';
					hiddenInput.name = 'submit_CompleteJob';
					hiddenInput.value = 'Upload & Complete'; // The value of your submit button
					form.appendChild(hiddenInput);
					// Update UI or refresh the page as needed
					//window.location.reload(true);
					form.submit(); // Submit the form after all files are uploaded
				}).catch(function(error) {
					console.error("Error during file upload:", error);
					alert("An error occurred during the file upload.");
				});
			} else {
				alert("Please select files to upload.");
			}
		}); // End of form submission event


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

		/*
		// Function to update the button state based on the slider value
		function updateButtonState() {
			if (slider.value == 100) {
				disable_UploadButton.disabled = false; // Enable disable_UploadButton
				// Optionally reset styles if needed
			} else {
				disable_UploadButton.disabled = true; // Disable disable_UploadButton
			}

		} // End of updateButtonState function
		*/

	}); // End of DOMContentLoaded

	// Function to show the range value
	$(function() {
		$('.likert_scale input').on('mousemove', function() {
			var getValRange = $(this).val();
			$('.likert_scale span').text(getValRange + '%');
		});
	}); // End of range value function

	// Function to apply visibility based on the state
	function applyVisibility() {
		var isUploadVisible = localStorage.getItem('isUploadVisible') === 'true'; // Retrieve state
		document.querySelector('.upload_container').style.display = isUploadVisible ? 'grid' : 'none';
		document.querySelector('.table_container').style.display = isUploadVisible ? 'none' : 'grid';
	} // End of applyVisibility function
</script>


</html>
<?php $conn->close(); ?>
<?php ob_end_flush(); ?>