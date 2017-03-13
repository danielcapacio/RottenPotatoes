<?php
session_start();

if ($_SESSION['loggedin'] != 1) {
    die('Visit the <a href="login.html">front page</a> first');
}
if ($_SESSION['loggedin'] == 1) {
    header('Location:welcome.php');
}
$username = $_SESSION['username'];
?>

