<!DOCTYPE html>
<html>
<?php include "superadmin_menu.php"?>
	
<head>
    <title>Superadmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: auto;
            display: flex;
            background-position: right; /* Linear gradient background */
            color: #FFFFFF;
            background-color: #000000;
            display: grid;
            grid-template-rows: 10vh 1fr 10vh;
            grid-template-columns: .5fr 2fr .5fr; /* Added grid columns */
            height:100%;
        }

        header {
        background-image: url("images/artist_home_header.jpg");
        background-repeat: no-repeat;
        background-color: #333;
        color: #fff;
        font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
        padding: 10px;
        text-align: center;
        grid-row: 1 / 2;
        grid-column: span 3;
        /* Header spans both columns */
        }

        #maintable {
            margin-top:100px;
            margin-left:200px;
            grid-area: 2 / 2 / 3 / 3;
            height:25vh;
            width:60vw;
            place-self: start center;
        }
        
        table{
            border-collapse: collapse;
            width: 80%;
            color: white;
            font-family: monospace;
            font-size: 1.2rem;
            text-align: center;
            border: 3px solid #FFFFFF;
        }

    </style>
</head>
<body>

<header>
        <h1>A D M I N</h1>
</header>

<?php
$limit = 5; // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.  
if (isset($_GET["page"])) {  
  $pn  = $_GET["page"];  
}  
else {  
  $pn=1;  
};  

$start_from = ($pn-1) * $limit;  

$sql = "SELECT firstname, lastname, job_description, email, contact_number, request_time FROM tbl_account_request LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  
?>  

<div id="maintable">
<form method="post" action="superadmin_hope.php">
<table>
    <tr>
        <th>Select</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Job Description</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Request Time</th>
    </tr>
    <?php  
    while ($row = mysqli_fetch_assoc($rs_result)) {  
    ?>  
                <tr>
                <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                <td><?php echo $row["firstname"]; ?></td>
                <td><?php echo $row["lastname"]; ?></td>
                <td><?php echo $row["job_description"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["contact_number"]; ?></td>
                <td><?php echo $row["request_time"]; ?></td>
                </tr>  
    <?php  
    };  
    ?>  
</table>
<input type="submit" name="add_selected" value="Add Selected">
</form>
</div>

<?php  
if (isset($_POST['add_selected'])) {
    // Check if any rows were selected for addition
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Prepare the SQL statement to insert the record into the new table
        $insertSql = "INSERT INTO tbl_userlist (username, password, job_position) VALUES (?)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($insertSql)) {
            $stmt->bind_param("s", $email);

            // Iterate over the selected rows and add each one
            foreach ($_POST['selected_rows'] as $email) {
                // Execute the statement for each selected email
                $stmt->execute();
            }

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

<?php  
$sql = "SELECT COUNT(*) FROM tbl_account_request";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<div class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= "<a href='superadmin_home.php?page=".$i."'>".$i."</a>";  
};  
echo $pagLink . "</div>";  
?>

</body>
</html>
