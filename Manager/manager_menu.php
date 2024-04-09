<?php
ob_start();
include "../session_handler.php";
include "../logindbase.php";

if (!isLoggedIn()) {
    header("Location: ../login_page.php");
    exit();
}
/*
if ($_SESSION['position'] != 'Manager') {
    header("Location: ../login_page.php");
    exit();
}
*/
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa2481bda4.js" crossorigin="anonymous"></script>
</head>

<style>
    .sidebar #dashboard_link {
        color: white;
        text-decoration: none;
        padding: 20px;
        min-width: 100px;
    }

    .sidebar #sidebar_link {
        color: white;
        text-decoration: none;
        min-width: 90px;
        padding: 10px;
    }

    .sidebar #sidebar_icons {
        margin-right: 10px;
        display: inline-block;
    }

    .sidebar {
        overflow: hidden;
        background-color: #0f0f0f;
        grid-area: 1 / 1 / 5 /-2;
        min-height: 100%;
        min-width: 100%;
    }

    .companylogo {
        margin-top: 20px;
        margin-left: 30px;
        margin-bottom: 20px;
        min-height: 50px;
        min-width: 50px;
    }

    .sidebar h3 {
        color: #ffffff;
        text-align: center;
        line-height: 25px;
        font-size: 20px;
        margin-bottom: 20px;
        font-size: 1rem;
        overflow-y: hidden;
    }

    .sidebar ul li {
        overflow: hidden;
        display: inline-block;
        width: 100%;
        list-style: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.5);
    }

    .sidebar ul li #sidebar_link {
        display: inline-block;
        width: 100%;
        height: 100%;
        transition: all 0.1s ease-in-out;
        font-size: 12px;
        line-height: 25px;
    }

    .sidebar ul li #sidebar_link:hover {
        background: #fff00f;
        color: #000000;
        font-weight: bold;
        font-size: 15px;
    }

    .greetings {
        display: grid;
        grid-template-rows: auto auto auto;
        grid-area: 1 / 2 / 2 / -1;
        z-index: 3;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 5px;
        width: 260px;
        height: 100px;
        place-self: start end;
        color: #ffffff;
        text-shadow: 2px 2px 4px #000000;
        font-size: 15px;
        border-bottom: none;
        padding-left: 10px;
    }


    .greetings .container_profilepic {
        grid-area: 2 / 1 / 3/ 2;
    }

    .greetings .container_profilepic img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        border: 1px solid #ffffff;
    }

    .greetings .username {
        grid-area: 1 / 1 / 2 / 2;
        top: 30px;
        left: 0px;
        padding: 10px;
    }

    .greetings a {
        grid-area: 2 / 1;
        overflow: hidden;
        color: white;
        text-decoration: none;
        font-size: 35px;
        margin-right: 30px;
        place-self: center center;
    }

    .greetings .logButton {
        grid-area: 2 / 1;
        place-self: center end;
    }

    .greetings .logButton button {
        cursor: pointer;
        height: 35px;
        min-width: 75px;
        border-radius: 7px;
        transition: all 0.1s ease-in-out;
    }

    .greetings .logButton button:hover {
        background: #ffc400;
        font-weight: bold;
        font-size: 15px;
    }
</style>
</head>

<body>



    <div class="greetings">
        <div class="username">
            <?php echo "Welcome, " . $_SESSION['username']; ?>
        </div>
        <div class="container_profilepic">
            <img src="profilepic.jpg">
        </div>
        <a href="../user_settings.php"><i class="fa-solid fa-cog"></i></a>
        <div class="logButton">
            <form action="manager_menu.php" method="post">
                <button type="submit" name="logoutButton"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </div>
    <div class="sidebar">
        <img src="imprint customs logo 1.png" class="companylogo">
        <h3><a id="dashboard_link" href="m-jobs-in-progress.php">Manager Dashboard</a></h3>
        <ul>
            <li><a id="sidebar_link" href="./m-jobs-in-progress.php"><i id="sidebar_icons" class="fa-solid fa-bars-progress"></i>Jobs In Progress</a></li>
            <li><a id="sidebar_link" href="./m-job-history.php"><i id="sidebar_icons" class="fa-solid fa-clock-rotate-left"></i>Job History</a></li>
            <li><a id="sidebar_link" href="./m-job-list.php"><i id="sidebar_icons" class="fa-solid fa-list"></i>Job List</a></li>
            <li><a id="sidebar_link" href="./m-employee-status.php"><i id="sidebar_icons" class="fa-solid fa-palette"></i>Employee Status</a></li>
            <li><a id="sidebar_link" href="./m-action-logs.php"><i id="sidebar_icons" class="fa-solid fa-person-circle-exclamation"></i>Action Logs</a></li>
            <li><a id="sidebar_link" href="./m-remove-jobs.php"><i id="sidebar_icons" class="fa-solid fa-trash"></i>Remove Jobs</a></li>
            <li><a id="sidebar_link" href="./m-recyclebin.php"><i id="sidebar_icons" class="fa-solid fa-recycle"></i>Recycle Bin</a></li>
            <li><a id="sidebar_link" href="./m-createtemplate.php"><i id="sidebar_icons" class="fa-solid fa-plus"></i>Add Product Template</a></li>
        </ul>
    </div>

</body>

<?php
    if (isset($_POST['logoutButton'])) {
        logoutUser();
        header("Location: ../login_page.php");
        exit();
    }
    ?>
</html>
<?php ob_end_flush(); ?>