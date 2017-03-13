<?php
session_start();
ob_start();

if ((!isset($_GET['loginBtn'])) and (!isset($_GET['registerBtn'])) and (!isset($_GET['guestBtn'])) and
    ($_SESSION['loggedin']) == 0) {
    die('Visit the <a href="login.html">front page</a> first');
}

if (isset($_GET['username']) and isset($_GET['password'])) {
    $username = trim($_GET['username']);
    $username = strip_tags($username);
    $password = trim($_GET['password']);
    $password = strip_tags($password);
}

$_SESSION['loggedin'] = 0;
$_SESSION['registered'] = 0;

// showCreds();

if (isset($_GET['loginBtn'])) {
    if (isset($_GET['username']) and isset($_GET['password'])) {
        // Connect to db
        $conn = mysqli_connect('localhost:3307', 'root', 'password') or
            die(mysqli_connect_error());
        mysqli_select_db($conn, 'potatoes') or
            die(mysqli_error($conn));

        $result = mysqli_query($conn, "SELECT * FROM users")or
            die(mysqli_error($conn));

        while($row = mysqli_fetch_assoc($result)) {
            // echo "username: " . $row['username'] . "<br>";
            // echo "password: " . $row['password'] . "<br><br>";
            if ($username == $row['username']) {
                $_SESSION['registered'] = 1;
                if ($password == $row['password']) {
                    createUserSession();
                    header('Location:welcome.php');
                } else if (!empty($password)){
                    incorrectPass();
                    break;
                }
            }
        }
        if (empty($username) and empty($password)) {
            emptyUserAndPass();
        } else if (empty($username)) {
            emptyUsername();
        } else if (($_SESSION['registered'] == 1) and empty($password)) {
            emptyPassword();
        } else if ($_SESSION['registered'] != 1){
            unregisteredUser();
        }
    }
} else if (isset($_GET['registerBtn'])) {
    header('Location:registration.html');
} else if (isset($_GET['guestBtn'])) {
    createGuestSession();
    header('Location:welcome.php');
}

function createUserSession() {
    global $username;
    $_SESSION['loggedin'] = 1;
    $_SESSION['username'] = $username;
    $_SESSION['firstPageLogin'] = 1;
}
function createGuestSession() {
    $_SESSION['loggedin'] = 1;
    $_SESSION['username'] = "Guest";
    $_SESSION['firstPageLogin'] = 1;
}
function emptyUserAndPass() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Empty username and password.</h4>";
    echo "<a href='login.html'><button class='btn btn-danger btn-lg'>Go Back</button></a>";
    echo "</div>";
}
function emptyUsername() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Empty username.</h4>";
    echo "<a href='login.html'><button class='btn btn-danger btn-lg'>Go Back</button></a>";
    echo "</div>";
}
function emptyPassword() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Empty password.</h4>";
    echo "<a href='login.html'><button class='btn btn-danger btn-lg'>Go Back</button></a>";
    echo "</div>";
}
function showCreds() {
    global $username;
    global $password;
    echo "<h3>username: $username<br></h3>";
    echo "<h3>password: $password<br></h3>";
}
function incorrectPass() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Incorrect password.</h4>";
    echo "<a href='login.html'><button class='btn btn-danger btn-lg'>Go Back</button></a>";
    echo "</div>";
}
function unregisteredUser() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Unregistered user.</h4>";
    echo "<a href='login.html'><button class='btn btn-danger btn-lg'>Go Back</button></a>";
    echo "</div>";
}

ob_end_flush();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/potato-cartoon.png">
    <title>Invalid Login</title>

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
            <a class="navbar-brand" href="login.html">Rotten Potatoes</a>
            <a href="http://www.imdb.com/"><img src="assets/images/potato-cartoon.png" style="height: 30pt; padding-top: 5.5pt;"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div>
    </div>
</nav>
</body>
</html>
