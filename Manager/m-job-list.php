<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="chart.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest"></script>
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
        border-bottom: 1px solid #525252;
    }

    .table_container tr:nth-of-type(even) {
        background-color: #cfcfcf;
    }

    .table_container tr:last-of-type {
        border-bottom: 4px solid #dbaf00;
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_jobs";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $current_page = basename($_SERVER['PHP_SELF']);


            ?>

            <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="chartViewBtn">Chart View</button>
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

        // Retrieve data from the database
        $sql = "SELECT job_id, 
        creator_name, 
        time_created, 
        job_status, 
        assigned_artist, 
        job_subject, 
        job_brief, 
        assigning_method, 
        template_method, 
        template_id, 
        job_tracking_method, 
        manual_deadline_date, 
        manual_deadline_time, 
        deadline_futureDateTime, 
        jobstart_datetime 
        FROM tbl_jobs WHERE job_status = 'pending' OR job_status = 'open' LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);

        ?>
        <div class="table_container" id="tableView">
            <!-- Display the table -->
            <table>
                <tr>
                    <th>Job ID</th>
                    <th>Creator Name</th>
                    <th>Time Created</th>
                    <th>Description</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['creator_name']; ?></td>
                        <td><?php echo $row['time_created']; ?></td>
                        <td><?php echo $row['job_brief']; ?></td>
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
    // Include Chart.js library
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
            const response = await fetch('joblist_chart.php');
            const jobData = await response.json();

            const data = {
                open: jobData.find(job => job.job_status === 'open')?.count || 0,
                pending: jobData.find(job => job.job_status === 'pending')?.count || 0
            };

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
            document.getElementById('tableView').style.display = 'block';
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

    document.getElementById('chartViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'chart');
        switchView('chart');
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
        fetch(`joblist_chart.php?timeFrame=${timeFrame}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderChart(data); // Update the chart with fetched data
            })
            .catch(error => console.error('Error fetching job data:', error));
    }
</script>


</html>
<?php ob_end_flush(); ?>