<?php 
include "../session_handler.php";
include "../logindbase.php";
	
	if (!isLoggedIn()){
		header("Location: ../login_page.php");
		exit();
	}
	if ($_SESSION['position'] != 'Superadmin'){
		header("Location: ../login_page.php");
		exit();
	}	
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    /* Sidebar styles */
    .sidebar {
        width: 100%;
        height: 100vh;
        background-color: #FFFFFF;
        padding-top: 6%;
        padding-right: 4%;
        padding-left: 4%;
        padding-bottom: 100vh;
        float: left;
        font-size: 1.5vw;
        font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
        font-weight: 400;
        font-style: normal;
        color: #000000;
        margin-left: 0;
        text-align: center;
    }

    .sidebar h3 {
        margin: 0;
        color: red;
        font-size: 1.5em;
        text-shadow: 0 0 2px #000000;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        text-align: center;
        text-decoration: none;
    }

    .sidebar ul li {
        border-bottom: 1px solid #ccc;
        padding: 1px 0;
    }

    .sidebar a {
        color: black;
        text-decoration: none;
        text-align: center;
        display: block;
        padding: 10px 0;
    }

    .sidebar img {
        border-radius: 5px;
    }


</style>

<body>
    <div class="sidebar">
        <img src="../images/imprint customs logo 1.png" class="companylogo">
        <h3>Admin</h3>
        <ul>

            <form action="superadmin_menu.php" method="post">
                <div class="logButton">
                    <button type="submit" name="logoutButton">Logout</button>
                </div>
            </form>
        </ul>
    </div>
    <?php
    if (isset($_POST['logoutButton'])) {
        logoutUser();
        header("Location: ../login_page.php");
        exit();
    }
    ?>
</body>

</html>