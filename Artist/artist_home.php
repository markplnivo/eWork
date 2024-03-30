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
        /*border-bottom: 1px solid #525252;*/
    }

    .table_container tr:nth-of-type(even) {
        background-color: #cfcfcf;
    }

    .table_container tr:last-of-type {
        /*border-bottom: 4px solid #dbaf00;*/
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

    input[type='radio']{
        transform: scale(1.25);
    
    }
</style>

<body>
    <div class="main">


        <?php
        include "artist_menu.php";
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE job_status = 'open' OR assigned_artist = '{$_SESSION['username']}'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);

            ?>

            <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="cardViewBtn">Card View</button>
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
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='$current_page?page=$i' class='page-link'>" . $i . "</a> ";
            }
            echo "<input type='text' id='searchInput' placeholder='Search for names...'>";
            echo "</div>";
            ?>

        </div>

        <?php
        $artistName = $_SESSION['username']; // Example: getting the artist name from the session

        // Prepare the SQL statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT artist_status FROM tbl_artist_status WHERE artist_name = ?");

        // Bind the parameter (s for string)
        $stmt->bind_param("s", $artistName);

        // Execute the query
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($artistStatus);

        // Fetch the result. No need for a loop since we expect only one row
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
            header("Location: ./artist_busy.php");
            exit();
        }
        ?>

        <?php

        // Retrieve data from the database for open jobs

        $sql_jobs = "
            SELECT job_id, creator_name, time_created, job_brief,
            CASE
            WHEN deadline_futureDateTime IS NOT NULL THEN deadline_futureDateTime
            WHEN manual_deadline_date IS NOT NULL AND manual_deadline_time IS NOT NULL
                THEN CONCAT(manual_deadline_date, ' ', manual_deadline_time)
            END AS effective_deadline
            FROM tbl_jobs
            WHERE job_status = 'open' 
            AND (assigning_method = 'Open to All' 
            OR (assigning_method = 'Assign an Artist' AND assigned_artist = '$username'))
            ORDER BY 
            CASE WHEN effective_deadline IS NULL THEN 1 ELSE 0 END, 
            effective_deadline ASC
            LIMIT $start_from, $results_per_page";

        $result_jobs = $conn->query($sql_jobs);
        echo '<div class="table_container" id="tableView">';
        // Display the table
        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<table>";
        echo "<tr><th id='th1'>Select</th><th>Job ID</th><th>Job Created By</th><th>Time Created</th><th>Job Brief</th><th>Deadline</th></tr>";


        while ($row_jobs = $result_jobs->fetch_assoc()) {
            $deadlineDisplay = $row_jobs['effective_deadline'] ? $row_jobs['effective_deadline'] : "Determined by Artist"; // Display "Not set" if null
            echo "<tr class='trHover'>";
            echo "<td><input type='radio' name='selected_job' value='" . $row_jobs['job_id'] . "'></td>";
            echo "<td>" . $row_jobs['job_id'] . "</td>";
            echo "<td>" . $row_jobs['creator_name'] . "</td>";
            echo "<td>" . $row_jobs['time_created'] . "</td>";
            echo "<td>" . $row_jobs['job_brief'] . "</td>";
            echo "<td>" . $deadlineDisplay . "</td>"; // Use the $deadlineDisplay variable here
            echo "</tr>";
        }

        echo "</table>";
        echo "<input type='submit' name='press_selectJob' value='Start Selected Job'>";
        echo "</form>";
        echo '</div>';


        // Check if the form is submitted
        if (isset($_POST['press_selectJob']) && isset($_POST['selected_job'])) {
            // Get the selected job_id and update tbl_jobs
            $selectedJobId = $_POST['selected_job'];
            $assignedArtist = $_SESSION['username'];
            $_SESSION['artist_currentJob'] = $selectedJobId;

            $updateSql = "UPDATE tbl_jobs SET job_status = 'ongoing', assigned_artist = ? WHERE job_id = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("si", $assignedArtist, $selectedJobId);
            $stmt->execute();
            $stmt->close();

            // Set session variable 'busy'
            $_SESSION['busy'] = 'busy';

            // Update tbl_artist_status
            $updateArtistStatusSql = "UPDATE tbl_artist_status SET artist_status = 'busy' WHERE artist_name = ?";
            $stmtArtistStatus = $conn->prepare($updateArtistStatusSql);
            $stmtArtistStatus->bind_param("s", $assignedArtist);
            $stmtArtistStatus->execute();
            $stmtArtistStatus->close();
            header("Refresh:0");
        }

        // Check tbl_userlist for new usernames with job_position 'Artist'
        $sqlCheckNewArtists = "SELECT username FROM tbl_userlist WHERE job_position = 'Artist' AND username NOT IN (SELECT artist_name FROM tbl_artist_status)";
        $resultCheckNewArtists = $conn->query($sqlCheckNewArtists);

        // Insert new artists into tbl_artist_status
        if ($resultCheckNewArtists->num_rows > 0) {
            $insertSql = "INSERT INTO tbl_artist_status (artist_name, artist_status) VALUES (?, 'open')";
            $stmtInsert = $conn->prepare($insertSql);

            while ($row = $resultCheckNewArtists->fetch_assoc()) {
                $newArtistName = $row['username'];
                $stmtInsert->bind_param("s", $newArtistName);
                $stmtInsert->execute();
            }

            $stmtInsert->close();
        }

        // Pagination links for open jobs
        $sql_jobs_total = "SELECT COUNT(*) AS total FROM tbl_jobs WHERE job_status = 'open'";
        $result_jobs_total = $conn->query($sql_jobs_total);
        $row_jobs_total = $result_jobs_total->fetch_assoc();
        $total_pages_jobs = ceil($row_jobs_total['total'] / $results_per_page);

        $current_page_jobs = basename($_SERVER['PHP_SELF']);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages_jobs; $i++) {
            echo "<a href='$current_page_jobs?page=" . $i . "'>" . $i . "</a> ";
        }
        echo "</div>";


        echo '<div class="card_container" id="cardView" style="display: none;">';
        foreach ($result as $row) {
            echo "<div class='card' style='width: 250px; height: 250px;'>";
            echo "<p>Job ID: " . $row['job_id'] . "</p>";
            echo "<p>Creator Name: " . $row['creator_name'] . "</p>";
            echo "<p>Time Created: " . $row['time_created'] . "</p>";
            echo "<p>Job Brief: " . $row['job_brief'] . "</p>";
            // Add more data as needed
            echo "</div>";
        }
        echo '</div>';


        // Close the database connection
        $conn->close();
        echo "</div>";
        echo "</div>";
        ?>
    </div>

    <script>
        $(document).ready(function() {
            $("#tableView table tbody tr").click(function() {
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
                        // Add more details as needed
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
            });

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
        });
    </script>
</body>
<?php ob_end_flush(); ?>