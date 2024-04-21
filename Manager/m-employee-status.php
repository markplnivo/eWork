<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="m-popup.css">
    <link rel="stylesheet" href="m-chart.css">
    <link rel="stylesheet" href="m-table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<meta charset="UTF-8">
<title>Team Status</title>
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

    .status-offline:hover {
        background-image: linear-gradient(to left, #b0c4de 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-offline {
        background-image: linear-gradient(to left, #b0c4de 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;

    }

    .status-online:hover {
        background-image: linear-gradient(to left, #00ff00 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-online {
        background-image: linear-gradient(to left, #00ff00 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-on-break:hover {
        background-image: linear-gradient(to left, #ffcc00 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-on-break {
        background-image: linear-gradient(to left, #ffcc00 10%, #cfcfcf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-busy:hover {
        background-image: linear-gradient(to left, #ff0000 10%, #bfbfbf 50%);
        background-position: -100%;
        background-size: 200%;
        animation: swipeGradient 0.5s linear forwards;
    }

    .status-busy {
        background-image: linear-gradient(to left, #ff0000 10%, #cfcfcf 50%);
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
        ?>

        <h1 class="main-title">Employee Status</h1>
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_artist_status";
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


        // Execute the SQL query

        // Retrieve data from the database
        $sql =
            "SELECT 
        username, 
        job_position,
        status_starttime,
        CASE 
            WHEN job_position = 'Artist' AND status = 'offline' THEN 'offline'
            WHEN job_position = 'Artist' AND status = 'online' THEN (SELECT artist_status FROM tbl_artist_status WHERE artist_name = username)
            WHEN job_position = 'Artist' THEN 'offline'
            WHEN status = 'on_break' THEN 'On Break'
            ELSE status 
        END AS employee_status
        FROM tbl_user_status
        LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);
        ?>

        <div class="table_container" id="tableView">
            <table>
                <tr class="infoRow">
                    <th style="background-color: slategray; text-align: left;" colspan="7">
                        <div style="display: inline-block; width: 10px; height: 10px; background-color: #b0c4de; border-radius: 50%; margin-right: 5px;"></div>: Offline
                        <div style="display: inline-block; width: 10px; height: 10px; background-color: #00ff00; border-radius: 50%; margin-right: 5px;"></div>: Online
                        <div style="display: inline-block; width: 10px; height: 10px; background-color: #ffcc00; border-radius: 50%; margin-right: 5px;"></div>: On Break
                        <div style="display: inline-block; width: 10px; height: 10px; background-color: #ff0000; border-radius: 50%; margin-right: 5px;"></div>: Busy
                    </th>
                </tr>
                <tr>
                    <th>Username</th>
                    <th>Job Position</th>
                    <th>Status Start Time</th>
                    <th>Employee Status</th> <!-- Updated to show computed employee_status -->
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <?php
                    $statusClass = '';
                    switch ($row['employee_status']) {
                        case 'offline':
                            $statusClass = 'status-offline';
                            break;
                        case 'online':
                            $statusClass = 'status-online';
                            break;
                        case 'on_break':
                            $statusClass = 'status-on_break';
                            break;
                        case 'busy':
                            $statusClass = 'status-busy';
                            break;
                    }
                    ?>
                    <tr class="<?php echo $statusClass; ?>">
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_position']); ?></td>
                        <td>
                            <?php
                            if (!empty($row['status_starttime'])) {
                                $formattedTime = (new DateTime($row['status_starttime']))->format('M d Y g:i A');
                                switch ($row['employee_status']) {
                                    case 'offline':
                                        echo "Last seen: " . $formattedTime;
                                        break;
                                    case 'online':
                                        echo "Online since: " . $formattedTime;
                                        break;
                                    case 'on_break':
                                        echo "On break at: " . $formattedTime;
                                        break;
                                    case 'busy':
                                        echo "Busy since: " . $formattedTime;
                                        break;
                                    default:
                                        echo $formattedTime; // Default case if none of the above
                                }
                            } else {
                                echo 'No logins yet.';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['employee_status']); ?></td> <!-- Display computed employee_status -->
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>


        <div class="chart_container" id="chartView" style="display: none;">
            <div class="canvasContainer">
                <canvas id="employeeStatusChart"></canvas>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

<script>
    let employeeStatusChart = null; // Holds chart instance
    const ctx = document.getElementById('employeeStatusChart').getContext('2d');

    // Render chart
    function renderChart(data) {
        if (employeeStatusChart) {
            employeeStatusChart.destroy();
        } // Destroy the previous chart instance
        window.employeeStatusChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Employee Status',
                    data: data.data,
                    backgroundColor: data.colors,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {

                }
            }
        });
    }


    async function fetchemployeeStatusData() {
        try {
            const response = await fetch('./ajax_employeestatus/employee_status_data.php'); // Adjust the path
            const employeeStatusData = await response.json();

            // Adjusted to match the new data structure
            const data = {
                labels: employeeStatusData.map(item => item.employee_status),
                data: employeeStatusData.map(item => parseInt(item.status_count)),
                colors: [] // Update or dynamically generate colors as needed
            };
            console.log(data.labels, data.data);
            // Example dynamic color assignment (simple)
            data.colors = data.labels.map(label => {
                switch (label) {
                    case 'busy':
                        return '#FF6384';
                    case 'online':
                        return '#36A2EB';
                    case 'offline':
                        return '#4BC0C0';
                    case 'on_break':
                        return '#FFCE56';
                    case 'open':
                        return '#E7E9ED';
                    default:
                        return '#cccccc'; // Fallback color
                }
            });

            renderChart(data);
        } catch (error) {
            console.error('Error fetching employee status data:', error);
        }
    }

    window.onload = function() {
        fetchemployeeStatusData();
        switchView(sessionStorage.getItem('currentView') || 'table');
    };

    function showChart() {
        document.getElementById('chartView').style.display = 'flex';
    }

    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'flex';
            document.getElementById('chartView').style.display = 'none';
            if (employeeStatusChart) {
                employeeStatusChart.destroy();
                employeeStatusChart = null;
            }
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'flex';
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
            var td = rows[i].getElementsByTagName('td')[1]; // Assuming you want to search by the 'Artist Name' column
            if (td) {
                if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });

    function fetchJobsData(timeframe) {
        fetch(`./ajax_employeestatus/employee_status_data.php?timeframe=${timeframe}`)
            .then(response => response.json())
            .then(data => {
                renderChart(data);
            })
            .catch(error => {
                console.error('Error fetching artist status data:', error);
            });
    }
</script>

</html>
<?php ob_end_flush(); ?>