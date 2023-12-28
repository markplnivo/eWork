<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
   /* Sidebar styles */
        .sidebar {
    width: 15%;
    background-color: #26D972;
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
        .menu {
            list-style: none;
            padding: 0;
        }
        .menu li {
            margin-bottom: 10px;
        }
</style>
<?php
include "../logindbase.php";
include "../session_handler.php";
	
if (!isLoggedIn() || $_SESSION['position'] !== 'Agent') {
    header("Location: ../login_page.php");
    exit();
}

?>
    <div class="sidebar">
        <a href="agent_home.php"><h3>Agent Dashboard</h3></a>
        <ul class="menu">
        	<li><?php echo "Welcome, ".$_SESSION['username'];?></li>
			<li><a href="agent_home.php">Job Creation</a></li>
			<li><a href="agent_joblist.php">Job List</a></li>
  		<form action="agent_menu.php" method="post">
        <button type="submit" name="logoutButton">Logout</button>
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

<body>
</body>
</html>