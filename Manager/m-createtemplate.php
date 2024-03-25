<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>
<meta charset="UTF-8">
<title>Add a Product Template</title>
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

    .content-container {
        grid-area: 3/ 2 / -1 / -1;
    }

    .view-buttons {
        grid-area: 2 / 2 / 3 / -1;
        display: flex;
        place-self: start;
        padding: 10px 0;
        background-color: rgb(41, 41, 41);
        width: 100%;
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

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #444;
        /* Input background color */
        color: #fff;
        /* Input text color */
    }

    #templateName {
        width: 400px;
    }

    #templateCreation {
        background-color: #919191;
        color: #ffc40c;
    }

    #templateCreation label {
        color: #ffc40c;
    }

    #templateCreationForm {
        margin: 50px;
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: 100%;
        grid-row-gap: 5px;
    }

    #templateCreationForm table {
        width: 70%;

    }

    input[type="checkbox"] {
        cursor: pointer;
        transform: scale(1.3);
    }

    #addProcessButton,
    #removeSelectedButton {
        background-color: green;
        color: white;
        padding: 10px;
        border: 2px solid green;
        border-radius: 15px;
        cursor: pointer;
        margin-left: 20px;
        width: 250px;
        font-size: 14px;
        /* CSS styles for the buttons with the specified IDs */
    }

    #submitTemplateCreation {
        margin: 20px;
        width: 250px;
        background-color: #4caf50;
        color: #fff;
        padding: 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    #submitTemplateCreation:hover {
        box-shadow: 0 0 5px #00ff00, 0 0 25px #00ff00;
        /* Button hover effect */
    }

    select {
        font-size: 1em;

    }

    .templateImageContainer {
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: auto;
        grid-row-gap: 5px;
        margin-bottom: 10px;
    }

    .templateImageContainer label {
        place-self: end start;
    }

    .templateImageContainer input {
        border: 2px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        background-color: #444;
        color: #fff;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #444;
        color: #fff;
        width: 300px;

    }

    .templateImageContainer img {
        width: 200px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
        /* Add box shadow effect */
    }

    #processFieldsTable th {
        background-color: #dbaf00;
        color: #fff;
        border-radius: 3px;
    }

    .templates-list-container,
    #templatesList {
        display: grid;
        background-color: #919191;
        grid-area: 3 / 2 / -1 / -1;
        width: 100%;
        height: 100%;
    }

    .templates-list-container table {
        border-collapse: collapse;
        margin: 25px 90px;
        font-size: 0.9em;
        min-width: 70vw;
        min-height: 100px;
        border-radius: 12px 12px 0px 0px;
    }

    .templates-list-container th {
        background-color: #ffc400;
        color: #000000;
        text-align: left;
        font-weight: bold;
    }

    .templates-list-container td,
    .templates-list-container th {
        padding: 12px 25px;
    }

    .templates-list-container tr {
        border-bottom: 1px solid #525252;
    }

    .templates-list-container tr:nth-of-type(even) {
        background-color: #cfcfcf;
    }

    .templates-list-container tr:last-of-type {
        border-bottom: 4px solid #dbaf00;
    }

    #templatesList form {
        display: grid;
        grid-template-rows: auto auto;
    }

    #templatesList form input[type="submit"] {
        margin-left: 150px;
        color: #000000;
        background: #fcba03;
        padding: 4px 20px;
        border-radius: 10px;
        width: 210px;
    }

    .template_NameAndContainer {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        width: 70%;
        padding: 20px;
    }
</style>

<body>
    <div class="main">


        <?php
        include "manager_menu.php";
        include "../logindbase.php";
        ?>

        <h1 class="main-title">Jobs in Progress</h1>
        <div class="header-banner">
            <img src="colored highway night lights.jpg" class="banner-logo">
        </div>

        <div class="view-buttons">
            <button id="addATemplateBtn">Add a Template</button>
            <button id="viewTemplatesBtn">View Templates</button>
        </div>

        <?php
        echo '
    <div class="template-creation-container" id="templateCreation">
    <form action="m-createtemplate.php" method="post" enctype="multipart/form-data" id="templateCreationForm">
        <div class="template_NameAndContainer">
        <label for="templateName">Template Name:</label>
        <input type="text" id="templateName" name="templateName" required>

        <div class="templateImageContainer">
        <label for="templateImage">Template Image:</label>
        <img id="imagePreview" src="../upload/default_template.jpg" alt="Template Preview"/>
        <input type="file" id="templateImage" name="templateImage" accept="image/*" placeholder="Upload Template Image">
        </div>
        </div>

        <table id="processFieldsTable">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Process Name</th>
                    <th>Duration Option</th>
                    <th>Duration (minutes)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Process rows will be added here -->
            </tbody>
        </table>
        <button type="button" id="addProcessButton">Add Process</button>
        <button type="button" id="removeSelectedButton">Remove Selected</button>
        <button type="submit" id="submitTemplateCreation" name="submitTemplateCreation">Create Template</button>
    </form>
</div>';
        ?>
        <div class="templates-list-container" id="templatesList" style="display: none;">
            <!-- PHP code to fetch and display templates from tbl_templatelist -->
            <form method="post" action="m-createtemplate.php">
                <?php
                $sql = "SELECT * FROM tbl_templatelist";
                $result = $conn->query($sql);

                echo "<table>";
                echo "<tr><th>Select</th><th>Template ID</th><th>Template Name</th><th>Number of Processes</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selectedTemplates[]' value='" . $row['template_id'] . "'></td>";
                    echo "<td>" . $row['template_id'] . "</td>";
                    echo "<td>" . $row['template_name'] . "</td>";
                    echo "<td>" . $row['template_processes'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                <input type="submit" name="deleteSelected" value="Delete Selected" id="deleteSelectedButton">
            </form>
        </div>
    </div>
    <?php


    if (isset($_POST['deleteSelected'])) {
        if (isset($_POST['selectedTemplates']) && is_array($_POST['selectedTemplates'])) {
            $deleteSql = "DELETE FROM tbl_templatelist WHERE template_id = ?";

            $stmt = $conn->prepare($deleteSql);
            foreach ($_POST['selectedTemplates'] as $templateId) {
                $stmt->bind_param("i", $templateId);
                $stmt->execute();
            }
            $stmt->close();

            // Redirect or display a success message
            header("Location: m-createtemplate.php");
        }
    }

    if (isset($_POST["submitTemplateCreation"])) {
        $templateName = $_POST['templateName'];

        // Count the number of processes
        $processCount = 0;
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'processName') === 0 && trim($value) != '') {
                $processCount++;
            }
        }

        // Insert into tbl_templatelist with templateName and processCount
        $sqlTemplate = "INSERT INTO tbl_templatelist (template_name, template_processes) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sqlTemplate)) {
            $stmt->bind_param("si", $templateName, $processCount);
            $stmt->execute();
            $templateId = $conn->insert_id; // Get the ID of the newly inserted template
            $stmt->close();
        }
        // Insert each process into tbl_template_processes
        for ($i = 1; $i <= $processCount; $i++) {
            if (isset($_POST["processName$i"])) {
                $processName = $_POST["processName$i"];
                $durationOption = $_POST["durationOption$i"] ?? null;
                $processDuration = ($durationOption == 'setNow') ? $_POST["processDuration$i"] ?? null : null;
                $sqlProcess = "INSERT INTO tbl_template_processes (template_id, process_name, duration_option, duration) VALUES (?, ?, ?, ?)";
                if ($stmt = $conn->prepare($sqlProcess)) {
                    $stmt->bind_param("issi", $templateId, $processName, $durationOption, $processDuration);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }

        // Redirect or display a success message
        // Image upload
        if (isset($_FILES["templateImage"]) && $_FILES["templateImage"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["templateImage"]["name"];
            $filetype = $_FILES["templateImage"]["type"];
            $filesize = $_FILES["templateImage"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                die("Error: Please select a valid file format.");
            }

            // Verify file size - 5MB maximum
            $maxsize = 10 * 1024 * 1024;
            if ($filesize > $maxsize) {
                die("Error: File size is larger than the allowed limit.");
            }

            // Generate a unique file name
            $extension = pathinfo($_FILES["templateImage"]["name"], PATHINFO_EXTENSION);
            $newFileName = uniqid() . "." . $extension;
            $uploadPath = "../upload/template_img/" . $newFileName;

            if (file_exists($uploadPath)) {
                echo $newFileName . " already exists.";
            } else {
                if (move_uploaded_file($_FILES["templateImage"]["tmp_name"], $uploadPath)) {
                    // Update the record in tbl_templatelist with the image file path
                    $sqlUpdate = "UPDATE tbl_templatelist SET filepath_templateimage = ? WHERE template_id = ?";
                    if ($stmt = $conn->prepare($sqlUpdate)) {
                        $stmt->bind_param("si", $uploadPath, $templateId);
                        $stmt->execute();
                        $stmt->close();
                        echo "<script>alert('Your file was uploaded successfully.');</script>";
                    } else {
                        echo "<script>alert('Error: Unable to update the database.');</script>";
                    }
                } else {
                    echo "<script>alert('There was an error uploading your file.');</script>";
                }
            }
        }
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $url); // Redirect to the same page
        exit(); // Stop script execution
    }


    ?>
</body>
<script>
    //Image Preview
    document.getElementById('templateImage').addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });


    // Switch between the two views
    document.getElementById('addATemplateBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'addTemplate');
        switchView('addTemplate');
    });

    document.getElementById('viewTemplatesBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'viewTemplates');
        switchView('viewTemplates');
    });

    function switchView(view) {
        if (view === 'addTemplate') {
            document.getElementById('templateCreation').style.display = 'block';
            document.getElementById('templatesList').style.display = 'none';
        } else if (view === 'viewTemplates') {
            document.getElementById('templateCreation').style.display = 'none';
            document.getElementById('templatesList').style.display = 'block';
        }
    }

    window.onload = function() {
        var currentView = sessionStorage.getItem('currentView') || 'addTemplate';
        switchView(currentView);
    };

    // Template creation form
    let processCount = 0;

    document.getElementById('addProcessButton').addEventListener('click', addProcessRow);
    document.getElementById('removeSelectedButton').addEventListener('click', removeSelectedRows);

    function addProcessRow() {
        processCount++;
        const table = document.getElementById('processFieldsTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        const cell1 = newRow.insertCell(0);
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        cell1.appendChild(checkbox);

        const cell2 = newRow.insertCell(1);
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'processName' + processCount;
        input.required = true;
        cell2.appendChild(input);

        const cell3 = newRow.insertCell(2);
        const select = document.createElement('select');
        select.name = 'durationOption' + processCount;
        select.required = true;
        select.innerHTML = `
        <option value="">Select an option</option>
        <option value="salesagent">Time is input by salesagent</option>
        <option value="setNow">Set duration now</option>
        `;
        cell3.appendChild(select);

        const cell4 = newRow.insertCell(3);
        const durationDiv = document.createElement('div');
        durationDiv.id = 'durationField' + processCount;
        durationDiv.style.display = 'none';
        const durationInput = document.createElement('input');
        durationInput.type = 'number';
        durationInput.name = 'processDuration' + processCount;
        durationDiv.appendChild(durationInput);
        cell4.appendChild(durationDiv);

        select.setAttribute('data-duration-field-id', 'durationField' + processCount);
        select.addEventListener('change', toggleDurationField);
    }


    function removeSelectedRows() {
        const table = document.getElementById('processFieldsTable').getElementsByTagName('tbody')[0];
        Array.from(table.rows).forEach((row) => {
            if (row.cells[0].getElementsByTagName('input')[0].checked) {
                table.deleteRow(row.rowIndex - 1);
            }
        });
    }

    function toggleDurationField(event) {
        const selectElement = event.target;
        const durationFieldId = selectElement.getAttribute('data-duration-field-id');
        const durationField = document.getElementById(durationFieldId);

        if (selectElement.value === 'setNow') {
            durationField.style.display = '';
        } else {
            durationField.style.display = 'none';
        }
    }

    window.onload = function() {
        addProcessRow(); // Add the first process row when the page loads
    };
</script>

</html>
<?php ob_end_flush(); ?>