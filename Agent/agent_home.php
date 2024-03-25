<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agent Job Creation</title>
<style>
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
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background: #fff;
        z-index: 11;
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
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="job-subject">Job Order Title:</label>
                <input type="text" id="job-subject" name="job-subject" required>

                <label for="job-brief">Job Order Description:</label>
                <textarea id="job-brief" name="job-brief" rows="4" required></textarea>
                <label for="assign-to">Assign to:</label>

                <!-- Add a dropdown list to select an artist -->
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

                <!-- This is where the selected template's name will appear -->
                <div id="selectedTemplateDiv"></div>
                <input type="hidden" id="selected-template-name" name="selected-template-name">

                <!-- Display the template details here -->
                <div id="templateDetails" style="display:none;"></div>

                <!-- Time tracking dropdown -->
                <label>Set Job Tracking As:</label>
                <select>
                    <option value="Artist">Artist</option>
                    <option value="Deadline">Deadline</option>
                </select>



                <!-- Time estimate input fields -->
                <div id="manual-time-input">
                    <label for="estimated-hours">Estimated Job Order Duration:</label>
                    <input type="number" id="estimated-hours" name="estimated-hours" placeholder="Hours">
                    <input type="number" id="estimated-minutes" name="estimated-minutes" placeholder="Minutes">
                </div>

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
    $assignTo = $_POST['assign-to'];
    $useTemplate = $_POST['use-template'];
    $selectedArtistName = $_POST['selected-artist-name'];
    $selectedTemplateName = $_POST['selected-template-name'];
    $hours = $_POST['estimated-hours'];
    $minutes = $_POST['estimated-minutes'];

    // Initialize an array to hold process details
    $processDetails = [];

    // Iterate through $_POST to find process duration inputs
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'duration_') === 0) {
            // Extract the process ID from the input name
            $processId = str_replace('duration_', '', $key);
            $processDetails[] = "Process ID $processId Duration: $value minutes";
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
        (!empty($processDetailsString) ? "\\n" . $processDetailsString : "") .
        "');</script>";
    /*
    $jobSubject = $_POST['job-subject'];
    $jobBrief = $_POST['job-brief'];
    $selectedArtistName = $_POST['selected-artist-name'];
    $selectedTemplateName = $_POST['selected-template-name'];
    $hours = intval($_POST['estimated-hours']);
    $minutes = intval($_POST['estimated-minutes']);
    $estimatedCompletion = $hours * 60 + $minutes;
    $creatorName = $_SESSION['username'];

    echo "<script>alert('Job Subject: " . $jobSubject . "\\nJob Brief: " . $jobBrief . "\\nSelected Artist Name: " . $selectedArtistName . "\\Selected Template Name: " . $selectedTemplateName . "');</script>";


    // Insert a new row into tbl_jobs
    /*
    $insertSql = "INSERT INTO tbl_jobs (creator_name, time_created, job_status, job_subject, job_brief, estimated_completion) VALUES (?, CURRENT_TIMESTAMP, 'open', ?, ?, ?)";
    $stmtInsert = $conn->prepare($insertSql);
    $stmtInsert->bind_param("sssi", $creatorName, $jobSubject, $jobBrief, $estimatedCompletion);
    $stmtInsert->execute();
    $stmtInsert->close();*/

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
                        console.log("Template ID: ", data.templateId);
                        let htmlContent = `<h3>${data.templateName} Processes</h3>`;
                        if (data.processes && data.processes.length > 0) {
                            htmlContent += "<ul>";
                            data.processes.forEach(process => {
                                htmlContent += `<li>${process.process_name}`;
                                // Check if the process's duration_option is 'salesagent', and add an input field if it is
                                if (process.duration_option === "salesagent") {
                                    htmlContent += `: <input type="number" name="duration_${process.process_id}" min="0" placeholder="Enter duration" />`;
                                } else {
                                    // If a duration is pre-defined, display it
                                    htmlContent += process.duration ? ` - Predefined Duration: ${process.duration} minutes` : '';
                                }
                                htmlContent += `</li>`;
                            });
                            htmlContent += "</ul>";
                        } else {
                            htmlContent += "<p>No processes found for this template.</p>";
                        }
                        document.getElementById('templateDetails').innerHTML = htmlContent;
                        document.getElementById('templateDetails').style.display = 'block';
                    } else {
                        console.error("Error fetching template details: ", data.error);
                    }
                })
                .catch(error => console.error('Error in fetch operation: ', error));
        }



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




</html>
<?php ob_end_flush(); ?>