<?php
include "../logindbase.php";
include "../session_handler.php";
	
	if (!isLoggedIn()){
		header("Location: ../login_page.php");
		exit();
	}
	if ($_SESSION['position'] != 'Artist'){
		header("Location: ../login_page.php");
		exit();
	}
?>

<?php
	if ($_SESSION['position'] == 'Artist'){
	$username = $_SESSION['username'];
    $fetchStatusSql = "SELECT artist_status FROM tbl_artist_status WHERE artist_name = ?";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare($fetchStatusSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($artistStatus);

    // Fetch the result
    $stmt->fetch();
    
    // Set $_SESSION['busy'] based on the fetched status
    $_SESSION['busy'] = $artistStatus;

    // Close the statement and database connection
    $stmt->close();
	}
	
?>

<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

        /* Sidebar styles */
        .sidebar {
    		width: 15vw;
    		background-color: gray;
			border: solid 3px white;
			border-radius: 20px;
    		padding-top: 30px;
    		padding-right: 4%;
    		padding-left: 4%;
    		padding-bottom: 10px;
    		float: left;
    		font-size: 1.5vw;
    		font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Verdana", sans-serif;
    		font-weight: 400;
    		font-style: normal;
    		color: #000000;
    		margin-left: 0;
    		text-align: center;
			z-index:1;
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
	
		#logo {
			height: 150px;
			width: 150px;
			border: 0 0 0 0;
			border-radius: 75px;
			margin-bottom: 30px;
		}
	
		li:hover {
			background-color: lightgray;
		}
	
        .menu {
            list-style: none;
            padding: 0;
        }
	
        .menu li {
            margin-bottom: 10px;
        }
	
		button {
			font-size: 16px;
			border: 2px solid red;
			background-color: lightpink;
			border-radius: 5px;
			margin: 150px 0 30px 0;
			padding: 3px 7px 3px 7px;
			cursor: pointer;
		}
	
		button:hover {
			background-color: lightcoral;
			border: 2px solid red;
		}
	
</style>

	
	<div class="sidebar">
		<img src="../images/imprint customs logo 2.png" id="logo">
		<h3><?php echo "Welcome, ".$_SESSION['username'];?></h3>
        <ul class="menu">
            <?php if ($_SESSION['busy'] == 'busy') : ?>
			  <li>Busy Content</li>
			<?php else : ?>
			  <li>Jobs Open</li>
			<?php endif; ?>
  		<form action="artist_menu.php" method="post">
        <button type="submit" name="logoutButton">🔒 Logout</button>
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