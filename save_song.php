<?php

// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php
// might have to put some of this into the functions.php



include_once('./db_connect.php');
include_once('./functions.php');
include_once('./Song.php');
session_start();

$data = json_decode(file_get_contents("php://input"), true);




$song_array = json_decode($data, true);
$user_name  = $_SESSION['user_name'];
$id         = (int)$song_array['id'];
$title      = $song_array['title'];
$sub_title  = $song_array['sub_title'];
$lyrics     = $song_array['lyrics'];
$message    = $song_array['message'];
echo "{$user_name} {$id} {$title} {$sub_title}";

if ($id != 0) {
    $result = mysqli_query($conn,  "UPDATE `songs` SET title = '{$title}', sub_title = '{$sub_title}', lyrics = '{$lyrics}' WHERE `id` = '{$id}';");
} else {
    $result = mysqli_query($conn,  "REPLACE INTO `songs` (`user_name`, `title`, `sub_title`, `lyrics`) VALUES ('{$user_name}','{$title}','{$sub_title}','{$lyrics}');");
}


if ($result) {
    echo "{$message}";
} else {
    echo 'There was a problem. Please, try again.';
}



