<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="m-table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Recycle Bin</title>
</head>
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


    .table_container form input[type="submit"] {
        margin-left: 150px;
        color: #000000;
        background: #fcba03;
        padding: 4px 20px;
        border-radius: 10px;
    }

    .table_container form input[name="remove_selected"] {
        font-size: 12px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body>
    <div class="main">
        <?php
        include "manager_menu.php";
        ?>
        <h1 class="main-title">Recycle Bin</h1>
        <div class="header-banner">
            <img src="colored highway night lights.jpg" class="banner-logo">
        </div>
        <div class="content-header">
            <h2 class="content-title"></h2>

            <?php
            // Pagination settings
            $itemsPerPage = 10;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the starting point for the current page
            $offset = ($currentPage - 1) * $itemsPerPage;

            // Retrieve data from the database
            $sql = "SELECT * FROM tbl_recyclebin LIMIT $offset, $itemsPerPage";
            $result = $conn->query($sql);

            // Total number of records
            $totalRecords = $conn->query("SELECT COUNT(*) as total FROM tbl_recyclebin")->fetch_assoc()['total'];

            // Calculate the total number of pages
            $totalPages = ceil($totalRecords / $itemsPerPage);
            ?>

            <!-- <div class="view-buttons">
                <button id="tableViewBtn">Table View</button>
                <button id="chartViewBtn">Chart View</button>
            </div> -->

            <div class="pagination-container">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>

        </div>



        <div class="table_container">
            <form method="post" action="m-recyclebin.php">
                <table id="removeJobTable">
                    <thead>
                        <tr>
                            <th></th> <!-- Checkbox column -->
                            <th>Job ID</th>
                            <th>Creator Name</th>
                            <th>Time Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row['job_id']; ?>"></td>
                                <td><?php echo $row['job_id']; ?></td>
                                <td><?php echo $row['creator_name']; ?></td>
                                <td><?php echo $row['time_created']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <input type="submit" name="remove_selected" value="Remove Selected">
            </form>

            <?php
            if (isset($_POST['remove_selected'])) {
                // Check if any rows were selected for removal
                if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
                    // Prepare the SQL statement to delete the record from the old table
                    $deleteSql = "DELETE FROM tbl_recyclebin WHERE JOB_ID = ?";

                    // Create a prepared statement
                    if ($stmt = $conn->prepare($deleteSql)) {
                        $stmt->bind_param("i", $jobId);
                        $stmt->execute();

                        // Iterate over the selected rows and delete each one
                        foreach ($_POST['selected_rows'] as $jobId) {
                            // Execute the statement for each selected job ID
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
        </div>
    </div>
</body>

</html>