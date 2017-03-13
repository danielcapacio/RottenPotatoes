<?php
session_start();
ob_start();

if ($_SESSION['loggedin'] != 1) {
    die('Visit the <a href="login.html">front page</a> first');
}
$username = $_SESSION['username'];

function showAllImagePosters() {
    $conn = mysqli_connect('localhost:3307', 'root', 'password') or
        die(mysqli_connect_error());
    mysqli_select_db($conn, 'potatoes') or
        die(mysqli_error($conn));

    $result = mysqli_query($conn, "SELECT * FROM movies_info")or
            die(mysqli_error($conn));

    echo "<div style='text-align: center'>";
        $link = "review.php";
        $counter = 1;
        while($row = mysqli_fetch_assoc($result)) {
            $movieName = $row['movie'];
            $imagePath = 'assets/movie-posters/' . $movieName . '.jpg';
            echo "<a href=$link><img style='border: 1px solid black; margin-left: 10pt; margin-top: 10pt; margin-bottom: 10pt; margin: right; src=\"" . $imagePath . "\"></a>";
            if ($counter % 10 == 0) {
                echo "<br>";
            }
            $counter++;
        }
    echo "</div>";
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
    <title>All Movies</title>

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
<?php
    showAllImagePosters();
?>
</body>
</html>

