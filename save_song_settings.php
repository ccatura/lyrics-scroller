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

$settings_array = json_decode($data, true);
$user_name  = $_SESSION['user_name'];
$song_id    = $_SESSION['song_object']->id;
$platform   = $settings_array['platform'];

foreach($settings_array as $setting => $value) {
    if ($setting == 'platform') continue;
    $result = mysqli_query($conn,  "REPLACE INTO `song_settings` (`user_name`, `song_id`, `platform`, `setting`, `value`) VALUES ('{$user_name}','{$song_id}','{$platform}','{$setting}','{$value}');");

    // echo $value;
}

if ($result) {
    echo ucwords($platform) . " settings saved!";
} else {
    echo 'There was a problem. Please, try again.';
}

