<?php ob_start();?>
<?php
include "agent_menu.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agent Job Creation</title>
<style>

    body {
        display: grid;
        gap: 30px 30px;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: .5fr 1fr .25fr;
        background-color: #1a1a1a;
        color: #fff;
        font-family: Arial, sans-serif;
    }

/* Header Styles */
.header {
    place-self:center stretch;
    position: relative;
    grid-area: 1 / 1/ 2 / -1;
    background-color: #333; /* Header background color */
    padding: 15vh;
    text-align: center;
    max-width: 100%;
    max-height: 100%; /* Adjusted height */
    overflow: hidden;
}

.header img {
    width: 100%;
    height: 100%;
    animation: slideshow 15s infinite; /* Slideshow animation */
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    object-fit: none; /* Preserves the image's aspect ratio */
    display: block; /* Removes any extra space below the image */
    margin: auto; /* For centering the image */
}

/* Slideshow Animation */
@keyframes slideshow {
    0%, 100% {
        opacity: 1;
        transform: translateX(-50%);
    }
    10%, 30% {
        opacity: 1;
        transform: translateX(-50%);
    }
    33.33%, 66.66% {
        opacity: 0;
        transform: translateX(-150%); /* Slide out */
    }
    70%, 90% {
        opacity: 1;
        transform: translateX(-50%);
    }
}

.header img:nth-child(1) {
    animation-delay: 5s;
}

.header img:nth-child(2) {
    animation-delay: 10s;
}

.header img:nth-child(3) {
    animation-delay: 15s;
}


/* Content Styles */
.content {
    grid-area: 2 / 1 / 3 / -1;
    display:grid;
    place-self:center stretch;
    margin: 5%;
    padding: 20px;
    background: black; /* Content background color */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    animation: chaseColors 4s linear infinite; /* Border color animation */
    max-width: 100%;
    height: 100%;
}

/* Border Color Animation */
@keyframes chaseColors {
    0%, 100% {
        border: 3px solid red;
    }
    50% {
        border: 3px solid blue;
    }
}

/* Typography Styles */
h2 {
    color: #ffc40c;
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
    text-align: center;
}

/* Form Styles */
form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    text-align: left;
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
    color: #ffc40c;
}

/* Input Styles */
input[type="text"],
textarea,
input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border-radius: 4px;
    background-color: #444; /* Input background color */
    color: #fff; /* Input text color */
}

/* Button Styles */
input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    box-shadow: 0 0 5px #00ff00, 0 0 25px #00ff00; /* Button hover effect */
}


</style>
<body>
<div class ="header">
    <img src="g7.jpg" id="pic1">
    <img src="g2.jpg" id="pic2">
    <img src="g3.jpg" id="pic3">
</div>
    <div class="content">
        <h2>Job Creation</h2>
        <form class="job-creation-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="job-subject">Job Subject:</label>
            <input type="text" id="job-subject" name="job-subject" required>

            <label for="job-brief">Job Brief:</label>
            <textarea id="job-brief" name="job-brief" rows="4" required></textarea>

            <label for="estimated-hours"> Estimated Completion Time:</label>
            <input type="number" id="estimated-hours" name="estimated-hours" placeholder="Hours" required>
            <input type="number" id="estimated-minutes" name="estimated-minutes" placeholder="Minutes" required>

            <center><input type="submit" name="submitJobCreation" value="Create Job"></center>
        </form>
    </div>
    <?php
    // Check if the form is submitted
    if (isset($_POST['submitJobCreation'])) {
        include "../logindbase.php";

        $jobSubject = $_POST['job-subject'];
        $jobBrief = $_POST['job-brief'];
        $hours = intval($_POST['estimated-hours']);
        $minutes = intval($_POST['estimated-minutes']);
        $estimatedCompletion = $hours * 60 + $minutes;
        $creatorName = $_SESSION['username'];

        // Insert a new row into tbl_jobs
        $insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief, estimated_completion) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?, ?)";
        $stmtInsert = $conn->prepare($insertSql);
        $stmtInsert->bind_param("sssi", $creatorName, $jobSubject, $jobBrief, $estimatedCompletion);
        $stmtInsert->execute();
        $stmtInsert->close();

        // Redirect to the agent home page or another appropriate page
        header("Refresh:0");
        exit();
    }
    ?>
</body>

</html>
<?php ob_end_flush();?>