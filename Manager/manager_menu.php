<?php 
include "../session_handler.php";
include "../logindbase.php";
	
	if (!isLoggedIn()){
		header("Location: ../login_page.php");
		exit();
	}
	if ($_SESSION['position'] != 'Manager'){
		header("Location: ../login_page.php");
		exit();
	}	
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

<style>

        a{
            color: white;
            text-decoration: none;
            padding: 20px;
        }
        i{
            margin-right: 10px;
            display: block;
        }
 
        .sidebar{
            background-color: #0f0f0f;
            grid-area: 1 / 1 / 5 /-2 ;
            height:100%;
        }
		.companylogo{
            margin-top: 20px;
			margin-left: 58px;
			margin-bottom: 20px;
            height: 100px;
            width: 100px;
        }
        .sidebar h3{
            color: #ffffff;
            text-align: center;
            line-height: 25px;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .sidebar ul li{
            width: 100%;
            list-style: none;
            line-height: 25px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        }
        .sidebar ul li a{
            display: block;
            width: 100%;
            height: 100%;
            transition: all 0.1s ease-in-out;
			font-size: 12px;
        }
        .sidebar ul li a:hover{
            background: #fff00f;
            color: #000000;
            font-weight: bold;
            font-size: 1.1em;
        }
		.sidebar .greetings{
			color: #ffffff;
			font-size: 15px;
			margin-left: 15px;
			margin-bottom: 20px;
			border-bottom: none;
			line-height: 30px;
		}
		.sidebar form{
			margin-left: 55px;
			margin-top: 0px;
		}
		.sidebar button{
			color: #000000;
			background: #cccccc;
			padding: 4px 20px;
			border-radius: 10px;
			transition: all 0.4s ease;
		}
		.sidebar button:active{
			transform: scale(0.70);
		}
		.sidebar button[name="logoutButton"]{
			font-size: 12px;
			font-weight: bold;
			font-family: Arial, Helvetica, sans-serif;
		}


</style>
</head>
<body>



<div class="sidebar">
	<image src="imprint customs logo 1.png" class="companylogo">
    <h3><a href="m-jobs-in-progress.php">MANAGER</a></h3>
    <ul>
        <li class="greetings"><?php echo "Welcome, ".$_SESSION['username'];?></li>
        <li><a href="./m-jobs-in-progress.php"><i class="fa-solid fa-bars-progress"></i>Jobs In Progress</a></li>
        <li><a href="./m-job-history.php"><i class="fa-solid fa-clock-rotate-left"></i>Job History</a></li>
        <li><a href="./m-job-list.php"><i class="fa-solid fa-list"></i>Job List</a></li>
        <li><a href="./m-artists-status.php"><i class="fa-solid fa-palette"></i>Artists Status</a></li>
        <li><a href="./m-action-logs.php"><i class="fa-solid fa-person-circle-exclamation"></i>Action Logs</a></li>
        <li><a href="./m-remove-jobs.php"><i class="fa-solid fa-trash"></i>Remove Jobs</a></li>
        <li><a href="./m-recyclebin.php"><i class="fa-solid fa-recycle"></i>Recycle Bin</a></li>
        <form action="manager_menu.php" method="post">
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
