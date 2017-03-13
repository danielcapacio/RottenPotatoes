<?php
session_start();
ob_start();

if (!isset($_GET['registerCompleteBtn'])) {
    die('Visit the <a href="registration.html">registration page</a> first');
}

$firstname = trim($_GET['firstname']);
$firstname = strip_tags($firstname);
$lastname = trim($_GET['lastname']);
$lastname = strip_tags($lastname);
$email = trim($_GET['email']);
$email = strip_tags($email);
$username = trim($_GET['username']);
$username = strip_tags($username);
$password = trim($_GET['password']);
$password = strip_tags($password);

$_SESSION['registrationComplete'] = 0;
$_SESSION['duplicateUsername'] = 0;
$_SESSION['invalidUsername'] = 0;

// showCreds();

$conn = mysqli_connect('localhost:3307', 'root', 'password') or
    die(mysqli_connect_error());
mysqli_select_db($conn, 'potatoes') or
    die(mysqli_error($conn));

$result = mysqli_query($conn, "SELECT * FROM users")or
    die(mysqli_error($conn));

if (($username == "Guest") || ($username == "guest")) {
    $_SESSION['invalidUsername'] = 1;
    invalidUsername();
} else {
    // check for duplicate username
    while($row = mysqli_fetch_assoc($result)) {
        // echo "username: " . $row['username'] . "<br>";
        if ($username == $row['username']) {
            $_SESSION['duplicateUsername'] = 1;
            duplicateUsername();
            break;
        }
    }
    // if there are is no duplicate found, then proceed to add info into db
    if ($_SESSION['duplicateUsername'] != 1) {
        mysqli_query($conn,
            "INSERT INTO users(username, password, firstname, lastname, email)
            VALUES('$username', '$password', '$firstname', '$lastname', '$email')") or
                die(mysqli_error($conn));
        $_SESSION['registrationComplete'] = 1;
    }
    if ($_SESSION['registrationComplete'] != 0) {
        registrationComplete();
    }
}

function showCreds() {
    global $firstname;
    global $lastname;
    global $email;
    global $username;
    global $password;
    echo "<h3>firstname: $firstname<br></h3>";
    echo "<h3>lastname: $lastname<br></h3>";
    echo "<h3>email: $email<br></h3>";
    echo "<h3>username: $username<br></h3>";
    echo "<h3>password: $password<br></h3>";
}
function registrationComplete() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Registration complete.</h4>";
    echo "<a href='login.html'><button class='btn btn-success btn-lg'>Back to front page</button></a>";
    echo "</div>";
}
function duplicateUsername() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Incomplete Registration. Duplicate username.</h4>";
    echo "<a href='registration.html'><button class='btn btn-danger btn-lg'>Please register again</button></a>";
    echo "</div>";
}
function invalidUsername() {
    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Incomplete Registration. Cannot use 'Guest' or 'guest' as a username.</h4>";
    echo "<a href='registration.html'><button class='btn btn-danger btn-lg'>Please register again</button></a>";
    echo "</div>";
}

ob_end_flush();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/potato-cartoon.png">
    <title>Registration Complete</title>

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
