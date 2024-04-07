<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="m-popup.css">
    <link rel="stylesheet" href="m-chart.css">
    <link rel="stylesheet" href="m-table.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/date-fns"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
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
</style>

<body>
    <div class="main">


        <?php
        include "manager_menu.php";
        include "../logindbase.php";
        ?>

        <h1 class="main-title">Jobs Completed</h1>
        <div class="header-banner">
            <img src="sunrise ride_ss.jpg" class="banner-logo">
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs where job_status ='completed'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);

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




            <?php
            // Initialize variables
            $results_per_page = 15;
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $start_from = ($page - 1) * $results_per_page;
            $current_page = basename($_SERVER['PHP_SELF']);
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'job_id'; // Default sort column
            $sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'DESC' : 'ASC'; // Default sort order
            $searchTermSql = "%" . $conn->real_escape_string($searchTerm) . "%";

            // Adjust the COUNT query to include search term
            $sqlCount = "SELECT COUNT(*) AS total 
             FROM tbl_jobs 
             WHERE job_status = 'completed' 
             AND (creator_name LIKE ? OR assigned_artist LIKE ? OR job_brief LIKE ?)";

            $stmtCount = $conn->prepare($sqlCount);
            $stmtCount->bind_param('sss', $searchTermSql, $searchTermSql, $searchTermSql);
            $stmtCount->execute();
            $resultCount = $stmtCount->get_result();
            $rowCount = $resultCount->fetch_assoc();
            $total_pages = ceil($rowCount['total'] / $results_per_page);

            // Fetch filtered and paginated data
            $sql = "SELECT job_id, creator_name, assigned_artist, job_brief, jobstart_datetime, jobend_datetime 
                FROM tbl_jobs 
                WHERE job_status = 'completed' 
                AND (creator_name LIKE ? OR assigned_artist LIKE ? OR job_brief LIKE ?)
                ORDER BY $sortBy $sortOrder 
                LIMIT $start_from, $results_per_page";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $searchTermSql, $searchTermSql, $searchTermSql);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>

            <div class="pagination-container">
                <!-- Pagination Links -->
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='$current_page?page=$i&sort_by=$sortBy&sort_order=$sortOrder&search=$searchTerm'>" . $i . "</a> ";
                }
                ?>
                <input type='text' id='searchInput' placeholder='Search for names...' value="<?php echo htmlspecialchars($searchTerm); ?>">
            </div>

        </div>


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
                    <th onclick="sortTable('creator_name')">Creator Name</th>
                    <th onclick="sortTable('assigned_artist')">Artist Assigned</th>
                    <th onclick="sortTable('job_brief')">Description</th>
                    <th onclick="sortTable('jobstart_datetime')">Job Start Date</th>
                    <th onclick="sortTable('jobend_datetime')">Job End Date</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['creator_name']; ?></td>
                        <td><?php echo $row['assigned_artist']; ?></td>
                        <td><?php echo $row['job_brief']; ?></td>
                        <td><?php echo date('M d, h:i A', strtotime($row['jobstart_datetime'])); ?></td>
                        <td><?php echo date('M d, h:i A', strtotime($row['jobend_datetime'])); ?></td>
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
                <canvas id="jobHistoryChart"></canvas>
            </div>
        </div>

        <?php $conn->close(); ?>
    </div>
</body>

<script>
    // Job details popup
    $(document).ready(function() {
        $("#tableView table tbody tr").click(function() {
            if ($(this).hasClass('infoRow')) {
                return false; // Prevent popup overlay for info row
            }
            var jobId = $(this).find("td:first").text(); // Assuming Job ID is in the first column
            // Fetch job details for completed jobs
            $.ajax({
                url: 'fetch_completed_job_details.php',
                type: 'POST',
                data: {
                    jobId: jobId
                },
                success: function(data) {
                    var jobDetails = JSON.parse(data);
                    var detailsHtml = '<div class="job-order-details">' +
                        '<p><strong>Job ID:</strong> ' + jobDetails.job_id + '</p>' +
                        '<p><strong>Creator Name:</strong> ' + jobDetails.creator_name + '</p>' +
                        '<p><strong>Job Start Date:</strong> ' + jobDetails.jobstart_datetime + '</p>' +
                        '<p><strong>Job End Date:</strong> ' + jobDetails.jobend_datetime + '</p>' +
                        '<p><strong>Description:</strong> ' + jobDetails.job_brief + '</p>' +
                        '</div>';
                    $("#jobDetails").html(detailsHtml);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching job details: " + error);
                }
            });

            // Fetch reference images for completed jobs
            $.ajax({
                url: 'fetch_completed_job_images.php',
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

        // Click event to enlarge the image


    }); //end of document ready


    let jobHistoryChart = null; // This will hold the chart instance
    const ctx = document.getElementById('jobHistoryChart').getContext('2d');

    // Render the chart using Chart.js
    function renderChart(data) {
        // If an instance of the chart already exists, destroy it
        if (jobHistoryChart) {
            jobHistoryChart.destroy();
        }

        // Create a new chart instance
        jobHistoryChart = new Chart(ctx, {
            type: 'line', // Assuming a line chart for job history
            data: {
                labels: data.map(item => item.jobDate),
                datasets: [{
                    label: 'Completed Jobs',
                    data: data.map(item => parseInt(item.jobCount)),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            tooltipFormat: 'PPP',
                            color: '#000',
                            font: {
                                size: 16,
                                weight: 'bold'
                            } // Formatting date for tooltip
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
                            }
                        }
                    },
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
                            },
                            // Enforce integer values
                            stepSize: 1,
                            precision: 0
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

    // Asynchronously fetch job data
    async function fetchJobHistoryData() {
        try {
            const response = await fetch('jobhistory_chart.php');
            const jobData = await response.json();
            renderChart(jobData); // Use the renderChart function to display fetched data
            console.log(jobData);
            console.log('Job data fetched successfully');
        } catch (error) {
            console.error('Error fetching job history data:', error);
        }
    }

    window.onload = function() {
        fetchJobHistoryData(); // Fetch initial job data on page load
        switchView(sessionStorage.getItem('currentView') || 'table');
    };

    // Show the chart view
    function showChart() {
        document.getElementById('chartView').style.display = 'flex';
    } // end of showChart

    // Switch between table and chart view
    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'flex';
            document.getElementById('chartView').style.display = 'none';
            // Destroy the chart instance when switching to table view
            if (jobHistoryChart) {
                jobHistoryChart.destroy();
                jobHistoryChart = null; // Reset the reference
            }
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'flex';
            fetchJobHistoryData();
        }
    }

    document.getElementById('tableViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'table');
        switchView('table');
    });

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
    searchInput.addEventListener('input', function() { // Use 'input' event for real-time search
        var filter = searchInput.value.toUpperCase();
        var rows = document.getElementById('tableView').getElementsByTagName('tr');

        // Start loop at 1 to skip the header row
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName('td');
            var textContent = Array.from(cells).map(cell => cell.textContent.toUpperCase()).join(' '); // Concatenate all cell text
            row.style.display = textContent.indexOf(filter) > -1 ? '' : 'none';
        }
    }); // End of search functionality



    // timeframe buttons for fetching data
    function fetchJobsData(timeFrame) {
        fetch(`jobhistory_chart.php?timeFrame=${timeFrame}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderChart(data); // Update the chart with fetched data
            })
            .catch(error => console.error('Error fetching job data:', error));
    } //end of fetchJobsData

    // Sort table by column name
    function sortTable(columnName) {
        // Assuming you have a way to keep track of the current sort direction for each column
        let currentSort = sessionStorage.getItem(columnName) || 'asc'; // Default to ascending
        let newSort = currentSort === 'asc' ? 'desc' : 'asc';
        sessionStorage.setItem(columnName, newSort); // Save the new sort direction

        // Construct the URL with sort parameters
        let newUrl = `${window.location.pathname}?sort_by=${columnName}&sort_order=${newSort}`;
        window.location.href = newUrl; // Redirect to the new URL
    } //end of sortTable

    // Sort table by time frame
    function sortByTime(timeFrame) {
        // Construct the URL with time frame parameters and redirect
        let newUrl = `${window.location.pathname}?time_frame=${timeFrame}`;
        window.location.href = newUrl;
    } //end of sortByTime
</script>

</html>
<?php ob_end_flush(); ?>