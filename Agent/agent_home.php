<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agent Job Creation</title>
<style>
    :root {
        /* FLUID RESPONSIVE FONT SIZE BASE VALUE = 9px MIN WIDTH = 425px AND MAX VALUE = 14px MAX WIDTH = 1480px*/
        --step--2: clamp(0.3906rem, 0.3224rem + 0.2569vi, 0.56rem);
        --step--1: clamp(0.4688rem, 0.3756rem + 0.3507vi, 0.7rem);
        --step-0: clamp(0.5625rem, 0.4366rem + 0.4739vi, 0.875rem);
        --step-1: clamp(0.675rem, 0.5063rem + 0.6351vi, 1.0938rem);
        --step-2: clamp(0.81rem, 0.5855rem + 0.845vi, 1.3672rem);
        --step-3: clamp(0.972rem, 0.6751rem + 1.1177vi, 1.709rem);
        --step-4: clamp(1.1664rem, 0.7757rem + 1.4708vi, 2.1362rem);
        --step-5: clamp(1.3997rem, 0.8878rem + 1.927vi, 2.6703rem);
        --step-6: clamp(1.6796rem, 1.0116rem + 2.5149vi, 3.3379rem);
        --step-7: clamp(2.0155rem, 1.1467rem + 3.271vi, 4.1723rem);

        /* FLUID RESPONSIVE PADDING/MARGIN SPACE BASE VALUE = 10px MIN WIDTH = 320px AND MAX VALUE = 15px MAX WIDTH = 1240px*/
        --space-3xs: clamp(0.1875rem, 0.1658rem + 0.1087vi, 0.25rem);
        --space-2xs: clamp(0.3125rem, 0.2473rem + 0.3261vi, 0.5rem);
        --space-xs: clamp(0.5rem, 0.4348rem + 0.3261vi, 0.6875rem);
        --space-s: clamp(0.625rem, 0.5163rem + 0.5435vi, 0.9375rem);
        --space-m: clamp(0.9375rem, 0.7636rem + 0.8696vi, 1.4375rem);
        --space-l: clamp(1.25rem, 1.0326rem + 1.087vi, 1.875rem);
        --space-xl: clamp(1.875rem, 1.5489rem + 1.6304vi, 2.8125rem);
        --space-2xl: clamp(2.5rem, 2.0652rem + 2.1739vi, 3.75rem);
        --space-3xl: clamp(3.75rem, 3.0978rem + 3.2609vi, 5.625rem);

        /* FLUID RESPONSIVE SPACE BASE VALUE = 21px MIN WIDTH = 480px AND MAX VALUE = 23px MAX WIDTH = 1490px*/
        --spaceHW-4xs: clamp(0.25rem, 0.2203rem + 0.099vi, 0.3125rem);
        --spaceHW-3xs: clamp(0.3125rem, 0.2828rem + 0.099vi, 0.375rem);
        --spaceHW-2xs: clamp(0.6875rem, 0.6578rem + 0.099vi, 0.75rem);
        --spaceHW-xs: clamp(1rem, 0.9703rem + 0.099vi, 1.0625rem);
        --spaceHW-s: clamp(1.3125rem, 1.2531rem + 0.198vi, 1.4375rem);
        --spaceHW-m: clamp(2rem, 1.9109rem + 0.297vi, 2.1875rem);
        --spaceHW-l: clamp(2.625rem, 2.5062rem + 0.396vi, 2.875rem);
        --spaceHW-xl: clamp(3.9375rem, 3.7593rem + 0.5941vi, 4.3125rem);
        --spaceHW-2xl: clamp(5.25rem, 5.0124rem + 0.7921vi, 5.75rem);
        --spaceHW-3xl: clamp(5.375rem, 5.1374rem + 0.7921vi, 5.875rem);
        /*Multiplier = 4.1*/
        --spaceHW-4xl: clamp(5.9375rem, 5.6702rem + 0.8911vi, 6.5rem);
        /*Multiplier = 4.5*/
        --spaceHW-5xl: clamp(6.4375rem, 6.1405rem + 0.9901vi, 7.0625rem);
        /*Multiplier = 4.9*/
        --spaceHW-6xl: clamp(6.5625rem, 6.2655rem + 0.9901vi, 7.1875rem);
        /*Multiplier = 5*/
        --spaceHW7xl: clamp(7.25rem, 6.9233rem + 1.0891vi, 7.9375rem);
        /*Multiplier = 5.5*/
        --spaceHW-8xl: clamp(7.875rem, 7.5186rem + 1.1881vi, 8.625rem);
        /*Multiplier = 6*/
        --spaceHW-9xl: clamp(8.5625rem, 8.1764rem + 1.2871vi, 9.375rem);
        /*Multiplier = 6.5*/
        --spaceHW-10xl: clamp(9.1875rem, 8.7717rem + 1.3861vi, 10.0625rem);
        /*Multiplier = 7*/
    }

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

    #selectedArtist {
        margin-top: 10px;
        display: flex;
        align-items: center;
    }

    .reset-button {
        margin-left: 10px;
        cursor: pointer;
        padding: 0 5px;
        height: 20px;
        line-height: 20px;
        border: none;
        background: #f44336;
        color: white;
        border-radius: 4px;
        font-size: 12px;
    }

    #selectedArtist {
        margin-top: 10px;
        display: flex;
        align-items: center;
    }

    .reset-button {
        margin-left: 10px;
        cursor: pointer;
        padding: 0 5px;
        height: 20px;
        line-height: 20px;
        border: none;
        background: #f44336;
        color: white;
        border-radius: 4px;
        font-size: 12px;
    }

    .overlay {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 10;
    }

    .overlay-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: var(--space-xs);
        background-color: white;
        z-index: 11;
        text-align: center;
        border-radius: .80rem;
        width: auto;
    }

    .overlay-content .overlay-button button {
        background-color: #ffd000;
        margin-block: var(--space-s);
        margin-inline: var(--space-3xs);
        padding: 3px 12px;
        font-weight: 790;
        border: none;
        border-radius: .50rem;
    }

    .overlay-content .overlay-button button:hover {
        background-color: #ffee00;
        transform: translateY(-1px);
        box-shadow: rgba(0, 0, 0, 0.50) 0 5px 10px;
    }

    .overlay-content>h2 {
        margin: var(--space-2xs);
        font-size: var(--step-3);
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

    .table_container {
        background: Radial-gradient(rgba(71, 71, 71, 0.8), rgba(71, 71, 71, 0)), Radial-gradient(at 0 0, #474747, #070707);

    }

    .table_container form {
        margin-left: 25px;
        margin-top: 25px;
        display: grid;
        background-color: #919191;
        grid-area: 3 / 2 / -1 / -1;
        width: 50%;
        height: auto;
        border: 2px solid #000;
        border-radius: 4px;
        padding: 10px;
        border-radius: 0% 0% 0% 0% / 0% 0% 0% 0%;
        color: white;
        box-shadow: 20px 20px rgba(0, 0, 0, .15);
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

    .referenceImageContainer {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px;
    }

    #referencePreview,
    .imagePreview {
        width: 250px;
        height: 250px;
        margin-right: 10px;
    }
</style>

<?php


// Retrieve artists from the database
$artists = [];
$query = "SELECT user_id, username FROM tbl_userlist WHERE job_position = 'Artist'"; // Adjust this query based on your actual database schema
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $artists[] = $row;
    }
    $result->free();
}

// Retrieve templates from the database
$templates = [];
$query = "SELECT template_id, template_name FROM tbl_templatelist"; // Adjust this query based on your actual database schema
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $templates[] = $row;
    }
    $result->free();
}


// Close the database connection
$conn->close();
?>

<body>
    <div class="main">

        <?php
        include "agent_menu.php";
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <h1 class="main-title">Agent Job Creation</h1>
        <div class="header-banner">
            <img src="../images/holden-baxter-oxQ0egaQMfU-unsplash.jpg" class="banner-logo">
        </div>
        <div class="content-header">
            <h2 class="content-title"></h2>
            <div class="view-buttons">
                <!--
                <button id="tableViewBtn">Table View</button>
                <button id="cardViewBtn">Card View</button> 
                -->
            </div>
        </div>

        <!-- Overlay for artist selection -->
        <div id="artistOverlay" class="overlay">
            <div class="overlay-content">
                <h2>Select an Artist</h2>
                <select id="artist-list">
                    <?php foreach ($artists as $artist) : ?>
                        <option value="<?php echo htmlspecialchars($artist['user_id']); ?>">
                            <?php echo htmlspecialchars($artist['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button id="selectArtistButton">Select Artist</button>
                <button id="closeArtistOverlay">Close</button>
            </div>
        </div>

        <!-- Overlay for template selection -->
        <div id="templateOverlay" class="overlay">
            <div class="overlay-content">
                <h2>Select a Template</h2>
                <select id="template-list">
                    <?php foreach ($templates as $template) : ?>
                        <option value="<?php echo htmlspecialchars($template['template_id']); ?>">
                            <?php echo htmlspecialchars($template['template_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button id="selectTemplateButton">Select Template</button>
                <button id="closeTemplateOverlay">Close</button>
            </div>
        </div>

        <!-- Job Creation Form -->
        <div class="table_container">
             <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="jobForm">
                <!-- form method="post" action="upload_file.php" enctype="multipart/form-data" id="jobForm"> -->
                <label for="job-subject">Job Order Title:</label>
                <input type="text" id="job-subject" name="job-subject" required>

                <label for="job-brief">Job Order Description:</label>
                <textarea id="job-brief" name="job-brief" rows="4" required></textarea>


                <!-- Upload design reference -->
                <div class="designReferenceContainer" id="designReferenceContainer">
                    <div class="referenceImageContainer">
                        <label for="referenceImage">Reference Image:</label>
                        <img id="referencePreview" src="../upload/default_reference.jpg" alt="Design Reference Preview" />
                        <div id="imagePreviewContainer"></div>

                        <input type="file" id="referenceImage" name="referenceImage[]" accept="image/*" multiple placeholder="Upload Reference Image">
                    </div>

                </div>

                <!-- Add a dropdown list to select an artist -->
                <label for="assign-to">Assign to:</label>
                <select id="assign-to" name="assign-to">
                    <option value="Open to All">Open to All Artists</option>
                    <option value="Assign an Artist">Assign an Artist</option>
                </select>
                <!-- This is where the selected artist's name will appear -->
                <div id="selectedArtist"></div>
                <input type="hidden" id="selected-artist-name" name="selected-artist-name">



                <!-- Template dropdown -->
                <label>Use Template to Determine Time:</label>
                <select id="use-template" name="use-template"> <!-- Add id and name attributes -->
                    <option value="Manually">Set Time Manually</option>
                    <option value="Template">Use a template</option>
                </select>
                <!-- A hidden input field to store the selected template name -->
                <input type="hidden" name="selectedTemplateName" id="selectedTemplateName">


                <!-- Display the template details here -->
                <div id="templateDetails" style="display:none;"></div>

                <!-- Time tracking dropdown -->
                <label>Set Job Tracking As:</label>
                <select id="job-tracking" name="job-tracking">
                    <option value="Artist">Artist</option>
                    <option value="Deadline">Deadline</option>
                </select>

                <!-- Time estimate input fields -->
                <div id="manual-time-input">
                    <!-- 
                    <label for="estimated-hours">Estimated Job Order Duration:</label>
                    <input type="number" id="estimated-hours" name="estimated-hours" placeholder="Hours">
                    <input type="number" id="estimated-minutes" name="estimated-minutes" placeholder="Minutes">
                    -->
                    <label for="deadline_date">Deadline Date:</label>
                    <input type="date" id="deadline_date" name="deadline_date" required>

                    <label for="deadline_time">Deadline Time:</label>
                    <input type="time" id="deadline_time" name="deadline_time" required>
                </div>

                <!-- Display the future date and time based on the selected date and time -->
                <div id="futureDateTimeDisplay" style="margin-top: 20px; font-weight: bold;"></div>



                <center><input type="submit" name="submitJobCreation" value="Create Job"></center>

            </form>
        </div>
    </div>
    <?php
    // Check if the form is submitted
    if (isset($_POST['submitJobCreation'])) {

        
    $jobSubject = $_POST['job-subject'];
    $jobBrief = $_POST['job-brief'];
    $assignTo = $_POST['assign-to'];
    $useTemplate = $_POST['use-template'];
    $selectedArtistName = $_POST['selected-artist-name'];
    $selectedTemplateName = $_POST['selectedTemplateName'];
    $hours = $_POST['estimated-hours'];
    $minutes = $_POST['estimated-minutes'];
    $jobTracking = $_POST['job-tracking'];

   
    // Initialize an array to hold process details
    $processDetails = [];

    // Iterate through $_POST to find process duration inputs
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'processName_') === 0) {
            $index = str_replace('processName_', '', $key);
            $processName = $value;
            $processDuration = $_POST["processDuration_" . $index] ?? 'Not specified';
            $processDetails[] = "$processName Duration: $processDuration minutes";
        }
    }

    // Convert the process details array into a string for the alert
    $processDetailsString = implode("\\n", $processDetails);

    // Creating the alert script with process details included
    echo "<script>alert('Job Subject: $jobSubject" .
        "\\nJob Brief: $jobBrief" .
        "\\nAssign to: $assignTo" .
        "\\nUse Template to Determine Time: $useTemplate" .
        "\\nSelected Artist Name: $selectedArtistName" .
        "\\nSelected Template Name: $selectedTemplateName" .
        "\\nEstimated Hours: $hours" .
        "\\nEstimated Minutes: $minutes" .
        "\\n" . $processDetailsString .
        "\\nJob Tracking: $jobTracking" .
        "');</script>";
   
        /*
        $jobSubject = $_POST['job-subject'];
        $jobBrief = $_POST['job-brief'];
        $selectedArtistName = $_POST['selected-artist-name'];
        $selectedTemplateName = $_POST['selected-template-name'];
        $hours = intval($_POST['estimated-hours']);
        $minutes = intval($_POST['estimated-minutes']);
        $estimatedCompletion = $hours * 60 + $minutes;
        $_POST['estimatedCompletion'] = $estimatedCompletion;
        $creatorName = $_SESSION['username'];
        */

        //echo "<script>alert('Job Subject: " . $jobSubject . "\\nJob Brief: " . $jobBrief . "\\nSelected Artist Name: " . $selectedArtistName . "\\Selected Template Name: " . $selectedTemplateName . "');</script>";


        // Insert a new row into tbl_jobs

        /*
    $insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief, estimated_completion) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertSql);
    $stmtInsert->bind_param("sssi", $creatorName, $jobSubject, $jobBrief, $estimatedCompletion);
    $stmtInsert->execute();
    $stmtInsert->close();
    */

        // Redirect to the agent home page or another appropriate page
        //header("Refresh:0");
        //exit();
    }


    ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var selectArtistButton = document.getElementById('selectArtistButton');
            var artistSelect = document.getElementById('artist-list');
            var selectedArtistDiv = document.getElementById('selectedArtist');
            var assignToSelect = document.getElementById('assign-to');
            var useTemplateSelect = document.getElementById('use-template');
            var selectTemplateButton = document.getElementById('selectTemplateButton');
            var templateOverlay = document.getElementById('templateOverlay');
            var selectedTemplateDiv = document.getElementById('selectedTemplateDiv');
            var closeArtistButton = document.getElementById('closeArtistOverlay');
            var closeButton = document.getElementById('closeTemplateOverlay');
            var templateList = document.getElementById('template-list');
            var manualTimeInput = document.getElementById('manual-time-input');
            var templateDetailsDiv = document.getElementById('templateDetails');



            //Form upload and receive job id for image file upload
            $("#jobForm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this);
                console.log([...formData]); // Debugging
                // AJAX call to create the job entry and get job_id
                $.ajax({
                    url: 'create_job.php', // Adjust this to your actual endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var job_id = JSON.parse(response).job_id; // Parse response to get job_id

                        // Assuming you have to upload files after creating the job
                        var files = $("#referenceImage")[0].files;
                        if (files.length > 0) {
                            Array.from(files).forEach(function(file) {
                                var fileData = new FormData();
                                fileData.append("job_id", job_id); // Include the job_id
                                fileData.append("referenceImage", file); // Add each file

                                // AJAX call to upload each file
                                $.ajax({
                                    url: 'upload_file.php', // Adjust this to your actual endpoint
                                    type: 'POST',
                                    data: fileData,
                                    processData: false,
                                    contentType: false,
                                    success: function(uploadResponse) {
                                        console.log("File uploaded successfully.");
                                        // Handle success (e.g., showing a message or updating UI)
                                    },
                                    error: function() {
                                        console.log("Error uploading file.");
                                        // Handle error
                                    }
                                });
                            });
                        }
                    },
                    error: function() {
                        console.log("Error creating job.");
                        // Handle job creation error
                    }
                });
            });

            // Close overlay event listeners
            if (closeButton) closeButton.addEventListener('click', closeTemplateOverlay);
            if (closeArtistButton) closeArtistButton.addEventListener('click', closeArtistOverlay);

            // Artist selection
            selectArtistButton.addEventListener('click', function() {
                var selectedArtistName = artistSelect.options[artistSelect.selectedIndex].text;
                document.getElementById('selected-artist-name').value = selectedArtistName;
                selectedArtistDiv.innerHTML = "Selected Artist: " + selectedArtistName +
                    '<button class="reset-button" id="resetSelection" title="Reset selection">X</button>';
                setTimeout(addResetFunctionality, 0);
            });

            // Assign to selection change
            assignToSelect.addEventListener('change', function() {
                if (this.value === "Assign an Artist") {
                    document.getElementById('artistOverlay').style.display = 'block';
                } else {
                    selectedArtistDiv.innerHTML = '';
                }
            });

            // Use template selection change
            useTemplateSelect.addEventListener('change', function() {
                if (this.value === "Template") {
                    templateOverlay.style.display = 'block';
                    manualTimeInput.style.display = 'none'; // Hide manual time inputs
                    templateDetailsDiv.style.display = 'block';
                } else {
                    manualTimeInput.style.display = 'block'; // Show manual time inputs
                    templateDetailsDiv.style.display = 'none';
                }
            });

            // Template selection
            selectTemplateButton.addEventListener('click', function() {
                var templateName = templateList.options[templateList.selectedIndex].text;
                fetchTemplateDetailsByName(templateName); // Function to fetch template details using the name
            });

            // Function to calculate future date and time based on the selected date and time
            function recalculateTotalDuration() {
                let totalDuration = 0;
                document.querySelectorAll('.user-duration').forEach(input => {
                    // Make sure to only add valid numbers
                    const duration = parseInt(input.value, 10);
                    if (!isNaN(duration)) {
                        totalDuration += duration;
                    }
                });

                // Also include predefined durations if necessary
                document.querySelectorAll('input[type="hidden"][name^="processDuration_"]').forEach(input => {
                    const duration = parseInt(input.value, 10);
                    if (!isNaN(duration)) {
                        totalDuration += duration;
                    }
                });

                console.log("Recalculated Total Duration: ", totalDuration);
                calculateFutureDateTime(totalDuration);
            }

            function calculateFutureDateTime(totalDuration) {
                fetch('calculate_future_datetime.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'totalDuration=' + totalDuration,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Future Date and Time: ", data.futureDateTime);
                            // You can now display this future date and time somewhere on the page.
                        } else {
                            console.error("Error calculating future date and time: ", data.error);
                        }
                    })
                    .catch(error => console.error('Error in fetch operation: ', error));
            }


            // Template details fetch function
            function fetchTemplateDetailsByName(templateName) {
                fetch('fetch_template_details.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'templateName=' + encodeURIComponent(templateName),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let totalDuration = 0; // Initialize total duration
                            let htmlContent = `<h3>${data.templateName} Processes</h3><ul>`;
                            document.getElementById('selectedTemplateName').value = data.templateName;
                            data.processes.forEach((process, index) => {
                                totalDuration += parseInt(process.duration || 0);
                                htmlContent += `<li>${process.process_name}`;
                                if (process.duration_option === "salesagent") {
                                    htmlContent += `: <input type="number" name="processDuration_${index}" min="0" placeholder="Enter duration"/>`;
                                } else {
                                    htmlContent += process.duration ? ` - Predefined Duration: ${process.duration} minutes` : '';
                                }
                                htmlContent += `</li>`;
                                // Include hidden inputs for name and duration
                                htmlContent += `<input type="hidden" name="processName_${index}" value="${process.process_name}">`;
                                htmlContent += `<input type="hidden" name="processDuration_${index}" value="${process.duration || 0}">`;
                            });
                            console.log("Total Duration in minutes: ", totalDuration);
                            calculateFutureDateTime(totalDuration); // Call a function to calculate future date and time
                            htmlContent += "</ul>";
                            document.getElementById('templateDetails').innerHTML = htmlContent;
                            document.getElementById('templateDetails').style.display = 'block';

                            // Attach event listeners to all user-duration input fields
                            document.querySelectorAll('.user-duration').forEach(input => {
                                input.addEventListener('change', recalculateTotalDuration);
                            });
                        } else {
                            console.error("Error fetching template details: ", data.error);
                        }
                    })
                    .catch(error => console.error('Error in fetch operation: ', error));
            }

            //Multiple Image Preview


            document.getElementById('referenceImage').addEventListener('change', function(event) {
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                const referencePreview = document.getElementById('referencePreview');

                // Clear out any existing dynamic previews in the imagePreviewContainer
                imagePreviewContainer.innerHTML = '';

                const files = event.target.files;

                if (files.length > 0) {
                    // Hide the default preview image
                    referencePreview.style.display = 'none';

                    Array.from(files).forEach(file => {
                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.classList.add('imagePreview'); // Apply the same class if needed for styling
                            img.src = URL.createObjectURL(file);
                            img.onload = function() {
                                URL.revokeObjectURL(img.src); // Clean up memory
                            };

                            // Append the dynamically created img element to the preview container
                            imagePreviewContainer.appendChild(img);
                        }
                    });
                } else {
                    // If no files are selected, show the default image
                    referencePreview.style.display = 'block';
                }
            });



            // Manual Time Input Show
            // Function to check the select values and show/hide the div
            function checkSelectValues() {
                var useTemplate = document.getElementById('use-template').value;
                var jobTracking = document.getElementById('job-tracking').value;

                // Show the div if both conditions are met
                if (useTemplate === 'Manually' && jobTracking === 'Deadline') {
                    document.getElementById('manual-time-input').style.display = 'block';
                } else {
                    document.getElementById('manual-time-input').style.display = 'none';
                }
            }

            // Add event listeners to both select elements
            document.getElementById('use-template').addEventListener('change', checkSelectValues);
            document.getElementById('job-tracking').addEventListener('change', checkSelectValues);

            // Initial check in case the selects are pre-populated or modified without user interaction
            checkSelectValues();


            //
            /*
            document.getElementById('use-template').addEventListener('change', function() {
                if (this.value === "Template") {
                    document.getElementById('templateOverlay').style.display = 'block';
                    document.getElementById('estimated-hours').style.display = 'none';
                    document.getElementById('estimated-minutes').style.display = 'none';
                    document.getElementById('templateDetails').style.display = 'block';
                } else {
                    document.getElementById('estimated-hours').style.display = 'block';
                    document.getElementById('estimated-minutes').style.display = 'block';
                    document.getElementById('templateDetails').style.display = 'none';
                }
            });
            */

            function addResetFunctionality() {
                var resetButton = document.getElementById('resetSelection');
                resetButton?.addEventListener('click', function() {
                    selectedArtistDiv.innerHTML = '';
                    assignToSelect.value = "Open to All";
                });
            }

            function addResetTemplateFunctionality() {
                var resetTemplateButton = document.getElementById('resetTemplateSelection');
                resetTemplateButton?.addEventListener('click', function() {
                    selectedTemplateDiv.innerHTML = '';
                    useTemplateSelect.value = "Manually";
                });
            }

            function closeArtistOverlay() {
                document.getElementById('artistOverlay').style.display = 'none';
            }

            function closeTemplateOverlay() {
                console.log("closeTemplateOverlay function called");
                document.getElementById('templateOverlay').style.display = 'none';
            }
        });
    </script>
</body>

</html>
<?php ob_end_flush(); ?>