<?php
    if (isset($_GET['page'])) {
        $page_title = $_GET['page'];
    } else {
        $page_title = 'Lyrics Scroller';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title><?php echo $page_title; ?></title>
</head>
<body>

<?php
    include_once('./db_connect.php');
    include_once('./functions.php');
    include_once('./Song.php');

    session_start();

    if (isset($_GET['page']) /* IF USER NAME IS LOGGED IN */) {
        $page = strtolower($_GET['page']);
    } else {
        $page = 'home';
    }
    echo "<div class='page-container'>";
        echo "<div class='header'>";
            include_once('./header.php');
        echo "</div>";

        echo "<div class='content'>";
            include_once("./{$page}.php");
        echo "</div>";

        echo "<div class='footer'>";
            include_once('./footer.php');
        echo "</div>";
    echo "</div>";
?>
</body>
</html>