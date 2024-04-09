<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="popup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa2481bda4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<meta charset="UTF-8">
<title>Artists' Status</title>
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
        justify-content: center;
        align-items: center;
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
        min-width: 90%;
        min-height: 100px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
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
        background-color: #cfcfcf;
        margin-bottom: 20px;
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

    input[type='radio'] {
        transform: scale(1.25);

    }

    tr:hover {
        background-image: linear-gradient(to left, #cfcfcf 10%, #bfbfbf 50%);
    }



    @keyframes swipeGradient {
        0% {
            background-position: 0%;
        }

        100% {
            background-position: -100%;
        }
    }

    .assignedToArtist:hover {
        /* Slightly adjust the gradient colors for hover state */
        background-image: linear-gradient(to left, #FFD700 10%, #bfbfbf 50%);
        /* Keep the rest of the properties the same */
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .assignedToArtist {
        /* Define a linear gradient background. Adjust colors as desired. */
        background-image: linear-gradient(to left, #FFD700 10%, #cfcfcf 50%);
        /* Initial background position */
        background-position: -100%;
        /* Make sure the gradient covers the entire row. */
        background-size: 200%;
        /* Apply the animation. Adjust duration and timing function as desired. */
        animation: swipeGradient 0.5s linear forwards;
    }

    #submitButton {
        /* Your styles here */
        /* For example: */
        background-color: #ffc400;
        color: #000000;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 100px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    #submitButton:hover {
        background-color: #dbaf00;
    }

    #on_breakAlert {
        display: none;
        background-color: #ff0000;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        font-size: 0.8vw;
    }
</style>


<body>
    <div class="main">


        <?php
        include "artist_menu.php";
        require_once "../action_logger.php";
        $artistName = $_SESSION['username']; // Example: getting the artist name from the session
        ?>

        <h1 class="main-title">Job List</h1>
        <div class="header-banner">
            <img src="../images/duo motorbike.jpg" class="banner-logo">
        </div>
        <div class="content-header">
            <h2 class="content-title"></h2>

            <?php
            // Pagination
            $results_per_page = 15;
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $start_from = ($page - 1) * $results_per_page;
            // Pagination links
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE (assigning_method = 'Open to All' AND job_status = 'open') OR (job_status = 'open' AND assigned_artist = '{$_SESSION['username']}')";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);

            ?>

            <div class="view-buttons">
                <button id="statusBtn">Start Break</button>
                <span id="on_breakAlert">You are on break. Work orders cannot be started while on break.</span>
            </div>

            <div id="jobDetailsPopup" class="popup-overlay" style="display:none;">
                <div class="popup-content-left">
                    <span class="close-btn">&times;</span>
                    <div id="jobDetails"></div>
                </div>
                <div class="popup-content-right">
                    <div id="jobImages"></div>
                </div>
            </div>

            <?php
            echo "<div class='pagination-container'>";
            echo "<label>Page</label>";
            for ($i = 1; $i < $total_pages; $i++) {
                echo "<a href='$current_page?page=$i' class='page-link'>" . $i . "</a> ";
            }
            echo "<input type='text' id='searchInput' placeholder='Search for names...'>";
            echo "</div>";
            ?>

        </div>

        <?php

        // Prepare the SQL statement to check if the current_jobID is not null for the current artist
        $sql = "SELECT current_jobID FROM tbl_artist_status WHERE artist_name = ? AND current_jobID IS NOT NULL";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $artistName);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // If the current_jobID is not null, set the session variable and redirect
            $_SESSION['busy'] = 'busy';
            header("Location: ./artist_busy.php");
            exit(); // Don't forget to exit to stop the script execution after the redirect
        } else {
            $_SESSION['busy'] = 'online';
        }
        $stmt->close();

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT artist_status FROM tbl_artist_status WHERE artist_name = ?");
        $stmt->bind_param("s", $artistName);
        $stmt->execute();
        $stmt->bind_result($artistStatus);
        // Fetch the result.
        if ($stmt->fetch()) {
            // Assign the result to the session variable
            $_SESSION['busy'] = $artistStatus;
        } else {
            // Handle the case where the artist does not exist in the table
            echo "Artist not found or other error.";
        }

        // Close the statement
        $stmt->close();

        if ($_SESSION['busy'] == 'busy') {
            echo "<script>console.log('Artist is busy.');</script>";
            header("Location: ./artist_busy.php");
            exit();
        }
        ?>

        <?php

        // Retrieve data from the database for open jobs

        $sql_jobs = "
        SELECT job_id, job_subject, creator_name, time_created, job_brief, assigned_artist,
        CASE
        WHEN deadline_futureDateTime IS NOT NULL THEN deadline_futureDateTime
        WHEN manual_deadline_date IS NOT NULL AND manual_deadline_time IS NOT NULL THEN CONCAT(manual_deadline_date, ' ', manual_deadline_time)
            END AS effective_deadline
        FROM tbl_jobs
            WHERE job_status = 'open' 
            AND (assigning_method = 'Open to All' OR (assigned_artist = '$artistName'))
            ORDER BY 
            (assigned_artist = '$artistName') DESC, 
            CASE WHEN effective_deadline IS NULL THEN 1 ELSE 0 END, 
            effective_deadline ASC 
            LIMIT $start_from, $results_per_page";

        $result_jobs = $conn->query($sql_jobs);
        ?>
        <div class="table_container" id="tableView">

            <!-- Display the table -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table>
                    <tr class="infoRow">
                        <th style="background-color: transparent; text-align: left;" colspan="7">
                            Jobs colored with <div style="display: inline-block; width: 10px; height: 10px; background-color: #FFD700; border-radius: 50%; margin-right: 5px;"></div>are assigned to you.
                        </th>
                    </tr>
                    <tr class="infoRow">
                        <th id="th1">Select</th>
                        <th>Job ID</th>
                        <th>Job Created By</th>
                        <th>Time Created</th>
                        <th>Job Title</th>
                        <th>Job Brief</th>
                        <th>Deadline</th>
                    </tr>

                    <?php while ($row_jobs = $result_jobs->fetch_assoc()) : ?>
                        <?php $deadlineDisplay = $row_jobs['effective_deadline'] ? $row_jobs['effective_deadline'] : "Determined by Artist"; // Display "Not set" if null 
                        ?>
                        <?php $rowClass = $row_jobs['assigned_artist'] === $artistName ? 'assignedToArtist' : 'trHover'; ?>
                        <tr class="<?php echo $rowClass; ?>">
                            <td><input type='radio' name='selected_job' value='<?php echo $row_jobs['job_id']; ?>'></td>
                            <td><?php echo $row_jobs['job_id']; ?></td>
                            <td><?php echo $row_jobs['creator_name']; ?></td>
                            <td><?php echo $row_jobs['time_created']; ?></td>
                            <td><?php echo $row_jobs['job_subject']; ?></td>
                            <td><?php echo $row_jobs['job_brief']; ?></td>
                            <td><?php echo $deadlineDisplay; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <input id="submitButton" type="submit" name="press_selectJob" value="Start Selected Job">
            </form>
        </div>


        <?php
        // Check if the form is submitted
        if (isset($_POST['press_selectJob']) && isset($_POST['selected_job'])) {
            // Get the selected job_id and update tbl_jobs
            $selectedJobId = $_POST['selected_job'];
            $assignedArtist = $_SESSION['username'];
            $_SESSION['artist_currentJob'] = $selectedJobId;


            $updateSql = "UPDATE tbl_jobs SET job_status = 'pending', assigned_artist = ?, jobstart_datetime = NOW() WHERE job_id = ?";
            //$updateSql = "UPDATE tbl_jobs SET job_status = 'pending', assigned_artist = ?, jobstart_datetime = DATE_ADD(NOW(), INTERVAL 8 HOUR) WHERE job_id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("si", $assignedArtist, $selectedJobId);
            $stmt->execute();
            $stmt->close();

            // Set session variable 'busy'
            $_SESSION['busy'] = 'busy';

            // Update tbl_artist_status
            $updateArtistStatusSql = "UPDATE tbl_artist_status SET artist_status = 'busy', current_jobID = ? WHERE artist_name = ?";
            $stmtArtistStatus = $conn->prepare($updateArtistStatusSql);
            $stmtArtistStatus->bind_param("is", $selectedJobId, $assignedArtist);
            $stmtArtistStatus->execute();
            /*
            if ($stmtArtistStatus->execute()) {
                // If the artist_status update is successful, proceed to update tbl_user_status
                $updateUserStatusSql = "UPDATE tbl_user_status SET status = 'busy' WHERE username = ?";
                $stmtUserStatus = $conn->prepare($updateUserStatusSql);
                $stmtUserStatus->bind_param("s", $assignedArtist);
                $stmtUserStatus->execute();
                $stmtUserStatus->close();
            }
            */

            $logAction = "Started on a job order";
            $logSubjectId = $selectedJobId;
            $logSubjectType = "Job";
            $logDetails = "Job ID: $selectedJobId assigned to $assignedArtist";
            logAction($logAction, $logSubjectId, $logSubjectType, $logDetails);


            $stmtArtistStatus->close();
            header("Location: ./artist_busy.php");
            exit();
        }



        // Pagination links for open jobs
        $sql_jobs_total = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE job_status = 'open' AND (assigning_method = 'Open to All' OR assigned_artist = '$artistName')";
        $result_jobs_total = $conn->query($sql_jobs_total);
        $row_jobs_total = $result_jobs_total->fetch_assoc();
        $total_pages_jobs = ceil($row_jobs_total['total'] / $results_per_page);
        echo "<script>console.log('Total pages: $total_pages_jobs');</script>";

        $current_page_jobs = basename($_SERVER['PHP_SELF']);


        // Close the database connection
        $conn->close();
        ?>
    </div>

    <script>
        $(document).ready(function() {
            var artistName = "<?php echo htmlspecialchars($artistName, ENT_QUOTES, 'UTF-8'); ?>"; // Get the artist name from PHP and sanitize it

            checkArtistStatus();

            // Event handler for the break status toggle button
            $("#statusBtn").click(function() {
                var currentText = $(this).text();
                var newStatus = currentText === "Start Break" ? "on_break" : "online"; // Use "open" for the active status

                $.ajax({
                    type: "POST",
                    url: "update_artist_status.php",
                    data: {
                        artistName: artistName,
                        artistStatus: newStatus
                    },
                    success: function(response) {
                        // Toggle the button text based on the new status
                        var buttonText = newStatus === "on_break" ? "End Break" : "Start Break";
                        $("#statusBtn").text(buttonText);

                        // Check the newStatus and adjust the "Start Selected Job" button accordingly
                        if (newStatus === "online") { // Use "open" to check if the artist is available to work
                            $("#submitButton").prop('disabled', false).css('background-color', ''); // Re-enable and reset color
                            $("#on_breakAlert").hide();
                        } else {
                            $("#submitButton").prop('disabled', true).css('background-color', 'grey'); // Disable and grey out
                            $("#on_breakAlert").show();
                        }
                    }
                });
            });

            $("#tableView table tbody tr").click(function() {
                if ($(this).hasClass('infoRow')) {
                    return false; // Prevent popup overlay for info row
                }
                var jobId = $(this).find("td:nth-child(2)").text(); // Assuming Job ID is in the second column

                // Fetch job details
                $.ajax({
                    url: 'fetch_job_details.php', // Endpoint that returns job details
                    type: 'POST',
                    data: {
                        jobId: jobId
                    },
                    success: function(data) {
                        var jobDetails = JSON.parse(data);
                        var detailsHtml = '<div class="job-order-details">';
                        detailsHtml += '<p><strong>Job ID:</strong> ' + jobDetails.job_id + '</p>';
                        detailsHtml += '<p><strong>Creator Name:</strong> ' + jobDetails.creator_name + '</p>';
                        detailsHtml += '<p><strong>Time Created:</strong> ' + jobDetails.time_created + '</p>';
                        detailsHtml += '<p><strong>Job Brief:</strong> ' + jobDetails.job_brief + '</p>';
                        detailsHtml += '</div>';
                        $("#jobDetails").html(detailsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching job details: " + error);
                    }
                });

                // Fetch reference images
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
                            var animationDelay = index * 150; // 100ms delay increment for each image
                            imagesHtml += `<img src="${url}" alt="Image" class="gallery-image" style="animation-delay: ${animationDelay}ms;">`;
                        });

                        imagesHtml += '</div>';
                        $("#jobImages").html(imagesHtml);
                        $("#jobDetailsPopup").show();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching images: " + error);
                    }
                });
            }); // End of table row click event

            $(document).on('click', '.gallery-image', function(e) {
                // Check if the image is already enlarged
                if ($(this).hasClass('enlarged')) {
                    // Image is already enlarged, so remove the class to minimize it
                    $(this).removeClass('enlarged');
                } else {
                    // Image is not enlarged, so first remove 'enlarged' class from any image that may have it
                    $('.gallery-image').removeClass('enlarged');
                    // Then, add 'enlarged' class to the clicked image
                    $(this).addClass('enlarged');
                }
                // Prevent the click event from propagating to higher elements
                e.stopPropagation();
            });

            // Click event for the popup overlay and its contents, excluding gallery images
            $(document).on('click', function(e) {
                // Conditions to close the popup:
                // 1. Click is outside of both popup-content-left and popup-content-right
                // 2. Click is not on a gallery image
                // This ensures clicks on enlarged images or within the popup content do not close the popup
                if (!$(e.target).closest('.popup-content-left').length &&
                    !$(e.target).closest('.popup-content-right').length &&
                    !$(e.target).hasClass('gallery-image')) {
                    // Minimize any enlarged image
                    $('.gallery-image').removeClass('enlarged');
                    // Hide the popup overlay
                    $("#jobDetailsPopup").hide();
                }
            });

            // Close button functionality: Close the popup when the close button is clicked
            $(".close-btn").click(function(e) {
                // Hide the popup
                $("#jobDetailsPopup").hide();
                // Prevent the event from propagating to avoid triggering the document click event
                e.stopPropagation();
            });

            // Specifically prevent the pop-up when clicking on the radio button
            $("#tableView table tbody tr td input[type='radio']").click(function(e) {
                e.stopPropagation(); // Stop the click event from bubbling up to the parent tr
            });

            /***End of code for popup ***/




        }); // End of document ready

        // Function to check the artist status
        function checkArtistStatus() {
            var artistName = "<?php echo htmlspecialchars($artistName, ENT_QUOTES, 'UTF-8'); ?>";
            $.ajax({
                type: "POST",
                url: "check_artist_status.php",
                data: {
                    artistName: artistName
                },
                success: function(response) {
                    if (response.trim() === "on_break") {
                        $("#submitButton").prop('disabled', true).css('background-color', 'grey');
                        $("#statusBtn").text("End Break"); // Assume the artist is on a break initially
                        $("#on_breakAlert").show();
                    } else if (response.trim() === "online") {
                        $("#submitButton").prop('disabled', false).css('background-color', ''); // Re-enable if status is "open"
                        $("#statusBtn").text("Start Break");
                        $("#on_breakAlert").hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + status + ", " + error);
                }
            });
        }// End of checkArtistStatus function
    </script>

</body>

<?php ob_end_flush(); ?>