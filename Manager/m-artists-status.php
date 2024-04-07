<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="chart.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <h1 class="main-title">Artists' Status</h1>
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
        $userid = $_SESSION['username'];
        $query = "SELECT user_id FROM tbl_userlist WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $artist_id = $row['user_id'];

        $insertQuery = "INSERT IGNORE INTO tbl_artist_status (artist_name, artist_status, artist_id)
               SELECT username, 'default_status', ? FROM tbl_userlist where job_position = 'Artist'";

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('i', $artist_id);
        $stmt->execute();


        // Retrieve data from the database
        $sql = "SELECT artist_name, artist_status, artist_id FROM tbl_artist_status LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);
        ?>

        <div class="table_container" id="tableView">
            <table>
                <tr>
                    <th>Artist ID</th>
                    <th>Artist Name</th>
                    <th>Status</th>
                    <th>Job Percentage</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['artist_id']; ?></td>
                        <td><?php echo $row['artist_name']; ?></td>
                        <td><?php echo $row['artist_status']; ?></td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="chart_container" id="chartView" style="display: none;">
            <div class="canvasContainer">
                <canvas id="artistStatusChart"></canvas>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

<script>
    let artistStatusChart = null; // Holds chart instance
    const ctx = document.getElementById('artistStatusChart').getContext('2d');

    // Render chart
    function renderChart(data) {
        if (artistStatusChart) {
            artistStatusChart.destroy();
        } // Destroy the previous chart instance

        window.artistStatusChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Artist Status',
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


    async function fetchArtistStatusData() {
        try {
            const response = await fetch('artist_status_data.php'); // Adjust the path
            const artistStatusData = await response.json();

            const data = {
                labels: artistStatusData.map(item => item.artist_status),
                data: artistStatusData.map(item => parseInt(item.artist_status_count)),
                colors: ['#FF6384', '#36A2EB', '#FFCE56'] // Example colors for 'busy', 'open', 'on_break'
            };

            renderChart(data);
        } catch (error) {
            console.error('Error fetching artist status data:', error);
        }
    }

    window.onload = function() {
        fetchArtistStatusData();
        switchView(sessionStorage.getItem('currentView') || 'table');
    };

    function showChart() {
        document.getElementById('chartView').style.display = 'flex';
    }

    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'block';
            document.getElementById('chartView').style.display = 'none';

            if (artistStatusChart) {
                artistStatusChart.destroy();
                artistStatusChart = null;
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
        fetch(`artist_status_data.php?timeframe=${timeframe}`)
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