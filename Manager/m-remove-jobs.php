<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="m-table.css">
    <link rel="stylesheet" href="m-popup.css">
    <meta charset="utf-8">
    <title>Remove Jobs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
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

    .table_container form input[type="submit"] {
        margin-left: 150px;
        color: #000000;
        background: #fcba03;
        padding: 4px 20px;
        border-radius: 10px;
    }

    .table_container form input[name="remove_selected"] {
        font-size: 12px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body>
    <div class="main">
        <?php
        include "manager_menu.php";
        ?>
        <h1 class="main-title">Remove Jobs</h1>
        <div class="header-banner">
            <img src="colored highway night lights.jpg" class="banner-logo">
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);



            echo "<div class='pagination-container'>";
            echo "<label>Page</label>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='$current_page?page=$i' class='page-link'>" . $i . "</a> ";
            }
            echo "<input type='text' id='searchInput' placeholder='Search for names...'>";
            echo "</div>";
            

            $sql = "SELECT j.job_id, 
            j.creator_name, 
            j.time_created, 
            j.job_status, 
            j.assigned_artist, 
            j.job_subject, 
            j.job_brief, 
            j.assigning_method, 
            j.template_method, 
            j.template_id, 
            j.job_tracking_method, 
            CASE 
                WHEN j.manual_deadline_date IS NOT NULL AND j.manual_deadline_time IS NOT NULL THEN CONCAT(j.manual_deadline_date, ' ', j.manual_deadline_time)
                WHEN j.deadline_futureDateTime IS NOT NULL THEN j.deadline_futureDateTime
                ELSE 'Artist Deadline'
            END AS job_deadline,
            j.jobstart_datetime,
            CASE 
                WHEN j.job_tracking_method = 'Artist' AND a.current_jobID = j.job_id AND a.artist_status = 'busy' THEN a.completion_percentage
                ELSE NULL
            END AS completion_percentage
            FROM tbl_jobs AS j
            LEFT JOIN tbl_artist_status AS a ON j.assigned_artist = a.artist_name
            LIMIT $start_from, $results_per_page";
            $result = $conn->query($sql);
            ?>

            <!-- <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="chartViewBtn">Chart View</button>
            </div> -->


            <div id="jobDetailsPopup" class="popup-overlay" style="display:none;">
                <div class="popup-content-left">
                    <span class="close-btn">&times;</span>
                    <div id="jobDetails"></div>
                </div>
                <div class="popup-content-right">
                    <div id="jobImages"></div>
                </div>
            </div>


        </div>


        <div class="table_container" id="tableView">
            <form method="post" action="m-remove-jobs.php">
                <table id="removeJobTable">
                    <thead>
                        <tr class="infoRow">
                            <th></th> <!-- Checkbox column -->
                            <th>Job ID</th>
                            <th>Job Agent</th>
                            <th>Time Created</th>
                            <th>Deadline</th>
                            <th>Tracking Method</th>
                            <th>Title</th>
                            <th>Assigned Artist</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row['job_id']; ?>"></td>
                                <td><?php echo $row['job_id']; ?></td>
                                <td><?php echo $row['creator_name']; ?></td>
                                <td><?php echo date('M d Y, g:i A', strtotime($row['time_created'])); ?></td>
                                <td><?php echo date('M d Y, g:i A', strtotime($row['job_deadline'])); ?></td>
                                <td><?php echo $row['job_tracking_method']; ?></td>
                                <td><?php echo $row['job_subject']; ?></td>
                                <td><?php echo $row['assigned_artist']; ?></td>
                                <td><?php echo $row['job_status']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <input type="submit" name="remove_selected" value="Remove Selected" id="RemoveButton">
            </form>
        </div>

        <?php
        if (isset($_POST['remove_selected'])) {
            // Check if any rows were selected for removal
            if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
                // Prepare the SQL statement to insert the record into the new table
                $insertSql = "INSERT INTO tbl_recyclebin SELECT * FROM tbl_jobs WHERE job_id = ?";

                // Prepare the SQL statement to delete the record from the old table
                $deleteSql = "DELETE FROM tbl_jobs WHERE job_id= ?";

                // Create a prepared statement
                if ($stmt = $conn->prepare($insertSql)) {
                    // Assuming $conn is your database connection and $jobId is the ID of the job you want to move
                    $stmt->bind_param("i", $jobId); // "i" indicates that the parameter is an integer
                    $stmt->execute();

                    // Iterate over the selected rows and delete each one
                    foreach ($_POST['selected_rows'] as $jobId) {
                        // Execute the statement for each selected job ID
                        $stmt->execute();
                    }

                    $stmt = $conn->prepare($deleteSql);
                    $stmt->bind_param("i", $jobId);
                    $stmt->execute();

                    // Close the prepared statement
                    $stmt->close();

                    // Redirect or display a success message
                    // You may want to redirect the user to a different page or display a success message.
                    // For example: header("Location: success.php");
                } else {
                    // Handle any errors with the prepared statement
                    echo "Error: " . $conn->error;
                }
            }
        }
        ?>



    </div>
</body>

<script type=text/javascript>
    $(document).ready(function() {
        $("#tableView table tbody tr").click(function() {
            if ($(this).hasClass('infoRow')) {
                return false; // Prevent popup overlay for info row
            }
            var jobId = $(this).find("td:eq(1)").text(); // Assuming Job ID is in the second column
            // Fetch job details for jobs in progress
            console.log(jobId);
            $.ajax({
                url: './ajax_list/fetch_jobslist_details.php',
                type: 'POST',
                data: {
                    jobId: jobId
                },
                success: function(response) {
                    console.log(response);
                    // Check if the request was successful
                    if (response.success) {
                        // Access the job details
                        var jobDetails = response.details;
                        var detailsHtml = '<div class="job-order-details">' +
                            '<p><strong>Job ID:</strong> ' + jobDetails.job_id + '</p>' +
                            '<p><strong>Job Agent:</strong> ' + jobDetails.creator_name + '</p>' +
                            '<p><strong>Job Title:</strong> ' + jobDetails.job_subject + '</p>' +
                            '<p><strong>Artist Assigned:</strong> ' + jobDetails.assigned_artist + '</p>' +
                            '<p><strong>Job Start Date:</strong> ' + jobDetails.jobstart_datetime + '</p>' +
                            '<p><strong>Job Deadline:</strong> ' + jobDetails.job_deadline + '</p>' +
                            '<p><strong>Completion Status:</strong> ' + jobDetails.completion_status + '</p>' +
                            '</div>';
                        $("#jobDetails").html(detailsHtml);
                    } else {
                        // Handle failure
                        $("#jobDetails").html('<p>Error fetching job details. Please try again.</p>');
                        console.error("Error fetching job details: " + response.message);
                    }
                }
            });

            // Fetch reference images for jobs in progress
            $.ajax({
                url: './ajax_list/fetch_jobslistreference_images.php',
                type: 'POST',
                data: {
                    jobId: jobId
                },
                success: function(data) {
                    var images = JSON.parse(data);
                    var imagesHtml = '<div class="image-gallery">';
                    if (images.length === 0) {
                        images.push('http://localhost/eWork_collab/upload/default_reference.jpg'); // Adjust default image path as necessary
                    }
                    images.forEach((url, index) => {
                        var animationDelay = index * 150; // 150ms delay increment for each image
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
    }); // End of document ready

      // Click event to enlarge the image
      $(document).on('click', '.gallery-image', function(e) {
        if ($(this).hasClass('enlarged')) {
            $(this).removeClass('enlarged');
        } else {
            $('.gallery-image').removeClass('enlarged');
            $(this).addClass('enlarged');
        }
        e.stopPropagation();
    }); // End of click event to enlarge the image

    // Click anywhere on the page to minimize the enlarged image
    $(document).click(function(e) {
        if (!$(e.target).is('.gallery-image')) {
            $('.gallery-image.enlarged').removeClass('enlarged');
        }
    }); //end of click

    // Close the popup when clicking the close button
    $(".close-btn").click(function(e) {
        $("#jobDetailsPopup").hide();
        e.stopPropagation();
    }); //end of click

    // Close the popup when clicking outside of it
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.popup-content-left').length &&
            !$(e.target).closest('.popup-content-right').length &&
            !$(e.target).hasClass('gallery-image')) {
            // Minimize any enlarged image
            $('.gallery-image').removeClass('enlarged');
            // Hide the popup overlay
            $("#jobDetailsPopup").hide();
        }
    }); //end of document click

    $("#tableView table tbody tr td input[type='checkbox']").click(function(e) {
                e.stopPropagation(); // Stop the click event from bubbling up to the parent tr
            });

</script>

</html>