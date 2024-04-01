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
			grid-template-rows: repeat(2, minmax(300px, 400px));
			grid-template-columns: repeat(4, minmax(300px, 500px));
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
			grid-area: 1 / 1 / 2 / 2;
		}

		.jobBrief {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 1 / 2 / 1 / 3;

		}

		.likertContainer {
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			grid-area: 1 / 3 / 2 / 4;
			text-align: center;

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

		.progressImages {
			grid-area: 1 / 4 / 2 / 4;
			padding: 10px;
			margin: 10px;
			border-radius: 8px;
			text-align: center;
			background-color: #cfcfcf;
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
			$sql = "SELECT job_id, creator_name, time_created, job_brief, job_subject, manual_deadline_date, manual_deadline_time, deadline_futureDateTime, template_id
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
				$templateId
			);
			// Fetch the results
			$stmt->fetch();
			$stmt->close();


			// Check if the form is submitted
			if (isset($_POST["submitLikert"])) {
			} // End of submitLikert check

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

			echo "$jobId"
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
				<?php
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
				<strong>Time Left Until Deadline:</strong>
				<div class="time-left">
					<div class="days"><?php echo $timeLeft->format('%a') . ' day(s)'; ?></div>
					<div class="hours"><?php echo $timeLeft->format('%h') . ' hours'; ?></div>
					<div class="minutes"><?php echo $timeLeft->format('%i') . ' minutes'; ?></div>
				</div>
			</div>


			<div class="jobBrief">
				<strong>Job Subject:</strong> <?php echo $jobSubject; ?>
				<br>
				<strong>Job Brief:</strong> <?php echo $jobBrief; ?>
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
			<div class="likertContainer">
				<form action="artist_busy.php" method="post" id="likert_container">
					<div class="likert_scale">
						<p id="likertTitle"><strong>Completion Percentage:</strong></p>
						<span id="likertSpan">0%</span>
						<input id="likertScale" type="range" min="0" max="100" step="25" value="<?php echo $completionPercentage; ?>" name="completionPercentage" />
					</div>
					<input type="submit" name="submitLikert" value="Submit" class="submitButton">
				</form>

				<div id="DEBUG BUTTON">
					<form action="artist_busy.php" method="post" id="debugOpen">
						<input type="submit" name="setOpen" value="debugOpen">
					</form>
				</div>
			</div>

			<!-- Reference images container -->
			<div id="jobImages">TEST</div>

			<!-- Progress images container -->
			<div class="progressImages">
				<form id="progressImageUploadForm" action="javascript:void(0);" method="post" enctype="multipart/form-data">
					<div class="progressImageContainer">
						<label for="progressImage">Reference Image:</label>
						<img id="defaultProgressImagePreview" src="../upload/default_reference.jpg" alt="Design Reference Preview" />
						<div id="progressImagePreviewContainer"></div>
						<input type="file" id="progressImage" name="progressImage[]" accept="image/*" multiple>
					</div>
					<input type="submit" name="submitProgressImage" value="Upload Reference Image" class="submitButton">
				</form>
			</div>


		</div> <!-- End of table_container div -->

	</div> <!-- End of main div -->


</body>



<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {

		// Directly use PHP variable by echoing it into the JavaScript variable
		var jobId = <?php echo json_encode($jobId); ?>; // Ensure $jobId is defined and accessible

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
					var imagesHtml = '<div class="image-gallery">';

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
					// Update UI or refresh the page as needed
					//window.location.reload(true);
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

	}); // End of DOMContentLoaded

	// Function to show the range value
	$(function() {
		$('.likert_scale input').on('mousemove', function() {
			var getValRange = $(this).val();
			$('.likert_scale span').text(getValRange + '%');
		});


	});
</script>


</html>
<?php $conn->close(); ?>
<?php ob_end_flush(); ?>