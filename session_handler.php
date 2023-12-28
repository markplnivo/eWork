<?php
session_start();

function loginUser($username, $position) {
    $_SESSION['username'] = $username;
    $_SESSION['position'] = $position;
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function isLoggedIn() {
    return isset($_SESSION['username']);
}

?>
