<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="m-popup.css">
    <link rel="stylesheet" href="m-chart.css">
    <link rel="stylesheet" href="m-table.css">
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@^3"></script>
    <script src="https://cdn.jsdelivr.net/npm/date-fns"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
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


    .chart_container {
        overflow-x: auto;
    }

    .canvasContainer {
        width: 80%;
        height: auto;
        align-self: center;
    }


    @keyframes swipeGradient {
        0% {
            background-position: 0%;
        }

        100% {
            background-position: -100%;
        }
    }

    .deadline-artist:hover {
        background-image: linear-gradient(to left, #FFD700 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-artist {
        background-image: linear-gradient(to left, #FFD700 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-past:hover {
        background-image: linear-gradient(to left, #FF6347 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-past {
        background-image: linear-gradient(to left, #FF6347 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-warning:hover {
        background-image: linear-gradient(to left, #FFA500 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-warning {
        background-image: linear-gradient(to left, #FFA500 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-safe:hover {
        background-image: linear-gradient(to left, #98fb98 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .deadline-safe {
        background-image: linear-gradient(to left, #98fb98 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }
</style>

<body>
    <div class="main">


        <?php
        include "manager_menu.php";
        include "../logindbase.php";
        include "sms.php";
        ?>

        <h1 class="main-title">Jobs in Progress</h1>
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs where job_status = 'pending'";
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
                    <button id="openOverlay">Send an SMS Notification</button>
                </div>
                <div class="popup-content-right">
                    <div id="jobImages"></div>
                </div>
            </div>

        </div>



        <?php
        // Retrieve data from the database
        $sql = "SELECT job_id, creator_name, assigned_artist, job_subject, jobstart_datetime, jobend_datetime, manual_deadline_date, manual_deadline_time, deadline_futuredatetime FROM tbl_jobs WHERE job_status = 'pending' LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);

        // Function to calculate deadline
        function calculateDeadlineDateTime($row, $conn)
        {
            // Original calculation logic remains the same
            if ($row['manual_deadline_date'] !== null && $row['manual_deadline_time'] !== null) {
                return new DateTime($row['manual_deadline_date'] . ' ' . $row['manual_deadline_time']);
            } elseif ($row['deadline_futuredatetime'] !== null) {
                return new DateTime($row['deadline_futuredatetime']);
            } else {
                // Fetch completion_percentage as fallback
                $artistQuery = "SELECT completion_percentage FROM tbl_artist_status WHERE artist_name = ?";
                $stmt = $conn->prepare($artistQuery);
                $stmt->bind_param("s", $row['assigned_artist']);
                $stmt->execute();
                $artistResult = $stmt->get_result();
                if ($artistResult->num_rows > 0) {
                    $artistRow = $artistResult->fetch_assoc();
                    $stmt->close();
                    return $artistRow['completion_percentage'];
                }
                $stmt->close();
                return 'N/A'; // Or however you want to handle no deadline
            }
        } // End of calculateDeadline function

        // Function to determine row color based on deadline
        function determineRowColor($deadline)
        {
            // Check if $deadline is a DateTime object
            if ($deadline instanceof DateTime) {
                $today = new DateTime(); // Today's date
                $halfDeadline = clone $deadline;

                // Calculate halfway to the deadline from today
                $interval = $today->diff($deadline);
                $daysTillDeadline = $interval->days;
                $halfDays = floor($daysTillDeadline / 2);
                $halfDeadline->sub(new DateInterval("P{$halfDays}D"));

                // Apply coloring based on conditions
                if ($deadline < $today) {
                    return 'deadline-past';
                } elseif ($today > $deadline) {
                    return 'deadline-warning';
                } else {
                    return 'deadline-safe';
                }
            }
            // If $deadline is not a DateTime object (e.g., a string or percentage), handle accordingly
            // This part depends on how you want to treat non-date values. As an example:
            elseif ($deadline !== 'N/A') {
                // If completion_percentage is returned and it's less than 100, you might want to color it differently
                return 'deadline-artist'; // Example color for non-date values
            }
            // Default styling or lack thereof for 'N/A' or other conditions
            return '';
        } // End of determineRowColor function
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
                <tr class="infoRow">
                    <th onclick="sortTable('job_id')">Job ID</th>
                    <th onclick="sortTable('creator_name')">Job Agent</th>
                    <th onclick="sortTable('assigned_artist')">Artist Assigned</th>
                    <th onclick="sortTable('job_subject')">Job Title</th>
                    <th onclick="sortTable('jobstart_datetime')">Job Start Date</th>
                    <th onclick="sortTable('deadline')">Job Deadline</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <?php
                    $deadlineDateTime = calculateDeadlineDateTime($row, $conn); // Get the deadline
                    $rowColor = determineRowColor($deadlineDateTime); // Determine row color based on deadline

                    // Check if $deadlineDateTime is a DateTime object before formatting
                    if ($deadlineDateTime instanceof DateTime) {
                        $formattedDeadline = $deadlineDateTime->format('F j Y, g:i A');
                    } else {
                        // If $deadlineDateTime is not a DateTime object, use it as is (assuming it's a string or integer)
                        $formattedDeadline = $deadlineDateTime;
                    }

                    $jobStartDateTime = new DateTime($row['jobstart_datetime']);
                    $formattedJobStart = $jobStartDateTime->format('F j Y, g:i A');
                    ?>
                    <tr class="<?php echo htmlspecialchars($rowColor); ?>">
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['creator_name']; ?></td>
                        <td><?php echo $row['assigned_artist']; ?></td>
                        <td><?php echo $row['job_subject']; ?></td>
                        <td><?php echo $formattedJobStart; ?></td>
                        <td><?php echo $formattedDeadline; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="chart_container" id="chartView" style="display: none;">
            <div id="chartSortBy">
                <label>Sort chart data by:</label>
                <button onclick="fetchJobsData('day')">Day</button>
                <button onclick="fetchJobsData('week')">Week</button>
                <button onclick="fetchJobsData('month')">Month</button>
                <button onclick="fetchJobsData('year')">Year</button>
            </div>
            <div class="canvasContainer">
                <canvas id="jobsProgressChart"></canvas>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>

</body>

<script src="sms.js"></script>
<script type="text/javascript">
    var sessionUsername = <?php echo json_encode($_SESSION['username']); ?>;

    $(document).ready(function() {
        $("#tableView table tbody tr").click(function() {
            if ($(this).hasClass('infoRow')) {
                return false; // Prevent popup overlay for info row
            }
            var jobId = $(this).find("td:first").text(); // Assuming Job ID is in the first column

            // Fetch job details for jobs in progress
            $.ajax({
                url: './ajax_progress/fetch_jobsinprogress_details.php',
                type: 'POST',
                data: {
                    jobId: jobId
                },
                success: function(data) {
                    console.log(data);
                    var jobDetails = JSON.parse(data);
                    fetchArtistContactNumber(jobDetails.assigned_artist);

                    var jobMessage = "Imprint Customs SMS Notification" + 
                    " sent by:" + sessionUsername + 
                    " Requesting update on Job ID: " + jobDetails.job_id + " - " + jobDetails.job_subject + " Please provide an update on the progress. Thank you.";
                    // Update the dropdown option with the new message
                    $("#presetMessage").empty(); // Clear existing options if needed
                    $("#presetMessage").append($('<option>', {
                        value: jobMessage,
                        text: jobMessage
                    }));

                    $("#artistName").text(jobDetails.assigned_artist);

                    var detailsHtml = '<div class="job-order-details">' +
                        '<p><strong>Job ID:</strong> ' + jobDetails.job_id + '</p>' +
                        '<p><strong>Job Agent:</strong> ' + jobDetails.creator_name + '</p>' +
                        '<p><strong>Job Title:</strong> ' + jobDetails.job_subject + '</p>' +
                        '<p><strong>Artist Assigned:</strong> ' + jobDetails.assigned_artist + '</p>' +
                        '<p><strong>Job Start Date:</strong> ' + jobDetails.jobstart_datetime + '</p>' +
                        '<p><strong>Job Deadline:</strong> ' + jobDetails.deadline + '</p>' +
                        // Include additional details fetched
                        '</div>';
                    $("#jobDetails").html(detailsHtml);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching job details: " + error);
                }
            });

            // Fetch reference images for jobs in progress
            $.ajax({
                url: './ajax_progress/fetch_jobsinprogressreference_images.php',
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
                !$(e.target).closest('.overlay-content').length &&
                !$(e.target).hasClass('gallery-image')) {
                // Minimize any enlarged image
                $('.gallery-image').removeClass('enlarged');
                // Hide the popup overlay
                $("#jobDetailsPopup").hide();
            }
        }); //end of document click

    }); // End of document ready



    let jobsProgressChartInstance = null; // Hold the chart instance globally
    const ctx = document.getElementById('jobsProgressChart').getContext('2d');

    async function fetchJobsInProgress() {
        console.log('Starting to fetch jobs data');
        try {
            const response = await fetch('./ajax_progress/jobsprogress_chart.php');
            const jobsData = await response.json();

            if (jobsData.error) {
                console.error(jobsData.error);
                return;
            }

            console.log('Fetched jobs data:', jobsData);
            renderChart(jobsData);
        } catch (error) {
            console.error('Error fetching jobs in progress:', error);
        }
    }

    function renderChart(jobsData) {
        console.log('Rendering chart with data:', jobsData);
        // Destroy the existing chart instance if it exists
        if (jobsProgressChartInstance) {
            jobsProgressChartInstance.destroy();
        }

        jobsProgressChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: jobsData.map(job => job.date),
                datasets: [{
                    label: 'Number of Jobs in Progress',
                    data: jobsData.map(job => parseInt(job.count)),
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Jobs',
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        type: 'time',
                        time: {
                            parser: 'yyyy-MM-dd',
                            unit: 'day',
                            displayFormats: {
                                day: 'yyyy-MM-dd'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Date',
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            autoSkip: true,
                            maxTicksLimit: 20
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
            }
        });
    }

    window.onload = function() {
        fetchJobsInProgress();
        switchView(sessionStorage.getItem('currentView') || 'table');
    };

    function showChart() {
        document.getElementById('chartView').style.display = 'flex';
    }

    document.getElementById('tableViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'table');
        switchView('table');
    });

    document.getElementById('chartViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'chart');
        switchView('chart');
    });

    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'flex';
            document.getElementById('chartView').style.display = 'none';
            // Optionally, destroy the chart when switching away from the chart view
            if (jobsProgressChartInstance) {
                jobsProgressChartInstance.destroy();
                jobsProgressChartInstance = null;
            }
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'flex';
            showChart();
            // Refetch and render the chart data when switching back to chart view
            fetchJobsInProgress();
        }
    }

    document.querySelectorAll('.page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var currentView = sessionStorage.getItem('currentView') || 'table';
            window.location.href = this.href + '&view=' + currentView;
        });
    });

    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        var filter = searchInput.value.toUpperCase();
        var rows = document.getElementById('tableView').getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            var td = rows[i].getElementsByTagName('td')[0];
            if (td) {
                if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }); // End of searchInput event listener

    function fetchJobsData(timeFrame) {
        fetch(`./ajax_progress/jobsprogress_chart.php?timeFrame=${timeFrame}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderChart(data);
            })
            .catch(error => console.error('Error fetching job data:', error));
    } // End of fetchJobsData function

    function fetchArtistContactNumber(artistName) {
        $.ajax({
            url: './sms_getartistcontact.php', // Path to your PHP script
            type: 'POST',
            dataType: 'json', // Expecting a JSON response
            data: {
                artistName: artistName
            },
            success: function(response) {
                console.log("Fetched artist contact number:", response);
                // Assuming the response contains the contact number in a property named 'contactNumber'
                $("#phoneNumber").text(response.contactNumber);
                $("#phoneNumber").val(response.contactNumber);
                // Update the input field
            },
            error: function(xhr, status, error) {
                console.error("Error fetching artist contact number: " + error);
            }
        });
    } // End of fetchArtistContactNumber function
</script>


</html>
<?php ob_end_flush(); ?>