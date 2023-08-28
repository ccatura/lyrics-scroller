<?php
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
}

if ($result) {
    echo 'Commited to DB';
} else {
    echo 'Was not commited to DB';
}

