<?php
session_start();
ob_start();

if ($_SESSION['loggedin'] != 1) {
    die('Visit the <a href="login.html">front page</a> first');
}
$username = $_SESSION['username'];
$_SESSION['selectedMovie'] = "";
$_SESSION['selectedMovieImg'] = "";
$_SESSION['movie'] = "";
$_SESSION['comments'] = "";
$_SESSION['foodchoice'] = "";
$_SESSION['rating'] = "";

function getMovies() {
    $conn = mysqli_connect('localhost:3307', 'root', 'password') or
        die(mysqli_connect_error());
    mysqli_select_db($conn, 'potatoes') or
        die(mysqli_error($conn));

    $result = mysqli_query($conn, "SELECT * FROM movies_info")or
        die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)) {
        $movieName = $row['movie'];
        $aPath = "<a href='#' onclick=\"
                $('#poster').attr('src', 'assets/movie-posters/$movieName.jpg');
                $('input[name=movie]').val('$movieName');
              \" name='$movieName'>$movieName</a>";
        echo "<li>";
        echo $aPath;
        echo "</li>";
    }
}
function welcomeUser() {
    global $username;
    if ($_SESSION['firstPageLogin'] == 1) {
        if ($username == "Guest") {
            echo "Welcome <i>$username</i>!";
        } else {
            echo "Welcome $username!";
        }
        $_SESSION['firstPageLogin']= 0;
    } else {
        if ($username == "Guest") {
            echo "<i>$username</i>";
        } else {
            echo "$username";
        }
    }
}

ob_end_flush();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/potato-cartoon.png">
    <title>Write a review</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-social/5.1.1/bootstrap-social.css">
    <script src="https://use.fontawesome.com/c829839222.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body id="backgroundWithoutImg">
<div class="container">
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

            <div id="navbar" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="review.php">Write a review</a></li>
                    <li><a href="showPosters.php">All Movies</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php
                                welcomeUser();
                            ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form class="form-signin" action="submitted-review.php" method="get">
        <h2 class="form-signin-heading" style="text-align: center">Write a review!</h2>
        <hr style="border-color: black">
        <div class="dropdown" style="text-align: center;">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="font-size: 20px;">Choose a movie
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                    getMovies();
                ?>
            </ul>
        </div> <br>

        <img id="poster" src="assets/images/blank-poster.jpg" style=" display: block; margin: 0 auto; border: 1px solid black;"><br>
        <input type="text" id="movieField" class="form-control" placeholder="No movie selected" value="" required name="movie"><br>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" name="comments"></textarea>
        </div><br>

        <label>Recommended food choice:</label><br>
        <div class="foodchoice">
            <label class="radio-inline"><input type="radio" name="food" value="popcorn"><img style="height: 125px" src="assets/images/popcorn-flat.png"></label>
            <label class="radio-inline"><input type="radio" name="food" value="burger"><img style="height: 125px" src="assets/images/burger-flat.png"></label>
            <label class="radio-inline"><input type="radio" name="food" value="hotdog"><img style="height: 125px" src="assets/images/hotdog-flat.png"></label>
            <label class="radio-inline"><input type="radio" name="food" value="taco"><img style="height: 125px" src="assets/images/taco-flat.png"></label>
        </div>
        <br><br>

        <label>Rating:</label>
        <label class="radio-inline"><input type="radio" name="rating" value="1">1 Star</label>
        <label class="radio-inline"><input type="radio" name="rating" value="2">2 Star</label>
        <label class="radio-inline"><input type="radio" name="rating" value="3">3 Star</label>
        <label class="radio-inline"><input type="radio" name="rating" value="4">4 Star</label>
        <label class="radio-inline"><input type="radio" name="rating" value="5">5 Star</label><br><br><br>

        <button class="btn btn-lg btn-success btn-block" type="submit" name="submitReviewBtn">Submit</button>
    </form>
</div>
</body>
</html>
