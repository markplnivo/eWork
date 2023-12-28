<?php
ob_start();
include "artist_menu.php";

if ($_SESSION['busy'] == 'open'){
    header("Location: ./artist_home.php");
    exit();
}


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
if (isset($_POST["submitLikert"])){
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

<!DOCTYPE html>
<html>
<head>
    <title>Artist Home Page</title>
    <style>

		.sidebar {
			grid-area: 1 / 1 / -1/ 2;
		}
		body {
			display:grid;
			height: 100vh;
            grid-template-rows: 10vh 1fr 10vh;
            grid-template-columns: .5fr 2fr .5fr; /* Added grid columns */
			background-color: darkslategray;
		}
		
		ul {
			list-style-type: none;
			padding: 0;
		}
		
		h1, h2, h3, h4 {
			margin: 0;

		}
		
		.dashboard {
			background-color: #f42b03;
			background-image: linear-gradient(316deg, #f42b03 0%, #ffbe0b 74%);
			padding: 30px 0 30px 0;
			border-radius: 5px;
			grid-area: 1 / 1 / 2 / -1;
			text-align: center;
		}
		
		.content {
			display:grid;
			grid-area: 2 / 2 / 3 / 3;
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr; 
		}
		
		.jobInfo {
			background-color: #f42b03;
			background-image: linear-gradient(316deg, #f42b03 0%, #ffbe0b 74%);
			padding: 30px 10px 100px 10px;
			width:80%;
			height: 20%;
			margin: 50px 0 0 20px;
			border-radius: 5px;
			float: left;
		}
		
		.jobBrief {
			background-color: #f42b03;
			background-image: linear-gradient(316deg, #f42b03 0%, #ffbe0b 74%);
			padding: 30px 10px 100px 10px;
			margin: 50px 10px 0 0px;
			height: 40%;
			border-radius: 5px;
		}
		
		#likert_container {
			grid-area: 2 / 2 / 2 / 3;
			place-self: end center;
		}
		.likert-scale{
			background-color: aqua;
			border-radius: 5px;
			clear: right;
			padding-bottom: 3px;
		}
		
        .likert-scale label {
            display: inline-block;
            margin: 0 10px;
            cursor: pointer;
        }
		
		input[type="radio"] {
			cursor: pointer;
			transform: scale(1.5);
  			margin-left: 32px;
		}
		
		.submitButton {
			background-color: green;
    		color: white;
    		padding: 12px 30px;
    		border: 2px solid green;
			border-radius: 20px;
    		cursor: pointer;
    		font-size: 16px;
			grid-area: 2 / 2 / 2 / 3;
			align-self: center;
		}

		#debugOpen {
			grid-area: 2 /2 /2 / 3;
			place-self: end right;
		}
		
    </style>
</head>
<body>

<div class="dashboard">
	<h1><center>D A S H B O A R D</center></h1>	
</div>
	
<div class="content">
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
</div>

<!-- Likert scale form -->
<form action="artist_busy.php" method="post" id="likert_container">
    <div class="likert-scale">
		<p><center><strong>Completion Percentage:</strong></center></p>
        <?php
        // Assuming completion_percentage is a column in tbl_artist_status
        for ($i = 0; $i <= 100; $i += 10) {
            echo "<label><input type='radio' name='completionPercentage' value='$i'>$i</label>";
        }
        ?>
    </div>
    <input type="submit" name="submitLikert" value="Submit" class="submitButton">
</form>

<form action="artist_busy.php" method="post" id="debugOpen">
    <input type="submit" name="setOpen" value="debugOpen">
</form>

</body>
</html>
<?php ob_end_flush();?>