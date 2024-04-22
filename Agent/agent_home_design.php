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
        --spaceHW-4xs: clamp(0.25rem, 0.2203rem + 0.099vi, 0.3125rem);/*Multiplier = 0.2*/
        --spaceHW-3xs: clamp(0.3125rem, 0.2828rem + 0.099vi, 0.375rem);
        --spaceHW-2xs: clamp(0.6875rem, 0.6578rem + 0.099vi, 0.75rem);
        --spaceHW-xs: clamp(1rem, 0.9703rem + 0.099vi, 1.0625rem);
        --spaceHW-s: clamp(1.3125rem, 1.2531rem + 0.198vi, 1.4375rem);
        --spaceHW-m: clamp(2rem, 1.9109rem + 0.297vi, 2.1875rem);
        --spaceHW-l: clamp(2.625rem, 2.5062rem + 0.396vi, 2.875rem);
        --spaceHW-xl: clamp(3.9375rem, 3.7593rem + 0.5941vi, 4.3125rem);
        --spaceHW-2xl: clamp(5.25rem, 5.0124rem + 0.7921vi, 5.75rem);
        --spaceHW-3xl: clamp(5.375rem, 5.1374rem + 0.7921vi, 5.875rem);/*Multiplier = 4.1*/
        --spaceHW-4xl: clamp(5.9375rem, 5.6702rem + 0.8911vi, 6.5rem);/*Multiplier = 4.5*/
        --spaceHW-5xl: clamp(6.4375rem, 6.1405rem + 0.9901vi, 7.0625rem);/*Multiplier = 4.9*/
        --spaceHW-6xl: clamp(6.5625rem, 6.2655rem + 0.9901vi, 7.1875rem);/*Multiplier = 5*/
        --spaceHW-7xl: clamp(7.25rem, 6.9233rem + 1.0891vi, 7.9375rem);/*Multiplier = 5.5*/
        --spaceHW-8xl: clamp(7.875rem, 7.5186rem + 1.1881vi, 8.625rem);/*Multiplier = 6*/
        --spaceHW-9xl: clamp(8.5625rem, 8.1764rem + 1.2871vi, 9.375rem);/*Multiplier = 6.5*/
        --spaceHW-10xl: clamp(9.1875rem, 8.7717rem + 1.3861vi, 10.0625rem);/*Multiplier = 7*/
}
    *,
    body,
    html {
        overflow-y: auto;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    .main {
        height: 100vh;
    }
    .reset-button {
        margin-block: var(--spaceHW-3xs);
        margin-inline: var(--space-2xs);
        cursor: pointer;
        padding-block: var(--spaceHW-4xs);
        padding-inline: var(--spaceHW-4xs);
        height: var(--space-m);
        border: none;
        background: #b90000;
        color: white;
        border-radius: .5rem;
        font-size: var(--step-2);
    }
    .reset-button:hover{
        background-color: #df2626;
        transform: translateY(-1px);
        box-shadow: rgba(0, 0, 0, 0.50) 0 5px 10px;
    }
    #selectedArtist {
        margin-block: var(--space-xs);
        display: flex;
        align-items: center;
        font-size: var(--step-1);
        font-weight: 700;
        color: #000;
    }
    #artist-list, #template-list{
        padding-block: var(--space-xs);
        padding-inline: var(--space-2xs);
        margin: var(--space-2xs);
        border: none;
        border-radius: 0.50rem;
        background-color: rgb(211, 211, 211);
    }
    #templateDetails h3{
        font-size: var(--step-2);
        color: #000;
        padding-top: var(--space-3xs);
        padding-bottom: var(--space-2xs);
        padding-inline: var(--space-3xs);
    }
    #templateDetails li{
        font-size: var(--step-1);
        color: #000;
        padding: var(--space-3xs);
    }
    #templateDetails li:nth-child(7){
        margin-bottom: var(--space-2xs);
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
    .overlay-content .overlay-button button{
        background-color: #ffd000;
        margin-block: var(--space-s);
        margin-inline: var(--space-3xs);
        padding: 3px 12px;
        font-weight: 790;
        border: none;
        border-radius: .50rem;
    }
    .overlay-content .overlay-button button:hover{
        background-color: #ffee00;
        transform: translateY(-1px);
        box-shadow: rgba(0, 0, 0, 0.50) 0 5px 10px;
    }
    .overlay-content > h2{
        margin: var(--space-2xs);
        font-size: var(--step-3);
    }
    .header-banner-container{
        display: flex;
        align-items: center;
        gap: var(--spaceHW-2xs);
        background-color: #0f0f0f;
        grid-auto-flow: row;
        position: fixed;
        height: var(--spaceHW-5xl);
        width: 100%;
        right: var(--spaceHW-xs);
        z-index: 1;
    }
    .header-banner-container .IClogo{
        display: flex;
        min-height: 60px;
        min-width: 60px;
        margin-left: var(--spaceHW-4xl);
        
    }
    .IClogo img{
        max-height: 90px;
        max-width: 90px;
    }
    .header-banner-container h1{
        font-size: var(--step-5);
        color: #ffbb00;
        margin-left: var(--spaceHW-xl);
    }
    
    .table_container {
        box-shadow: rgb(45, 45, 94) 0px 30px 500px -15px inset, rgba(0, 0, 0, 0.603) 0px 20px 500px -15px inset;
        position: relative;
        top: var(--spaceHW-5xl);
        min-height: 100%;
        padding-top: var(--spaceHW-xl);
        padding-bottom: var(--spaceHW-7xl);
    }
    .table_container.active{
        left: 250px;
        width: calc(100% - 250px);
    }
    .table_container .header_create_job{
        text-align: center;
        margin-bottom: var(--space-xs);
    }
    .table_container .header_create_job h3{
        font-size: var(--step-3);
        font-weight: 800;
        color: #ffbb00;
        -webkit-text-stroke: .1rem black;
    }
    .table_container form {
		margin: auto;
        display: grid;
        background-color: white;
        grid-area: 3 / 2 / -1 / -1;
        width: 50%;
        min-height: 100%;
        border: none;
        border-radius: 1rem;
        padding: var(--space-s);
        color: white;
        box-shadow: rgba(50, 50, 93, 0.801) 0px 50px 100px -20px, rgba(0, 0, 0, 0.767) 0px 30px 60px -30px, rgba(10, 37, 64, 0.473) 0px -2px 6px 0px inset;
    }
    .table_container label{
        font-size: var(--step-1);
        font-weight: 900;
        color: #000;
    }
    .table_container select{
        border: none;
        border-radius: 0.30rem;
        margin-top: var(--space-xs);
        margin-bottom: var(--space-s);
        font-size: var(--step-1);
        padding-block: var(--space-2xs);
        padding-inline: var(--spaceHW-4xs);
        background-color: rgb(211, 211, 211);
    }
    input[type="text"],
    textarea,
    input[type="number"] {
        width: 100%;
        padding: var(--space-xs);
        margin-top: var(--space-2xs);
        margin-bottom: var(--space-s);
        box-sizing: border-box;
        border-radius: 4px;
        border: none;
        background-color: rgb(211, 211, 211);
        color: black;
        font-size: var(--step-0);
    }
    input[type="submit"] {
        background-color: #ffd000;
        color: rgba(0, 0, 0);
        font-size: var(--step-0);
        font-weight: 900;
        padding: var(--space-3xs);
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 20px auto;
        width: 50%;
    }
    input[type="submit"]:hover {
        background-color: #ffee00;
        transform: translateY(-1px);
        border-color: #471d00;
        box-shadow: rgba(0, 0, 0, 0.60) 0 10px 15px;
    }
    .referenceImageContainer {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px;
        width: auto;
    }
    .Preview_Container{
        display: flex;
        justify-content: center;
        align-content: center;
        width: auto;
        height: 100%;
        background-color: #b90000;
    }
    .Preview_Container .imagePreview{
        width: 10vw;
        height: 10vw;
    }
    #referencePreview{
        margin: 1rem auto;
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
        <div class="header-banner-container">
        <div class="IClogo">
            <img src="imprint customs logo.png">
        </div>
        <h1>Imprint Customs  WORKSPACE</h1>
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
                <h2>Select Artist</h2>
                <select id="artist-list">
                    <?php foreach ($artists as $artist) : ?>
                        <option value="<?php echo htmlspecialchars($artist['user_id']); ?>">
                            <?php echo htmlspecialchars($artist['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="overlay-button">
                <button id="selectArtistButton">Select</button>
                <button id="closeArtistOverlay">Close</button>
                </div>
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
                <div class="overlay-button">
                <button id="selectTemplateButton">Select</button>
                <button id="closeTemplateOverlay">Close</button>
                </div>
            </div>
        </div>

        <!-- Job Creation Form -->
        <div class="table_container">
            <div class="header_create_job">
            <h3>Job Order Form</h3>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="jobForm">
                <label for="job-subject">Job Order Title:</label>
                <input type="text" id="job-subject" name="job-subject">

                <label for="job-brief">Job Order Description:</label>
                <textarea id="job-brief" name="job-brief" rows="4"></textarea>


                <!-- Upload design reference -->
                <div class="designReferenceContainer" id="designReferenceContainer">
                    <div class="referenceImageContainer">
                        <label for="referenceImage">Reference Image:</label>
                        
                        <img id="referencePreview" src="../upload/default_reference.jpg" alt="Design Reference Preview">
                        
                        <div class="Preview_Container" id="imagePreviewContainer"></div>
                    
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
                                $('#jobForm').trigger("reset");
                                window.location.reload(true); // refresh the page
                            }).catch((error) => {
                                console.log([...formData]);
                                console.error("Error during file upload:", error);
                                alert("An error occurred during the file upload.");
                            });
                        } else {
                            // If no files, just show success log and reset form
                            $('#jobForm').trigger("reset");
                            window.location.reload(true);
                        }
                    }, // End of success callback
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
                } 
                if (this.value === "Open to All") {
                    document.getElementById('selected-artist-name').value = null;
                    document.getElementById('artistOverlay').style.display = 'none'; // Hide the overlay if it was previously shown
                    selectedArtistDiv.innerHTML = ''; // Clear any selected artist information
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