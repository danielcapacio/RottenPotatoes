<?php
session_start();
ob_start();

$conn = mysqli_connect('localhost:3307', 'root', 'password') or
    die(mysqli_connect_error());
mysqli_select_db($conn, 'potatoes') or
    die(mysqli_error($conn));

$result = mysqli_query($conn, "SELECT * FROM movies_info")or
    die(mysqli_error($conn));

while($row = mysqli_fetch_assoc($result)) {
    $movie = $row['movie'];
    if ($_SESSION['selectedMovie'] == $row['movie']) {
        $_SESSION['selectedMovieImg'] = $movie . '.jpg';
        break;
    }
}
header('Location:review.php');

ob_end_flush();
?>