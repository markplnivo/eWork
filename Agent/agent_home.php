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
                <label for="job-subject">Job Order Title:</label>
                <input type="text" id="job-subject" name="job-subject">

                <label for="job-brief">Job Order Description:</label>
                <textarea id="job-brief" name="job-brief" rows="4"></textarea>


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
                    <label for="deadline_date">Deadline Date:</label>
                    <input type="date" id="deadline_date" name="deadline_date">

                    <label for="deadline_time">Deadline Time:</label>
                    <input type="time" id="deadline_time" name="deadline_time">
                </div>

                <!-- Display the future date and time based on the selected date and time -->
                <div id="futureDateTimeDisplay" style="margin-top: 20px; font-weight: bold;"></div>
                <input type="hidden" id="futureDateTimeInput" name="futureDateTime" value="" />
                <center><input type="submit" name="submitJobCreation" value="Create Job"></center>

            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submitJobCreation'])) {

        /*
        $jobSubject = $_POST['job-subject'];
        $jobBrief = $_POST['job-brief'];
        $assignTo = $_POST['assign-to'];
        $useTemplate = $_POST['use-template'];
        $selectedArtistName = $_POST['selected-artist-name'];
        $selectedTemplateName = $_POST['selectedTemplateName'];
        $jobTracking = $_POST['job-tracking'];


        // Initialize an array to hold process details
        $processDetails = [];
        // Process structured process durations
        if (isset($_POST['processDuration']) && is_array($_POST['processDuration'])) {
            foreach ($_POST['processDuration'] as $processId => $duration) {
                // Process ID is directly available, and duration is the corresponding value
                $processDetails[] = "Process ID $processId Duration: $duration minutes";
            }
        }

        // Iterate through $_POST to find process duration inputs
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'processName_') === 0) {
                $index = str_replace('processName_', '', $key);
                $processName = $value;
                $processDuration = $_POST["processDuration_" . $index] ?? 'Not specified';
                $processDetails[] = "$processName Duration: $processDuration minutes";
            }
        }



        $futureDateTime = $_POST['futureDateTime'] ?? 'Not Available';
        $processDetailsString = implode("\\n", $processDetails);
        // Output the script to show the alert with job and process details
        echo "<script>alert('Job Subject: $jobSubject" .
            "\\nJob Brief: $jobBrief" .
            "\\nAssign to: $assignTo" .
            "\\nUse Template to Determine Time: $useTemplate" .
            "\\nSelected Artist Name: $selectedArtistName" .
            "\\nSelected Template Name: $selectedTemplateName" .
            "\\n" . $processDetailsString . // Include process details in the alert
            "\\nFuture Date and Time: $futureDateTime" . // Include future date and time
            "\\nJob Tracking: $jobTracking" .
            "');</script>";
            */
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

            /*** FORM UPLOAD AND IMAGE UPLOAD ***/

            //Form upload and receive job id for image file upload
            $("#jobForm").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this);
                // Log formData for debugging
                // Append process durations and their IDs to formData

                /*$('.user-duration, .predefined-duration').each(function(index, input) {
                    var processId = $(this).data('process-id');
                    var duration = $(this).val();
                    formData.append(`processes[${index}][id]`, processId);
                    formData.append(`processes[${index}][duration]`, duration);
                    // Retrieve and append the selected option value for each process
                    var selectedOption = $(this).closest('li').find('.process-option').val();
                    formData.append(`processes[${index}][option]`, selectedOption);
                });*/

                // New logic to append process details using the structured naming convention
                $('.process-row').each(function(index, processRow) {
                    var processId = $(processRow).data('process-id'); // Assuming processId is stored as data attribute
                    var duration = $(processRow).find('.process-duration').val(); // Assuming you have an input with class 'process-duration'
                    var option = $(processRow).find('.process-option').val(); // Assuming select class 'process-option'

                    formData.append(`processes[${index}][id]`, processId);
                    formData.append(`processes[${index}][duration]`, duration);
                    formData.append(`processes[${index}][option]`, option);
                });
                console.log([...formData]);
                // AJAX call to create the job entry and potentially get job_id
                $.ajax({
                    url: 'create_job.php', // actual endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var job_id = JSON.parse(response).job_id; // Parse response to get job_id
                        console.log("Job created successfully with ID:", job_id);

                        // Check if there are files to upload
                        var files = $("#referenceImage")[0].files;
                        if (files.length > 0) {
                            // If there are files, upload each one
                            var uploadPromises = Array.from(files).map(function(file) {
                                var fileData = new FormData();
                                fileData.append("job_id", job_id); // Include the job_id
                                fileData.append("referenceImage", file); // Add the file
                                // Return the AJAX call promise
                                return $.ajax({
                                    url: 'upload_file.php', // actual endpoint
                                    type: 'POST',
                                    data: fileData,
                                    processData: false,
                                    contentType: false
                                });
                            });

                            // Wait for all file uploads to complete
                            Promise.all(uploadPromises).then(() => {
                                console.log("All files uploaded successfully.");
                                //$('#jobForm').trigger("reset");
                            }).catch((error) => {
                                console.log([...formData]);
                                console.error("Error during file upload:", error);
                                alert("An error occurred during the file upload.");
                            });
                        } else {
                            // If no files, just show success log and reset form
                            //$('#jobForm').trigger("reset");
                        }
                    },
                    error: function() {
                        
                        console.log("Error creating job.");
                        alert("Error creating job.");
                    }
                });
            });

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

            /*** END OF FORM UPLOAD AND IMAGE UPLOAD ***/

            /*** ARTIST SELECTION JAVASCRIPT ***/

            // Function to add reset functionality to the reset button
            function addResetFunctionality() {
                var resetButton = document.getElementById('resetSelection');
                resetButton?.addEventListener('click', function() {
                    selectedArtistDiv.innerHTML = '';
                    assignToSelect.value = "Open to All";
                });
            }
            // Function to close the artist overlay
            function closeArtistOverlay() {
                document.getElementById('artistOverlay').style.display = 'none';
            }
            // Add event listener to the select artist button
            selectArtistButton.addEventListener('click', function() {
                var selectedArtistName = artistSelect.options[artistSelect.selectedIndex].text;
                document.getElementById('selected-artist-name').value = selectedArtistName;
                selectedArtistDiv.innerHTML = "Selected Artist: " + selectedArtistName +
                    '<button class="reset-button" id="resetSelection" title="Reset selection">X</button>';
                setTimeout(addResetFunctionality, 0);
            });
            // Add event listener to the assign to select dropdown
            assignToSelect.addEventListener('change', function() {
                if (this.value === "Assign an Artist") {
                    document.getElementById('artistOverlay').style.display = 'block';
                } else {
                    selectedArtistDiv.innerHTML = '';
                }
            });
            // Add event listener to the close button
            if (closeArtistButton) closeArtistButton.addEventListener('click', closeArtistOverlay);

            /*** END OF ARTIST SELECTION JAVASCRIPT ***/


            /*** TEMPLATE SELECTION JAVASCRIPT ***/

            // Function to add reset functionality to the reset button
            function addResetTemplateFunctionality() {
                var resetTemplateButton = document.getElementById('resetTemplateSelection');
                resetTemplateButton?.addEventListener('click', function() {
                    selectedTemplateDiv.innerHTML = '';
                    useTemplateSelect.value = "Manually";
                });
            }

            // Function to close the template overlay
            function closeTemplateOverlay() {
                console.log("closeTemplateOverlay function called");
                document.getElementById('templateOverlay').style.display = 'none';
            }

            // Add event listener to the select template button
            selectTemplateButton.addEventListener('click', function() {
                var templateName = templateList.options[templateList.selectedIndex].text;
                document.getElementById('selectedTemplateName').value = templateName;
                fetchTemplateDetailsByName(templateName); // Call a function to fetch template details
            });

            // Add event listener to the use template select dropdown
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

            // Add event listener to the close button
            if (closeButton) closeButton.addEventListener('click', closeTemplateOverlay);

            // Function to calculate future date and time based on total duration
            function calculateFutureDateTime(totalDuration) {
                fetch('calculate_future_datetime.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'totalDuration=' + totalDuration,
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log("Future Date and Time: ", data.futureDateTime);
                            document.getElementById('futureDateTimeDisplay').innerText = "Future Date and Time: " + data.futureDateTime;
                            // Store the future date in a hidden input so it can be submitted with the form
                            document.getElementById('futureDateTimeInput').value = data.futureDateTime; // Ensure this input exists in your form
                        } else {
                            console.error("Error calculating future date and time: ", data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error in fetch operation: ', error);
                        document.getElementById('futureDateTimeDisplay').innerText = "Error calculating future date and time.";
                    });
            }


            //Template Fetching
            // Function to fetch template details and setup the page for input
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
                            let htmlContent = `<h3>${data.templateName} Processes</h3><ul>`;
                            document.getElementById('selectedTemplateName').value = data.templateName;
                            data.processes.forEach((process, index) => {
                                htmlContent += generateProcessHTML(process, index);
                            });
                            htmlContent += "</ul>";
                            document.getElementById('templateDetails').innerHTML = htmlContent;
                            document.getElementById('templateDetails').style.display = 'block';
                            // Attach event listeners to user-duration inputs after appending them to the DOM
                            document.querySelectorAll('.user-duration').forEach(input => {
                                input.addEventListener('change', recalculateTotalDuration);
                            });
                            // Recalculate to account for any predefined durations
                            recalculateTotalDuration();
                        } else {
                            console.error("Error fetching template details: ", data.error);
                        }
                    })
                    .catch(error => console.error('Error in fetch operation: ', error));
            }

            function generateProcessHTML(process, index) {
                // Wrap the process details in a div or li with class 'process-row' and data attribute for process ID
                let html = `<li class="process-row" data-process-id="${process.process_id}">${process.process_name}`;

                // Check for user-set durations and adjust class names accordingly
                if (process.duration_option === "salesagent") {
                    // For user-set durations, provide an input field with class 'process-duration'
                    html += `: <input type="number" class="process-duration user-duration" name="processDuration_${index}" min="0" placeholder="Enter duration in minutes" />`;
                } else {
                    // Predefined durations also carry the process ID in a data attribute
                    // Using 'process-duration' for consistency, though it might be hidden or readonly based on your design
                    html += process.duration ? ` - Predefined Duration: ${process.duration} minutes` : '';
                    html += `<input type="hidden" class="process-duration predefined-duration" name="processDuration_${index}" value="${process.duration || 0}">`;
                }

                // Adding a select element with options using class 'process-option'
                html += ` <select name="processOption_${index}" class="process-option">
                <option value="Artist">Artist</option>
                <option value="Production">Production</option>
                </select>`;

                html += `</li>`;
                return html;
            }

            function recalculateTotalDuration() {
                let totalDuration = 0;
                document.querySelectorAll('.user-duration, .predefined-duration').forEach(input => {
                    const duration = parseInt(input.value, 10); // Removed fallback to dataset.defaultDuration for clarity
                    if (!isNaN(duration)) {
                        totalDuration += duration;
                    }
                });

                console.log("Recalculated Total Duration:", totalDuration);
                if (totalDuration > 0) {
                    calculateFutureDateTime(totalDuration);
                }
            }

            // Add event listener for template selection changes
            document.getElementById('use-template').addEventListener('change', function() {
                // Check if the user selects "Set Time Manually" or changes the template
                if (this.value === "Manually") {
                    resetAndRecalculateDuration();
                } else {
                    // If a template is selected, fetch its details (which should also handle duration recalculation)
                    fetchTemplateDetailsByName(this.value);
                }
            });

            // Function to reset and recalculate total duration
            function resetAndRecalculateDuration() {
                // Reset any input fields if necessary. For example:
                document.querySelectorAll('.user-duration').forEach(input => input.value = '');

                // Clear predefined durations
                document.querySelectorAll("input[type='hidden'][name^='processDuration_']").forEach(input => input.value = '0');

                // You may want to hide or reset the display of future date/time
                document.getElementById('futureDateTimeDisplay').innerText = '';

                // Recalculate duration (which will now effectively be reset)
                recalculateTotalDuration();
            }

            // Assuming fetchTemplateDetailsByName function is modified to also reset durations and recalculate as needed




            /*** END OF TEMPLATE SELECTION JAVASCRIPT ***/


            /*** TIME PROCESS JAVASCRIPT ***/

            // Function to check the select values and show/hide the div
            function checkSelectValues() {
                var useTemplate = document.getElementById('use-template').value;
                var jobTracking = document.getElementById('job-tracking').value;
                var deadlineDateInput = document.getElementById('deadline_date');
                var deadlineTimeInput = document.getElementById('deadline_time');

                // Show the div if both conditions are met
                if (useTemplate === 'Manually' && jobTracking === 'Deadline') {
                    document.getElementById('manual-time-input').style.display = 'block';
                    deadlineDateInput.setAttribute('required', '');
                    deadlineTimeInput.setAttribute('required', '');
                } else {
                    document.getElementById('manual-time-input').style.display = 'none';
                    deadlineDateInput.removeAttribute('required');
                    deadlineTimeInput.removeAttribute('required');
                }
            }

            // Add event listeners to both select elements
            document.getElementById('use-template').addEventListener('change', checkSelectValues);
            document.getElementById('job-tracking').addEventListener('change', checkSelectValues);

            // Initial check in case the selects are pre-populated or modified without user interaction
            checkSelectValues();

            /*** END OF TIME PROCESS JAVASCRIPT ***/

        });
    </script>
</body>

</html>
<?php ob_end_flush(); ?>