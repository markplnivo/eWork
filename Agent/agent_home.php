<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agent Job Creation</title>
<style>
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
        grid-template-rows: auto;
        background-color: #292929;
        padding: 20px;
        border-top-style: solid;
        border-bottom-style: solid;
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

    .table_container form {
        display: grid;
        background-color: #919191;
        grid-area: 3 / 2 / -1 / -1;
        width: 100%;
        height: 100%;
    }

    input[type="text"],
    textarea,
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #444;
        color: #fff;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        margin: 20px auto;
        width: 210px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
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
            <img src="banner logo.jpg" class="banner-logo">
        </div>
        <div class="content-header">
            <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="cardViewBtn">Card View</button>
            </div>
        </div>
        <div class="table_container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="job-subject">Job Subject:</label>
                <input type="text" id="job-subject" name="job-subject" required>

                <label for="job-brief">Job Brief:</label>
                <textarea id="job-brief" name="job-brief" rows="4" required></textarea>

                <label for="estimated-hours">Estimated Completion Time:</label>
                <input type="number" id="estimated-hours" name="estimated-hours" placeholder="Hours" required>
                <input type="number" id="estimated-minutes" name="estimated-minutes" placeholder="Minutes" required>

                <center><input type="submit" name="submitJobCreation" value="Create Job"></center>
            </form>
        </div>
    </div>
</body>
<?php
// Check if the form is submitted
if (isset($_POST['submitJobCreation'])) {
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


</html>
<?php ob_end_flush(); ?>