<?php
    if (isset($_GET['page'])) {
        $page_title = $_GET['page'];
    } else {
        $page_title = 'Lyrics Scroller';
    }



    //show errors
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src='./scripts.js' defer></script>
    <title>Lyrics Scroller</title>
</head>
<body>

<?php
    include_once('./db_connect.php');
    include_once('./functions.php');
    include_once('./Song.php');
    session_start();
    $_SESSION['conn'] = $conn;
    // $_SESSION['user_name'] = 'ccatura';
    // unset($_SESSION['user_name']);

    if ((isset($_GET['page']) && isset($_SESSION['user_name'])) || (isset($_GET['page']) && !isset($_SESSION['user_name']))) {
        $page = strtolower($_GET['page']);
    } elseif (!isset($_GET['page']) && isset($_SESSION['user_name'])) {
        $page = 'song_list';
    } else {
        header("Location: ./?page=login");
    }
    echo "<div class='page-container' id='page-container'>";
        echo "<div class='header'>";
            include_once('./header.php');
        echo "</div>";

        echo "<div class='content'>";
            include_once("./{$page}.php");
        echo "</div>";
    echo "</div>";
?>
</body>
</html>