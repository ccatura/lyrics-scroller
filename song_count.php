<?php

include_once('./db_connect.php');
include_once('./functions.php');
include_once('./Song.php');
session_start();

$_SESSION['conn'] = $conn;


$conn       = $_SESSION['conn'];
$user_name  = $_SESSION['user_name'];
$result     = mysqli_query($conn,  "SELECT count(*) as 'count' FROM songs
                                    WHERE user_name = '$user_name';");

while ($row = mysqli_fetch_assoc($result)) {
    $output = $row['count'];
}

return $output;

