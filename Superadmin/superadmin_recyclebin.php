<!DOCTYPE html>
<html>
<?php include "superadmin_menu.php" ?>
<?php

if (isset($_POST['remove_selected'])) {
    // Check if any rows were selected for removal
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Create a string of placeholders based on the number of selected rows
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));

        // Prepare the SQL statement to delete the records from the original table
        $deleteSql = "DELETE FROM tbl_recyclebin_account_request WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($deleteSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to delete the selected rows from the original table
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();
        }

        $_POST['selected_rows'] = array();
        header("Location: superadmin_recyclebin.php");
        exit(); // Terminate script execution after redirection
    }
}

if (isset($_POST['restore_selected'])) {
    // Check if any rows were selected for restoration
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Create a string of placeholders based on the number of selected rows
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));

        // Prepare the SQL statement to insert the records back into the original table
        $restoreSql = "INSERT INTO tbl_account_request (firstname, lastname, job_description, email, contact_number, user_password, request_time, username) 
            SELECT firstname, lastname, job_description, email, contact_number, user_password, request_time, username
            FROM tbl_recyclebin_account_request 
            WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($restoreSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to restore the selected rows
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();
        }

        // Prepare the SQL statement to delete the rows from the recyclebin table
        $deleteSql = "DELETE FROM tbl_recyclebin_account_request WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($deleteSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to delete the selected rows from the recyclebin table
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();
        }

        $_POST['selected_rows'] = array();
        header("Location: superadmin_recyclebin.php");
        exit(); // Terminate script execution after redirection
    }
}

    ?>


<head>
    <title>Superadmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #919191;
            color: #FFFFFF;
            display: grid;
            grid-template-rows: 10vh 1fr 10vh;
            grid-template-columns: 0.5fr auto 0.5fr;
            height: 100%;
            grid-gap: 50px;
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
            grid-column: 1 / -1;
            width: 100vw;
            height: 100%;
        }

        #maintable {
            display: grid;
            grid-template-columns: auto;
            grid-template-rows: auto auto auto;
            grid-area: 2 / 2 / 3 / 3;
            height: 25vh;
            width: 100%;
            place-self: start center;
            row-gap: 20px;
            min-width: 1000px;
        }

        table {
            grid-area: 2 / 1 / 3 / -1;
            color: white;
            font-family: monospace;
            font-size: 0.9rem;
            text-align: center;
            border: 0px solid #FFFFFF;
            background-color: lightgray;
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            color: black;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ffc400;
            color: #0;
        }

        tr {
            border: 1px solid black;
        }

        .trHover:hover {
            background-color: white;
        }

        #pageNumbers {
            margin-left: auto;
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            width: 100px;
            font-size: 1.2rem;

        }

        #restoreSelect {
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            height: 50px;
            width: 150px;
            place-self: start start;
			background-color: #ffc400;
			border: 0px solid;
			border-radius: 8px;
        }

        #removeSelect {
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            height: 50px;
            width: 120px;
            margin-left: 200px;
			background-color: #ffc400;
			border: 0px solid;
			border-radius: 8px;
        }
		
		#restoreSelect:hover {
			cursor: pointer;
			box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
		}
		
		#removeSelect:hover {
			cursor: pointer;
			box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
		}
		
		#restoreSelect:active {
			margin: 2px 0 0 2px;
			box-shadow: none;
		}
		
		#removeSelect:active {
			margin: 2px 0 0 202px;
			box-shadow: none;
		}

        #searchInput{
            grid-area: 1 / 1 / 1 / 1;
            width:300px;
            height:25px;
            place-self: end;
			border: 0 solid;
			border-radius: 4px;
			background-color: lightyellow;
        }
		
		input[type="checkbox"] {
			cursor: pointer;
			height: 20px;
			width: 20px;
			accent-color: #ffc400;
		}
		
    </style>
</head>
<body>
    <header>
        <h1>Recycle Bin</h1>
    </header>

    <?php
    $limit = 5; // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.  
    if (isset($_GET["page"])) {
        $pn  = $_GET["page"];
    } else {
        $pn = 1;
    };

    $start_from = ($pn - 1) * $limit;

    $sql = "SELECT firstname, lastname, job_description, email, contact_number, request_time, username FROM tbl_recyclebin_account_request ORDER BY request_time DESC LIMIT $start_from, $limit";
    $rs_result = mysqli_query($conn, $sql);
    ?>
    <form method="post" action="superadmin_recyclebin.php">
        <div id="maintable">
        <input type="text" id="searchInput" placeholder="Search for names...">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</tH>
                    <th>Job Description</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Request Time</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($rs_result)) {
                ?>
                    <tr class="trHover">
                        <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["job_description"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["contact_number"]; ?></td>
                        <td><?php echo date("h:i A, M j", strtotime($row["request_time"])); ?></td>
                    </tr>
                <?php
                };
                ?>
            </table>
            <input id="removeSelect" type="submit" name="remove_selected" value="Remove Selected">
            <input id="restoreSelect" type="submit" name="restore_selected" value="Restore Selected">
    </form>

    <div id="pageNumbers">
        <?php
        $sql = "SELECT COUNT(*) FROM tbl_recyclebin_account_request";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<a href='superadmin_recyclebin.php?page=" . $i . "'>" . $i . "</a>";
        };
        echo $pagLink . "</div>";
        ?>
    </div>
    </div>

  

</body>

<script>
    // Get the input element and table
    var input = document.getElementById("searchInput");
    var table = document.querySelector("table");

    // Add an event listener to the input field
    input.addEventListener("keyup", function() {
        var filter = input.value.toUpperCase();
        var rows = table.querySelectorAll("tr.trHover");

        // Loop through all table rows
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].querySelectorAll("td");
            var found = false;

            // Loop through all table cells in a row
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell) {
                    var textValue = cell.textContent || cell.innerText;
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            // Toggle row visibility based on search result
            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>


</html>