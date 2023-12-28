<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job History</title>
    <style>
        *, body, html{
            overflow: hidden;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
           
        }
        .main{
            height: 100vh;
            display: grid;
            grid-template-rows: 180px 50px 1fr;
            grid-template-columns: 210px 1fr;
            
        }
        .header1{
            background-color: hsla(0, 0%, 0%, 0.425);
            grid-area: 1 / 2 / -4 / 3 ;
        }
        .header1 .bannerlogo{
            width: 1400px;
            height: 275px;
            position: relative;
            object-fit: cover;
            z-index: -1;
        }
        h1{
            font-family: 'Oswald', sans-serif;
            color: hsla(0, 0%, 100%, 0.74);
            position: absolute;
            z-index: 1;
            margin-top: 27px;
            margin-left: 500px;
            font-size: 10vmin;
            -webkit-text-stroke: 4px black;
            letter-spacing: calc(1em / 9);
        }
        .header2{
            background-color: #292929; 
            grid-area: 3 / 2 / -3 / -2;
			border-top-style: solid;
			border-bottom-style: solid;

        }
		.header2 h2{
			color: #ffffff;
			-webkit-text-stroke: 2px black;
			letter-spacing: calc(4em / 15);
			font-weight: bold;
			font-size: 30px;
			margin-top: 2.5px;
			margin-left: 610px;
		}

		 .table_container{
			background-color:#919191;
            grid-area: 3 / 2 / -1 / -1 ;
        }
		.table_container .table_containerTwo table{
			border-collapse: collapse;
			margin: 25px 90px;
			font-size: 0.9em;
			min-width: 70vw;
			min-height: 100px;
			border-radius: 12px 12px 0px 0px;
		}
		.table_container .table_containerTwo tbody tr th{
			background-color: #ffc400;
			color: #000000;
			text-align: left;
			font-weight: bold;
		}
		.table_container .table_containerTwo tbody td,
		.table_container .table_containerTwo tbody th{
			padding: 12px 25px;
		}
		.table_container .table_containerTwo tbody tr{
			border-bottom: 1px solid #525252;
		}
		.table_container .table_containerTwo tbody tr:nth-of-type(even){
			background-color: #cfcfcf;
		}
		.table_container .table_containerTwo tbody tr:last-of-type{
			border-bottom: 4px solid #dbaf00;
		}
		.table_container .pagination{
			margin-left:600px;
			margin-top: 105px;
			position: fixed;
		}
		.table_container .pagination a{
			color: black;
			font-weight: bold;
		}
    </style>
</head>
<body>
<div class="main">

<?php 
include "manager_menu.php";
include "../logindbase.php";


$header_one = "DASHBOARD";
$imageSource = "sunrise ride_ss.jpg";
$header_two = "Job History";

echo "<div class='header1'>";
echo "<h1>" .$header_one. "</h1>";
echo '<img src="'.$imageSource.'" class="bannerlogo">';
echo "</div>";
echo "<div class='header2'>";
echo "<h2>" .$header_two."</h2>";
echo "</div>";
echo "<div class='table_container'>";
echo "<div class='table_containerTwo'>";
// Pagination
$results_per_page = 10;
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start_from = ($page - 1) * $results_per_page;

// Retrieve data from the database
$sql = "SELECT job_id, creator_name, assigned_artist, job_brief FROM tbl_jobs where job_status = 'completed' LIMIT $start_from, $results_per_page";
$result = $conn->query($sql);

// Display the table
echo "<table>";
echo "<tr><th>Job ID</th><th>Creator Name</th><th>Artist Assigned</th><th>Description</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['job_id'] . "</td>";
    echo "<td>" . $row['creator_name'] . "</td>";
    echo "<td>" . $row['assigned_artist'] . "</td>";
	echo "<td>" . $row['job_brief'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Pagination links
$sql = "SELECT COUNT(*) AS total FROM tbl_jobs where job_status ='completed'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row['total'] / $results_per_page);

$current_page = basename($_SERVER['PHP_SELF']);
	
echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='$current_page?page=" . $i . "'>" . $i . "</a> ";
}
echo "</div>";

// Close the database connection
$conn->close();
echo "</div>";
echo "</div>";
?>
</div>
</body>
</html>
