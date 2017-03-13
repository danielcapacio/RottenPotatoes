<?php
session_start();
ob_start();

if ($_SESSION['loggedin'] != 1) {
    die('Visit the <a href="login.html">front page</a> first');
}
$username = $_SESSION['username'];

function showReviews() {
    $conn = mysqli_connect('localhost:3307', 'root', 'password') or
    die(mysqli_connect_error());
    mysqli_select_db($conn, 'potatoes') or
    die(mysqli_error($conn));

    $result = mysqli_query($conn, "SELECT * FROM reviews")or
    die(mysqli_error($conn));

    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $movie = $row['movie'];
        $username = $row['username'];
        $comments = $row['comments'];
        $food = $row['food'];
        $rating = $row['rating'];
        $poster = $movie . '.jpg';
        if ($counter % 2 == 0) {
            echo "
                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <h2>$movie</h2>
                        <h4><i>Posted by: </i><label>$username</label></h4>
                        <img style='border: 1px solid black' src='assets/movie-posters/$movie.jpg'>
                        <p>$comments</p>
                        <p><label>Suggested food while watching: </label> $food</p>
                        <!-- <p><a class='btn btn-default' href='#' role='button''>View details &raquo;</a></p> -->
                    </div>
                ";
        } else {
            echo "
                <div class=\"col-md -6\">
                    <h2>$movie</h2>
                    <h4><i>Posted by: </i><label>$username</label></h4>
                    <img style='border: 1px solid black' src='assets/movie-posters/$movie.jpg'>
                    <p>$comments</p>
                    <p><label>Suggested food while watching: </label> $food</p>
                    <!-- <p><a class='btn btn-default' href='#' role='button''>View details &raquo;</a></p> -->
                </div>
            </div>
            ";
        }
        $counter++;
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
    <title>Rotten Potatoes</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-social/5.1.1/bootstrap-social.css">
    <script src="https://use.fontawesome.com/c829839222.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body id="backgroundWithImg">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php">Rotten Potatoes</a>
            <a href="http://www.imdb.com/"><img src="assets/images/potato-cartoon.png" style="height: 30pt; padding-top: 5.5pt;"></a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
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

<div class="jumbotron" style="background: transparent">
    <div class="container">
        <h2>Enjoy content on movie reviews made by anyone!</h2>
        <p>A website to poke and have fun at movie reviews.</p>
        <p><a class="btn btn-primary btn-lg" href="showPosters.php" role="button">Show available movies to review &raquo;</a></p>
    </div>
</div>

<div class="container" style="background-color: #a3cdae; border: 1px solid black;">
    <?php
        showReviews();
    ?>
    <!-- <hr style="border-color: black"> -->
    <footer class="text-center">
        <p>Copyright &copy; Rotten Potatoes by Daniel Capacio</p>
        <a target="_blank" href="https://www.facebook.com/" class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a>
        <a target="_blank" href="https://twitter.com" class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
        <a target="_blank" href="https://www.linkedin.com" class="btn btn-social-icon btn-linkedin"><span class="fa fa-linkedin"></span></a>
        <a target="_blank" href="https://bitbucket.org" class="btn btn-social-icon btn-bitbucket"><span class="fa fa-bitbucket"></span></a>
        <a target="_blank" href="https://github.com/" class="btn btn-social-icon btn-github"><span class="fa fa-github"></span></a>
        <br>&nbsp;
    </footer>
</div>
</body>
</html>
