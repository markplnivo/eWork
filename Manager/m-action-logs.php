<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="m-table.css">
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
</style>

<body>
    <div class="main">


        <?php
        include "manager_menu.php";
        include "../logindbase.php";
        ?>

        <h1 class="main-title">Action Logs</h1>
        <div class="header-banner">
            <img src="bike and helmet.jpg" class="banner-logo">
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
            $sql = "SELECT COUNT(*) AS total FROM tbl_actionlogs";
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
        $sql = "SELECT action, user_id, username, time, subject_id, subject_type, details, ip_address FROM tbl_actionlogs LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);
        ?>

        <div class="table_container" id="tableView">
            <!-- Display the table -->
            <table>
                <tr>
                    <th>Action</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Time</th>
                    <th>Subject</th>
                    <th>Subject Type</th>
                    <th>Subject Details</th>
                    <th>IP Address</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['action'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['subject_id'] . "</td>";
                    echo "<td>" . $row['subject_type'] . "</td>";
                    echo "<td>" . $row['details'] . "</td>";
                    echo "<td>" . $row['ip_address'] . "</td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>

<script type="text/javascript">
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
</script>

</html>