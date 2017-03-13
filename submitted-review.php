<?php
session_start();
ob_start();

if (!isset($_GET['submitReviewBtn'])) {
    die('Visit the <a href="review.php">review page</a> first');
}

setReviewSessionVariables();
setReviewVariablesForDb();

$conn = mysqli_connect('localhost:3307', 'root', 'password') or
    die(mysqli_connect_error());
mysqli_select_db($conn, 'potatoes') or
    die(mysqli_error($conn));

$result = mysqli_query($conn, "SELECT * FROM reviews")or
    die(mysqli_error($conn));

/*
while($row = mysqli_fetch_assoc($result)) {
    echo "username: " . $row['username'] . "<br>";
    echo "movie: " . $row['movie'] . "<br>";
    echo "comments: " . $row['comments'] . "<br>";
    echo "foodchoice: " . $row['food'] . "<br>";
    echo "rating: " . $row['rating'] . "<br><br>";
}
*/

if (isset($_GET['submitReviewBtn'])) {
    reviewComplete();
}

mysqli_query($conn,
    "INSERT INTO reviews(movie, username, comments, food, rating)
            VALUES('$movie', '$username', '$comments', '$food', '$rating')") or
die(mysqli_error($conn));

function setReviewSessionVariables() {
    $_SESSION['movie'] = $_GET['movie'];
    $_SESSION['comments'] = $_GET['comments'];
    $_SESSION['foodchoice'] = $_GET['food'];
    $_SESSION['rating'] = $_GET['rating'];
}
function setReviewVariablesForDb() {
    global $movie, $username, $comments, $food, $rating;
    $movie = $_GET['movie'];
    $username = $_SESSION['username'];
    $comments = $_GET['comments'];
    $food = $_GET['food'];
    $rating = $_GET['rating'];
}
function reviewComplete() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Your review is completed.</h4>";
    echo "<a href='welcome.php'><button class='btn btn-success btn-lg'>Go back to welcome page</button></a>";
    echo "</div>";
}

ob_end_flush();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/potato-cartoon.png">
    <title>Review Validation</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-social/5.1.1/bootstrap-social.css">
    <script src="https://use.fontawesome.com/c829839222.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body id="backgroundWithoutImg">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" ></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php">Rotten Potatoes</a>
            <a href="http://www.imdb.com/"><img src="assets/images/potato-cartoon.png" style="height: 30pt; padding-top: 5.5pt;"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div>
    </div>
</nav>
</body>
</html>
