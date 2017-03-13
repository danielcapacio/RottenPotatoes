<?php
session_start();
loggedOut();

function loggedOut() {
    $_SESSION['loggedin'] = 0;
    $_SESSION['firstPageLogin'] = 1;

    echo "<div style='padding-top: 5pt; padding-left: 10pt;'>";
    echo "<h4>Logged out successfully.</h4>";
    echo "<a href='login.html'><button class='btn btn-success btn-lg'>Back to front page</button></a>";
    echo "</div>";
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/potato-cartoon.png">
    <title>Logout</title>

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

