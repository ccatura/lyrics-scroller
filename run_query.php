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

$data_array = json_decode($data, true);
$user_name  = $_SESSION['user_name'];

// var_dump($data);

foreach($data_array as $key => $value) {
    if ($key == 'sql') {
        $query = $value;
        $result = mysqli_query($conn, "{$query}");
    } elseif ($key == 'message') {
        $message = $value;
    }
}

if ($result) {
    echo "{$message}";
} else {
    echo 'There was a problem. Please, try again.';
}

