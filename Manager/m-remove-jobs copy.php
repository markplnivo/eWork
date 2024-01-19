<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Remove Jobs</title>
</head>
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
			object-position: bottom;
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
			margin-left: 590px;
		}

		 .table_container{
			background-color:#919191;
            grid-area: 3 / 2 / -1 / -1 ;
        }
		.table_container .table_containerTwo form{
			position: absolute;
		}
		.table_container .table_containerTwo table{
			border-collapse: collapse;
			margin-top: 25px;
			margin-left: 90px;
			margin-right: 90px;
			margin-bottom: 10px;
			font-size: 0.9em;
			min-width: 70vw;
			min-height: 100px;
			border-radius: 12px 12px 0px 0px;
		}
		.table_container .table_containerTwo thead tr th{
			background-color: #ffc400;
			color: #000000;
			text-align: left;
			font-weight: bold;
		}
		.table_container .table_containerTwo tbody td,
		.table_container .table_containerTwo thead th{
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
		.table_container .table_containerTwo .pagination{
			margin-left:600px;
			margin-top: 510px;
			position: relative;
		}
		.table_container .table_containerTwo .pagination a{
			color: black;
			font-weight: bold;
		}
		.table_container .table_containerTwo form input[type="submit"]{
			margin-left: 150px;
			color: #000000;
			background: #fcba03;
			padding: 4px 20px;
			border-radius: 10px;
		}
		.table_container .table_containerTwo form input[name="remove_selected"]{
			font-size: 12px;
			font-weight: bold;
			font-family: Arial, Helvetica, sans-serif;
		}


</style>
<body>
<div class="main">
<div class="header1">
   <h1>DASHBOARD</h1>
   <img src="highway with nature.jpg" class="bannerlogo">
</div>
<div class="header2">
     <h2>Remove Jobs</h2>
</div>
<?php 
include "manager_menu.php";

	
// Pagination settings
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting point for the current page
$offset = ($currentPage - 1) * $itemsPerPage;

// Retrieve data from the database
$sql = "SELECT * FROM tbl_jobs LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

// Total number of records
$totalRecords = $conn->query("SELECT COUNT(*) as total FROM tbl_jobs")->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $itemsPerPage);
?>
<div class="table_container">
<div class="table_containerTwo">
<form method="post" action="m-remove-jobs.php">
    <table id="removeJobTable">
        <thead>
            <tr>
                <th></th> <!-- Checkbox column -->
                <th>JOB_ID</th>
                <th>CREATOR_NAME</th>
                <th>TIME_CREATED</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row['job_id']; ?>"></td>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['creator_name']; ?></td>
                    <td><?php echo $row['time_created']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <input type="submit" name="remove_selected" value="Remove Selected" id="RemoveButton">
</form>


	<?php
	if (isset($_POST['remove_selected'])) {
    // Check if any rows were selected for removal
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Prepare the SQL statement to insert the record into the new table
        $insertSql = "INSERT INTO tbl_recyclebin SELECT * FROM tbl_jobs WHERE JOB_ID = ?";

        // Prepare the SQL statement to delete the record from the old table
        $deleteSql = "DELETE FROM tbl_jobs WHERE JOB_ID = ?";

        // Create a prepared statement
        if ($stmt = $conn->prepare($insertSql)) {
            // Assuming $conn is your database connection and $jobId is the ID of the job you want to move
            $stmt->bind_param("i", $jobId); // "i" indicates that the parameter is an integer
            $stmt->execute();

            // Iterate over the selected rows and delete each one
            foreach ($_POST['selected_rows'] as $jobId) {
                // Execute the statement for each selected job ID
                $stmt->execute();
            }

            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("i", $jobId);
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();

            // Redirect or display a success message
            // You may want to redirect the user to a different page or display a success message.
            // For example: header("Location: success.php");
        } else {
            // Handle any errors with the prepared statement
            echo "Error: " . $conn->error;
        }
    }
}
?>


    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</div>
</div>	
</div>
</body>
</html>
