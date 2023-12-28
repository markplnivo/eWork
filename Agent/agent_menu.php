<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    /* Sidebar Styles */
    .sidebar {
        display:grid;
        place-self: start stretch;
        grid-area: 1 / 1 / -1 / 2;
        width: 15%;
        background-color: #313b4b;
        /* Sidebar background color */
        font-size: 1rem;
        font-weight: 400;
        color: #fff;
        position: fixed;
        overflow: hidden;
        height:100%;
        border-right: 3px solid #485c6a;
        /* Sidebar border color */
        transition: margin-left 1s ease;
        /* Sidebar transition */
        margin-left: -11%;
        /* Initial state off-screen */
        z-index: 1;
    }

    .sidebar:focus {
        margin-left: 0;
        /* Sidebar focused state */
        z-index: 2;
    }

    .sidebar img {
        width: 100%;
        height: auto;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .sidebar h3 {
        margin-top: 15vh;
        margin-bottom: 20px;
        color: #fff;
        font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
        text-align: left;
        font-weight: bold;
        font-size: larger;
        line-height: 60px;
        margin-left: 20px;
        text-transform: capitalize;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        text-align: left;
    }

    .sidebar ul li {
        padding: 0;
        font-family: Constantia, "Lucida Bright", "DejaVu Serif", Georgia, serif;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid #485c6a;
        /* Sidebar list item border */
        transition: background-color 0.3s;
        /* Hover transition */
    }

    .sidebar ul li:last-child {
        border-bottom: none;
        /* Last item border removal */
    }

    .sidebar ul li:hover {
        background-color: #3a4755;
        /* Hover background color */
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        display: block;
        padding: 10px 0;
        transition: color 0.3s;
        /* Link color transition */
    }

    .sidebar a:hover {
        color: #00d1ff;
        /* Hover link color */
    }

    .sidebar a.job-link:hover {
        color: #ffc40c;
        /* Specific link hover color */
    }

    .sidebar a.logout-button {
        background-color: #4caf50;
        /* Logout button background color */
        color: #fff;
        padding: 10px 20px;
        border-radius: 4px;
        display: block;
        margin: auto;
        margin-top: 20px;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
        /* Logout button transitions */
    }

    .sidebar a.logout-button:hover {
        background-color: #333;
        /* Hover state for logout button */
        color: #e0e0e0;
        transform: scale(1.05);
        /* Button scale on hover */
    }

    .menu {
        list-style: none;
        padding: 0;
    }

    .menu li {
        margin: 50px;
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
<div class="sidebar" tabindex="0">
    <center>
    <a href="agent_home.php">
        <h3>Agent Dashboard</h3>
    </a>
    <ul class="menu">
        <img src="ic.png">
        <li><?php echo "Welcome, " . $_SESSION['username']; ?></li>
        <li><a href="agent_home.php">Job Creation</a></li>
        <li><a href="agent_joblist.php">Job List</a></li>
    </ul>
        <form action="agent_menu.php" method="post">
        <center><button type="submit" name="logoutButton">Logout</button></center>
    
        </form>
    
    </center>
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