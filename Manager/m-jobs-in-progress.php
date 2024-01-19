<!DOCTYPE html>
<html lang="en">

<head>
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
        margin-right:5%;
    }

    .pagination-container a, label{
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
                <button id="cardViewBtn">Card View</button>
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


        echo '<div class="table_container" id="tableView">';
        // Display the table
        echo "<table>";
        echo "<tr><th>Job ID</th><th>Creator Name</th><th>Artist Assigned</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['job_id'] . "</td>";
            echo "<td>" . $row['creator_name'] . "</td>";
            echo "<td>" . $row['assigned_artist'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';

        echo '<div class="card_container" id="cardView" style="display: none;">';
        foreach ($result as $row) {
            echo "<div class='card' style='width: 250px; height: 250px;'>";
            echo "<p>Job ID: " . $row['job_id'] . "</p>";
            echo "<p>Creator Name: " . $row['creator_name'] . "</p>";
            echo "<p>Assigned Artist: " . $row['assigned_artist'] . "</p>";
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
</body>

<script>
    document.getElementById('tableViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'table');
        switchView('table');
    });

    document.getElementById('cardViewBtn').addEventListener('click', function() {
        sessionStorage.setItem('currentView', 'card');
        switchView('card');
    });

    function switchView(view) {
        if (view === 'table') {
            document.getElementById('tableView').style.display = 'block';
            document.getElementById('cardView').style.display = 'none';
        } else {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('cardView').style.display = 'block';
        }
    }

    document.querySelectorAll('.page-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var currentView = sessionStorage.getItem('currentView') || 'table';
            window.location.href = this.href + '&view=' + currentView;
        });
    });

    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);
        var view = urlParams.get('view') || sessionStorage.getItem('currentView') || 'table';
        switchView(view);
    };

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
    });
</script>

</html>