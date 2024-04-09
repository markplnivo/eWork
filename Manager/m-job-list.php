<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="m-popup.css">
    <link rel="stylesheet" href="m-chart.css">
    <link rel="stylesheet" href="m-table.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest"></script>
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

    @keyframes swipeGradient {
        0% {
            background-position: 0%;
        }

        100% {
            background-position: -100%;
        }
    }

    .jobopen:hover {
        background-image: linear-gradient(to left, #b0c4de 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .jobopen {
        background-image: linear-gradient(to left, #b0c4de 10%, #cfcfcf 50%);
        background-position: 0;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .pending_noupdate:hover {
        background-image: linear-gradient(to left, #ffcccb 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .pending_noupdate {
        background-image: linear-gradient(to left, #ffcccb 10%, #cfcfcf 50%);
        background-position: 0;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .pending_update:hover {
        background-image: linear-gradient(to left, #ed9121 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .pending_update {
        background-image: linear-gradient(to left, #ed9121 10%, #cfcfcf 50%);
        background-position: 0;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .using_deadline:hover {
        background-image: linear-gradient(to left, #ffffe0 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .using_deadline {
        background-image: linear-gradient(to left, #ffffe0 10%, #cfcfcf 50%);
        background-position: 0;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }
</style>

<body>
    <div class="main">


        <?php
        include "manager_menu.php";
        include "../logindbase.php";
        ?>

        <h1 class="main-title">Job List</h1>
        <div class="header-banner">
            <img src="banner logo.jpg" class="banner-logo">
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs where job_status = 'pending' OR job_status = 'open'";
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
            ?>

            <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="chartViewBtn">Chart View</button>
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

        </div>

        <?php
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
            WHERE j.job_status = 'pending' OR j.job_status = 'open'
            LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);
        ?>
        <div class="table_container" id="tableView">
            <div id="timeSortOptions">
                <label>Sort table data by:</label>
                <button onclick="sortByTime('day')">Day</button>
                <button onclick="sortByTime('week')">Week</button>
                <button onclick="sortByTime('month')">Month</button>
                <button onclick="sortByTime('year')">Year</button>
            </div>
            <table>
                <tr>
                    <th>Job ID</th>
                    <th>Job Agent</th>
                    <th>Time Created</th>
                    <th>Deadline</th>
                    <th>Tracking Method</th>
                    <th>Title</th>
                    <th>Assigned Artist</th>
                    <th>Status</th>
                    <th>Tracking Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) {
                    $completionText = '';
                    $rowClass = ''; // Initialize a variable for the row's class

                    if ($row['job_status'] == 'open') {
                        $completionText = 'Job Still Open';
                        $rowClass = 'jobopen'; //class name
                    } elseif ($row['job_status'] == 'pending' && $row['job_tracking_method'] == 'Artist') {
                        if (empty($row['completion_percentage'])) {
                            $completionText = 'Pending & No Update';
                            $rowClass = 'pending_noupdate'; //class name
                        } else {
                            $completionText = $row['completion_percentage'] . '%';
                            $rowClass = 'pending_update'; //class name
                        }
                    } elseif ($row['job_tracking_method'] != 'Artist') {
                        $completionText = 'Using Deadline';
                        $rowClass = 'using_deadline'; //class name
                    }
                ?>
                    <tr class="<?php echo htmlspecialchars($rowClass); ?>">
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['creator_name']; ?></td>
                        <td><?php echo date('M d Y, g:i A', strtotime($row['time_created'])); ?></td>
                        <td><?php echo date('M d Y, g:i A', strtotime($row['job_deadline'])); ?></td>
                        <td><?php echo $row['job_tracking_method']; ?></td>
                        <td><?php echo $row['job_subject']; ?></td>
                        <td><?php echo $row['assigned_artist']; ?></td>
                        <td><?php echo $row['job_status']; ?></td>
                        <td><?php echo $completionText; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <?php

        ?>
        <div class="chart_container" id="chartView" style="display: none;">
            <div id="chartSortBy">
                <label>Sort chart data by:</label>
                <button onclick="fetchJobsData('day')">Day</button>
                <button onclick="fetchJobsData('week')">Week</button>
                <button onclick="fetchJobsData('month')">Month</button>
                <button onclick="fetchJobsData('year')">Year</button>
            </div>
            <div class="canvasContainer">
                <canvas id="jobStatusChart"></canvas>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
</div>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $("#tableView table tbody tr").click(function() {
            if ($(this).hasClass('infoRow')) {
                return false; // Prevent popup overlay for info row
            }
            var jobId = $(this).find("td:first").text(); // Assuming Job ID is in the first column
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


    const ctx = document.getElementById('jobStatusChart').getContext('2d');
    let jobStatusChart = null; // This will hold the chart instance

    // Render the chart using Chart.js
    function renderChart(data) {
        // If an instance of the chart already exists, destroy it
        if (jobStatusChart) {
            jobStatusChart.destroy();
        }

        // Create a new chart instance
        jobStatusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Open Jobs', 'Pending Jobs'],
                datasets: [{
                    label: 'Job Status Count',
                    data: [data.open, data.pending],
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Job Orders by Status',
                        font: {
                            size: 20,
                            weight: 'bold'
                        },
                        color: '#000'
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });
    } // end of chartjs

    // Asynchronously fetch job data
    async function fetchJobData() {
        try {
            const response = await fetch('./ajax_list/joblist_chart.php');
            const jobData = await response.json();

            const data = {
                open: jobData.find(job => job.job_status === 'open')?.count || 0,
                pending: jobData.find(job => job.job_status === 'pending')?.count || 0
            };
            console.log("attempting to render chart" + data);
            renderChart(data);
        } catch (error) {
            console.error('Error fetching job data:', error);
        }
    } // end of fetchJobData

    window.onload = function() {
        fetchJobData(); // Fetch and render the chart as part of window load
        switchView(sessionStorage.getItem('currentView') || 'table');
    };

    // Switch between table and chart view
    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'flex';
            document.getElementById('chartView').style.display = 'none';
            // Optionally destroy the chart when switching away from chart view
            if (jobStatusChart) {
                jobStatusChart.destroy();
                jobStatusChart = null;
            }
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'flex';
            // Refetch data or show the existing chart when switching to chart view
            fetchJobData();
        }
    }

    document.getElementById('tableViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'table');
        switchView('table');
    });

    // Show the chart view
    function showChart() {
        document.getElementById('chartView').style.display = 'flex';
    } // end of showChart


    document.getElementById('chartViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'chart');
        switchView('chart');
        showChart();
    });

    document.querySelectorAll('.page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var currentView = sessionStorage.getItem('currentView') || 'table';
            window.location.href = this.href + '&view=' + currentView;
        });
    });

    // Search Functionality
    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        var filter = searchInput.value.toUpperCase();
        var rows = document.getElementById('tableView').getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var td = rows[i].getElementsByTagName('td')[1];
            if (td) {
                if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });

    // Fetch job data based on time frame
    function fetchJobsData(timeFrame) {
        fetch(`./ajax_list/joblist_chart.php?timeFrame=${timeFrame}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const formattedData = {
                    open: data.find(job => job.job_status === 'open')?.count || 0,
                    pending: data.find(job => job.job_status === 'pending')?.count || 0
                };
                renderChart(formattedData); // Pass the formatted data to the chart
            })
            .catch(error => console.error('Error fetching job data:', error));
    }
</script>


</html>
<?php ob_end_flush(); ?>