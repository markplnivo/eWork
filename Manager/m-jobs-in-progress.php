<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="chart.css">
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@^3"></script>
    <script src="https://cdn.jsdelivr.net/npm/date-fns"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
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

    .chart_container {
        overflow-x: auto;
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
        $sql = "SELECT job_id, creator_name, assigned_artist FROM tbl_jobs where job_status = 'In Progress' LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);


        ?>
        <div class="table_container" id="tableView">
            <table>
                <tr>
                    <th>Job ID</th>
                    <th>Creator Name</th>
                    <th>Artist Assigned</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['creator_name']; ?></td>
                        <td><?php echo $row['assigned_artist']; ?></td>
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

<script type="text/javascript">
    const ctx = document.getElementById('jobsProgressChart').getContext('2d');

    // Fetch job data from the server

    async function fetchJobsInProgress() {
        console.log('Starting to fetch jobs data'); // Expected output: "Starting to fetch jobs data"

        try {
            const response = await fetch('jobsprogress_chart.php');
            const jobsData = await response.json();

            if (jobsData.error) {
                console.error(jobsData.error);
                return;
            }

            console.log('Fetched jobs data:', jobsData); // Expected output: The fetched data array or an error object

            // Prepare data for charting
            renderChart(jobsData);
        } catch (error) {
            console.error('Error fetching jobs in progress:', error);
        }
    }

    function renderChart(jobsData) {
        console.log('Rendering chart with data:', jobsData); // Expected output: The data array used to render the chart

        new Chart(ctx, {
            type: 'line', // Change to 'line' type for an area chart
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
                            parser: 'yyyy-MM-dd', // specify the correct parser for your datetime format
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

    
    // Switch between table and chart view
    window.onload = function() {
        fetchJobsInProgress(); // Fetch and render the chart as part of window load
        // Other onload logic here
        switchView(sessionStorage.getItem('currentView') || 'table');
    }; // end of window.onload

    // Show the chart view
    function showChart() {
        console.log('Showing chart view'); // Expected output: "Showing chart view" when the function is triggered

        document.getElementById('chartView').style.display = 'flex';
    } // end of showChart


    // Switch between table and chart view
    document.getElementById('tableViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'table');
        switchView('table');
    });

    document.getElementById('chartViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'chart');
        switchView('chart');
        showChart();
    });

    function switchView(view) {
        console.log('Switching view to:', view); // Expected output: "Switching view to: chart" or "table"

        if (view === 'table') {
            document.getElementById('tableView').style.display = 'block';
            document.getElementById('chartView').style.display = 'none';
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'flex';
            showChart();
        }
    } // end of switchView

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
            var td = rows[i].getElementsByTagName('td')[0]; // Search by Job ID
            if (td) {
                if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }); // end of searchInput

    
    // Fetch job data based on time frame
    function fetchJobsData(timeFrame) {
        fetch(`jobsprogress_chart.php?timeFrame=${timeFrame}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Call renderChart or any function to update the chart with this data
            })
            .catch(error => console.error('Error fetching job data:', error));
    } // end of fetchJobsData
    
</script>

</html>
<?php ob_end_flush(); ?>